<?php
class ControllerExtensionModuleProductmrpvalue extends Controller {
    private $error = array();

    public function index()
    {

        $this->load->language('extension/module/productmrpvalue');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('extension/module');


        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            if (!isset($this->request->get['module_id'])) {
                $this->model_extension_module->addModule('productmrpvalue', $this->request->post);
            } else {
                $this->model_extension_module->editModule($this->request->get['module_id'], $this->request->post);
            }

        }

        $data['heading_title'] = $this->language->get('heading_title');
    }
    protected function validateForm() {
        if (!$this->user->hasPermission('modify', 'extension/module/productmrpvalue')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }

    public function install() {


        $this->db->query("ALTER TABLE `" . DB_PREFIX . "product` ADD `mrp` DECIMAL(15,2) NOT NULL AFTER `location`");
    }
    public function uninstall() {
         $this->db->query("ALTER TABLE `" . DB_PREFIX . "product` DROP COLUMN `mrp`");
    }
}
?>