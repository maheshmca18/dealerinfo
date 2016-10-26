<?php
class ModelLocalisationOrdertracking extends Model {
		public function addOrdertrack($data) { //print_r($data);exit;
		$this->db->query("INSERT INTO " . DB_PREFIX . "ordertrack SET courier_company_name = '" . $this->db->escape($data['courier_company_name']) . "',tracking_url = '" . $this->db->escape($data['tracking_url']) . "', status = '" . $this->db->escape($data['status']) . "'");

	}

	public function editOrdertrack($ordertracking_id, $data) { //print_r($data);exit;
      
		$this->db->query("UPDATE " . DB_PREFIX . "ordertrack SET courier_company_name = '" . $this->db->escape($data['courier_company_name']) . "',tracking_url = '" . $this->db->escape($data['tracking_url']) . "', status = '" . $this->db->escape($data['status']) . "'  WHERE ordertracking_id = '" . (int)$ordertracking_id . "'");

	}
	public function deleteOrdertrack($ordertracking_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "ordertrack WHERE ordertracking_id = '" . (int)$ordertracking_id . "'");

       }

	public function getOrdertrack($ordertracking_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "ordertrack WHERE ordertracking_id = '" . (int)$ordertracking_id . "'");

		return $query->row;
	}

	public function getOrdertracks($data = array()) {
		if ($data) {
			$sql = "SELECT * FROM " . DB_PREFIX . "ordertrack";

			$sort_data = array(
				'courier_company_name',
				'tracking_url',
				'status'
			);


			$query = $this->db->query($sql);

			return $query->rows;
		} else {
			$ordertrack_data = $this->cache->get('ordertrack');

			if (!$ordertrack_data) {
                $ordertrack_data = array();

				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "ordertrack ORDER BY courier_company_name");

				foreach ($query->rows as $result) {
                    $ordertrack_data[$result['ordertracking_id']] = array(
						'ordertracking_id' => $result['ordertracking_id'],
						'courier_company_name'        => $result['courier_company_name'],  
                                                'tracking_url'        => $result['tracking_url'],
						'status'        => $result['status']

					);
				}

				$this->cache->set('ordertrack', $ordertrack_data);
			}

			return $query->rows;
		}
	}

	public function getTotalrecords() {
		$query = $this->db->query("SELECT COUNT(*) AS holiday_name FROM " . DB_PREFIX . "ordertrack");

		//return $query->row['holiday_name'];
	}
}
