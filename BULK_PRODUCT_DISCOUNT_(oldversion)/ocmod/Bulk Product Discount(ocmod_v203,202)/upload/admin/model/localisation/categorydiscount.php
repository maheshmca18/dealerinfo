<?php
class ModelLocalisationCategorydiscount extends Model {
	public function addCategoryDiscount($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "category_discount SET category_id = '" . (int)$data['category_id'] . "', customer_group_id = '" . (int)$data['customer_group_id'] . "', percentage = '" . $this->db->escape($data['percentage']) . "', status = '" . (int)$data['status'] . "'");

		$this->cache->delete('categorydiscount');
	}

	public function editCategoryDiscount($category_discount_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "category_discount SET category_id = '" . (int)$data['category_id'] . "', customer_group_id = '" . (int)$data['customer_group_id'] . "', percentage = '" . $this->db->escape($data['percentage']) . "', status = '" . (int)$data['status'] . "' WHERE category_discount_id = '" . (int)$category_discount_id . "'");

		$this->cache->delete('categorydiscount');
	}

	public function deleteCategoryDiscount($category_discount_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "category_discount WHERE category_discount_id = '" . (int)$category_discount_id . "'");

		$this->cache->delete('categorydiscount');
	}

	public function getCategoryDiscount($category_discount_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "category_discount WHERE category_discount_id = '" . (int)$category_discount_id . "'");

		return $query->row;
	}

	public function getCategoryDiscounts($data = array()) {
		if ($data) {
			$sql = "SELECT * FROM " . DB_PREFIX . "category_discount";

			$sort_data = array(
				'category_id',
			);	

			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];	
			} else {
				$sql .= " ORDER BY category_id";	
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
		} else {
			$categorydiscount_data = $this->cache->get('categorydiscount');

			if (!$categorydiscount_data) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category_discount ORDER BY category_id ASC");

				$categorydiscount_data = $query->rows;

				$this->cache->set('categorydiscount', $country_data);
			}

			return $categorydiscount_data;			
		}	
	}

	public function getTotalCategoryDiscounts() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "category_discount");

		return $query->row['total'];
	}	
}
?>
