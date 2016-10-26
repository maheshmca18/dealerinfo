<?php
class ModelExtensionOrderCancel extends Model {
	// get reason
	public function getordercancelreason() {

        $pdfinvoice_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "cancel_order ");

        foreach ($query->rows as $result) {
            $pdfinvoice_data[] = $result;
        }
        return $pdfinvoice_data;
    }

    // insert reason
    public function insertordercancelreason($reason_name,$sort) {

        $ordercancel_data = array();

        $this->db->query("INSERT INTO " . DB_PREFIX . "cancel_order SET cance_description = '" . $this->db->escape($reason_name) . "', sort = '" . (int)$sort . "'");
        $cancel_order_id = $this->db->getLastId();
        
        $ordercancel_data['cancel_order_id'] = $cancel_order_id;
        return $ordercancel_data;
    }

    // insert reason
    public function deleteordercancelreason($reason_id) {
        $ordercancel_data = array();
        $this->db->query("DELETE FROM " . DB_PREFIX . "cancel_order WHERE cancel_description_id = '" . (int)$reason_id . "'");
        $ordercancel_data[]="deleted deleted";
        return $ordercancel_data;
    }

// enable reason
    public function enableCustomerOrderCancellations() {

        $pdfinvoice_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "cancel_order ORDER BY sort ASC ");

        foreach ($query->rows as $result) {
            $pdfinvoice_data[] = $result;
        }
        return $pdfinvoice_data;
    }
}