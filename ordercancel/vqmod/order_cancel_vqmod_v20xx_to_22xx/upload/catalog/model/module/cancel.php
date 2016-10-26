<?php 

class ModelModuleCancel extends Model {
    
    /**
     * see catalog/model/checkout/order #258
     */
    public function cancel_order($order_id,$reason_description) {
        
        $order_status_id = 7 ; //canceled
        $notify = false;
		if($reason_description == ''){
				$reason_description= "Canceled by Customer";
		}
		$reason_description= "Canceled by Customer ".$reason_description;
        
        $this->db->query("UPDATE `" . DB_PREFIX . "order` SET order_status_id = '" . (int)$order_status_id . "', date_modified = NOW() WHERE order_id = '" . (int)$order_id . "'");
        
        $this->db->query("INSERT INTO " . DB_PREFIX . "order_history SET order_id = '" . (int)$order_id . "', order_status_id = '" . (int)$order_status_id . "', notify = '" . (int)$notify . "', comment = '" . $this->db->escape($reason_description) . "', date_added = NOW()");
        
    }
    
    public function stock_back($quantity, $product_id){
        //get old quantity
        $query = $this->db->query("SELECT `quantity` FROM " . DB_PREFIX . "product WHERE `product_id`=" . (int)$product_id);
        
        if ($query->num_rows) {
            $oldQuantity = $query->row['quantity'];
            
            //sum
            $newQuantity = $oldQuantity + $quantity;
            
            //save new quantity
            $this->db->query("UPDATE " . DB_PREFIX . "product SET `quantity`=" . $newQuantity . " WHERE `product_id`=" . (int)$product_id);
        }
        
    }
    public function getOrdercompletedate($order_id) {


      //  $this->db->query("UPDATE `" . DB_PREFIX . "order` SET order_status_id = '" . (int)$order_status_id . "', date_modified = NOW() WHERE order_id = '" . (int)$order_id . "'");

      //  $this->db->query("INSERT INTO " . DB_PREFIX . "order_history SET order_id = '" . (int)$order_id . "', order_status_id = '" . (int)$order_status_id . "', notify = '" . (int)$notify . "', comment = '" . $this->db->escape($comment) . "', date_added = NOW()");
        $query = $this->db->query("SELECT oh.date_added FROM `" . DB_PREFIX . "order` o LEFT JOIN " . DB_PREFIX . "order_history oh ON(o.order_id=oh.order_id)WHERE o.order_id = '" . (int)$order_id . "' AND oh.order_status_id = '5' AND o.order_status_id=oh.order_status_id");

        if(!empty($query->row)) {
            return $query->row['date_added'];

        } else{
            return false;
        }
    }
}

?>