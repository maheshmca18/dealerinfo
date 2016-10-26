<?php
class ModelLocalisationMinimumOrderTotal extends Model {
    public function addMinimumordertotal($data) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "minimum_order_total SET mot_total = '" . $this->db->escape($data['minimum_order_total_total']) . "',mot_geo_zone_id = '" . $this->db->escape($data['minimum_order_total_geo_zone_id']) . "',  mot_status = '" . (int)$data['minimum_order_total_status'] . "'");

        $this->cache->delete('minimum_order_total');
    }

    public function editMinimumordertotal($mot_id, $data) {
        $this->db->query("UPDATE " . DB_PREFIX . "minimum_order_total SET mot_total = '" . $this->db->escape($data['minimum_order_total_total']) . "',mot_geo_zone_id = '" . $this->db->escape($data['minimum_order_total_geo_zone_id']) . "', mot_status = '" . (int)$data['minimum_order_total_status'] . "' WHERE mot_id = '" . (int)$mot_id . "'");

        $this->cache->delete('minimum_order_total');
    }

    public function deleteMinimumordertotal($mot_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "minimum_order_total WHERE mot_id = '" . (int)$mot_id . "'");

        $this->cache->delete('minimum_order_total');
    }

    public function getMinimumordertotal($mot_id) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "minimum_order_total WHERE mot_id = '" . (int)$mot_id . "'");

        return $query->row;
    }

    public function getMinimumordertotaldetails($data = array()) {
        if ($data) {
            $sql = "SELECT * FROM " . DB_PREFIX . "minimum_order_total";

            $sql .= " ORDER BY mot_id ASC";

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
            $Minimumordertotal_data = $this->cache->get('minimum_order_total');

            if (!$Minimumordertotal_data) {
                $Minimumordertotal_data = array();

                $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "minimum_order_total ORDER BY sort ASC");

                foreach ($query->rows as $result) {
                    $Minimumordertotal_data[$result['mot_id']] = array(
                        'mot_id'   => $result['mot_id'],
                        'mot_total'         => $result['mot_total'],
                        'mot_geo_zone_id'  =>$result['mot_geo_zone_id'],
                        'mot_status'        => $result['mot_status']
                    );
                }

                $this->cache->set('minimum_order_total', $Minimumordertotal_data);
            }

            return $Minimumordertotal_data;
        }
    }

    public function getTotalMinimumordertotaldetails() {
        $query = $this->db->query("SELECT COUNT(*) AS mot_total FROM " . DB_PREFIX . "minimum_order_total");

        return $query->row['mot_total'];
    }
}