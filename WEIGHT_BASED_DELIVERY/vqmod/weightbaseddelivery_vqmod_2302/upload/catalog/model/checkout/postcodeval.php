<?php
class ModelCheckoutPostcodeval extends Model {
//frontend postcode validation
   public function getPostcode($postcode) {
        $query = $this->db->query("SELECT postcode FROM " . DB_PREFIX . "postcode_master_weightbased WHERE postcode = '" . (int)$postcode . "'");

       if(!empty($query->row)){

           return 1;
       }

       return '';

    }
//take shipping charge and validation
    public function getshipping_charge($postcode) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "postcode_master_weightbased WHERE postcode = '" . (int)$postcode . "'ORDER BY condition_type");

        return $query->rows;
    }


//validation for postcode check availability for product detail page
    public function getPostcodeavailable($postcode) {
        $query = $this->db->query("SELECT postcode FROM " . DB_PREFIX . "postcode_master_weightbased WHERE postcode = '" . (int)$postcode . "'");

        if(!empty($query->row)){

            return $query->row['postcode'];
        }

        return '';

    }

}
