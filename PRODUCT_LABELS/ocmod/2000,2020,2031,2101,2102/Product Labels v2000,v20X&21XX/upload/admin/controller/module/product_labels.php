<?php
class ControllerModuleProductlabels extends Controller {
    private $error = array();

    public function index()
    {

        $this->load->language('module/product_labels');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('extension/module');


        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            if (!isset($this->request->get['module_id'])) {
                $this->model_extension_module->addModule('product_labels', $this->request->post);
            } else {
                $this->model_extension_module->editModule($this->request->get['module_id'], $this->request->post);
            }

        }

        $data['heading_title'] = $this->language->get('heading_title');
    }
    protected function validateForm() {
        if (!$this->user->hasPermission('modify', 'module/product_labels')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }

    public function install() {


         $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "product_labels` (
 `label_id` int(5) unsigned NOT NULL  PRIMARY KEY,
 `label_text` varchar(50) NOT NULL,
 `label_color` char(30) NOT NULL,
`label_text_color` char(30) NOT NULL,
`condition_type` int(3)  NOT NULL,
`status` enum('0','1') NOT NULL,
`position` int(3)  NOT NULL)");

        $this->db->query("insert into `" . DB_PREFIX . "product_labels` (label_id,label_text,label_color,label_text_color,condition_type,status,position)values (1,'New','#1cbfef','#c64a6a',30,1,2)");
        $this->db->query("insert into `" . DB_PREFIX . "product_labels` (label_id,label_text,label_color,label_text_color,condition_type,status,position)values (2,'Discount','#1cd04a','#25353a',50,1,1)");
        $this->db->query("insert into `" . DB_PREFIX . "product_labels` (label_id,label_text,label_color,label_text_color,condition_type,status,position)values (3,'Free shipping','#f12e1c','#d7ebf1',0,1,4)");
        $this->db->query("insert into `" . DB_PREFIX . "product_labels` (label_id,label_text,label_color,label_text_color,condition_type,status,position)values (4,'Out Of Stack','#43a19d','#d7ebf1',0,1,3)");

        $Enable=1;
        $this->load->model('setting/setting');
        $this->model_setting_setting->editSetting('product_label_install_status',array('product_label_install_status'=>$Enable));

     }
     public function uninstall() {
         $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "product_labels`");

         $Enable=0;
         $this->load->model('setting/setting');
         $this->model_setting_setting->editSetting('product_label_install_status',array('product_label_install_status'=>$Enable));

     }
}
?>
