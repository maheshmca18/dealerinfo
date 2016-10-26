<?php

class ModelAccountBirthdaysendmail extends Model {

    public function getbirthdaycustomerdetails($dbdate)
    {
        $getbirthdaycustomerdetails = array();
        $arr=explode('-',$dbdate); // splitting the array
        $dd=$arr[2]; // first element of the array is month
        $mm=$arr[1]; // second element is date
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer  WHERE DAY(Dateofbirth) = '".$dd."' AND MONTH(Dateofbirth) = '".$mm."'");
        foreach ($query->rows as $result) {
            $getbirthdaycustomerdetails[] = $result;
        }
        return $getbirthdaycustomerdetails;
    }

 public function getbirthdaysettingdetails()
    {
       $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_birtdayreminder");
       $getbirthdaysettingdetails= $query->rows;  
       return $getbirthdaysettingdetails;

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
