<?php
class ControllerDashboardSalePie extends Controller {
    public function index() {
        $this->load->language('dashboard/chart');
        $data['heading_title'] = "Sale Category";
        $data['product_sale_report'] = $this->url->link('sale/product_sale', 'token=' . $this->session->data['token'], 'SSL');
        $data['text_day'] = $this->language->get('text_day');
        $data['text_week'] = $this->language->get('text_week');
        $data['text_month'] = $this->language->get('text_month');
        $data['text_year'] = $this->language->get('text_year');
        $data['text_view'] = $this->language->get('text_view');
        $data['token'] = $this->session->data['token'];
        return $this->load->view('dashboard/sale_pie.tpl', $data);
    }
    public function salePieChart() {
        $this->load->language('dashboard/chart');
        $json = array();
        $this->load->model('sale/order');
        $json['order_count']['label'] = "";
        $json['order_count']['data'] = array();
        if (isset($_POST['cat_name'])) {
            $results = $this->model_sale_order->getTotalCategorySalesByCategoryName($_POST['cat_name']);
            foreach ($results as $key => $value) {
                $json['order_count']['data'][] = array($value['cat_name'] , (int)$value['total']);
            }
        }else{
            $results = $this->model_sale_order->getTotalCategorySalesByAll();
            foreach ($results as $key => $value) {
                $json['order_count']['data'][] = array($value['cat_name'] , (int)$value['total']);
            }
        } // eo else
        if(!empty($json['order_count']['data'])){
            $json['order_count']['title'] = "Sales Orders";
        }else{
            $json['order_count']['title'] = "No Sales Found";
        }
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
}