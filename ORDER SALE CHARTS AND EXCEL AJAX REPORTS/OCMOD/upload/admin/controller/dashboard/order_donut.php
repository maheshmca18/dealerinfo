<?php
class ControllerDashboardOrderDonut extends Controller {
    public function index() {
        $this->load->language('dashboard/chart');
        $data['heading_title'] = "Order Category";
        $data['product_sale_report'] = $this->url->link('sale/product_sale', 'token=' . $this->session->data['token'], 'SSL');
        $data['text_day'] = $this->language->get('text_day');
        $data['text_week'] = $this->language->get('text_week');
        $data['text_month'] = $this->language->get('text_month');
        $data['text_year'] = $this->language->get('text_year');
        $data['text_view'] = $this->language->get('text_view');
        $data['token'] = $this->session->data['token'];
        return $this->load->view('dashboard/order_donut.tpl', $data);
    }
    public function orderChart() {
        $this->load->language('dashboard/chart');
        $json = array();
        $this->load->model('sale/order');
        $json['order_count']['label'] = "";
        $json['order_count']['data'] = array();
        if (isset($_POST['cat_name'])) {
            $results = $this->model_sale_order->getTotalCategoryOrdersByCategoryName($_POST['cat_name']);
            foreach ($results as $key => $value) {
                $json['order_count']['data'][] = array($value['cat_name'] , (int)$value['total']);
            }
        }else{
            $results = $this->model_sale_order->getTotalCategoryOrdersByAll();
            foreach ($results as $key => $value) {
                $json['order_count']['data'][] = array($value['cat_name'] , (int)$value['total']);
                $json['order_count']['id'][] = (int)$value['categoryid'];
            }
        }
        /* check empty array */
        if(!empty($json['order_count']['data'])){
            $json['order_count']['title'] = "Category Orders";
        }else{
            $json['order_count']['title'] = "No Orders Found";
        }
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
}