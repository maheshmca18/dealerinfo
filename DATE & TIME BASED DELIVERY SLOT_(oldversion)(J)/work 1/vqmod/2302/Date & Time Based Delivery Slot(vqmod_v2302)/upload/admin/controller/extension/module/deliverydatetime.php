<?php
class ControllerExtensionModuleDeliverydatetime extends Controller {

    private $error = array();

    public function index()
    { 
        $this->load->language('extension/module/deliverydatetime');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

            $this->model_setting_setting->editSetting('deliverydatetime', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_edit'] = $this->language->get('text_edit');

        $data['text_status_enabled'] = $this->language->get('text_status_enabled');
        $data['text_status_disabled'] = $this->language->get('text_status_disabled');

        $data['entry_admin'] = $this->language->get('entry_admin');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_time_interval'] = $this->language->get('entry_time_interval');

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
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL')           
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_module'),
            'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'], 'SSL')            
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('module/module/deliverydatetime', 'token=' . $this->session->data['token'], 'SSL')           
        );


        $data['action'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', 'SSL');

        $data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', 'SSL');

        $data['token'] = $this->session->data['token'];

        if (isset($this->request->post['deliverydatetime_status'])) {
            $data['deliverydatetime_status'] = $this->request->post['deliverydatetime_status'];
        } else {
            $data['deliverydatetime_status'] = $this->config->get('deliverydatetime_status');
        }

        if (isset($this->request->post['deliverydatetime_timeinterval'])) {
            $data['deliverydatetime_timeinterval'] = $this->request->post['deliverydatetime_timeinterval'];
        } else {
            $data['deliverydatetime_timeinterval'] = $this->config->get('deliverydatetime_timeinterval');
        }

	$data['header'] = $this->load->controller('common/header');
	$data['column_left'] = $this->load->controller('common/column_left');
	$data['footer'] = $this->load->controller('common/footer');

	$this->response->setOutput($this->load->view('extension/module/deliverydatetime', $data));


    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'extension/module/deliverydatetime')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        return !$this->error;
    }

    public function install() {

        $deliverydatetime_status=1;
        $this->load->model('setting/setting');
        $this->model_setting_setting->editSetting('deliverydatetime',array('deliverydatetime_status'=>$deliverydatetime_status,'deliverydatetime_timeinterval'=>4));


//timeslot
        $this->db->query("ALTER TABLE `" . DB_PREFIX . "order` ADD `delivery_date` DATE NOT NULL AFTER `shipping_method`, ADD `delivery_time` varchar(30) NOT NULL AFTER `delivery_date`");
						
        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "deliverydatetime` (
							  `deliverytime_id` int(11) NOT NULL AUTO_INCREMENT,
							  `title` varchar(30) NOT NULL,
							  `from_time` varchar(255) NOT NULL,
							  `to_time` varchar(255) NOT NULL,
							  `status` enum('1','0') NOT NULL,
								PRIMARY KEY (deliverytime_id)
							)");


    }
    public function uninstall() {
        
        $deliverydatetime_status=0;
        $this->model_setting_setting->editSetting('deliverydatetime',array('deliverydatetime_status'=>$deliverydatetime_status));

//timeslot
        $this->db->query("ALTER TABLE `" . DB_PREFIX . "order` DROP `delivery_date`, DROP `delivery_time`");

						
        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "deliverydatetime`");


    }
}


