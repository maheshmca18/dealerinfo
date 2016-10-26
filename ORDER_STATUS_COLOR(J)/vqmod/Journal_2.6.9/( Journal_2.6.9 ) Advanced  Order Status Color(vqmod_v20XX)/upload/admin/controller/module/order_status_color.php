<?php
class ControllerModuleOrderstatuscolor extends Controller {
    private $error = array();

    public function index()
    {
        $this->load->language('module/order_status_color');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');
//echo $this->config->get('order_status_color_status');exit;
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

            $this->model_setting_setting->editSetting('order_status_color', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
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
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_module'),
            'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('module/order_status_color', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['action'] = $this->url->link('module/order_status_color', 'token=' . $this->session->data['token'], 'SSL');

        $data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

        if (isset($this->request->post['order_status_color_status'])) {
            $data['order_status_color_status'] = $this->request->post['order_status_color_status'];
        } else {
            $data['order_status_color_status'] = $this->config->get('order_status_color_status');
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('module/order_status_color.tpl', $data));

    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'module/order_status_color')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        return !$this->error;
    }

    public function install() {

        $input_color = array("rgba(58,203,208,0.77)", "rgba(81,142,96,0.77)","rgba(186,97,86,0.77)","rgba(226,232,146,0.77)" ,"rgba(211,164,82,0.77)", "rgba(232,146,199,0.77)");

        $this->db->query("ALTER TABLE `" . DB_PREFIX . "order_status` ADD `order_status_color` varchar(255) NOT NULL AFTER `name`");


        $this->load->model('localisation/order_status');

        $results = $this->model_localisation_order_status->getOrderStatuses();
       // print_r($results);exit;
     foreach($results as $eachvalue)
     {
     $random_keys=array_rand($input_color,1);
     $eachvalue['order_status_id'];
     $this->db->query("UPDATE " . DB_PREFIX . "order_status SET order_status_color = '".$input_color[$random_keys]."' where order_status_id=".$eachvalue['order_status_id']." ");
     }
        //set status enable
        $Enable=1;
        $this->load->model('setting/setting');
        $this->model_setting_setting->editSetting('order_status_color',array('order_status_color_status'=>$Enable));


    }

    public function uninstall() {

        $this->db->query("ALTER TABLE `" . DB_PREFIX . "order_status` DROP COLUMN `order_status_color`");

    }
}
?>

