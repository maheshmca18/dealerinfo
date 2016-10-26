<?php
class ModelLocalisationProductshipping extends Model {
	public function addproductshipping($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "product_based_shipping SET zone_name = '" . $this->db->escape($data['zone_name']) . "', status = '" . $this->db->escape($data['status']) . "'");

	}

	public function editproductshipping($product_basedshipping_id,$data) {  
		$this->db->query("UPDATE " . DB_PREFIX . "product_based_shipping SET zone_name = '" . $this->db->escape($data['zone_name']) . "', status = '" . $this->db->escape($data['status']) . "'  WHERE product_basedshipping_id = '" . (int)$product_basedshipping_id . "'");

	}
	public function ajaxeditproductshipping($data) {

		$this->db->query("INSERT INTO " . DB_PREFIX . "shipping_zone SET zone_location = '" . $this->db->escape($data['location']) . "', postcode = '" . $this->db->escape($data['postcode']) . "',product_basedshipping_id = '" . (int)$data['product_basedshipping_id'] . "'");

	}
	public function ajaxdeletezone($locationid) {

		$this->db->query("DELETE FROM " . DB_PREFIX . "shipping_zone WHERE zone_id = '" . (int)$locationid . "'");

	}

	public function deleteproductshipping($product_basedshipping_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_based_shipping WHERE product_basedshipping_id = '" . (int)$product_basedshipping_id . "'");

	}
	public function getlocationinfo($product_basedshipping_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "shipping_zone  WHERE product_basedshipping_id = '" . (int)$product_basedshipping_id . "'");

		return $query->rows;

	}

	public function getzone($product_basedshipping_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "product_based_shipping WHERE product_basedshipping_id = '" . (int)$product_basedshipping_id . "'");

		return $query->row;
	}

	public function getzones($data = array()) {
		if ($data) {
			$sql = "SELECT * FROM " . DB_PREFIX . "product_based_shipping";

			$sort_data = array(
				'zone_name',
				'status'
			);


			$query = $this->db->query($sql);

			return $query->rows;
		} else {
			$product_basedshipping_id_data = $this->cache->get('productbasedshipping');

			if (!$product_basedshipping_id_data) {
				$product_basedshipping_id_data = array();

				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_based_shipping ORDER BY zone_name");

				foreach ($query->rows as $result) {
					$product_basedshipping_id_data[$result['product_basedshipping_id']] = array(
						'product_basedshipping_id' => $result['product_basedshipping_id'],
						'zone_name'        => $result['zone_name'],
						'status'        => $result['status']

					);
				}

				$this->cache->set('productbasedshipping', $product_basedshipping_id_data);
			}

			return $query->rows;
		}
	}

	public function getTotalrecords() {
		$query = $this->db->query("SELECT COUNT(*) AS zone_name FROM " . DB_PREFIX . "product_based_shipping");

		//return $query->row['holiday_name'];
	}

//import detail

public function addzonesdetail($data) {

		$this->db->query("INSERT INTO " . DB_PREFIX . "shipping_zone SET zone_location = '" . $this->db->escape($data['zone_location']) . "', postcode = '" . $this->db->escape($data['postcode']) . "',product_basedshipping_id = '" . (int)$data['product_basedshipping_id'] . "'");

	}
	
	public function getvalidationzonename($zone_location) {
		$query = $this->db->query("SELECT zone_name FROM " . DB_PREFIX . "product_based_shipping where zone_name like '$zone_location'");


		return $query->row;
	}
	
	public function getvalidationlocation($data) {
		//$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "shipping_zone where product_basedshipping_id = '" . $data['product_basedshipping_id'] . "' AND zone_location = '" . $data['location'] . "' OR  postcode = '" . $data['postcode'] . "'");
		//return $query->rows;
		
		$insert = "true";
		
		$query1 = $this->db->query("SELECT * FROM " . DB_PREFIX . "shipping_zone where product_basedshipping_id = '" . $data['product_basedshipping_id'] . "' AND zone_location = '" . $data['location'] . "'");
		
		if($query1->rows){
			$insert = "false";
		}		
				
		$query2 = $this->db->query("SELECT * FROM " . DB_PREFIX . "shipping_zone where product_basedshipping_id = '" . $data['product_basedshipping_id'] . "' AND postcode = '" . $data['postcode'] . "'");

        if($query2->rows){
			$insert = "false";
		}
		
		return $insert;	
	}
	
	//validation
	public function getZonevalidationlist($product_basedshipping_id) {
		
		$query	 = $this->db->query("SELECT * FROM " . DB_PREFIX . "shipping_zone where product_basedshipping_id = $product_basedshipping_id");


		return $query->rows;
	}



}


