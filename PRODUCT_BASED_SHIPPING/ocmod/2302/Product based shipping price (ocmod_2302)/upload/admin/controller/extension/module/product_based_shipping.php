<?php
class ControllerExtensionModuleProductbasedshipping extends Controller {
    private $error = array();

    public function index()
    { 
        $this->load->language('extension/module/product_based_shipping');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

            $this->model_setting_setting->editSetting('product_based_shipping', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], true));
        }

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_edit'] = $this->language->get('text_edit');

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
			'href' => $this->url->link('extension/module/product_based_shipping', 'token=' . $this->session->data['token'], true)
		);
		
		$data['action'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);

        $data['token'] = $this->session->data['token'];

       
        if (isset($this->request->post['product_based_shipping_text'])) {
            $data['product_based_shipping_text'] = $this->request->post['product_based_shipping_text'];
        } else {
            $data['product_based_shipping_text'] = $this->config->get('product_based_shipping_text');
        }

	$data['header'] = $this->load->controller('common/header');
	$data['column_left'] = $this->load->controller('common/column_left');
	$data['footer'] = $this->load->controller('common/footer');
	$this->response->setOutput($this->load->view('extension/module/product_based_shipping', $data));


    }

    protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/product_based_shipping')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

        return !$this->error;
    }

    public function install() {

$this->load->model('setting/setting');


$text=array('product_based_shipping_text'=>'Shipping');

$this->model_setting_setting->editSetting('product_based_shipping',$text);

//alter product table
         $this->db->query("ALTER TABLE `" . DB_PREFIX . "product` ADD `product_basedshipping_id` varchar(50) NOT NULL AFTER `price`, ADD `shippingprice` int(11) NOT NULL AFTER `points`");

//table create "product_based_shipping"
         $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "product_based_shipping` (
							  `product_basedshipping_id` int(11) NOT NULL AUTO_INCREMENT,
							  `zone_name` varchar(255) NOT NULL,
						          `status` enum('1','0') NOT NULL,
								PRIMARY KEY (product_basedshipping_id)
							)");

//table create "shipping_zone"
         $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "shipping_zone` (
							  `zone_id` int(50) NOT NULL AUTO_INCREMENT,
							  `product_basedshipping_id` int(11) NOT NULL,
							  `zone_location` varchar(255) NOT NULL,				
							  `postcode` varchar(255) NOT NULL,				
						                PRIMARY KEY (zone_id)
							)");


    }
    public function uninstall() {
//alter product table
          $this->db->query("ALTER TABLE `" . DB_PREFIX . "product` DROP `product_basedshipping_id`, DROP `shippingprice`");

//table delete "product_based_shipping"
	  $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "product_based_shipping`");

//table delete "shipping_zone"
	  $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "shipping_zone`");



    }
}
?>