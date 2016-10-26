<?php
class ControllerModuleProductmrpvalue extends Controller {

    private $error = array();

    public function index()
    {
        $this->load->language('module/productmrpvalue');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

            $this->model_setting_setting->editSetting('mrp', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['text_edit'] = $this->language->get('text_edit');

        $this->data['text_min_day'] = $this->language->get('text_min_day');
        $this->data['text_max_day'] = $this->language->get('text_max_day');
        $this->data['text_status_enabled'] = $this->language->get('text_status_enabled');
        $this->data['text_status_disabled'] = $this->language->get('text_status_disabled');

        $this->data['entry_admin'] = $this->language->get('entry_admin');
        $this->data['entry_status'] = $this->language->get('entry_status');

        $this->data['button_save'] = $this->language->get('button_save');
        $this->data['button_cancel'] = $this->language->get('button_cancel');

        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
        }

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_module'),
            'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => '::'
        );

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('module/productmrpvalue', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => '::'
        );


        $this->data['action'] = $this->url->link('module/productmrpvalue', 'token=' . $this->session->data['token'], 'SSL');

        $this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

        $this->data['token'] = $this->session->data['token'];

        if (isset($this->request->post['mrp_status'])) {
            $this->data['mrp_status'] = $this->request->post['mrp_status'];
        } else {
            $this->data['mrp_status'] = $this->config->get('mrp_status');
        }


        $this->template = 'module/productmrpvalue.tpl';
        $this->children = array(
            'common/header',
            'common/footer',
        );
        $this->response->setOutput($this->render());

    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'module/productmrpvalue')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        return !$this->error;
    }

    public function install() {


        $this->db->query("ALTER TABLE `" . DB_PREFIX . "product` ADD `mrp` DECIMAL(15,2) NOT NULL AFTER `location`");

        //set status enable
        $Enable=0;
        $this->load->model('setting/setting');
        $this->model_setting_setting->editSetting('mrp',array('mrp_status'=>$Enable));

    }
    public function uninstall() {
         $this->db->query("ALTER TABLE `" . DB_PREFIX . "product` DROP COLUMN `mrp`");
        $Enable=0;
        $this->model_setting_setting->editSetting('mrp',array('mrp_status'=>$Enable));
    }
}


