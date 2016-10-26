<?php
class ControllerModuleDashboardChart extends Controller {
    private $error = array();

    public function index() {
        $this->load->language('module/dashboard_chart');
        $this->document->setTitle($this->language->get('heading_title'));
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->session->data['success'] = $this->language->get('text_success');
            $this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
        }
        $data['heading_title'] = $this->language->get('heading_title');
    }
    protected function validate() {
        if (!$this->user->hasPermission('modify', 'module/dashboard_chart')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        return !$this->error;
    }
}