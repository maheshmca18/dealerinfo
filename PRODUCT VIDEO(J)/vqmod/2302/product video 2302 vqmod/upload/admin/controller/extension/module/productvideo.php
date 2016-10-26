<?php
class ControllerExtensionModuleProductvideo extends Controller {
    private $error = array();

    public function index()
    {

        $this->load->language('extension/module/productvideo');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('extension/module');


        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            if (!isset($this->request->get['module_id'])) {
                $this->model_extension_module->addModule('productvideo', $this->request->post);
            } else {
                $this->model_extension_module->editModule($this->request->get['module_id'], $this->request->post);
            }

        }

        $data['heading_title'] = $this->language->get('heading_title');
    }
    protected function validateForm() {
        if (!$this->user->hasPermission('modify', 'extension/module/productvideo')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }

    public function install() {


        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "video_link` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`product_id` int(10) unsigned NOT NULL,
`label` varchar(255) NOT NULL,
`url` varchar(255) NOT NULL,
`image` varchar(255) NOT NULL,
`status` varchar(255) NOT NULL,
PRIMARY KEY (`id`)
)");
    }
    public function uninstall() {
        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "video_link`");
    }
}
?>