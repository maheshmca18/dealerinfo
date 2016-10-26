<?php
class ModelLocalisationHolidaymaster extends Model {
	public function addHoliday($data) {
        //change date formate and sent to db...
        $date = str_replace('/', '-',$data['holiday_date']);
        $datevaluechange = date('Y-m-d', strtotime($date));

		$this->db->query("INSERT INTO " . DB_PREFIX . "holiday_master SET holiday_name = '" . $this->db->escape($data['holiday_name']) . "', holiday_date = '" . $this->db->escape($datevaluechange) . "', is_recursive = '" . $this->db->escape($data['is_recursive']) . "'");

	}

	public function editHoliday($holiday_id, $data) {
        $date = str_replace('/', '-',$data['holiday_date']);
        $datevaluechange = date('Y-m-d', strtotime($date));

		$this->db->query("UPDATE " . DB_PREFIX . "holiday_master SET holiday_name = '" . $this->db->escape($data['holiday_name']) . "', holiday_date = '" . $this->db->escape($datevaluechange) . "', is_recursive = '" . $this->db->escape($data['is_recursive']) . "' WHERE holiday_id = '" . (int)$holiday_id . "'");

	}

	public function deleteHoliday($holiday_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "holiday_master WHERE holiday_id = '" . (int)$holiday_id . "'");

    }

	public function getHoliday($holiday_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "holiday_master WHERE holiday_id = '" . (int)$holiday_id . "'");

		return $query->row;
	}

	public function getHolidays($data = array()) {
		if ($data) {
			$sql = "SELECT * FROM " . DB_PREFIX . "holiday_master";

			$sort_data = array(
				'holiday_name',
				'holiday_date',
				'is_recursive'
			);


			$query = $this->db->query($sql);

			return $query->rows;
		} else {
			$holiday_data = $this->cache->get('holidaymaster');

			if (!$holiday_data) {
                $holiday_data = array();

				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "holiday_master ORDER BY holiday_name");

				foreach ($query->rows as $result) {
                    $holiday_data[$result['holiday_id']] = array(
						'holiday_id' => $result['holiday_id'],
						'holiday_name'        => $result['holiday_name'],
						'holiday_date'        => $result['holiday_date'],
						'is_recursive'      => $result['is_recursive']

					);
				}

				$this->cache->set('holidaymaster', $holiday_data);
			}

			return $query->rows;
		}
	}

	public function getTotalLanguages() {
		/*$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "language");

		return $query->row['total'];*/
	}
}
