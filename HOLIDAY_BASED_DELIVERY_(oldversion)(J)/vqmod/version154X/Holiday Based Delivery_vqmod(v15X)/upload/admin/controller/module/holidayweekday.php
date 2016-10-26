<?php
class ControllerModuleHolidayweekday extends Controller {
    private $error = array();

    public function index()
    {
        $this->load->language('module/holidayweekday');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

            $this->model_setting_setting->editSetting('holidayweekday', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['text_edit'] = $this->language->get('text_edit');

        $this->data['text_min_day'] = $this->language->get('text_min_day');
        $this->data['text_max_day'] = $this->language->get('text_max_day');
        $this->data['text_status_enabled'] = $this->language->get('text_status_enabled');
        $this->data['text_status_disabled'] = $this->language->get('text_status_disabled');

        $this->data['entry_admin'] = $this->language->get('entry_admin');
        $this->data['entry_status'] = $this->language->get('entry_status');

        $this->data['button_save'] = $this->language->get('button_save');
        $this->data['button_cancel'] = $this->language->get('button_cancel');

        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
        }

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_module'),
            'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => '::'
        );

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('module/holidayweekday', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => '::'
        );

       /* $this->data['action'] = $this->url->link('module/holidayweekday', 'token=' . $this->session->data['token'], 'SSL');

        $this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');*/

        $this->data['action'] = $this->url->link('module/holidayweekday', 'token=' . $this->session->data['token'], 'SSL');

        $this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

        $this->data['token'] = $this->session->data['token'];

       if (isset($this->request->post['holidayweekday_min_day'])) {
            $this->data['holidayweekday_min_day'] = $this->request->post['holidayweekday_min_day'];
        } else {
            $this->data['holidayweekday_min_day'] = $this->config->get('holidayweekday_min_day');

        }

        if (isset($this->request->post['holidayweekday_max_day'])) {
            $this->data['holidayweekday_max_day'] = $this->request->post['holidayweekday_max_day'];
        } else {
            $this->data['holidayweekday_max_day'] = $this->config->get('holidayweekday_max_day');
        }


        if (isset($this->request->post['holidayweekday_status'])) {
            $this->data['holidayweekday_status'] = $this->request->post['holidayweekday_status'];
        } else {
            $this->data['holidayweekday_status'] = $this->config->get('holidayweekday_status');
        }

        /*$this->data['header'] = $this->load->controller('common/header');
        $this->data['column_left'] = $this->load->controller('common/column_left');
        $this->data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('module/holidayweekday.tpl', $data));*/



        $this->template = 'module/holidayweekday.tpl';
        $this->children = array(
            'common/header',
            'common/footer',
        );
        $this->response->setOutput($this->render());

    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'module/holidayweekday')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        return !$this->error;
    }

    public function install() {

        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "holiday_master` (
`holiday_id` int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
`holiday_name` varchar(255) NOT NULL,
`holiday_date` date NOT NULL,
`is_recursive` enum('1','0') NOT NULL,
`created_on` date NOT NULL,
`last_edited_on` date NOT NULL)");

        $this->load->model('setting/setting');

        $min_day=array('holidayweekday_max_day'=>'10','holidayweekday_min_day'=>'3');

        $this->model_setting_setting->editSetting('holidayweekday',$min_day);//add default min max days in db setting table

        $this->db->query("ALTER TABLE `" . DB_PREFIX . "order` ADD `delivery_date` date  AFTER `shipping_method`");

    }

    public function uninstall() {
        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "holiday_master`");

        $this->db->query("ALTER TABLE `" . DB_PREFIX . "order` DROP COLUMN `delivery_date`");
        
        $this->load->model('setting/setting');

        $this->model_setting_setting->deleteSetting('weekdays');
    }
}
?>
