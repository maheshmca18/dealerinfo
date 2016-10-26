<?php

class ControllerLocalisationMinimumOrderTotal extends Controller {
    private $error = array();

    public function index() {
        $this->load->language('localisation/minimum_order_total');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('localisation/minimum_order_total');

        $this->getList();
    }

    public function add() {
        $this->load->language('localisation/minimum_order_total');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('localisation/minimum_order_total');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_localisation_minimum_order_total->addMinimumordertotal($this->request->post);

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

            $this->response->redirect($this->url->link('localisation/minimum_order_total', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    public function edit() {
        $this->load->language('localisation/minimum_order_total');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('localisation/minimum_order_total');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

            $this->model_localisation_minimum_order_total->editMinimumordertotal($this->request->get['mot_id'], $this->request->post);

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

            $this->response->redirect($this->url->link('localisation/minimum_order_total', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    public function delete() {
        $this->load->language('localisation/minimum_order_total');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('localisation/minimum_order_total');

        if (isset($this->request->post['selected']) && $this->validateDelete()) {
            foreach ($this->request->post['selected'] as $mot_id) {
                $this->model_localisation_minimum_order_total->deleteMinimumordertotal($mot_id);
            }

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

            $this->response->redirect($this->url->link('localisation/minimum_order_total', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getList();
    }

    protected function getList() {
        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'ic_name';
        }

        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'ASC';
        }

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
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
            'href' => $this->url->link('localisation/minimum_order_total', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );

        $data['add'] = $this->url->link('localisation/minimum_order_total/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $data['delete'] = $this->url->link('localisation/minimum_order_total/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $data['refresh'] = $this->url->link('localisation/minimum_order_total/refresh', 'token=' . $this->session->data['token'] . $url, 'SSL');

        $data['currencies'] = array();

        $filter_data = array(
            'sort'  => $sort,
            'order' => $order,
            'start' => ($page - 1) * $this->config->get('config_limit_admin'),
            'limit' => $this->config->get('config_limit_admin')
        );

        $currency_total = $this->model_localisation_minimum_order_total->getTotalMinimumordertotaldetails();

        $this->load->model('localisation/geo_zone');

        $results = $this->model_localisation_minimum_order_total->getMinimumordertotaldetails($filter_data);

        foreach ($results as $result) {
          $geo_zone_details=  $this->model_localisation_geo_zone->getGeoZone($result['mot_geo_zone_id']);
            $data['mot_details'][] = array(
                'mot_id'   => $result['mot_id'],
                'mot_total'         => $result['mot_total'] . (($result['mot_id'] == $this->config->get('config_currency')) ? $this->language->get('text_default') : null),
               'mot_geo_zone_id' =>  (isset($geo_zone_details['name']))? $geo_zone_details['name'] : 'All Zones' ,
                'mot_status'   => $result['mot_status'],
                'edit'          => $this->url->link('localisation/minimum_order_total/edit', 'token=' . $this->session->data['token'] . '&mot_id=' . $result['mot_id'] . $url, 'SSL')
            );
        }

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_list'] = $this->language->get('text_list');
        $data['text_no_results'] = $this->language->get('text_no_results');
        $data['text_confirm'] = $this->language->get('text_confirm');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');

        $data['column_title'] = $this->language->get('column_title');
        $data['column_code'] = $this->language->get('column_code');
        $data['column_value'] = $this->language->get('column_value');
        $data['column_date_modified'] = $this->language->get('column_date_modified');
        $data['column_action'] = $this->language->get('column_action');

        $data['button_add'] = $this->language->get('button_add');
        $data['button_edit'] = $this->language->get('button_edit');
        $data['button_delete'] = $this->language->get('button_delete');
        $data['button_currency'] = $this->language->get('button_currency');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        if (isset($this->request->post['selected'])) {
            $data['selected'] = (array)$this->request->post['selected'];
        } else {
            $data['selected'] = array();
        }

        $url = '';

        if ($order == 'ASC') {
            $url .= '&order=DESC';
        } else {
            $url .= '&order=ASC';
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['sort_title'] = $this->url->link('localisation/minimum_order_total', 'token=' . $this->session->data['token'] . '&sort=ic_name' . $url, 'SSL');
        $data['sort_code'] = $this->url->link('localisation/minimum_order_total', 'token=' . $this->session->data['token'] . '&sort=code' . $url, 'SSL');
        $data['sort_value'] = $this->url->link('localisation/minimum_order_total', 'token=' . $this->session->data['token'] . '&sort=value' . $url, 'SSL');
        $data['sort_date_modified'] = $this->url->link('localisation/minimum_order_total', 'token=' . $this->session->data['token'] . '&sort=date_modified' . $url, 'SSL');

        $url = '';

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        $pagination = new Pagination();
        $pagination->total = $currency_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_limit_admin');
        $pagination->url = $this->url->link('localisation/minimum_order_total', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($currency_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($currency_total - $this->config->get('config_limit_admin'))) ? $currency_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $currency_total, ceil($currency_total / $this->config->get('config_limit_admin')));

        $data['sort'] = $sort;
        $data['order'] = $order;

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('localisation/minimum_order_total_list.tpl', $data));
    }

    protected function getForm() {
        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_form'] = !isset($this->request->get['ic_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_all_zones'] = $this->language->get('text_all_zones');

        $data['entry_title'] = $this->language->get('entry_title');
        $data['entry_code'] = $this->language->get('entry_code');
        $data['entry_value'] = $this->language->get('entry_value');
        $data['entry_symbol_left'] = $this->language->get('entry_symbol_left');
        $data['entry_symbol_right'] = $this->language->get('entry_symbol_right');
        $data['entry_decimal_place'] = $this->language->get('entry_decimal_place');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_geo_zone'] = $this->language->get('entry_geo_zone');

        $data['help_code'] = $this->language->get('help_code');
        $data['help_value'] = $this->language->get('help_value');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        $data['tab_general'] = $this->language->get('tab_general');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['title'])) {
            $data['error_title'] = $this->error['title'];
        } else {
            $data['error_title'] = '';
        }

        if (isset($this->error['code'])) {
            $data['error_code'] = $this->error['code'];
        } else {
            $data['error_code'] = '';
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
            'href' => $this->url->link('localisation/minimum_order_total', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );

        if (!isset($this->request->get['mot_id'])) {
            $data['action'] = $this->url->link('localisation/minimum_order_total/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
        } else {
            $data['action'] = $this->url->link('localisation/minimum_order_total/edit', 'token=' . $this->session->data['token'] . '&mot_id=' . $this->request->get['mot_id'] . $url, 'SSL');
        }

        $data['cancel'] = $this->url->link('localisation/minimum_order_total', 'token=' . $this->session->data['token'] . $url, 'SSL');

        if (isset($this->request->get['mot_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $mot_info = $this->model_localisation_minimum_order_total->getMinimumordertotal($this->request->get['mot_id']);
        }

        if (isset($this->request->post['minimum_order_total_total'])) {
            $data['minimum_order_total_total'] = $this->request->post['minimum_order_total_total'];
        } elseif (!empty($mot_info)) {
            $data['minimum_order_total_total'] = $mot_info['mot_total'];
        } else {
            $data['minimum_order_total_total'] ='';
        }

        if (isset($this->request->post['minimum_order_total_geo_zone_id'])) {
            $data['minimum_order_total_geo_zone_id'] = $this->request->post['minimum_order_total_geo_zone_id'];
        } elseif (!empty($mot_info)) {
            $data['minimum_order_total_geo_zone_id'] = $mot_info['mot_geo_zone_id'];
        } else {
            $data['minimum_order_total_geo_zone_id'] = '';
        }

        $this->load->model('localisation/geo_zone');

        $data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

        if (isset($this->request->post['minimum_order_total_status'])) {
            $data['minimum_order_total_status'] = $this->request->post['minimum_order_total_status'];
        } elseif (!empty($mot_info)) {
            $data['minimum_order_total_status'] = $mot_info['mot_status'];
        } else {
            $data['minimum_order_total_status'] = '';
        }

        /* if (isset($this->request->post['symbol_left'])) {
             $data['symbol_left'] = $this->request->post['symbol_left'];
         } elseif (!empty($currency_info)) {
             $data['symbol_left'] = $currency_info['symbol_left'];
         } else {
             $data['symbol_left'] = '';
         }

         if (isset($this->request->post['symbol_right'])) {
             $data['symbol_right'] = $this->request->post['symbol_right'];
         } elseif (!empty($currency_info)) {
             $data['symbol_right'] = $currency_info['symbol_right'];
         } else {
             $data['symbol_right'] = '';
         }

         if (isset($this->request->post['decimal_place'])) {
             $data['decimal_place'] = $this->request->post['decimal_place'];
         } elseif (!empty($currency_info)) {
             $data['decimal_place'] = $currency_info['decimal_place'];
         } else {
             $data['decimal_place'] = '';
         }

         if (isset($this->request->post['value'])) {
             $data['value'] = $this->request->post['value'];
         } elseif (!empty($currency_info)) {
             $data['value'] = $currency_info['value'];
         } else {
             $data['value'] = '';
         }*/


        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
       // print_r($data);

        $this->response->setOutput($this->load->view('localisation/minimum_order_total_form.tpl', $data));

    }

    protected function validateForm() {
        if (!$this->user->hasPermission('modify', 'localisation/minimum_order_total')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if ($this->request->post['minimum_order_total_total'] == "" ) {
            $this->error['title'] = $this->language->get('error_title');
        }

       /* if (utf8_strlen($this->request->post['sort']) == "") {
            $this->error['code'] = $this->language->get('error_code');
        }*/

        return !$this->error;
    }

    protected function validateDelete() {
        if (!$this->user->hasPermission('modify', 'localisation/minimum_order_total')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        $this->load->model('setting/store');
        $this->load->model('sale/order');

      /*  foreach ($this->request->post['selected'] as $currency_id) {
            $currency_info = $this->model_localisation_minimum_order_total->getCurrency($currency_id);

            if ($currency_info) {
                if ($this->config->get('config_currency') == $currency_info['code']) {
                    $this->error['warning'] = $this->language->get('error_default');
                }

                $store_total = $this->model_setting_store->getTotalStoresByCurrency($currency_info['code']);

                if ($store_total) {
                    $this->error['warning'] = sprintf($this->language->get('error_store'), $store_total);
                }
            }

            $order_total = $this->model_sale_order->getTotalOrdersByCurrencyId($currency_id);

            if ($order_total) {
                $this->error['warning'] = sprintf($this->language->get('error_order'), $order_total);
            }
        }*/

        return !$this->error;
    }

    protected function validateRefresh() {
        if (!$this->user->hasPermission('modify', 'localisation/minimum_order_total')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }
}
