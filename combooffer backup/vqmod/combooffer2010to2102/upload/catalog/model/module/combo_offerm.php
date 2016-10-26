<?php
class ModelModuleComboOfferm  extends Model {


    public function getComboofferdetails($c_id) {

       $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "combo_offerl WHERE c_id = '" . (int)$c_id . "'AND c_status = 1 AND ((c_start_date = '0000-00-00' OR c_start_date < NOW()) AND (c_end_date = '0000-00-00' OR c_end_date > NOW()))");

        return $query->row;
    } 
    public function getProduct($product_id) {
		 $query = $this->db->query("SELECT DISTINCT *, pd.name AS name, p.image, m.name AS manufacturer, (SELECT price FROM " . DB_PREFIX . "product_discount pd2 WHERE pd2.product_id = p.product_id AND pd2.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount, (SELECT price FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special, (SELECT points FROM " . DB_PREFIX . "product_reward pr WHERE pr.product_id = p.product_id AND customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "') AS reward, (SELECT ss.name FROM " . DB_PREFIX . "stock_status ss WHERE ss.stock_status_id = p.stock_status_id AND ss.language_id = '" . (int)$this->config->get('config_language_id') . "') AS stock_status, (SELECT wcd.unit FROM " . DB_PREFIX . "weight_class_description wcd WHERE p.weight_class_id = wcd.weight_class_id AND wcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS weight_class, (SELECT lcd.unit FROM " . DB_PREFIX . "length_class_description lcd WHERE p.length_class_id = lcd.length_class_id AND lcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS length_class, (SELECT AVG(rating) AS total FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = p.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating, (SELECT COUNT(*) AS total FROM " . DB_PREFIX . "review r2 WHERE r2.product_id = p.product_id AND r2.status = '1' GROUP BY r2.product_id) AS reviews, p.sort_order FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id) WHERE p.product_id  in(" . $product_id . ") AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");
 
 	return $query->rows;
	}

    public function getProductdetails($product_id) {
        $product_related_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "combo_offerl WHERE product_id = '" . (int)$product_id . "' AND c_status = 1");

        foreach ($query->rows as $result) {
            $product_related_data[] = $result['related_id'];
        }

        return $product_related_data;
    }
    public function getLayoutModules($layout_id, $position) {
        $query = $this->db->query("SELECT position FROM " . DB_PREFIX . "layout_module WHERE layout_id = '" . (int)$layout_id . "' AND code LIKE '%" . $this->db->escape($position) . "%' ORDER BY sort_order");

        return $query->row['position'];
    }

    public function getcombooffer($data = array()) {
        $sql = "SELECT * FROM " . DB_PREFIX . "combo_offerl WHERE c_status = 1 AND ((c_start_date = '0000-00-00' OR c_start_date < NOW()) AND (c_end_date = '0000-00-00' OR c_end_date > NOW()))";

        if (!empty($data['filter_name'])) {
            $sql .= " AND c_name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
        }


        $sql .= " GROUP BY c_id";

        $sort_data = array(
            'c_name',
            'c_status',
            'c_sort_order'
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY c_name";
        }

        if (isset($data['order']) && ($data['order'] == 'DESC')) {
            $sql .= " DESC";
        } else {
            $sql .= " ASC";
        }

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }

        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function getProductOptions($product_id) {
        $product_option_data = array();

        $product_option_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option po LEFT JOIN `" . DB_PREFIX . "option` o ON (po.option_id = o.option_id) LEFT JOIN " . DB_PREFIX . "option_description od ON (o.option_id = od.option_id) WHERE po.product_id in(" . $product_id . ") AND od.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY o.sort_order");

        foreach ($product_option_query->rows as $product_option) {

            $product_option_value_data = array();

            $product_option_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option_value pov LEFT JOIN " . DB_PREFIX . "option_value ov ON (pov.option_value_id = ov.option_value_id) LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE pov.product_id  ='" . (int)$product_option['product_id'] . "' AND pov.product_option_id = '" . (int)$product_option['product_option_id'] . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY ov.sort_order");

            foreach ($product_option_value_query->rows as $product_option_value) {
                $product_option_value_data[] = array(
                    'product_option_value_id' => $product_option_value['product_option_value_id'],
                    'option_value_id'         => $product_option_value['option_value_id'],
                    'name'                    => $product_option_value['name'],
                    'image'                   => $product_option_value['image'],
                    'quantity'                => $product_option_value['quantity'],
                    'subtract'                => $product_option_value['subtract'],
                    'price'                   => $product_option_value['price'],
                    'price_prefix'            => $product_option_value['price_prefix'],
                    'weight'                  => $product_option_value['weight'],
                    'weight_prefix'           => $product_option_value['weight_prefix']
                );
            }

            $product_option_data[$product_option['product_id']][] = array(
                'product_option_id'    => $product_option['product_option_id'],
                'option_id'            => $product_option['option_id'],
                'name'                 => $product_option['name'],
                'type'                 => $product_option['type'],
                'value'                => $product_option['value'],
                'required'             => $product_option['required'],
                'product_option_value' => $product_option_value_data
            );
        }
        return $product_option_data;
    }
    public function getcomboofferproductbase($product_id) {

        $combodetails=array();
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "combo_offerl WHERE c_product LIKE '%" . (int)$product_id . "%' AND c_status = 1 AND ((c_start_date = '0000-00-00' OR c_start_date < NOW()) AND (c_end_date = '0000-00-00' OR c_end_date > NOW()))");
        foreach($query->rows as $row){

            $combodetails[]=$row['c_id'];

        }

        return $combodetails;
    }
    public function getcombooffercategorybase($category_id) {

        $combodetails=array();
        $productdetails = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "product_to_category WHERE category_id = '" . (int)$category_id . "'");

        foreach($productdetails->rows as $product_id) {

            $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "combo_offerl WHERE c_product LIKE '%" . (int)$product_id['product_id'] . "%' AND c_status = 1 AND ((c_start_date = '0000-00-00' OR c_start_date < NOW()) AND (c_end_date = '0000-00-00' OR c_end_date > NOW()))");

            foreach ($query->rows as $row) {
                $combodetails[] = $row['c_id'];
            }
        }

        return $combodetails;
    }
    public function getTotalcomboofferldetails() {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "combo_offerl WHERE c_status = 1 AND ((c_start_date = '0000-00-00' OR c_start_date < NOW()) AND (c_end_date = '0000-00-00' OR c_end_date > NOW()))");
        if(!empty($query->rows)) {
            return $query->rows;
        }
    }

}
