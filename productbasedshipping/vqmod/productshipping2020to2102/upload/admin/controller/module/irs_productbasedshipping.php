<?php
class ControllerModuleIrsProductBasedShipping extends Controller {
	private $error = array();
       
  	public function index() {
		$this->language->load('module/irs_productbasedshipping');
		//$this->language->load('shipping/irs_productbasedshipping');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
           //print_r($this->request->post); exit;
			$this->model_setting_setting->editSetting('productbasedshipping', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('module/irs_productbasedshipping', 'token=' . $this->session->data['token'], 'SSL'));


			//$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		
		}
		
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_module'] = $this->language->get('text_module');
		//$data['text_help'] = $this->language->get('text_help');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		 $data['entry_theme'] = $this->language->get('entry_theme');
		$data['entry_status'] = $this->language->get('entry_status');
		

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

       		 $data['token'] = $this->session->data['token'];

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		
		 if (isset($this->request->post['productbasedshipping_status'])) {
		    $data['productbasedshipping_status'] = $this->request->post['productbasedshipping_status'];

		} else {
		    $data['productbasedshipping_status'] = $this->config->get('productbasedshipping_status');
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
			'href'      => $this->url->link('module/irs_productbasedshipping', 'token=' . $this->session->data['token'], 'SSL'),
			//'separator' => ' :: '
		);

		$data['action'] = $this->url->link('module/irs_productbasedshipping', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

	
		$this->template = 'module/irs_productbasedshipping.tpl';

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');


		//$this->response->setOutput($this->render());
		$this->response->setOutput($this->load->view('module/irs_productbasedshipping.tpl', $data));
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/irs_productbasedshipping')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	 public function install() {
		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "product_shipping_charge` (
  `product_shipping_charge_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(255) NOT NULL,
  `shipping_charge` decimal(15,4) NOT NULL DEFAULT '0.0000',
  		      PRIMARY KEY (`product_shipping_charge_id`)
                        )");
 		
    }
   	public function uninstall() { 
		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "product_shipping_charge`");      
        	$this->load->model('setting/setting');
	        $this->model_setting_setting->deleteSetting('productbasedshipping');

	}
    
}
?>
