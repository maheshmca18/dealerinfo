<?php
class ModelModuleTestimonial extends Model {
    
    public function getTestimonialCustom() {
	
		$sql = "SELECT ts.testimonial_key, ts.testimonial_value FROM " . DB_PREFIX . "testimonial_setting ts";
			
		$query = $this->db->query($sql);
        
        $result = $query->rows;
        
        $styles = array();
        
        foreach($result as $row)
        {
            $styles[$row['testimonial_key']] = $row['testimonial_value'];
            
        }
        
		return $styles;
        
	//	return $query->rows;
	}
    
    public function getTestimonials() {
	
		$sql = "SELECT ts.testimonial_key, ts.testimonial_value FROM " . DB_PREFIX . "testimonial_setting ts";
			
		$query = $this->db->query($sql);
        
        $result = $query->rows;
        
        $styles = array();
        
        foreach($result as $row)
        {
            $styles[$row['testimonial_key']] = $row['testimonial_value'];
            
        }
        
		return $styles;
        
	//	return $query->rows;
	}

}
?>