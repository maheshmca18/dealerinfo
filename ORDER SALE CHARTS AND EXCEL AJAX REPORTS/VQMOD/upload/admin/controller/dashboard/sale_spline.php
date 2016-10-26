<?php
class ControllerDashboardSaleSpline extends Controller {
    public function index() {
        $this->load->language('dashboard/chart');
        $data['heading_title'] = "Order Product Ratio";
        $data['product_sale_report'] = $this->url->link('sale/product_sale', 'token=' . $this->session->data['token'], 'SSL');
        $data['text_day'] = $this->language->get('text_day');
        $data['text_week'] = $this->language->get('text_week');
        $data['text_month'] = $this->language->get('text_month');
        $data['text_year'] = $this->language->get('text_year');
        $data['text_view'] = $this->language->get('text_view');
        $data['token'] = $this->session->data['token'];
        return $this->load->view('dashboard/sale_spline.tpl', $data);
    }
    public function saleChart() {
        $this->load->language('dashboard/chart');
        $json = array();
        $this->load->model('report/sale');
        $json['order_count'] = array();
        $json['order_count']['label'] = "Order Count";
        $json['total']['label'] = "Total Sale";
        if (isset($this->request->get['range'])) {
            $range = $this->request->get['range'];
        } else {
            $range = 'day';
        }
        switch ($range) {
            case 'day':
                $results = $this->model_report_sale->getTotalOrdersByDay();
                foreach ($results as $key => $value) {
                    $json['order_count']['data'][] = (int)$value['total'];
                }
                array_unshift($json['order_count']['data'],$json['order_count']['label']);
                $results = $this->model_report_sale->getTotalSalesByDay();
                foreach ($results as $key => $value) {
                    $json['total']['data'][] = (int)$value['total'];
                }
                array_unshift($json['total']['data'],$json['total']['label']);
                for ($i = 0; $i < 24; $i++) {
                    $json['xaxis'][] = $i;
                }
                $json['disp_count'][] = 6;
                break;
            case 'week':
                $results = $this->model_report_sale->getTotalOrdersByWeek();
                foreach ($results as $key => $value) {
                    $json['order_count']['data'][] = (int)$value['total'];
                }
                array_unshift($json['order_count']['data'],$json['order_count']['label']);
                $results = $this->model_report_sale->getTotalSalesByWeek();
                foreach ($results as $key => $value) {
                    $json['total']['data'][] = (int)$value['total'];
                }
                array_unshift($json['total']['data'],$json['total']['label']);
                $date_start = strtotime('-' . date('w') . ' days');
                for ($i = 0; $i < 7; $i++) {
                    $date = date('Y-m-d', $date_start + ($i * 86400));
                    $json['xaxis'][] = date('D', strtotime($date));
                }
                break;
            default:
            case 'month':
                $results = $this->model_report_sale->getTotalOrdersByMonth();
                foreach ($results as $key => $value) {
                    $json['order_count']['data'][] = (int)$value['total'];
                }
                array_unshift($json['order_count']['data'],$json['order_count']['label']);
                $results = $this->model_report_sale->getTotalSalesByMonth();
                foreach ($results as $key => $value) {
                    $json['total']['data'][] = (int)$value['total'];
                }
                array_unshift($json['total']['data'],$json['total']['label']);
                for ($i = 1; $i <= date('t'); $i++) {
                    $date = date('Y') . '-' . date('m') . '-' . $i;
                    $json['xaxis'][] = date('d', strtotime($date));
                }
                $json['disp_count'][] = 6;
                break;
            case 'year':
                $results = $this->model_report_sale->getTotalOrdersByYear();
                foreach ($results as $key => $value) {
                    $json['order_count']['data'][] = (int)$value['total'];
                }
                array_unshift($json['order_count']['data'],$json['order_count']['label']);
                $results = $this->model_report_sale->getTotalSalesByYear();
                foreach ($results as $key => $value) {
                    $json['total']['data'][] = (int)$value['total'];
                }
                array_unshift($json['total']['data'],$json['total']['label']);
                for($m=1;$m<=12;$m++){
                    $json['xaxis'][]=date("M",mktime(0,0,0,$m,1,2000));
                }
                break;
        }
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
}