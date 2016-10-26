<?php
class ModelLocalisationDeliverytimeslot extends Model {
		public function addTimeslot($data) { 
		$this->db->query("INSERT INTO " . DB_PREFIX . "deliverydatetime SET from_time = '" . $this->db->escape($data['from_time']) . "',to_time = '" . $this->db->escape($data['to_time']) . "',title = '" . $this->db->escape($data['title']) . "', status = '" . $this->db->escape($data['status']) . "'");

	}

	public function editTimeslot($deliverytime_id, $data) { //print_r($data);exit;
      
		$this->db->query("UPDATE " . DB_PREFIX . "deliverydatetime SET from_time = '" . $this->db->escape($data['from_time']) . "',to_time = '" . $this->db->escape($data['to_time']) . "',title = '" . $this->db->escape($data['title']) . "', status = '" . $this->db->escape($data['status']) . "'  WHERE deliverytime_id = '" . (int)$deliverytime_id . "'");

	}
	public function deleteTimeslot($deliverytime_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "deliverydatetime WHERE deliverytime_id = '" . (int)$deliverytime_id . "'");

       }

	public function getTimeslot($deliverytime_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "deliverydatetime WHERE deliverytime_id = '" . (int)$deliverytime_id . "'");

		return $query->row;
	}

	public function getTimeslots($data = array()) {
		if ($data) {
			$sql = "SELECT * FROM " . DB_PREFIX . "deliverydatetime";

			$sort_data = array(
				'title',
				'status'
			);


			$query = $this->db->query($sql);

			return $query->rows;
		} else {
			$holiday_data = $this->cache->get('deliverytimeslot');

			if (!$holiday_data) {
                $holiday_data = array();

				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "deliverydatetime ORDER BY title");

				foreach ($query->rows as $result) {
                    $holiday_data[$result['deliverytime_id']] = array(
						'deliverytime_id' => $result['deliverytime_id'],
						'title'        => $result['title'],  
                                                 'from_time'        => $result['from_time'],
						'to_time'        => $result['to_time'],
						'status'        => $result['status']

					);
				}

				$this->cache->set('deliverytimeslot', $holiday_data);
			}

			return $query->rows;
		}
	}

	public function getTotalrecords() {
		$query = $this->db->query("SELECT COUNT(*) AS holiday_name FROM " . DB_PREFIX . "deliverydatetime");

		//return $query->row['holiday_name'];
	}
}
