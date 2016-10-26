<?php
class ModelCheckoutHolidaydate extends Model {

    public function getHolidaydate() {

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "holiday_master");
         return $query->rows;

    }

}
