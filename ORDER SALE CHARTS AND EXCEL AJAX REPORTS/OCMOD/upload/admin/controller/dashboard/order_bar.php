<?php
class ControllerDashboardOrderBar extends Controller
{
    public function index()
    {
        $this->load->language('dashboard/chart');
        $data['heading_title'] = "Top 10 Selling Products";
        $data['product_sale_report'] = $this->url->link('sale/product_sale', 'token=' . $this->session->data['token'], 'SSL');
        $data['text_day'] = $this->language->get('text_day');
        $data['text_week'] = $this->language->get('text_week');
        $data['text_month'] = $this->language->get('text_month');
        $data['text_year'] = $this->language->get('text_year');
        $data['text_view'] = $this->language->get('text_view');
        $data['token'] = $this->session->data['token'];
        return $this->load->view('dashboard/order_bar.tpl', $data);
    }
    public function orderChart()
    {
        $this->load->language('dashboard/chart');
        $json = array();
        $this->load->model('sale/order');
        $json['order_count']['label'] = 'Order Count';
        $json['total']['label'] = 'Total Sale';
        if (isset($this->request->get['range'])) {
            $range = $this->request->get['range'];
        } else {
            $range = 'day';
        }
        switch ($range) {
            case 'all':
                $results = $this->model_sale_order->getOrderStatusByAll();
                $i = 0;
                foreach ($results as $key => $value) {
                    $json['order_count']['data'][] = (int)$value['order_count'];
                    $json['total']['data'][] = (int)$value['total'];
                    $json['xaxis'][] = $value['product_name'];
                    $i++;
                } // eo inner foreach
                if (empty($json['order_count']['data'])) {
                    $json['order_count']['data'][] = 0;
                    $json['total']['data'][] = 0;
                }
                array_unshift($json['order_count']['data'], $json['order_count']['label']);
                array_unshift($json['total']['data'], $json['total']['label']);
                $json['disp_count'][] = ($i > 10) ? 10 : '';
                break;
            default:
            case 'month':
                $results = $this->model_sale_order->getOrderStatusByMonth();
                $i = 0;
                foreach ($results as $key => $value) {
                    $json['order_count']['data'][] = (int)$value['order_count'];
                    $json['total']['data'][] = (int)$value['total'];
                    $json['xaxis'][] = $value['product_name'];
                    $i++;
                } // eo inner foreach
                if (empty($json['order_count']['data'])) {
                    $json['order_count']['data'][] = 0;
                    $json['total']['data'][] = 0;
                }
                array_unshift($json['order_count']['data'], $json['order_count']['label']);
                array_unshift($json['total']['data'], $json['total']['label']);
                $json['disp_count'][] = ($i > 10) ? 10 : '';
                break;
            case 'week':
                $results = $this->model_sale_order->getOrderStatusByWeek();
                $i = 0;
                foreach ($results as $key => $value) {
                    $json['order_count']['data'][] = (int)$value['order_count'];
                    $json['total']['data'][] = (int)$value['total'];
                    $json['xaxis'][] = $value['product_name'];
                    $i++;
                } // eo inner foreach
                if (empty($json['order_count']['data'])) {
                    $json['order_count']['data'][] = 0;
                    $json['total']['data'][] = 0;
                }
                array_unshift($json['order_count']['data'], $json['order_count']['label']);
                array_unshift($json['total']['data'], $json['total']['label']);
                $json['disp_count'][] = ($i > 10) ? 10 : '';
                break;
            case 'day':
                $results = $this->model_sale_order->getOrderStatusByDay();
                $i = 0;
                foreach ($results as $key => $value) {
                    $json['order_count']['data'][] = (int)$value['order_count'];
                    $json['total']['data'][] = (int)$value['total'];
                    $json['xaxis'][] = $value['product_name'];
                    $i++;
                } // eo inner foreach
                if (empty($json['order_count']['data'])) {
                    $json['order_count']['data'][] = 0;
                    $json['total']['data'][] = 0;
                }
                array_unshift($json['order_count']['data'], $json['order_count']['label']);
                array_unshift($json['total']['data'], $json['total']['label']);
                $json['disp_count'][] = ($i > 10) ? 10 : '';
                break;
            case 'year':
                $results = $this->model_sale_order->getOrderStatusByYear();
                $i = 0;
                foreach ($results as $key => $value) {
                    $json['order_count']['data'][] = (int)$value['order_count'];
                    $json['total']['data'][] = (int)$value['total'];
                    $json['xaxis'][] = $value['product_name'];
                    $i++;
                } // eo inner foreach
                if (empty($json['order_count']['data'])) {
                    $json['order_count']['data'][] = 0;
                    $json['total']['data'][] = 0;
                }
                array_unshift($json['order_count']['data'], $json['order_count']['label']);
                array_unshift($json['total']['data'], $json['total']['label']);
                $json['disp_count'][] = ($i > 10) ? 10 : '';
                break;
        }
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
}