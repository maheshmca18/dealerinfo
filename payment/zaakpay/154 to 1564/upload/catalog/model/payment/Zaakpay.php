<?php 
class ModelPaymentZaakpay extends Model {
  	public function getMethod($address, $total) {
		$this->load->language('payment/Zaakpay');
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$this->config->get('Zaakpay_geo_zone_id') . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");
		
		if ($this->config->get('total') > $total) {
			$status = false;
		} elseif (!$this->config->get('geo_zone_id')) {
			$status = true;
		} elseif ($query->num_rows) {
			$status = true;
		} else {
			$status = false;
		}	
		
		$method_data = array();
	
		if ($status) {  
      		$method_data = array( 
        		'code'       => 'Zaakpay',
        		'title'      => $this->language->get('text_title'),
			'sort_order' => $this->config->get('sort_order')
      		);
    	}
   
    	return $method_data;
  	}
}
?>
