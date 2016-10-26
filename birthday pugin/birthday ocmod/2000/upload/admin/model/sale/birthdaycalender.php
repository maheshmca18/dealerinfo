<?php
class ModelSaleBirthdaycalender extends Model {

public function addProduct($data)
{


    $this->db->query("INSERT INTO " . DB_PREFIX . "cusmer_birtdayreminder SET br_subject = '" . $this->db->escape($data['subject']) . "', br_message = '" . $this->db->escape($data['message']) . "', br_birthdayreminderstatus = '" . $this->db->escape($data['birthstatus']) . "', br_sendbCCtostoreowner = '" . $this->db->escape($data['ownerstatus']) . "'");

}
    public function editProduct($data)
    {

        $this->db->query("UPDATE `" . DB_PREFIX . "cusmer_birtdayreminder` SET `br_subject` = '" . $this->db->escape($data['subject']) . "', `br_message` = '" . $this->db->escape($data['message']) . "', `br_birthdayreminderstatus` = '" . $this->db->escape($data['birthstatus']) . "', `br_sendbCCtostoreowner` = '" . $this->db->escape($data['ownerstatus']) . "' WHERE `br_id` = '" . $this->db->escape($data['id'])  . "'");

    }


    public function getProducts()
    {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "cusmer_birtdayreminder");

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



}
?>

