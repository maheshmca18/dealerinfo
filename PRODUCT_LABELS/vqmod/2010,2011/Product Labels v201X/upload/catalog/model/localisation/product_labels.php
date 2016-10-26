<?php
class ModelLocalisationProductlabels extends Model {
    public function addlabels($data) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "product_labels SET label_id = '" . $this->db->escape($data['label_id']) . "',label_text = '" . $this->db->escape($data['label_text']) . "', label_color = '" . $this->db->escape($data['label_color']) . "', label_text_color = '" . $this->db->escape($data['label_text_color']) . "', condition_type = '" . $this->db->escape($data['condition_type']) . "', status = '" . $this->db->escape($data['status']) . "'");

    }

    public function editlabel($data) {

        if($data['label_id'][0]) {
            $this->db->query("UPDATE " . DB_PREFIX . "product_labels SET  label_text = '" . $this->db->escape($data['label_text'][0]) . "', label_color = '" . $this->db->escape($data['label_color'][0]) . "', label_text_color = '" . $this->db->escape($data['label_text_color'][0]) . "', condition_type = '" . $this->db->escape($data['condition_type'][0]) . "', status = '" . $this->db->escape($data['status'][0]) . "' WHERE label_id = '" . (int)$data['label_id'][0] . "' ");
        }

        if($data['label_id'][1]) {
            $this->db->query("UPDATE " . DB_PREFIX . "product_labels SET  label_text = '" . $this->db->escape($data['label_text'][1]) . "', label_color = '" . $this->db->escape($data['label_color'][1]) . "', label_text_color = '" . $this->db->escape($data['label_text_color'][1]) . "', condition_type = '" . $this->db->escape($data['condition_type'][1]) . "', status = '" . $this->db->escape($data['status'][1]) . "' WHERE label_id = '" . (int)$data['label_id'][1] . "' ");
        }
        if($data['label_id'][2]) {
            $this->db->query("UPDATE " . DB_PREFIX . "product_labels SET  label_text = '" . $this->db->escape($data['label_text'][2]) . "', label_color = '" . $this->db->escape($data['label_color'][2]) . "', label_text_color = '" . $this->db->escape($data['label_text_color'][2]) . "', condition_type = '" . $this->db->escape($data['condition_type'][1]) . "', status = '" . $this->db->escape($data['status'][2]) . "' WHERE label_id = '" . (int)$data['label_id'][2] . "' ");
        }
    }

    public function getLabels() {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "product_labels");
        return $query->rows;
    }


}