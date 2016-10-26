<?php
class ControllerModuleDiscountprice extends Controller {
    private $error = array();

    public function index() {
        $this->load->language('module/discountprice');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

            $this->model_setting_setting->editSetting('discountprice', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_edit'] = $this->language->get('text_edit');
        $data['text_percent'] = $this->language->get('text_percent');
        $data['text_price'] = $this->language->get('text_price');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_label_color'] = $this->language->get('text_label_color');
        $data['text_label_text_color'] = $this->language->get('text_label_text_color');

        $data['entry_admin'] = $this->language->get('entry_admin');
        $data['entry_status'] = $this->language->get('entry_status');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['error_discountprice_label_color'])) {
            $data['error_label_color'] = $this->error['error_discountprice_label_color'];
        } else {
            $data['error_label_color'] = '';
        }

        if (isset($this->error['error_discountprice_label_text_color'])) {
            $data['error_label_text_color'] = $this->error['error_discountprice_label_text_color'];
        } else {
            $data['error_label_text_color'] = '';
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
            'href' => $this->url->link('module/discountprice', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['action'] = $this->url->link('module/discountprice', 'token=' . $this->session->data['token'], 'SSL');

        $data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

        if (isset($this->request->post['discountprice_option'])) {
            $data['discountprice_option'] = $this->request->post['discountprice_option'];
        } else {
            $data['discountprice_option'] = $this->config->get('discountprice_option');

        }

        if (isset($this->request->post['discountprice_status'])) {
            $data['discountprice_status'] = $this->request->post['discountprice_status'];
        } else {
            $data['discountprice_status'] = $this->config->get('discountprice_status');
        }


        if (isset($this->request->post['discountprice_label_color'])) {
            $data['discountprice_label_color'] = $this->request->post['discountprice_label_color'];
        } else {
            $data['discountprice_label_color'] = $this->config->get('discountprice_label_color');
        }


        if (isset($this->request->post['discountprice_label_text_color'])) {
            $data['discountprice_label_text_color'] = $this->request->post['discountprice_label_text_color'];
        } else {
            $data['discountprice_label_text_color'] = $this->config->get('discountprice_label_text_color');
        }


        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('module/discountprice.tpl', $data));

    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'module/discountprice')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        if(!$this->request->post['discountprice_label_color'])
        {
            $this->error['error_discountprice_label_color']=$this->language->get('error_label_color');

        }
        if(!$this->request->post['discountprice_label_text_color'])
        {
            $this->error['error_discountprice_label_text_color']=$this->language->get('error_label_text_color');
        }
        return !$this->error;
    }
}