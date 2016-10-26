<?php
class ControllerExtensionModuleOrdertracker extends Controller {
    private $error = array();

    public function index()
    {
        $this->load->language('extension/module/ordertracker');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');
//echo $this->config->get('order_status_color_status');exit;
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

            $this->model_setting_setting->editSetting('ordertracker', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');
			
			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true));
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
			'href' => $this->url->link('extension/module/ordertracker', 'token=' . $this->session->data['token'], true)
		);

		$data['action'] = $this->url->link('extension/module/ordertracker', 'token=' . $this->session->data['token'], true);

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);

        if (isset($this->request->post['ordertracker_status'])) {
            $data['ordertracker_status'] = $this->request->post['ordertracker_status'];
        } else {
            $data['ordertracker_status'] = $this->config->get('ordertracker_status');
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/ordertracker.tpl', $data));

    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'extension/module/ordertracker')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        return !$this->error;
    }

    public function install() {

	$this->db->query("ALTER TABLE `" . DB_PREFIX . "order` ADD `courier_company` varchar(255) NOT NULL AFTER `date_modified`, ADD `tracking_code` varchar(255) NOT NULL AFTER `courier_company`");

	$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "ordertrack` (
							  `ordertracking_id` int(11) NOT NULL AUTO_INCREMENT,
							  `courier_company_name` varchar(255) NOT NULL,
							  `tracking_url` varchar(255) NOT NULL,
						          `status` enum('1','0') NOT NULL,
								PRIMARY KEY (ordertracking_id)
							)");
        //set status enable
        $Enable=1;
        $this->load->model('setting/setting');
        $this->model_setting_setting->editSetting('ordertracker',array('ordertracker_status'=>$Enable));

    }
	public function uninstall() {       
        $this->db->query("ALTER TABLE `" . DB_PREFIX . "order` DROP `courier_company`, DROP `tracking_code`"); 
						
        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "ordertrack`");

    }

}
?>

