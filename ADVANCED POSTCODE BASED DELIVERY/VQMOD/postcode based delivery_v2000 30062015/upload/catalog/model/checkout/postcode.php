<?php
class ModelCheckoutPostcode extends Model {
	public function checkAvailability($postcode) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "postcode_delivery WHERE postcode = '" . $postcode . "' AND status = '1'");
		
		return $query;
	}	
}
?>