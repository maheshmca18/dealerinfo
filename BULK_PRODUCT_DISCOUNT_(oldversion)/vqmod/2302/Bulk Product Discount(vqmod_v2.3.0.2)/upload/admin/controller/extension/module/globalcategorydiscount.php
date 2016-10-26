<?php
class ControllerExtensionModuleGlobalCategoryDiscount extends Controller {

    private $error = array();

    public function index()
    {
        $this->load->language('extension/module/globalcategorydiscount');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');


        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
           
            $this->model_setting_setting->editSetting('global', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true));
        }

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_edit'] = $this->language->get('text_edit');

        $data['text_min_day'] = $this->language->get('text_min_day');
        $data['text_max_day'] = $this->language->get('text_max_day');
        $data['text_status_enabled'] = $this->language->get('text_status_enabled');
        $data['text_status_disabled'] = $this->language->get('text_status_disabled');

        $data['entry_admin'] = $this->language->get('entry_admin');
        $data['entry_status'] = $this->language->get('entry_status');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        $data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true),
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true),
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/globalcategorydiscount', 'token=' . $this->session->data['token'], true)
		);

        if (isset($this->error['error_global_discount'])) {
            $data['error_discount'] = $this->error['error_global_discount'];
        } else {
            $data['error_discount'] = '';
        }

		$data['action'] = $this->url->link('extension/module/globalcategorydiscount', 'token=' . $this->session->data['token'], true);

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);
		

      //  $data['token'] = $this->session->data['token'];

        if (isset($this->request->post['global_discount'])) {
            $data['global_discount'] = $this->request->post['global_discount'];
        } else {
            $data['global_discount'] = $this->config->get('global_discount');
        }

       if (isset($this->request->post['global_discount_status'])) {
            $data['global_discount_status'] = $this->request->post['global_discount_status'];
        } else {
            $data['global_discount_status'] = $this->config->get('global_discount_status');
        }

        $data['header']      = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer']      = $this->load->controller('common/footer');

	$this->response->setOutput($this->load->view('extension/module/globalcategorydiscount', $data));


    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'extension/module/globalcategorydiscount')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        if(!$this->request->post['global_discount'])
        {
            $this->error['error_global_discount']="Please give global discount percentage";

        }
        return !$this->error;
    }

    public function install() {

$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "category_discount` (
`category_discount_id` int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
`category_id` int(11) unsigned NOT NULL,
`customer_group_id` int(11) unsigned NOT NULL,
`percentage` decimal(15,4) unsigned NOT NULL,
`date_start` date NOT NULL,
`date_end` date NOT NULL,
`status` enum('1','0') NOT NULL)");

        //set status enable
        $Enable=0;
        $this->load->model('setting/setting');
        $this->model_setting_setting->editSetting('global',array('global_discount_status'=>$Enable,'global_discount'=>1));

    }
    public function uninstall() {
        $Enable=1;
		$this->load->model('setting/setting');
        $this->model_setting_setting->editSetting('global',array('global_discount_status'=>$Enable));
    }
}



