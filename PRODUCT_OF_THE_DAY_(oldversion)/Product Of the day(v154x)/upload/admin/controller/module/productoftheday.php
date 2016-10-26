<?php
class ControllerModuleProductoftheday extends Controller {
    private $error = array();

    public function index()
    {
        $this->load->language('module/productoftheday');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('localisation/productoftheday');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
//print_r($this->request->post);exit;
            $this->model_localisation_productoftheday->addproduct($this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

           // $this->response->redirect($this->url->link('module/productoftheday', 'token=' . $this->session->data['token'], 'SSL'));

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

        if (isset($this->request->post['product_related'])) {
            $products = $this->request->post['product_related'];
        } elseif (isset($this->request->get['product_id'])) {
            $products = $this->model_catalog_product->getProductRelated($this->request->get['product_id']);
        } else {
            $products = array();
        }

        $this->data['product_relatedsss'] = array();

        foreach ($products as $product_id) {
            $related_info = $this->model_catalog_product->getProduct($product_id);

            if ($related_info) {
                $this->data['product_relatedsss'][] = array(
                    'product_id' => $related_info['product_id'],
                    'name'       => $related_info['name']
                );
            }
        }
        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_module'),
            'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('module/productoftheday', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->data['action'] = $this->url->link('module/productoftheday', 'token=' . $this->session->data['token'], 'SSL');

        $this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');


      //$data['multiple_days_value']=array();


        $this->load->model('localisation/productoftheday');
        $results = $this->model_localisation_productoftheday->getid();

        foreach($results as $result) {

  if($result['day_id']==1) {
      $this->data['product_relateds1'] = array();

      $explode_product_id = explode(" ", $result['product_ofthe_day_id']);//print_r($explode_product_id);
      $this->load->model('catalog/product');
      foreach ($explode_product_id as $product_id) {
          $related_info = $this->model_catalog_product->getProduct($product_id);
          //print_r($related_info);exit;

          if ($related_info) {
              $this->data['product_relateds1'][] = array(
                  'product_id' => $related_info['product_id'],
                  'name' => $related_info['name']
              );//print_r( $data['product_relateds1']);
          }
      }
  }

            if($result['day_id']==2) {
                $this->data['product_relateds2'] = array();
                $explode_product_id = explode(" ", $result['product_ofthe_day_id']);
                $this->load->model('catalog/product');
                foreach ($explode_product_id as $product_id) {
                    $related_info = $this->model_catalog_product->getProduct($product_id);

                    if ($related_info) {
                        $this->data['product_relateds2'][] = array(
                            'product_id' => $related_info['product_id'],
                            'name' => $related_info['name']
                        );
                    }
                }
            }

            if($result['day_id']==3) {
                $this->data['product_relateds3'] = array();
                $explode_product_id = explode(" ", $result['product_ofthe_day_id']);
                $this->load->model('catalog/product');
                foreach ($explode_product_id as $product_id) {
                    $related_info = $this->model_catalog_product->getProduct($product_id);

                    if ($related_info) {
                        $this->data['product_relateds3'][] = array(
                            'product_id' => $related_info['product_id'],
                            'name' => $related_info['name']
                        );
                    }
                }
            }
            if($result['day_id']==4) {
                $this->data['product_relateds4'] = array();
                $explode_product_id = explode(" ", $result['product_ofthe_day_id']);
                $this->load->model('catalog/product');
                foreach ($explode_product_id as $product_id) {
                    $related_info = $this->model_catalog_product->getProduct($product_id);

                    if ($related_info) {
                        $this->data['product_relateds4'][] = array(
                            'product_id' => $related_info['product_id'],
                            'name' => $related_info['name']
                        );
                    }
                }
            }
            if($result['day_id']==5) {
                $this->data['product_relateds5'] = array();
                $explode_product_id = explode(" ", $result['product_ofthe_day_id']);
                $this->load->model('catalog/product');
                foreach ($explode_product_id as $product_id) {
                    $related_info = $this->model_catalog_product->getProduct($product_id);

                    if ($related_info) {
                        $this->data['product_relateds5'][] = array(
                            'product_id' => $related_info['product_id'],
                            'name' => $related_info['name']
                        );
                    }
                }
            }
            if($result['day_id']==6) {
                $this->data['product_relateds6'] = array();
                $explode_product_id = explode(" ", $result['product_ofthe_day_id']);
                $this->load->model('catalog/product');
                foreach ($explode_product_id as $product_id) {
                    $related_info = $this->model_catalog_product->getProduct($product_id);

                    if ($related_info) {
                        $this->data['product_relateds6'][] = array(
                            'product_id' => $related_info['product_id'],
                            'name' => $related_info['name']
                        );
                    }
                }
            }
            if($result['day_id']==7) {
                $this->data['product_relateds7'] = array();
                $explode_product_id = explode(" ", $result['product_ofthe_day_id']);
                $this->load->model('catalog/product');
                foreach ($explode_product_id as $product_id) {
                    $related_info = $this->model_catalog_product->getProduct($product_id);

                    if ($related_info) {
                        $this->data['product_relateds7'][] = array(
                            'product_id' => $related_info['product_id'],
                            'name' => $related_info['name']
                        );
                    }
                }
            }


        }
        $this->data['token'] = $this->session->data['token'];

        $this->template = 'module/productoftheday.tpl';
        $this->children = array(
            'common/header',
            'common/footer',
        );
        $this->response->setOutput($this->render());

       /* $this->data['header'] = $this->load->controller('common/header');
        $this->data['column_left'] = $this->load->controller('common/column_left');
        $this->data['footer'] = $this->load->controller('common/footer');
        $this->data['token'] = $this->session->data['token'];

        $this->response->setOutput($this->load->view('module/productoftheday.tpl', $data));*/

    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'module/productoftheday')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        return !$this->error;
    }

