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

            $this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_edit'] = $this->language->get('text_edit');

        $data['text_min_day'] = $this->language->get('text_min_day');
        $data['text_max_day'] = $this->language->get('text_max_day');
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
            'href' => $this->url->link('module/holidayweekday', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['action'] = $this->url->link('module/holidayweekday', 'token=' . $this->session->data['token'], 'SSL');

        $data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

       if (isset($this->request->post['holidayweekday_min_day'])) {
            $data['holidayweekday_min_day'] = $this->request->post['holidayweekday_min_day'];
        } else {
            $data['holidayweekday_min_day'] = $this->config->get('holidayweekday_min_day');

        }

        if (isset($this->request->post['holidayweekday_max_day'])) {
            $data['holidayweekday_max_day'] = $this->request->post['holidayweekday_max_day'];
        } else {
            $data['holidayweekday_max_day'] = $this->config->get('holidayweekday_max_day');
        }


        if (isset($this->request->post['holidayweekday_status'])) {
            $data['holidayweekday_status'] = $this->request->post['holidayweekday_status'];
        } else {
            $data['holidayweekday_status'] = $this->config->get('holidayweekday_status');
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('module/holidayweekday.tpl', $data));

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
