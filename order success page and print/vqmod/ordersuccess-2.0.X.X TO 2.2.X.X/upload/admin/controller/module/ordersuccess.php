<?php
class ControllerModuleOrdersuccess extends Controller {
	private $error = array();

	public function index() {   
		$this->language->load('module/ordersuccess');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

			$this->model_setting_setting->editSetting('ordersuccess', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			
			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));

		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_module'] = $this->language->get('text_module');
       		$data['text_enabled'] = $this->language->get('text_enabled');
      		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_displayordersuccess'] = $this->language->get('entry_displayordersuccess');
		$data['entry_beforeorder'] = $this->language->get('entry_beforeorder');
		$data['entry_afterorder'] = $this->language->get('entry_afterorder');
		$data['entry_msgbeforeorder'] = $this->language->get('entry_msgbeforeorder');
		$data['entry_msgafterorder'] = $this->language->get('entry_msgafterorder');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

       		$data['token'] = $this->session->data['token'];

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}


		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
			
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/ordersuccess', 'token=' . $this->session->data['token'], 'SSL'),
			
		);

		$data['action'] = $this->url->link('module/ordersuccess', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['ordersuccess_status'])) {
			$data['ordersuccess_status'] = $this->request->post['ordersuccess_status'];
		} else {
			$data['ordersuccess_status'] = $this->config->get('ordersuccess_status');
		}

		if (isset($this->request->post['ordersuccess_beforemessage'])) {
			$data['ordersuccess_beforemessage'] = $this->request->post['ordersuccess_beforemessage'];
		} else {
			$data['ordersuccess_beforemessage'] = $this->config->get('ordersuccess_beforemessage');
		}

		if (isset($this->request->post['ordersuccess_aftermessage'])) {
		    $data['ordersuccess_aftermessage'] = $this->request->post['ordersuccess_aftermessage'];
		} else {
		    $data['ordersuccess_aftermessage'] = $this->config->get('ordersuccess_aftermessage');
		}


		$this->template = 'module/ordersuccess.tpl';

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/ordersuccess.tpl', $data));
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/ordersuccess')) {
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
