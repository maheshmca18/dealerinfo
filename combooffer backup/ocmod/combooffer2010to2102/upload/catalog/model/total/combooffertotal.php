<?php
class ModelTotalComboOfferTotal extends Model {
	
	protected function bundlesWithQuantity() {
		$this->load->model('catalog/product');
		$this->load->model('module/combo_offerm');
		
		$CustomBundles = $this->model_module_combo_offerm->getTotalcomboofferldetails();
		$showingBundles = array();
		if (isset($CustomBundles)) {
			foreach ($CustomBundles as $key => $CurrentBundle) {
				$productid= explode(",",$CurrentBundle['c_product']);
				foreach ($productid as $result) {
					$product_info = $this->model_catalog_product->getProduct($result);
					if ($product_info && $product_info['quantity']<=0) {
						unset($showingBundles[$key]);
						break;
					} else {
						$showingBundles[$key] = $CurrentBundle;
					}
				}
			}
		}
	
		return $showingBundles;	
	}
	
	public function getTotal(&$total_data, &$total, &$taxes) {
		$cartProducts = $this->cart->getProducts();
		$cartProductsFlat = array();
		$cartProductsQuantities = array();
		$taxClasses = array();
		$matchingBundles = array();
		foreach ($cartProducts as $product) {
			$cartProductsFlat[] = $product['product_id'];
			if (empty($cartProductsQuantities[$product['product_id']])) {
				$cartProductsQuantities[$product['product_id']] = $product['quantity'];
			} else {
				$cartProductsQuantities[$product['product_id']] += $product['quantity'];
			}
			
			$taxClasses[$product['product_id']] = $product['tax_class_id'];
		}
		
		$bndlSettings = $this->bundlesWithQuantity();
		$bundles = isset($bndlSettings) ? $bndlSettings : array();
		usort($bundles, array($this, 'cmp'));
		
$setting['MultipleBundles']=1;
		$discountsApply = (isset($setting['MultipleBundles'])) ? true : false;
		
		if (isset($bundles)) {
			foreach ($bundles as $bundle) { 
					$productid= explode(",",$bundle['c_product']);

				if (array_diff($productid, $cartProductsFlat) === array()) { 
					$bundleQuantities = array(); 
					foreach($productid as $product_id) { 
						if (empty($bundleQuantities[$product_id])) {
							$bundleQuantities[$product_id] = 1;
						} else {
							$bundleQuantities[$product_id]++;
						}
					}
					
					for(;;) {
						foreach($bundleQuantities as $product_id=>$quantity) {
							if (!isset($cartProductsQuantities[$product_id]) || ($quantity > $cartProductsQuantities[$product_id])) {
								continue 3;
							}
						}
						
						foreach($bundleQuantities as $product_id=>$quantity) {
							$cartProductsQuantities[$product_id] -= $quantity;
						}
						
						if (!array_key_exists($bundle['c_id'], $matchingBundles)) {
							$matchingBundles[$bundle['c_id']] = array();
							$matchingBundles[$bundle['c_id']][] = $bundle;
						} else if ($discountsApply) {
							$matchingBundles[$bundle['c_id']][] = $bundle;
						}
					}
				}
			}
			
			$this->load->model('catalog/product');
			
			if (!empty($matchingBundles)) {
				$this->language->load('total/combooffertotal');
				
				$grandTotal = 0;
				foreach ($matchingBundles as $bundle) {
					$taxClassesUnique = array();
					foreach ($bundle as $bndl) { $productid= explode(",",$bndl['c_product']);
						foreach ($productid as $product) {
							$taxClassesUnique[] = $taxClasses[$product];
						}
					}	
					$taxClassesUnique = array_unique($taxClassesUnique);
					foreach($bundle as $instance) { 
						foreach ($taxClassesUnique as $taxClassId) {
							$tax_rates = $this->tax->getRates((float)$instance['c_discount_amount'], $taxClassId);
							foreach ($tax_rates as $tax_rate) {
								if ($tax_rate['type'] == 'P') {
									$taxes[$tax_rate['tax_rate_id']] -= $tax_rate['amount'];
								}
							}
						}
						$grandTotal += (float)$instance['c_discount_amount'];
					}
				}
				
				$total_data[] = array(
					'code'       => 'combooffertotal',
					'title'      => $this->language->get('entry_title'),
					'text'       => $this->currency->format(-$grandTotal),
					'value'      => -$grandTotal,
					'sort_order' => $this->config->get('combooffertotal_sort_order')
				);
		
				$total -= (float)$grandTotal;
				if ($total < 0) {
					$total = 0;
				}
			}
		}
	}
	
	private function cmp($a, $b) {
		if ($a == $b) {
             return 0;
		}
		
		return (count($a['c_product']) > count($b['c_product'])) ? -1 : 1;
	}	
}
?>
