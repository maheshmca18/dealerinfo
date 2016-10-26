<?php
class ModelLocalisationProductoftheday extends Model {
    public function addproduct($data) {
         if($data['day_id1']==1){
            $convert = $data['product_id1'];
            $convert_product_id = implode(" ", $convert);
            // print_r($convert_product_id);exit;
            $query = $this->db->query("UPDATE " . DB_PREFIX . "product_ofthe_day SET  product_ofthe_day_id = '" . $this->db->escape($convert_product_id) . "'  WHERE day_id = '" . (int)$data['day_id1'] . "' ");
        }
        if($data['day_id2']==2){
            $convert = $data['product_id2'];
            $convert_product_id = implode(" ", $convert);
            $query = $this->db->query("UPDATE " . DB_PREFIX . "product_ofthe_day SET  product_ofthe_day_id = '" . $this->db->escape($convert_product_id) . "'  WHERE day_id = '" . (int)$data['day_id2'] . "' ");
        }
        if($data['day_id3']==3){
            $convert = $data['product_id3'];
            $convert_product_id = implode(" ", $convert);
            $query = $this->db->query("UPDATE " . DB_PREFIX . "product_ofthe_day SET  product_ofthe_day_id = '" . $this->db->escape($convert_product_id) . "'  WHERE day_id = '" . (int)$data['day_id3'] . "' ");
        }
        if($data['day_id4']==4){
            $convert = $data['product_id4'];
            $convert_product_id = implode(" ", $convert);
            $query = $this->db->query("UPDATE " . DB_PREFIX . "product_ofthe_day SET  product_ofthe_day_id = '" . $this->db->escape($convert_product_id) . "'  WHERE day_id = '" . (int)$data['day_id4'] . "' ");
        }
        if($data['day_id5']==5){
            $convert = $data['product_id5'];
            $convert_product_id = implode(" ", $convert);
            $query = $this->db->query("UPDATE " . DB_PREFIX . "product_ofthe_day SET  product_ofthe_day_id = '" . $this->db->escape($convert_product_id) . "'  WHERE day_id = '" . (int)$data['day_id5'] . "' ");
        }
        if($data['day_id6']==6){
            $convert = $data['product_id6'];
            $convert_product_id = implode(" ", $convert);
            $query = $this->db->query("UPDATE " . DB_PREFIX . "product_ofthe_day SET  product_ofthe_day_id = '" . $this->db->escape($convert_product_id) . "'  WHERE day_id = '" . (int)$data['day_id6'] . "' ");
        }
        if($data['day_id7']==7){
            $convert = $data['product_id7'];
            $convert_product_id = implode(" ", $convert);
            $query = $this->db->query("UPDATE " . DB_PREFIX . "product_ofthe_day SET  product_ofthe_day_id = '" . $this->db->escape($convert_product_id) . "'  WHERE day_id = '" . (int)$data['day_id7'] . "' ");
        }
    }
    public function getid() {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_ofthe_day");
        return $query->rows;
    }


    public function getLayoutModules() {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "layout_module");

        return $query->rows;
    }



}