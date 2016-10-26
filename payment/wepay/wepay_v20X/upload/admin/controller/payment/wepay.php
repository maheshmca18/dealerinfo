<?php
class ControllerPaymentWePay extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('payment/wepay');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

			$this->model_setting_setting->editSetting('wepay', $this->request->post);
			
			
			$this->session->data['success'] = $this->language->get('text_success');

			//$this->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
 $this->response->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_all_zones'] = $this->language->get('text_all_zones');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_authorization'] = $this->language->get('text_authorization');
		$data['text_sale'] = $this->language->get('text_sale');
  $data['text_edit'] = $this->language->get('text_edit');

		$data['entry_staging'] = $this->language->get('entry_staging');
		$data['entry_accountid'] = $this->language->get('entry_accountid');
		$data['entry_clientid'] = $this->language->get('entry_clientid');
		$data['entry_clientsecret'] = $this->language->get('entry_clientsecret');
		$data['entry_accesstoken'] = $this->language->get('entry_accesstoken');
		$data['entry_feepayer'] = $this->language->get('entry_feepayer');
		$data['entry_chargetax'] = $this->language->get('entry_chargetax');	
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$data['entry_status'] = $this->language->get('entry_status');
        $data['entry_pending_status'] = $this->language->get('entry_pending_status');
        $data['entry_processed_status'] = $this->language->get('entry_processed_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

 
 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

 		if (isset($this->error['email'])) {
			$data['error_email'] = $this->error['email'];
		} 
		
		if (isset($this->error['staging'])) {
			$data['error_staging'] = $this->error['staging'];
		} 
		
		if (isset($this->error['accountid'])) {
			$data['error_accountid'] = $this->error['accountid'];
		} 
        
        if (isset($this->error['clientid'])) {
			$data['error_clientid'] = $this->error['clientid'];
		} 
        
        if (isset($this->error['clientsecret'])) {
			$data['error_clientsecret'] = $this->error['clientsecret'];
		} 
        
        if (isset($this->error['accesstoken'])) {
			$data['error_accesstoken'] = $this->error['accesstoken'];
		} 
        if (isset($this->error['feepayer'])) {
			$data['error_feepayer'] = $this->error['feepayer'];
		}
        
        if (isset($this->error['chargetax'])) {
			$data['error_chargetax'] = $this->error['chargetax'];
		} else {
			$data['error_chargetax'] = '';
		}


		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),      		
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_payment'),
			'href'      => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('payment/wepay', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

		$data['action'] = $this->url->link('payment/wepay', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['wepay_staging'])) {
			$data['wepay_staging'] = $this->request->post['wepay_staging'];
		} else {
			$data['wepay_staging'] = $this->config->get('wepay_staging');
		}
		
		if (isset($this->request->post['wepay_accountid'])) {
			$data['wepay_accountid'] = $this->request->post['wepay_accountid'];
		} else {
			$data['wepay_accountid'] = $this->config->get('wepay_accountid');
		}

		if (isset($this->request->post['wepay_clientid'])) {
			$data['wepay_clientid'] = $this->request->post['wepay_clientid'];
		} else {
			$data['wepay_clientid'] = $this->config->get('wepay_clientid');
		}


		if (isset($this->request->post['wepay_clientsecret'])) {
			$data['wepay_clientsecret'] = $this->request->post['wepay_clientsecret'];
		} else {
			$data['wepay_clientsecret'] = $this->config->get('wepay_clientsecret');
		}
		
		if (isset($this->request->post['wepay_accesstoken'])) {
			$data['wepay_accesstoken'] = $this->request->post['wepay_accesstoken'];
		} else {
			$data['wepay_accesstoken'] = $this->config->get('wepay_accesstoken'); 
		} 
        
        if (isset($this->request->post['wepay_feepayer'])) {
			$data['wepay_feepayer'] = $this->request->post['wepay_feepayer'];
		} else {
			$data['wepay_feepayer'] = $this->config->get('wepay_feepayer'); 
		} 
        
        if (isset($this->request->post['wepay_chargetax'])) {
			$data['wepay_chargetax'] = $this->request->post['wepay_chargetax'];
		} else {
			$data['wepay_chargetax'] = $this->config->get('wepay_chargetax'); 
		} 

		$this->load->model('localisation/order_status');

		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		if (isset($this->request->post['wepay_geo_zone_id'])) {
			$data['wepay_geo_zone_id'] = $this->request->post['wepay_geo_zone_id'];
		} else {
			$data['wepay_geo_zone_id'] = $this->config->get('wepay_geo_zone_id');
		}

		$this->load->model('localisation/geo_zone');

		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		if (isset($this->request->post['wepay_status'])) {
			$data['wepay_status'] = $this->request->post['wepay_status'];
		} else {
			$data['wepay_status'] = $this->config->get('wepay_status');
		}
        
        if (isset($this->request->post['wepay_pending_status_id'])) {
			$data['wepay_pending_status_id'] = $this->request->post['wepay_pending_status_id'];
		} else {
			$data['wepay_pending_status_id'] = $this->config->get('wepay_pending_status_id');
		}
        
        if (isset($this->request->post['wepay_processed_status_id'])) {
			$data['wepay_processed_status_id'] = $this->request->post['wepay_processed_status_id'];
		} else {
			$data['wepay_processed_status_id'] = $this->config->get('wepay_processed_status_id');
		}
		
		if (isset($this->request->post['wepay_sort_order'])) {
			$data['wepay_sort_order'] = $this->request->post['wepay_sort_order'];
		} else {
			$data['wepay_sort_order'] = $this->config->get('wepay_sort_order');
		}
 
 
 


	$data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('payment/wepay.tpl', $data));
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'payment/wepay')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

	if ($this->request->post['wepay_accountid']=="") {
			$this->error['accountid'] = $this->language->get('error_accountid');
		}
if ($this->request->post['wepay_clientid']=="") {
			$this->error['clientid'] = $this->language->get('error_clientid');
		}
if ($this->request->post['wepay_clientsecret']=="") {
			$this->error['clientsecret'] = $this->language->get('error_clientsecret');
		}
if ($this->request->post['wepay_accesstoken']=="") {
			$this->error['accesstoken'] = $this->language->get('error_accesstoken');
		}
if ($this->request->post['wepay_feepayer']=="") {
			$this->error['feepayer'] = $this->language->get('error_feepayer');
		}
if ($this->request->post['wepay_chargetax']=="") {
			$this->error['chargetax'] = $this->language->get('error_chargetax');
		}



		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
}
?>
