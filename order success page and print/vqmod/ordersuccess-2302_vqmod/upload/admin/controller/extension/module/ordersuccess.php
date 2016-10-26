<?php
class ControllerExtensionModuleOrdersuccess extends Controller {
	private $error = array();

	public function index() {   
		$this->language->load('extension/module/ordersuccess');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

			$this->model_setting_setting->editSetting('ordersuccess', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			
			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true));

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
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true),
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true),
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/ordersuccess', 'token=' . $this->session->data['token'], true)
		);

		$data['action'] = $this->url->link('extension/module/ordersuccess', 'token=' . $this->session->data['token'], true);

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);

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


		$this->template = 'extension/module/ordersuccess.tpl';

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/ordersuccess.tpl', $data));
	}

	private function validate() {
	if (!$this->user->hasPermission('modify', 'extension/module/ordersuccess')) {
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