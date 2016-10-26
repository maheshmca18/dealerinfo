<?php
class ControllerModuleOrdersuccess extends Controller {
	private $error = array();

	public function index() {   
		$this->language->load('module/ordersuccess');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

           // print_r($this->request->post); exit;
			$this->model_setting_setting->editSetting('ordersuccess', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');


            $this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));

		}

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_module'] = $this->language->get('text_module');
        $this->data['text_enabled'] = $this->language->get('text_enabled');
        $this->data['text_disabled'] = $this->language->get('text_disabled');

		$this->data['entry_displayordersuccess'] = $this->language->get('entry_displayordersuccess');
		$this->data['entry_beforeorder'] = $this->language->get('entry_beforeorder');
		$this->data['entry_afterorder'] = $this->language->get('entry_afterorder');
		$this->data['entry_msgbeforeorder'] = $this->language->get('entry_msgbeforeorder');
		$this->data['entry_msgafterorder'] = $this->language->get('entry_msgafterorder');

		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

        $this->data['token'] = $this->session->data['token'];

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}




        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_module'),
            'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->data['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('module/ordersuccess', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

		$this->data['action'] = $this->url->link('module/ordersuccess', 'token=' . $this->session->data['token'], 'SSL');

        $this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['ordersuccess_status'])) {
            $this->data['ordersuccess_status'] = $this->request->post['ordersuccess_status'];
		} else {
            $this->data['ordersuccess_status'] = $this->config->get('ordersuccess_status');
		}

		if (isset($this->request->post['ordersuccess_beforemessage'])) {
            $this->data['ordersuccess_beforemessage'] = $this->request->post['ordersuccess_beforemessage'];
		} else {
            $this->data['ordersuccess_beforemessage'] = $this->config->get('ordersuccess_beforemessage');
		}

        if (isset($this->request->post['ordersuccess_aftermessage'])) {
            $this->data['ordersuccess_aftermessage'] = $this->request->post['ordersuccess_aftermessage'];
        } else {
            $this->data['ordersuccess_aftermessage'] = $this->config->get('ordersuccess_aftermessage');
        }


		$this->template = 'module/ordersuccess.tpl';


        $this->children = array(
            'common/header',
            'common/footer',
        );

         $this->response->setOutput($this->render());


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
