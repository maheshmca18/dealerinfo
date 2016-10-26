<?php
class ModelLocalisationTestimonial extends Model {
    
	public function addTestimonial($data) {		
	         
		$this->db->query("INSERT INTO " . DB_PREFIX . "testimonial SET  name = '" . $this->db->escape($data['name']) . "', data = '" . $this->db->escape($data['testimonial']) . "', customer_id = '" . (int)$this->user->getId() . "', added_on = NOW(), approved_on = NOW(), status=1");
	}
          
	public function editTestimonial($testimonial_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "testimonial SET status = '" . (int)$data['status'] . "', approved_on = NOW() WHERE testimonial_id = '" . (int)$testimonial_id. "'");
	}
	
	public function deleteTestimonial($testimonial_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "testimonial WHERE testimonial_id = '" . (int)$testimonial_id . "'");
	}

    public function getTestimonial_id($testimonial_id){
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "testimonial WHERE testimonial_id = '" . (int)$testimonial_id . "'");
		
		return $query->row;
    }
      
    public function getTestimonial($data) {
		$sql = "SELECT * FROM " . DB_PREFIX . "testimonial t";
			
		$sort_data = array(
			't.name',
			't.data',
            't.status',
            't.added_on',
		);	
			
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY t.added_on";	
		}
			
		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " ASC";
		} else {
			$sql .= " DESC";
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
  
    public function getTotalTestimonial() {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "testimonial");
		
		return $query->row['total'];
	}
    

}
?>