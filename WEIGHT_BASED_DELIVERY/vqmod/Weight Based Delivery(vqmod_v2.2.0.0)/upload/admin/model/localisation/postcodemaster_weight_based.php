<?php
class ModelLocalisationPostcodemasterweightbased extends Model {
	public function addPostcode($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "postcode_master_weightbased SET postcode = '" . $this->db->escape($data['postcode']) . "', condition_type = '" . $this->db->escape($data['condition_type']) . "', min_weight = '" . $this->db->escape($data['min_weight']) . "', max_weight = '" . $this->db->escape($data['max_weight']) . "', shipping_charge = '" . $this->db->escape($data['shipping_charge']) . "' , status = '" . $this->db->escape($data['status']) . "'");
    }

	public function editPostcode($postcode_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "postcode_master_weightbased SET postcode = '" . $this->db->escape($data['postcode']) . "', condition_type = '" . $this->db->escape($data['condition_type']) . "', min_weight = '" . $this->db->escape($data['min_weight']) . "', max_weight = '" . $this->db->escape($data['max_weight']) . "', shipping_charge = '" . $this->db->escape($data['shipping_charge']) . "' , status = '" . $this->db->escape($data['status']) . "' WHERE postcode_id = '" . (int)$postcode_id . "'");

		/*$this->cache->delete('language');*/
	}

	public function deletePostcode($postcode_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "postcode_master_weightbased WHERE postcode_id = '" . (int)$postcode_id . "'");


	}

	public function getPostcode($postcode_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "postcode_master_weightbased WHERE postcode_id = '" . (int)$postcode_id . "'");

		return $query->row;
	}

	public function getPostcodes($data = array()) {
		if ($data) {
			$sql = "SELECT * FROM " . DB_PREFIX . "postcode_master_weightbased ORDER BY condition_type";

			$sort_data = array(
				'postcode',
				'condition_type',
				'min_weight',
				'max_weight',
				'shipping_charge',
				'status'
			);

			$query = $this->db->query($sql);

			return $query->rows;
		} else {
			$postcode_data = $this->cache->get('holidaymaster');

			if (!$postcode_data) {
                $postcode_data = array();

				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "postcode_master_weightbased ORDER BY condition_type");

				foreach ($query->rows as $result) {
                    $postcode_data[$result['postcode_id']] = array(
						'postcode_id' => $result['postcode_id'],
						'postcode'        => $result['postcode'],
						'condition_type'        => $result['condition_type'],
						'min_weight'      => $result['min_weight'],
						'max_weight'      => $result['max_weight'],
						'shipping_charge'      => $result['shipping_charge'],
						'status'      => $result['status']

					);
				}

				$this->cache->set('postcodemaster', $postcode_data);
			}

			return $postcode_data;
		}
	}

	public function getTotalLanguages() {
		/*$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "language");

		return $query->row['total'];*/
	}
}

