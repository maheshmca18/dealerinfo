<?php
class ModelInformationTestimonial extends Model {

	public function addTestimonial($data) {		
       
		$this->db->query("INSERT INTO " . DB_PREFIX . "testimonial SET  name = '" . $this->db->escape($data['name']) . "', data = '" . $this->db->escape($data['testimonial']) . "', customer_id = '" . (int)$this->customer->getId() . "', added_on = NOW(), approved_on = '', status=0");
	}
    
    
     public function getTestimonial($data) {
		$sql = "SELECT * FROM " . DB_PREFIX . "testimonial t WHERE t.status=1";
		$sort_data = array(
		//	't.name',
		//	't.data',
          //  't.status',
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
    
    
     public function getTestimonialsingle($testimonialid) {
		$sql = "SELECT * FROM " . DB_PREFIX . "testimonial t WHERE t.status=1 AND t.testimonial_id='".$testimonialid."'";	
		
		$query = $this->db->query($sql);
        if($query->num_rows>0)
    		return $query->row;
        else
            return 0;
	}
  
    public function getTotalTestimonial() {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "testimonial WHERE status=1");
		
		return $query->row['total'];
	}
}
?>