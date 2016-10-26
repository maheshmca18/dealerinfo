<?php
class ModelLocalisationPostcodemaster extends Model {
    public function getPostcodelist($start = 0, $limit = 10) {

        if ($start < 0) {
            $start = 0;
        }

        if ($limit < 1) {
            $limit = 1;
        }


        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "postcode_master_weightbased ORDER BY condition_type ASC LIMIT "  . (int)$start . "," . (int)$limit);

        return $query->rows;
    }

    public function getTotalrecords() {
        $query = $this->db->query("SELECT COUNT(*) AS postcode FROM " . DB_PREFIX . "postcode_master_weightbased ");

        return $query->row['postcode'];
    }



}

