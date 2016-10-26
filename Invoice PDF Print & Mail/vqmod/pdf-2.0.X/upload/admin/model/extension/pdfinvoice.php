<?php
class ModelExtensionPdfinvoice extends Model {
    public function addpdfinvoice($pdftaxname, $pdftaxnumber) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "pdf_invoice SET `pdf_invoice_taxname` = '" . $this->db->escape($pdftaxname) . "', `pdf_invoice_taxnumber` = '" . $this->db->escape($pdftaxnumber) . "'");

        $pdfinvoice_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "pdf_invoice ");

        foreach ($query->rows as $result) {
            $pdfinvoice_data[] = $result;
        }

        return $pdfinvoice_data;

    }
    public function editpdfinvoice($pdftaxid,$pdftaxname,$pdftaxnumber) {

        $this->db->query("UPDATE " . DB_PREFIX . "pdf_invoice SET pdf_invoice_taxname = '" . $pdftaxname . "', pdf_invoice_taxnumber = '" . $pdftaxnumber . "' WHERE pdf_invoice_id = '" . (int)$pdftaxid . "'");

        $pdfinvoice_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "pdf_invoice ");

        foreach ($query->rows as $result) {
            $pdfinvoice_data[] = $result;
        }

        return $pdfinvoice_data;


    }
    public function getpdfinvoice() {

        $pdfinvoice_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "pdf_invoice ");

        foreach ($query->rows as $result) {
            $pdfinvoice_data[] = $result;
        }

        return $pdfinvoice_data;

    }

    public function deletepdfinvoice($pdftaxid) {

        $this->db->query("DELETE FROM " . DB_PREFIX . "pdf_invoice WHERE `pdf_invoice_id` = '" . $this->db->escape($pdftaxid) . "'");

        $pdfinvoice_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "pdf_invoice ");

        foreach ($query->rows as $result) {
            $pdfinvoice_data[] = $result;
        }

        return $pdfinvoice_data;
    }
}