<?php
class ControllerModuleDeliverydatetime extends Controller {

    private $error = array();

    public function index()
    { 
        $this->load->language('module/deliverydatetime');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

            $this->model_setting_setting->editSetting('deliverydatetime', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_edit'] = $this->language->get('text_edit');

        $data['text_status_enabled'] = $this->language->get('text_status_enabled');
        $data['text_status_disabled'] = $this->language->get('text_status_disabled');

        $data['entry_admin'] = $this->language->get('entry_admin');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_time_interval'] = $this->language->get('entry_time_interval');
                $data['text_min_day'] = $this->language->get('text_min_day');
        $data['text_max_day'] = $this->language->get('text_max_day');

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
            'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')            
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('module/deliverydatetime', 'token=' . $this->session->data['token'], 'SSL')           
        );


        $data['action'] = $this->url->link('module/deliverydatetime', 'token=' . $this->session->data['token'] , 'SSL');

        $data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

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
        
         //Holiday added	
        if (isset($this->request->post['deliverydatetime_min_day'])) {
            $data['deliverydatetime_min_day'] = $this->request->post['deliverydatetime_min_day'];
        } else {
            $data['deliverydatetime_min_day'] = $this->config->get('deliverydatetime_min_day');

        }

        if (isset($this->request->post['deliverydatetime_max_day'])) {
            $data['deliverydatetime_max_day'] = $this->request->post['deliverydatetime_max_day'];
        } else {
            $data['deliverydatetime_max_day'] = $this->config->get('deliverydatetime_max_day');
        }

	$data['header'] = $this->load->controller('common/header');
	$data['column_left'] = $this->load->controller('common/column_left');
	$data['footer'] = $this->load->controller('common/footer');

	$this->response->setOutput($this->load->view('module/deliverydatetime.tpl', $data));


    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'module/deliverydatetime')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
       //Holiday added	
        /*if (!$this->user->hasPermission('modify', 'extension/module/holidayweekday')) {
            $this->error['warning'] = $this->language->get('error_permission');
        } */       
        return !$this->error;
    }

    public function install() {

        $deliverydatetime_status=1;
        $this->load->model('setting/setting');
        
        //$min_day=array('deliverydatetime_max_day'=>'10','deliverydatetime_min_day'=>'3');

      //  $this->model_setting_setting->editSetting('deliverydatetime',$min_day);//add default min max days in db setting table
        
        $this->model_setting_setting->editSetting('deliverydatetime',array('deliverydatetime_status'=>$deliverydatetime_status,'deliverydatetime_timeinterval'=>4,'deliverydatetime_max_day'=>'10','deliverydatetime_min_day'=>'3'));


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
							
							
		//Holiday added					
		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "holiday_master` (
`holiday_id` int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
`holiday_name` varchar(255) NOT NULL,
`holiday_date` date NOT NULL,
`is_recursive` enum('1','0') NOT NULL,
`created_on` date NOT NULL,
`last_edited_on` date NOT NULL)");

       // $min_day=array('deliverydatetime_max_day'=>'10','deliverydatetime_min_day'=>'3');

       // $this->model_setting_setting->editSetting('deliverydatetime',$min_day);//add default min max days in db setting table


    }
    public function uninstall() {
        
        $this->load->model('setting/setting');      
        
        $deliverydatetime_status=0;
        $this->model_setting_setting->editSetting('deliverydatetime',array('deliverydatetime_status'=>$deliverydatetime_status));

        $this->db->query("ALTER TABLE `" . DB_PREFIX . "order` DROP `delivery_date`, DROP `delivery_time`");

						
        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "deliverydatetime`");
        
        //Holiday added		
        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "holiday_master`");
        $this->model_setting_setting->deleteSetting('weekdays');


    }
}


