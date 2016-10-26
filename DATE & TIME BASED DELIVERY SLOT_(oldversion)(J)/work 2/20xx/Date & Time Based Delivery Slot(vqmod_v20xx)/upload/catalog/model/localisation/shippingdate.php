<?php
class ModelLocalisationShippingdate extends Model {
	public function getShippingdate() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "deliverydatetime");
		
		return $query->rows;
	}	
	}
?>
