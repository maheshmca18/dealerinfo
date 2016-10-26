<?php

class ModelAccountBirthdaysendmail extends Model {

    public function getbirthdaydetails($dbdate)
    {

        $product_category_data1 = array();

        $arr=explode('-',$dbdate); // splitting the array

        $dd=$arr[2]; // first element of the array is month

        $mm=$arr[1]; // second element is date

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer c ," . DB_PREFIX . "cusmer_birtdayreminder WHERE DAY(c.Dateofbirth) = '".$dd."' AND MONTH(c.Dateofbirth) = '".$mm."'");



        foreach ($query->rows as $result) {
            $product_category_data1[] = $result;

        }
        return $product_category_data1;


    }

    public function editSetting($code, $data, $store_id = 0) {

        $this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE store_id = '" . (int)$store_id . "' AND `code` = '" . $this->db->escape($code) . "'");


        foreach ($data as $key => $value) {

            if (substr($key, 0, strlen($code)) == $code) {

                if (!is_array($value)) {
                    $this->db->query("INSERT INTO " . DB_PREFIX . "setting SET store_id = '" . (int)$store_id . "', `code` = '" . $this->db->escape($code) . "', `key` = '" . $this->db->escape($key) . "', `value` = '" . $this->db->escape($value) . "'");
                } else {

                    $this->db->query("INSERT INTO " . DB_PREFIX . "setting SET store_id = '" . (int)$store_id . "', `code` = '" . $this->db->escape($code) . "', `key` = '" . $this->db->escape($key) . "', `value` = '" . $this->db->escape(serialize($value)) . "', serialized = '1'");
                }
            }
        }
    }

    }
