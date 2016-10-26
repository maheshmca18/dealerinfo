<?php
class ModelModulePostcode extends Model {
        
	public function getPostcode($postcode) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "postcode_delivery WHERE postcode = '" . $postcode . "'");
		
		return $query->row;
	}
    
    public function getPostcodes($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "postcode_delivery p";
			
		$sort_data = array(
			'p.postcode',
			'p.status'
		);	
			
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY p.postcode";	
		}
			
		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}
		
		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}		
			
			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}	
			
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
		
		$query = $this->db->query($sql);
		
		return $query->rows;
	}
    
    public function getTotalPostcodes() {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "postcode_delivery");
		
		return $query->row['total'];
	}
    public function getTotalByPostcode($postcode) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "postcode_delivery WHERE postcode = '" . $postcode . "'");
	
		return $query->row['total'];
	}
    public function getPostcodeById($postcode_id){
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "postcode_delivery WHERE postcode_id = '" . (int)$postcode_id . "'");
		
		return $query->row;
    }
	 public function getIdByPostcode($postcode){
	 
        $query = $this->db->query("SELECT postcode_id FROM " . DB_PREFIX . "postcode_delivery WHERE postcode= '" . $postcode . "'");
		
		return $query->row['postcode_id'];
    }

}
?>