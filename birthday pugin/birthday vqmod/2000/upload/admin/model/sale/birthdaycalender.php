<?php
class ModelSaleBirthdaycalender extends Model {

    public function addbirthdaysetting($data)
    {
         $this->db->query("INSERT INTO " . DB_PREFIX . "customer_birtdayreminder SET br_subject = '" . $this->db->escape($data['subject']) . "', br_message = '" . $this->db->escape($data['message']) . "', br_birthdayreminderstatus = '" . $this->db->escape($data['birthstatus']) . "', br_sendbCCtostoreowner = '" . $this->db->escape($data['ownerstatus']) . "'");
}

    public function editbirthdaysetting($data)
    {
        $this->db->query("UPDATE `" . DB_PREFIX . "customer_birtdayreminder` SET `br_subject` = '" . $this->db->escape($data['subject']) . "', `br_message` = '" . $this->db->escape($data['message']) . "', `br_birthdayreminderstatus` = '" . $this->db->escape($data['birthstatus']) . "', `br_sendbCCtostoreowner` = '" . $this->db->escape($data['ownerstatus']) . "' WHERE `br_id` = '" . $this->db->escape($data['id'])  . "'");
    }

    public function getbirthdaysetting()
    {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_birtdayreminder");
        return $query->row;
    }

    public function getbirthdaydate($startmonth,$endmonth)
       {
        $product_category_data = array();
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE MONTH(Dateofbirth) BETWEEN '$startmonth' and '$endmonth'");
        foreach ($query->rows as $result) {
            $product_category_data[] =  array(
                'customer_id'                  => $result['customer_id'],
                'firstname' => $result['firstname'],
                'lastname'=> $result['lastname'],
                'email'=> $result['email'],
                'Dateofbirth'=> $result['Dateofbirth']
            );
        }
        return $product_category_data;
    }
}
?>

