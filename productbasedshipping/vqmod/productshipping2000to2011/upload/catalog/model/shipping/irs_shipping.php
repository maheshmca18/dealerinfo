<?php
class ModelShippingIrsShipping extends Model {
	function getQuote($address) {
$status = false;
		if($this->config->get('productbasedshipping_status')){
		$this->load->language('shipping/irs_shipping');
			$products=$this->cart->getProducts();
			$current_shipping_charge=0;
			foreach ($products as $product) {				
					
					$product_info = $this->db->query("SELECT shipping FROM " . DB_PREFIX . "product  WHERE product_id = '" . (int)$product['product_id'] . "' AND status = '1'")->row;
										
					if($product_info['shipping'] == 1){ 
					$getShippingcharge = $this->db->query("SELECT shipping_charge FROM ".DB_PREFIX."product_shipping_charge WHERE product_id = '".$product['product_id']."'")->row;
					if(isset($getShippingcharge['shipping_charge'])){

					$adminShippingchargevalue =$getShippingcharge['shipping_charge'] * $product['quantity'];
					
					} else {
					$adminShippingchargevalue = 0;
					}
				} else {
					$adminShippingchargevalue = 0;
				}			
					$current_shipping_charge += $adminShippingchargevalue;					
				
				}			
$status = true;
}
		$method_data = array();

		if ($status) {
			$quote_data = array();

			$quote_data['irs_shipping'] = array(
				'code'         => 'irs_shipping.irs_shipping',
				'title'        => $this->language->get('text_description'),
				'cost'         => $current_shipping_charge,
				'tax_class_id' => 0,
				'text'         => $this->currency->format($current_shipping_charge)
			);

			$method_data = array(
				'code'       => 'irs_shipping',
				'title'      => $this->language->get('text_title'),
				'quote'      => $quote_data,
				'sort_order' => $this->config->get('irs_shipping_sort_order'),
				'error'      => false
			);
		}

		return $method_data;
	}
}
