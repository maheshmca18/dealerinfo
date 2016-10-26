<?php
class ControllerPaymentWePay extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('payment/wepay');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('WePay', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_all_zones'] = $this->language->get('text_all_zones');
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');
		$this->data['text_authorization'] = $this->language->get('text_authorization');
		$this->data['text_sale'] = $this->language->get('text_sale');

		$this->data['entry_staging'] = $this->language->get('entry_staging');
		$this->data['entry_accountid'] = $this->language->get('entry_accountid');
		$this->data['entry_clientid'] = $this->language->get('entry_clientid');
		$this->data['entry_clientsecret'] = $this->language->get('entry_clientsecret');
		$this->data['entry_accesstoken'] = $this->language->get('entry_accesstoken');
		$this->data['entry_feepayer'] = $this->language->get('entry_feepayer');
		$this->data['entry_chargetax'] = $this->language->get('entry_chargetax');	
		$this->data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$this->data['entry_status'] = $this->language->get('entry_status');
        $this->data['entry_pending_status'] = $this->language->get('entry_pending_status');
        $this->data['entry_processed_status'] = $this->language->get('entry_processed_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

 
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

 		if (isset($this->error['email'])) {
			$this->data['error_email'] = $this->error['email'];
		} else {
			$this->data['error_email'] = '';
		}
		
		if (isset($this->error['staging'])) {
			$this->data['error_staging'] = $this->error['staging'];
		} else {
			$this->data['error_staging'] = '';
		}
		
		if (isset($this->error['accountid'])) {
			$this->data['error_accountid'] = $this->error['accountid'];
		} else {
			$this->data['error_accountid'] = '';
		}
        
        if (isset($this->error['clientid'])) {
			$this->data['error_clientid'] = $this->error['clientid'];
		} else {
			$this->data['error_clientid'] = '';
		}
        
        if (isset($this->error['clientsecret'])) {
			$this->data['error_clientsecret'] = $this->error['clientsecret'];
		} else {
			$this->data['error_clientsecret'] = '';
		}
        
        if (isset($this->error['accesstoken'])) {
			$this->data['error_accesstoken'] = $this->error['accesstoken'];
		} else {
			$this->data['error_accesstoken'] = '';
		}
        
        if (isset($this->error['feepayer'])) {
			$this->data['error_feepayer'] = $this->error['feepayer'];
		} else {
			$this->data['error_feepayer'] = '';
		}
        
        if (isset($this->error['chargetax'])) {
			$this->data['error_chargetax'] = $this->error['chargetax'];
		} else {
			$this->data['error_chargetax'] = '';
		}


		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),      		
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_payment'),
			'href'      => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('payment/wepay', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

		$this->data['action'] = $this->url->link('payment/wepay', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['wepay_staging'])) {
			$this->data['wepay_staging'] = $this->request->post['wepay_staging'];
		} else {
			$this->data['wepay_staging'] = $this->config->get('wepay_staging');
		}
		
		if (isset($this->request->post['wepay_accountid'])) {
			$this->data['wepay_accountid'] = $this->request->post['wepay_accountid'];
		} else {
			$this->data['wepay_accountid'] = $this->config->get('wepay_accountid');
		}

		if (isset($this->request->post['wepay_clientid'])) {
			$this->data['wepay_clientid'] = $this->request->post['wepay_clientid'];
		} else {
			$this->data['wepay_clientid'] = $this->config->get('wepay_clientid');
		}


		if (isset($this->request->post['wepay_clientsecret'])) {
			$this->data['wepay_clientsecret'] = $this->request->post['wepay_clientsecret'];
		} else {
			$this->data['wepay_clientsecret'] = $this->config->get('wepay_clientsecret');
		}
		
		if (isset($this->request->post['wepay_accesstoken'])) {
			$this->data['wepay_accesstoken'] = $this->request->post['wepay_accesstoken'];
		} else {
			$this->data['wepay_accesstoken'] = $this->config->get('wepay_accesstoken'); 
		} 
        
        if (isset($this->request->post['wepay_feepayer'])) {
			$this->data['wepay_feepayer'] = $this->request->post['wepay_feepayer'];
		} else {
			$this->data['wepay_feepayer'] = $this->config->get('wepay_feepayer'); 
		} 
        
        if (isset($this->request->post['wepay_chargetax'])) {
			$this->data['wepay_chargetax'] = $this->request->post['wepay_chargetax'];
		} else {
			$this->data['wepay_chargetax'] = $this->config->get('wepay_chargetax'); 
		} 

		$this->load->model('localisation/order_status');

		$this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		if (isset($this->request->post['wepay_geo_zone_id'])) {
			$this->data['wepay_geo_zone_id'] = $this->request->post['wepay_geo_zone_id'];
		} else {
			$this->data['wepay_geo_zone_id'] = $this->config->get('wepay_geo_zone_id');
		}

		$this->load->model('localisation/geo_zone');

		$this->data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		if (isset($this->request->post['wepay_status'])) {
			$this->data['wepay_status'] = $this->request->post['wepay_status'];
		} else {
			$this->data['wepay_status'] = $this->config->get('wepay_status');
		}
        
        if (isset($this->request->post['wepay_pending_status_id'])) {
			$this->data['wepay_pending_status_id'] = $this->request->post['wepay_pending_status_id'];
		} else {
			$this->data['wepay_pending_status_id'] = $this->config->get('wepay_pending_status_id');
		}
        
        if (isset($this->request->post['wepay_processed_status_id'])) {
			$this->data['wepay_processed_status_id'] = $this->request->post['wepay_processed_status_id'];
		} else {
			$this->data['wepay_processed_status_id'] = $this->config->get('wepay_processed_status_id');
		}
		
		if (isset($this->request->post['wepay_sort_order'])) {
			$this->data['wepay_sort_order'] = $this->request->post['wepay_sort_order'];
		} else {
			$this->data['wepay_sort_order'] = $this->config->get('wepay_sort_order');
		}
 
 
 

		$this->template = 'payment/wepay.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'payment/wepay')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
}
?>