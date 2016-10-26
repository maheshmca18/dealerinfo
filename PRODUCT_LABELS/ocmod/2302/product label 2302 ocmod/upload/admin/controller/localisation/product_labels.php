<?php
class ControllerLocalisationProductlabels extends Controller {
    private $error = array();

    public function index() {

        $this->load->language('localisation/product_labels');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('localisation/product_labels');

        $this->getForm();

    }

    public function edit() {

        $this->load->language('localisation/product_labels');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('localisation/product_labels');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

            $this->model_localisation_product_labels->editlabel($this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->response->redirect($this->url->link('localisation/product_labels', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    protected function getForm() {
        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_form'] = !isset($this->request->get['label_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_addlabel'] = $this->language->get('text_addlabel');

        $data['text_label_text'] = $this->language->get('text_label_text');
        $data['text_label_color'] = $this->language->get('text_label_color');
        $data['text_label_text_color'] = $this->language->get('text_label_text_color');
        $data['text_label_conditiontype'] = $this->language->get('text_label_conditiontype');
        $data['text_label_id'] = $this->language->get('text_label_id');


        $data['text_addnew'] = $this->language->get('text_addnew');
        $data['text_addshipping'] = $this->language->get('text_addshipping');
        $data['text_adddiscount'] = $this->language->get('text_adddiscount');

        $data['entry_name'] = $this->language->get('entry_name');
        $data['entry_code'] = $this->language->get('entry_code');
        $data['entry_locale'] = $this->language->get('entry_locale');
        $data['entry_image'] = $this->language->get('entry_image');
        $data['entry_directory'] = $this->language->get('entry_directory');
        $data['entry_sort_order'] = $this->language->get('entry_sort_order');
        $data['entry_status'] = $this->language->get('entry_status');

        $data['help_code'] = $this->language->get('help_code');
        $data['help_locale'] = $this->language->get('help_locale');
        $data['help_image'] = $this->language->get('help_image');
        $data['help_directory'] = $this->language->get('help_directory');
        $data['help_status'] = $this->language->get('help_status');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['name'])) {
            $data['error_name'] = $this->error['name'];
        } else {
            $data['error_name'] = '';
        }


        $url = '';

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('localisation/product_labels', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );


       //$label_info = $this->model_localisation_product_labels->getLabels();

        $data['action'] = $this->url->link('localisation/product_labels/edit', 'token=' . $this->session->data['token'] . $url, 'SSL');

        $data['cancel'] = $this->url->link('common/dashboard', 'token=' . $this->session->data['token'] . $url, 'SSL');

        $data['labels']=array();

            $label_info = $this->model_localisation_product_labels->getLabels();

        foreach($label_info as $labelget){
            $data['labels'][]=array(
                'label_id'=> $labelget['label_id'],
                'label_text'=> $labelget['label_text'],
                'label_color'=> $labelget['label_color'],
                'label_text_color'=> $labelget['label_text_color'],
                'condition_type'=> $labelget['condition_type'],
                'status'=> $labelget['status'],
                'position'=> $labelget['position']

            );
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('localisation/product_labels', $data));
    }

    protected function validateForm() {
        if (!$this->user->hasPermission('modify', 'localisation/product_labels')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

     /*   if ($this->request->post['holiday_name']=="") {
            $this->error['name'] = $this->language->get('error_name');
        }

        if ($this->request->post['holiday_date']=="") {
            $this->error['date'] = $this->language->get('error_date');
        }
*/
        return !$this->error;
    }



}
