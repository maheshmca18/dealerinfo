<?php
class ControllerModuleRecaptchaprice extends Controller {
	private $error = array(); 

	public function index() {   
		$this->language->load('module/recaptchaprice');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('recaptcha', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			//$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));


			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_module'] = $this->language->get('text_module');
		$data['text_help'] = $this->language->get('text_help');

		$data['entry_private_key'] = $this->language->get('entry_private_key');
		$data['entry_public_key'] = $this->language->get('entry_public_key');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['private_key'])) {
			$data['error_private_key'] = $this->error['private_key'];
		} else {
			$data['error_private_key'] = '';
		}

		if (isset($this->error['public_key'])) {
			$data['error_public_key'] = $this->error['public_key'];
		} else {
			$data['error_public_key'] = '';
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
			//'separator' => ' :: '
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/recaptchaprice', 'token=' . $this->session->data['token'], 'SSL'),
			//'separator' => ' :: '
		);

		$data['action'] = $this->url->link('module/recaptchaprice', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['private_key'])) {
			$data['private_key'] = $this->request->post['recaptcha_private_key'];
		} else {
			$data['private_key'] = $this->config->get('recaptcha_private_key');
		}

		if (isset($this->request->post['public_key'])) {
			$data['public_key'] = $this->request->post['recaptcha_public_key'];
		} else {
			$data['public_key'] = $this->config->get('recaptcha_public_key');
		}

		$this->template = 'module/recaptchaprice.tpl';
		//$this->children = array(
		//	'common/header',
		//	'common/footer',
		//);

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');


		//$this->response->setOutput($this->render());
		$this->response->setOutput($this->load->view('module/recaptchaprice.tpl', $data));
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/recaptchaprice')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->request->post['recaptcha_private_key']) {
			$this->error['private_key'] = $this->language->get('error_private_key');
		}

		if (!$this->request->post['recaptcha_public_key']) {
			$this->error['public_key'] = $this->language->get('error_public_key');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
}
?>
