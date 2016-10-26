<?php
class ModelLocalisationItemCondition extends Model {
    public function addCurrency($data) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "product_item_condition_master SET ic_name = '" . $this->db->escape($data['ic_name']) . "',sort = '" . $this->db->escape($data['sort']) . "',  status = '" . (int)$data['status'] . "', date = NOW()");

        if ($this->config->get('config_item_condition_auto')) {
            $this->refresh(true);
        }

        $this->cache->delete('product_item_condition_master');
    }

    public function editCurrency($ic_id, $data) {
        $this->db->query("UPDATE " . DB_PREFIX . "product_item_condition_master SET ic_name = '" . $this->db->escape($data['ic_name']) . "',sort = '" . $this->db->escape($data['sort']) . "', status = '" . (int)$data['status'] . "', date = NOW() WHERE ic_id = '" . (int)$ic_id . "'");

        $this->cache->delete('product_item_condition_master');
    }

    public function deleteCurrency($ic_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_item_condition_master WHERE ic_id = '" . (int)$ic_id . "'");

        $this->cache->delete('product_item_condition_master');
    }

    public function getCurrency($ic_id) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "product_item_condition_master WHERE ic_id = '" . (int)$ic_id . "'");

        return $query->row;
    }

   /* public function getCurrencyByCode($currency) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "currency WHERE code = '" . $this->db->escape($currency) . "'");

        return $query->row;
    }*/

    public function getCurrencies($data = array()) {
        if ($data) {
            $sql = "SELECT * FROM " . DB_PREFIX . "product_item_condition_master";

            $sort_data = array(
                'ic_id',
                'ic_name',
                'sort',
                'status',
                'date'
            );

            /*if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
                $sql .= " ORDER BY " . $data['sort'];
            } else {
                $sql .= " ORDER BY sort";
            }

            if (isset($data['order']) && ($data['order'] == 'DESC')) {
                $sql .= " DESC";
            } else {
                $sql .= " ASC";
            }*/
            $sql .= " ORDER BY sort ASC";

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
        } else {
            $currency_data = $this->cache->get('product_item_condition_master');

            if (!$currency_data) {
                $currency_data = array();

                $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_item_condition_master ORDER BY sort ASC");

                foreach ($query->rows as $result) {
                    $currency_data[$result['ic_id']] = array(
                        'ic_id'   => $result['ic_id'],
                        'ic_name'         => $result['ic_name'],
                        'sort'  =>$result['sort'],
                        'status'        => $result['status'],
                        'date' => $result['date']
                    );
                }

                $this->cache->set('product_item_condition_master', $currency_data);
            }

            return $currency_data;
        }
    }

    public function refresh($force = false) {
        if (extension_loaded('curl')) {
            $data = array();

            if ($force) {
                $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_item_condition_master WHERE code != '" . $this->db->escape($this->config->get('config_currency')) . "'");
            } else {
                $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_item_condition_master WHERE code != '" . $this->db->escape($this->config->get('config_currency')) . "' AND date_modified < '" .  $this->db->escape(date('Y-m-d H:i:s', strtotime('-1 day'))) . "'");
            }

            foreach ($query->rows as $result) {
                $data[] = $this->config->get('config_currency') . $result['ic_id'] . '=X';
            }

            $curl = curl_init();

            curl_setopt($curl, CURLOPT_URL, 'http://download.finance.yahoo.com/d/quotes.csv?s=' . implode(',', $data) . '&f=sl1&e=.csv');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
            curl_setopt($curl, CURLOPT_TIMEOUT, 30);

            $content = curl_exec($curl);

            curl_close($curl);

            $lines = explode("\n", trim($content));

            foreach ($lines as $line) {
                $currency = utf8_substr($line, 4, 3);
                $value = utf8_substr($line, 11, 6);

                if ((float)$value) {
                    $this->db->query("UPDATE " . DB_PREFIX . "product_item_condition_master SET value = '" . (float)$value . "', date_modified = '" .  $this->db->escape(date('Y-m-d H:i:s')) . "' WHERE code = '" . $this->db->escape($currency) . "'");
                }
            }

            $this->db->query("UPDATE " . DB_PREFIX . "product_item_condition_master SET value = '1.00000', date_modified = '" .  $this->db->escape(date('Y-m-d H:i:s')) . "' WHERE code = '" . $this->db->escape($this->config->get('config_currency')) . "'");

            $this->cache->delete('product_item_condition_master');
        }
    }

    public function getTotalCurrencies() {
        $query = $this->db->query("SELECT COUNT(*) AS ic_name FROM " . DB_PREFIX . "product_item_condition_master");

        return $query->row['ic_name'];
    }
}