    public function autocomplete() {
        $json = array();

        if (isset($this->request->get['filter_name']) || isset($this->request->get['filter_model']) || isset($this->request->get['filter_category_id'])) {
            $this->load->model('catalog/product');
            $this->load->model('catalog/option');

            if (isset($this->request->get['filter_name'])) {
                $filter_name = $this->request->get['filter_name'];
            } else {
                $filter_name = '';
            }

            if (isset($this->request->get['filter_model'])) {
                $filter_model = $this->request->get['filter_model'];
            } else {
                $filter_model = '';
            }

            if (isset($this->request->get['limit'])) {
                $limit = $this->request->get['limit'];
            } else {
                $limit = 20;
            }

            $data = array(
                'filter_name'  => $filter_name,
                'filter_model' => $filter_model,
                'start'        => 0,
                'limit'        => $limit
            );

            $results = $this->model_catalog_product->getProducts($data);

            foreach ($results as $result) {
                $option_data = array();

                $product_options = $this->model_catalog_product->getProductOptions($result['product_id']);

                foreach ($product_options as $product_option) {
                    $option_info = $this->model_catalog_option->getOption($product_option['option_id']);

                    if ($option_info) {
                        if ($option_info['type'] == 'select' || $option_info['type'] == 'radio' || $option_info['type'] == 'checkbox' || $option_info['type'] == 'image') {
                            $option_value_data = array();

                            foreach ($product_option['product_option_value'] as $product_option_value) {
                                $option_value_info = $this->model_catalog_option->getOptionValue($product_option_value['option_value_id']);

                                if ($option_value_info) {
                                    $option_value_data[] = array(
                                        'product_option_value_id' => $product_option_value['product_option_value_id'],
                                        'option_value_id'         => $product_option_value['option_value_id'],
                                        'name'                    => $option_value_info['name'],
                                        'price'                   => (float)$product_option_value['price'] ? $this->currency->format($product_option_value['price'], $this->config->get('config_currency')) : false,
                                        'price_prefix'            => $product_option_value['price_prefix']
                                    );
                                }
                            }

                            $option_data[] = array(
                                'product_option_id' => $product_option['product_option_id'],
                                'option_id'         => $product_option['option_id'],
                                'name'              => $option_info['name'],
                                'type'              => $option_info['type'],
                                'option_value'      => $option_value_data,
                                'required'          => $product_option['required']
                            );
                        } else {
                            $option_data[] = array(
                                'product_option_id' => $product_option['product_option_id'],
                                'option_id'         => $product_option['option_id'],
                                'name'              => $option_info['name'],
                                'type'              => $option_info['type'],
                                'option_value'      => $product_option['option_value'],
                                'required'          => $product_option['required']
                            );
                        }
                    }
                }

                $json[] = array(
                    'product_id' => $result['product_id'],
                    'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
                    'model'      => $result['model'],
                    'option'     => $option_data,
                    'price'      => $result['price']
                );
            }
        }

        $this->response->setOutput(json_encode($json));
    }

    public function install() {

        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "product_ofthe_day` (
`day_id` int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
`day` varchar(20) NOT NULL,
`product_ofthe_day_id` varchar(255) NOT NULL)");

        $this->db->query("insert into `" . DB_PREFIX . "product_ofthe_day` (day_id,day,product_ofthe_day_id)values (1,'Sunday',28)");
        $this->db->query("insert into `" . DB_PREFIX . "product_ofthe_day` (day_id,day,product_ofthe_day_id)values (2,'Monday',43)");
        $this->db->query("insert into `" . DB_PREFIX . "product_ofthe_day` (day_id,day,product_ofthe_day_id)values (3,'Tuesday',40)");
        $this->db->query("insert into `" . DB_PREFIX . "product_ofthe_day` (day_id,day,product_ofthe_day_id)values (4,'Wednesday',42)");
        $this->db->query("insert into `" . DB_PREFIX . "product_ofthe_day` (day_id,day,product_ofthe_day_id)values (5,'Thursday',40)");
        $this->db->query("insert into `" . DB_PREFIX . "product_ofthe_day` (day_id,day,product_ofthe_day_id)values (6,'Friday',41)");
        $this->db->query("insert into `" . DB_PREFIX . "product_ofthe_day` (day_id,day,product_ofthe_day_id)values (7,'Saturday',44)");

    }

    public function uninstall() {
        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "product_ofthe_day`");

    }
}
?>
