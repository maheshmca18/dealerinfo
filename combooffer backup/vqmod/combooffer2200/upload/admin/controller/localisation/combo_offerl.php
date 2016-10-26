<?php

class ControllerLocalisationComboOfferl extends Controller {
    private $error = array();

    public function index() {
        $this->load->language('localisation/combo_offerl');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('localisation/combo_offerl');

        $this->getList();
    }

    public function add() {
        $this->load->language('localisation/combo_offerl');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('localisation/combo_offerl');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
        	
            $this->model_localisation_combo_offerl->addComboofferl($this->request->post);

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

            $this->response->redirect($this->url->link('localisation/combo_offerl', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    public function edit() {
        $this->load->language('localisation/combo_offerl');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('localisation/combo_offerl');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_localisation_combo_offerl->editComboofferl($this->request->get['c_id'], $this->request->post);

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

            $this->response->redirect($this->url->link('localisation/combo_offerl', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    public function delete() {
        $this->load->language('localisation/combo_offerl');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('localisation/combo_offerl');

        if (isset($this->request->post['selected']) && $this->validateDelete()) {
            foreach ($this->request->post['selected'] as $c_id) {
                $this->model_localisation_combo_offerl->deleteComboofferl($c_id);
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

            $this->response->redirect($this->url->link('localisation/combo_offerl', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getList();
    }

    public function refresh() {
        $this->load->language('localisation/combo_offerl');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('localisation/combo_offerl');

        if ($this->validateRefresh()) {
            $this->model_localisation_combo_offerl->refresh(true);

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

            $this->response->redirect($this->url->link('localisation/combo_offerl', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getList();
    }

    protected function getList() {
        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'c_name';
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
            'href' => $this->url->link('localisation/combo_offerl', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );

        $data['add'] = $this->url->link('localisation/combo_offerl/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $data['delete'] = $this->url->link('localisation/combo_offerl/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $data['refresh'] = $this->url->link('localisation/combo_offerl/refresh', 'token=' . $this->session->data['token'] . $url, 'SSL');

        $data['combo_offerl'] = array();

        $filter_data = array(
            'sort'  => $sort,
            'order' => $order,
            'start' => ($page - 1) * $this->config->get('config_limit_admin'),
            'limit' => $this->config->get('config_limit_admin')
        );

        $combo_offerl_total = $this->model_localisation_combo_offerl->getTotalcomboofferl();

        $results = $this->model_localisation_combo_offerl->getComboofferl($filter_data);

        foreach ($results as $result) {
            $data['combo_offerl'][] = array(
                'c_id'   => $result['c_id'],
                'c_name'         => $result['c_name'],
               'sort' => $result['c_sort_order'],
                'status'   => $result['c_status'],
                'date' => date($this->language->get('date_format_short'), strtotime($result['c_start_date'])),
                'edit'          => $this->url->link('localisation/combo_offerl/edit', 'token=' . $this->session->data['token'] . '&c_id=' . $result['c_id'] . $url, 'SSL')
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
        $data['button_combo_offer'] = $this->language->get('button_combo_offer');

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

        $data['sort_title'] = $this->url->link('localisation/combo_offerl', 'token=' . $this->session->data['token'] . '&sort=ic_name' . $url, 'SSL');
        $data['sort_code'] = $this->url->link('localisation/combo_offerl', 'token=' . $this->session->data['token'] . '&sort=code' . $url, 'SSL');
        $data['sort_value'] = $this->url->link('localisation/combo_offerl', 'token=' . $this->session->data['token'] . '&sort=value' . $url, 'SSL');
  $data['sort_status'] = $this->url->link('localisation/combo_offerl', 'token=' . $this->session->data['token'] . '&sort=status' . $url, 'SSL');
        $data['sort_date_modified'] = $this->url->link('localisation/combo_offerl', 'token=' . $this->session->data['token'] . '&sort=date_modified' . $url, 'SSL');

        $url = '';

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        $pagination = new Pagination();
        $pagination->total = $combo_offerl_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_limit_admin');
        $pagination->url = $this->url->link('localisation/combo_offerl', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($combo_offerl_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($combo_offerl_total - $this->config->get('config_limit_admin'))) ? $combo_offerl_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $combo_offerl_total, ceil($combo_offerl_total / $this->config->get('config_limit_admin')));

        $data['sort'] = $sort;
        $data['order'] = $order;

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('localisation/combo_offerl_list.tpl', $data));
    }

    protected function getForm() {
        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_form'] = !isset($this->request->get['ic_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');

        $data['entry_title'] = $this->language->get('entry_title');
        $data['entry_code'] = $this->language->get('entry_code');
        $data['entry_value'] = $this->language->get('entry_value');
        $data['entry_discount_price'] = $this->language->get('entry_discount_price');
        $data['entry_product'] = $this->language->get('entry_product');
        $data['entry_start_date'] = $this->language->get('entry_start_date');
		$data['entry_end_date'] = $this->language->get('entry_end_date');
        $data['entry_status'] = $this->language->get('entry_status');

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
	
		$data['token']= $this->session->data['token'];

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

if (isset($this->request->post['products'])) {
			$products = $this->request->post['products'];
		} elseif (isset($this->request->get['product_id'])) {
			$products = $this->model_localisation_combo_offerl->getProductdetails($this->request->get['product_id']);
		} else {
			$products = array();
		}
$data['products'] = array();

		foreach ($products as $product_id) {
			$related_info = $this->model_localisation_combo_offerl->getProduct($product_id);

			if ($related_info) {
				$data['products'][] = array(
					'product_id' => $related_info['product_id'],
					'name'       => $related_info['name']
				);
			}
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
            'href' => $this->url->link('localisation/combo_offerl', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );

        if (!isset($this->request->get['c_id'])) {
            $data['action'] = $this->url->link('localisation/combo_offerl/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
        } else {
            $data['action'] = $this->url->link('localisation/combo_offerl/edit', 'token=' . $this->session->data['token'] . '&c_id=' . $this->request->get['c_id'] . $url, 'SSL');
        }

        $data['cancel'] = $this->url->link('localisation/combo_offerl', 'token=' . $this->session->data['token'] . $url, 'SSL');

        if (isset($this->request->get['c_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $currency_info = $this->model_localisation_combo_offerl->getComboofferdetails($this->request->get['c_id']);
        }

        if (isset($this->request->post['c_name'])) {
            $data['c_name'] = $this->request->post['c_name'];
        } elseif (!empty($currency_info)) {
            $data['c_name'] = $currency_info['c_name'];
        } else {
            $data['c_name'] = '';
        }

         if (isset($this->request->post['c_discount_price'])) {
             $data['c_discount_price'] = $this->request->post['c_discount_price'];
         } elseif (!empty($currency_info)) {
             $data['c_discount_price'] = $currency_info['c_discount_amount'];
         } else {
             $data['c_discount_price'] = '';
         }
 if (isset($currency_info['c_product'])) {
	$explodeproduct=explode(',',$currency_info['c_product']);

	foreach ($explodeproduct as $product_id) {
			$related_info = $this->model_localisation_combo_offerl->getProduct($product_id);

			if ($related_info) {
				$data['products'][] = array(
					'product_id' => $related_info['product_id'],
					'name'       => $related_info['name']
				);
			}
		}
			}
		$dateempty=0000-00-00 ;
      
         if (isset($this->request->post['c_start_date'])) {
             $data['c_start_date'] = $this->request->post['c_start_date'];
         } elseif (!empty($currency_info)) {
	if($currency_info['c_start_date']!=$dateempty){
                $newDate = date("d/m/Y", strtotime($currency_info['c_start_date']));
	        $data['c_start_date'] = $newDate;            }
            else{
                $data['c_start_date'] = '';
            }			
         } else {
             $data['c_start_date'] = '';
         }


         if (isset($this->request->post['c_end_date'])) {
             $data['c_end_date'] = $this->request->post['c_end_date'];
         } elseif (!empty($currency_info)) {
 		
            if($currency_info['c_end_date']!=$dateempty){
                $newDate = date("d/m/Y", strtotime($currency_info['c_end_date']));
	        $data['c_end_date'] = $newDate;            }
            else{
                $data['c_end_date'] = '';
            }
	
         } else {
             $data['c_end_date'] = '';
         }

	 if (isset($this->request->post['c_sort_order'])) {
            $data['c_sort_order'] = $this->request->post['c_sort_order'];
        } elseif (!empty($currency_info)) {
            $data['c_sort_order'] = $currency_info['c_sort_order'];
        } else {
            $data['c_sort_order'] = '';
        }

        if (isset($this->request->post['c_status'])) {
            $data['c_status'] = $this->request->post['c_status'];
        } elseif (!empty($currency_info)) {
            $data['c_status'] = $currency_info['c_status'];
        } else {
            $data['c_status'] = '';
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
     
        $this->response->setOutput($this->load->view('localisation/combo_offerl_form.tpl', $data));

    }

    protected function validateForm() {
        if (!$this->user->hasPermission('modify', 'localisation/combo_offerl')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if ((utf8_strlen($this->request->post['c_name']) == "") ) {
            $this->error['title'] = $this->language->get('error_title');
        }

        return !$this->error;
    }

    protected function validateDelete() {
        if (!$this->user->hasPermission('modify', 'localisation/combo_offerl')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        $this->load->model('setting/store');
        $this->load->model('sale/order');

        foreach ($this->request->post['selected'] as $c_id) {
            $currency_info = $this->model_localisation_combo_offerl->getComboofferl($c_id);

            if ($currency_info) {
                if ($this->config->get('config_currency') == $currency_info['code']) {
                    $this->error['warning'] = $this->language->get('error_default');
                }

             }
	}

        return !$this->error;
    }

    protected function validateRefresh() {
        if (!$this->user->hasPermission('modify', 'localisation/combo_offerl')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }
	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name']) || isset($this->request->get['filter_model'])) {
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
				$limit = 5;
			}

			$filter_data = array(
				'filter_name'  => $filter_name,
				'filter_model' => $filter_model,
				'start'        => 0,
				'limit'        => $limit
			);

			$results = $this->model_catalog_product->getProducts($filter_data);

			foreach ($results as $result) {
				$option_data = array();

				$product_options = $this->model_catalog_product->getProductOptions($result['product_id']);

				foreach ($product_options as $product_option) {
					$option_info = $this->model_catalog_option->getOption($product_option['option_id']);

					if ($option_info) {
						$product_option_value_data = array();

						foreach ($product_option['product_option_value'] as $product_option_value) {
							$option_value_info = $this->model_catalog_option->getOptionValue($product_option_value['option_value_id']);

							if ($option_value_info) {
								$product_option_value_data[] = array(
									'product_option_value_id' => $product_option_value['product_option_value_id'],
									'option_value_id'         => $product_option_value['option_value_id'],
									'name'                    => $option_value_info['name'],
									'price'                   => (float)$product_option_value['price'] ? $this->currency->format($product_option_value['price'], $this->config->get('config_currency')) : false,
									'price_prefix'            => $product_option_value['price_prefix']
								);
							}
						}

						$option_data[] = array(
							'product_option_id'    => $product_option['product_option_id'],
							'product_option_value' => $product_option_value_data,
							'option_id'            => $product_option['option_id'],
							'name'                 => $option_info['name'],
							'type'                 => $option_info['type'],
							'value'                => $product_option['value'],
							'required'             => $product_option['required']
						);
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

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
}
