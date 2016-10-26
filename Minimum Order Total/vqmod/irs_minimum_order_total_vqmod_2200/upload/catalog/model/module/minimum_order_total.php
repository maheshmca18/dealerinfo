<?php
class ModelModuleMinimumOrderTotal extends Model {

    public function getMinimumordertotal() {
        $query = $this->db->query("SELECT mot_total FROM " . DB_PREFIX . "minimum_order_total WHERE mot_geo_zone_id=0 AND mot_status=1");

        return $query->row;
    }

    public function getGeozonedetails($country_id) {

        //SELECT mot.* FROM `oc_geo_zone` gz INNER JOIN oc_zone_to_geo_zone ztgz
        // ON(ztgz.geo_zone_id=gz.geo_zone_id) INNER JOIN oc_minimum_order_total mot
        // ON(mot.mot_geo_zone_id=gz.geo_zone_id) WHERE ztgz.country_id=222 GROUP BY gz.geo_zone_id

        if(!empty($country_id)) {
            $query = $this->db->query("SELECT MIN(mot.mot_total) AS mot_total FROM " . DB_PREFIX . "geo_zone gz INNER JOIN " . DB_PREFIX . "zone_to_geo_zone ztgz ON(ztgz.geo_zone_id=gz.geo_zone_id) INNER JOIN " . DB_PREFIX . "minimum_order_total mot ON(mot.mot_geo_zone_id=gz.geo_zone_id) WHERE ztgz.country_id=" . $country_id . "  AND mot.mot_status=1 GROUP BY gz.geo_zone_id");

            return $query->row;

        } else {
            $empty=array();
            return $empty;
        }
    }

}