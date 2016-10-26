<?php
class ControllerModuleWeightbaseddelivery extends Controller {
    private $error = array();

    public function index()
    {

        $this->load->language('module/weight_based_delivery');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('extension/module');


        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            if (!isset($this->request->get['module_id'])) {
                $this->model_extension_module->addModule('weight_based_delivery', $this->request->post);
            } else {
                $this->model_extension_module->editModule($this->request->get['module_id'], $this->request->post);
            }

        }

        $data['heading_title'] = $this->language->get('heading_title');
    }
    protected function validateForm() {
        if (!$this->user->hasPermission('modify', 'module/weight_based_delivery')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }

    public function install() {


        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "postcode_master_weightbased` (
`postcode_id` int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
`postcode` int(10) unsigned NOT NULL,
`condition_type` enum('1','2','3') NOT NULL,
`min_weight` float NOT NULL,
`max_weight` float NOT NULL,
`shipping_charge` int(10) unsigned NOT NULL,
`status` int(10) unsigned NOT NULL)");
    }
    public function uninstall() {
        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "postcode_master_weightbased`");
    }
}
?>
