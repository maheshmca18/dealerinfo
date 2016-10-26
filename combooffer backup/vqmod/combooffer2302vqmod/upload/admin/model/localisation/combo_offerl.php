<?php
class ModelLocalisationComboOfferl extends Model {
   public function addComboofferl($data) {

  $startdate = str_replace('/', '-', $data['c_start_date']);
            $cstartdate = date('Y-m-d', strtotime($startdate)); 
$enddate = str_replace('/', '-', $data['c_end_date']);
            $cenddate = date('Y-m-d', strtotime($enddate)); 
//echo $cstartdate; echo $cenddate ; exit;

   		$product=implode(",",$data['products']);
        $this->db->query("INSERT INTO " . DB_PREFIX . "combo_offerl SET 
        c_name = '" . $this->db->escape($data['c_name']) . "',
        c_discount_amount = '" . $this->db->escape($data['c_discount_price']) . "',
        c_product = '" . $this->db->escape($product) . "',
        c_start_date = '" . $this->db->escape($cstartdate) . "',
         c_end_date = '" . $this->db->escape($cenddate) . "',
        c_sort_order = '" . $this->db->escape($data['c_sort_order']) . "',
        c_status = '" . (int)$data['c_status'] . "'");

        if ($this->config->get('config_combo_offerl_auto')) {
            $this->refresh(true);
        }

       // $this->cache->delete('product_combo_offerl_master');
    }

    public function editComboofferl($c_id, $data) {
		//print_r($data); exit;
		$product=implode(",",$data['products']);
		$startdate = str_replace('/', '-', $data['c_start_date']);
            $cstartdate = date('Y-m-d', strtotime($startdate)); 
$enddate = str_replace('/', '-', $data['c_end_date']);
            $cenddate = date('Y-m-d', strtotime($enddate)); 
            
        $this->db->query("UPDATE " . DB_PREFIX . "combo_offerl SET 
        c_name = '" . $this->db->escape($data['c_name']) . "',
        c_discount_amount = '" . $this->db->escape($data['c_discount_price']) . "',
        c_product = '" . $this->db->escape($product) . "',
        c_start_date = '" . $this->db->escape($cstartdate) . "',
         c_end_date = '" . $this->db->escape($cenddate) . "',
        c_sort_order = '" . $this->db->escape($data['c_sort_order']) . "',
        c_status = '" . (int)$data['c_status'] . "' WHERE c_id = '" . (int)$c_id . "'");

        
    }

    public function deleteComboofferl($c_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "combo_offerl WHERE c_id = '" . (int)$c_id . "'");

           }

    public function getComboofferdetails($c_id) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "combo_offerl WHERE c_id = '" . (int)$c_id . "'");

        return $query->row;
    } 
    public function getProduct($product_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'product_id=" . (int)$product_id . "') AS keyword FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE p.product_id = '" . (int)$product_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}
	public function getProductdetails($product_id) {
		$product_related_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "combo_offerl WHERE product_id = '" . (int)$product_id . "'");

		foreach ($query->rows as $result) {
			$product_related_data[] = $result['related_id'];
		}

		return $product_related_data;
	}

      public function getComboofferl($data = array()) {
        if ($data) {
            $sql = "SELECT * FROM " . DB_PREFIX . "combo_offerl";

            $sort_data = array(
                'c_id',
                'c_name',
                'c_sort_order',
                'c_status',
               
            );

            $sql .= " ORDER BY c_sort_order ASC";

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
            $combo_offerl = $this->cache->get('combo_offerl');

            if (!$combo_offerl) {
                $combo_offerl = array();

                $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "combo_offerl ORDER BY c_sort_order ASC");

                foreach ($query->rows as $result) {
                    $combo_offerl[$result['c_id']] = array(
                        'c_id'   => $result['c_id'],
                        'c_name'         => $result['c_name'],
                        'sort'  =>$result['sort'],
                        'status'        => $result['status'],
                        'date' => $result['date']
                    );
                }

                $this->cache->set('combo_offerl', $combo_offerl);
            }

            return $combo_offerl;
        }
    }

    public function refresh($force = false) {
        if (extension_loaded('curl')) {
            $data = array();

           /* if ($force) {
                $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_item_condition_master WHERE code != '" . $this->db->escape($this->config->get('config_currency')) . "'");
            } else {
                $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_item_condition_master WHERE code != '" . $this->db->escape($this->config->get('config_currency')) . "' AND date_modified < '" .  $this->db->escape(date('Y-m-d H:i:s', strtotime('-1 day'))) . "'");
            }

            foreach ($query->rows as $result) {
                $data[] = $this->config->get('config_currency') . $result['ic_id'] . '=X';
            }*/

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
                   // $this->db->query("UPDATE " . DB_PREFIX . "product_item_condition_master SET value = '" . (float)$value . "', date_modified = '" .  $this->db->escape(date('Y-m-d H:i:s')) . "' WHERE code = '" . $this->db->escape($currency) . "'");
                }
            }

           // $this->db->query("UPDATE " . DB_PREFIX . "product_item_condition_master SET value = '1.00000', date_modified = '" .  $this->db->escape(date('Y-m-d H:i:s')) . "' WHERE code = '" . $this->db->escape($this->config->get('config_currency')) . "'");

           // $this->cache->delete('product_item_condition_master');
        }
    }

    public function getTotalcomboofferl() {
        $query = $this->db->query("SELECT COUNT(*) AS c_name FROM " . DB_PREFIX . "combo_offerl");

        return $query->row['c_name'];
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

}
