<?php
class ModelTotalComboOfferTotal extends Model {
	
	protected function bundlesWithQuantity() {
		$this->load->model('catalog/product');
		$this->load->model('module/combo_offerm');
		
		$CustomBundles = $this->model_module_combo_offerm->getTotalcomboofferldetails();
		$showingBundles = array();
		//print_r($CustomBundles);
		if (isset($CustomBundles)) {
			foreach ($CustomBundles as $key => $CurrentBundle) {
//echo $CurrentBundle['c_product'];
				$productid= explode(",",$CurrentBundle['c_product']);
//print_r($productid);
				foreach ($productid as $result) { //echo $result;
					$product_info = $this->model_catalog_product->getProduct($result);
					//print_r($product_info['quantity']);
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
	
	public function getTotal($total) {
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
		//print_r($bundles);
		//$setting = $this->config->get('productbundles');
$setting['MultipleBundles']=1;
		$discountsApply = (isset($setting['MultipleBundles'])) ? true : false;
		
		if (isset($bundles)) {
			foreach ($bundles as $bundle) { //echo $bundle['c_product']; print_r($cartProductsFlat);
					$productid= explode(",",$bundle['c_product']);
//print_r($productid);
				if (array_diff($productid, $cartProductsFlat) === array()) { //echo "hi";
					$bundleQuantities = array(); //echo $productid;
					foreach($productid as $product_id) { //echo $product_id;
						if (empty($bundleQuantities[$product_id])) {
							$bundleQuantities[$product_id] = 1;
						} else {
							$bundleQuantities[$product_id]++;
						}
					}
					//print_r($bundleQuantities);
					for(;;) {
						foreach($bundleQuantities as $product_id=>$quantity) {
							if (!isset($cartProductsQuantities[$product_id]) || ($quantity > $cartProductsQuantities[$product_id])) {
								continue 3;
							}
						}
						
						foreach($bundleQuantities as $product_id=>$quantity) {
							$cartProductsQuantities[$product_id] -= $quantity;
						}
						//print_r($bundle['c_id']);
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
					foreach($bundle as $instance) { //print_r($instance);
						
						$grandTotal += (float)$instance['c_discount_amount'];
					}
				}
				
				$total['totals'][] = array(
					'code'       => 'combooffertotal',
					'title'      => $this->language->get('entry_title'),
					'text'       => $this->currency->format(-$grandTotal, $this->session->data['currency']),
					'value'      => -$grandTotal,
					'sort_order' => $this->config->get('combooffertotal_sort_order')
				);
		
				$total['total']  -= $grandTotal;
				if ($total['total'] < 0) {
					$total['total'] = 0;
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
