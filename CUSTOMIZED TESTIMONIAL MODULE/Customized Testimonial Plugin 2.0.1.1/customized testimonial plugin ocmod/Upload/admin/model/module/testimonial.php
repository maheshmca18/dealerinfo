<?php
class ModelModuleTestimonial extends Model {
    
    public function getTestimonialCustom() {
	
		$sql = "SELECT ts.testimonial_label, ts.testimonial_key, ts.testimonial_value FROM " . DB_PREFIX . "testimonial_setting ts";
			
		$query = $this->db->query($sql);
		
		return $query->rows;
	}
    
    public function editTestimonialCustom($data=array()) {
        
        if(count($data)>0)
        {
        $sql = "UPDATE `" . DB_PREFIX . "testimonial_setting` SET        
                `testimonial_value` = IF(`testimonial_key`='bgcolor','".$data['bgcolor']."',`testimonial_value`),
                `testimonial_value` = IF(`testimonial_key`='textcolor','".$data['textcolor']."',`testimonial_value`),
                `testimonial_value` = IF(`testimonial_key`='headtextcolor','".$data['headtextcolor']."',`testimonial_value`),
                `testimonial_value` = IF(`testimonial_key`='nametextcolor','".$data['nametextcolor']."',`testimonial_value`),
                `testimonial_value` = IF(`testimonial_key`='limitchar','".$data['limitchar']."',`testimonial_value`),
                `testimonial_value` = IF(`testimonial_key`='widgetheight','".$data['widgetheight']."',`testimonial_value`),
                `testimonial_value` = IF(`testimonial_key`='headbgcolor','".$data['headbgcolor']."',`testimonial_value`),
				`testimonial_value` = IF(`testimonial_key`='viewalltextcolor','".$data['viewalltextcolor']."',`testimonial_value`),
				`testimonial_value` = IF(`testimonial_key`='viewallbgcolor','".$data['viewallbgcolor']."',`testimonial_value`)";
			
		$this->db->query($sql);  
                  
        }
            return;
		
	}

}
?>