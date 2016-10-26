<?php
class ControllerLocalisationPostcodemasterweightbased extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('localisation/postcodemaster_weight_based');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/postcodemaster_weight_based');

		$this->getList();
	}

	public function add() {
		$this->load->language('localisation/postcodemaster_weight_based');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/postcodemaster_weight_based');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_localisation_postcodemaster_weight_based->addPostcode($this->request->post);

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

			$this->response->redirect($this->url->link('localisation/postcodemaster_weight_based', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('localisation/postcodemaster_weight_based');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/postcodemaster_weight_based');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_localisation_postcodemaster_weight_based->editPostcode($this->request->get['postcode_id'], $this->request->post);

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

			$this->response->redirect($this->url->link('localisation/postcodemaster_weight_based', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('localisation/postcodemaster_weight_based');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/postcodemaster_weight_based');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $postcode_id) {
				$this->model_localisation_postcodemaster_weight_based->deletePostcode($postcode_id);
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

			$this->response->redirect($this->url->link('localisation/postcodemaster_weight_based', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	protected function getList() {
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'name';
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
			'href' => $this->url->link('localisation/postcodemaster_weight_based', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['add'] = $this->url->link('localisation/postcodemaster_weight_based/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('localisation/postcodemaster_weight_based/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['postcodemaster'] = array();

		$filter_data = array(
			'postcode'  => $sort,
			'min_day' => $order,
			'max_day' => $order,
			'min_amount' => $order,
			'max_amount' => $order,
			'shipping_charge' => $order
			//'is_recursive' => ($page - 1) * $this->config->get('config_limit_admin')

		);

		    $language_total = $this->model_localisation_postcodemaster_weight_based->getTotalLanguages();

		$results = $this->model_localisation_postcodemaster_weight_based->getPostcodes($filter_data);

		foreach ($results as $result) {
			$data['postcodemaster'][$result['postcode']][] = array(
				'postcode_id' => $result['postcode_id'],
				'postcode'        => $result['postcode'], //.(($result['min_weight'] == $this->config->get('config_language')) ? $this->language->get('text_default') : null),
				'condition_type'        => $result['condition_type'],
				'min_weight'  => $result['min_weight'],
				'max_weight'  => $result['max_weight'],
				'shipping_charge'  => $result['shipping_charge'],
				'status'  => $result['status'],
				'edit'        => $this->url->link('localisation/postcodemaster_weight_based/edit', 'token=' . $this->session->data['token'] . '&postcode_id=' . $result['postcode_id'] . $url, 'SSL')
			);
		}


		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_name'] = $this->language->get('column_name');
		$data['column_code'] = $this->language->get('column_code');
		$data['column_sort_order'] = $this->language->get('column_sort_order');
		$data['column_action'] = $this->language->get('column_action');

        $data['text_addpostcodemaster'] = $this->language->get('text_addholidaymaster');
        $data['text_postcode'] = $this->language->get('text_postcode');


        $data['text_addpostcodemaster'] = $this->language->get('text_addholidaymaster');
        $data['text_postcode'] = $this->language->get('text_postcode');
        $data['text_conditiontype'] = $this->language->get('text_conditiontype');
        $data['text_conditiontype_min'] = $this->language->get('text_conditiontype_min');
        $data['text_conditiontype_max'] = $this->language->get('text_conditiontype_max');
        $data['text_conditiontype_weight'] = $this->language->get('text_conditiontype_weight');
        $data['text_conditiontype_between'] = $this->language->get('text_conditiontype_between');
        $data['text_shipping_charge'] = $this->language->get('text_shipping_charge');
        $data['text_status_enabled'] = $this->language->get('text_status_enabled');
        $data['text_status_disabled'] = $this->language->get('text_status_disabled');
        $data['entry_status'] = $this->language->get('entry_status');

		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');

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

		$data['sort_name'] = $this->url->link('localisation/postcodemaster_weight_based', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
		$data['sort_code'] = $this->url->link('localisation/postcodemaster_weight_based', 'token=' . $this->session->data['token'] . '&sort=code' . $url, 'SSL');
		$data['sort_sort_order'] = $this->url->link('localisation/postcodemaster_weight_based', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $language_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('localisation/postcodemaster_weight_based', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($language_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($language_total - $this->config->get('config_limit_admin'))) ? $language_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $language_total, ceil($language_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('localisation/postcodemaster_weight_based_list.tpl', $data));
	}

	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['language_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

        $data['text_addpostcodemaster'] = $this->language->get('text_addholidaymaster');
        $data['text_postcode'] = $this->language->get('text_postcode');
        $data['text_conditiontype'] = $this->language->get('text_conditiontype');
        $data['text_conditiontype_min'] = $this->language->get('text_conditiontype_min');
        $data['text_conditiontype_max'] = $this->language->get('text_conditiontype_max');
        $data['text_conditiontype_weight'] = $this->language->get('text_conditiontype_weight');
        $data['text_conditiontype_between'] = $this->language->get('text_conditiontype_between');
        $data['text_shipping_charge'] = $this->language->get('text_shipping_charge');
        $data['text_status_enabled'] = $this->language->get('text_status_enabled');
        $data['text_status_disabled'] = $this->language->get('text_status_disabled');
        $data['entry_status'] = $this->language->get('entry_status');

       /* $data['text_minday'] = $this->language->get('text_minday');
        $data['text_maxday'] = $this->language->get('text_maxday');
        $data['text_minamount'] = $this->language->get('text_minamount');
        $data['text_maxamount'] = $this->language->get('text_maxamount');
        $data['text_shippingcharge'] = $this->language->get('text_shippingcharge');*/
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

        if (isset($this->error['name'])) {
            $data['error_name'] = $this->error['name'];
        } else {
            $data['error_name'] = '';
        }

        if (isset($this->error['postcode'])) {
            $data['error_postcode'] = $this->error['postcode'];
        } else {
            $data['error_postcode'] = '';
        }

        if (isset($this->error['shipping_charge'])) {
            $data['error_shipping_charge'] = $this->error['shipping_charge'];
        } else {
            $data['error_shipping_charge'] = '';
        }

        if (isset($this->error['condition_type1'])) {
            $data['error_condition_typemin'] = $this->error['condition_type1'];
        } else {
            $data['error_condition_typemin'] = '';
        }

        if (isset($this->error['condition_type3'])) {
            $data['error_condition_typemax'] = $this->error['condition_type3'];
        } else {
            $data['error_condition_typemax'] = '';
        }

        if (isset($this->error['condition_type2'])) {
            $data['error_condition_typebetween'] = $this->error['condition_type2'];
        } else {
            $data['error_condition_typebetween'] = '';
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
			'href' => $this->url->link('localisation/postcodemaster_weight_based', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		if (!isset($this->request->get['postcode_id'])) {
			$data['action'] = $this->url->link('localisation/postcodemaster_weight_based/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('localisation/postcodemaster_weight_based/edit', 'token=' . $this->session->data['token'] . '&postcode_id=' . $this->request->get['postcode_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('localisation/postcodemaster_weight_based', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['postcode_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$postcode_info = $this->model_localisation_postcodemaster_weight_based->getPostcode($this->request->get['postcode_id']);
		}

		if (isset($this->request->post['postcode'])) {
			$data['postcode'] = $this->request->post['postcode'];
		} elseif (!empty($postcode_info)) {
			$data['postcode'] = $postcode_info['postcode'];
		} else {
			$data['postcode'] = '';
		}

        if (isset($this->request->post['condition_type'])) {
            $data['condition_type'] = $this->request->post['condition_type'];
        } elseif (!empty($postcode_info)) {
            $data['condition_type'] = $postcode_info['condition_type'];
        } else {
            $data['condition_type'] = '';
        }

        if (isset($this->request->post['min_weight'])) {
            $data['min_weight'] = $this->request->post['min_weight'];
        } elseif (!empty($postcode_info)) {
            $data['min_weight'] = $postcode_info['min_weight'];
        } else {
            $data['min_weight'] = '';
        }

        if (isset($this->request->post['max_weight'])) {
            $data['max_weight'] = $this->request->post['max_weight'];
        } elseif (!empty($postcode_info)) {
            $data['max_weight'] = $postcode_info['max_weight'];
        } else {
            $data['max_weight'] = '';
        }

        if (isset($this->request->post['shipping_charge'])) {
            $data['shipping_charge'] = $this->request->post['shipping_charge'];
        } elseif (!empty($postcode_info)) {
            $data['shipping_charge'] = $postcode_info['shipping_charge'];
        } else {
            $data['shipping_charge'] = '';
        }

        if (isset($this->request->post['status'])) {
            $data['status'] = $this->request->post['status'];
        } elseif (!empty($postcode_info)) {
            $data['status'] = $postcode_info['status'];
        } else {
            $data['shipping_charge'] = '';
        }



		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('localisation/postcodemaster_weight_based_form.tpl', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'localisation/postcodemaster_weight_based')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ($this->request->post['postcode']== "") {
			$this->error['postcode'] = $this->language->get('error_postcode');
		}
        if ($this->request->post['shipping_charge']== "") {
            $this->error['shipping_charge'] = $this->language->get('error_shipping_charge');
        }


        if ($this->request->post['condition_type']== 1) {
            if ($this->request->post['min_weight']== "") {
                $this->error['condition_type1'] = $this->language->get('error_condition_typemin');
        }
        }

        if ($this->request->post['condition_type']== 3) {
            if ($this->request->post['max_weight']== "") {
                $this->error['condition_type3'] = $this->language->get('error_condition_typemax');
            }
        }

        if ($this->request->post['condition_type']== 2) {
            if ($this->request->post['min_weight']== "" ) {
                $this->error['condition_type1'] = $this->language->get('error_condition_typemin');
            }
            if ($this->request->post['max_weight']== "" ) {
                $this->error['condition_type3'] = $this->language->get('error_condition_typemax');
            }

        }


		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'localisation/postcodemaster_weight_based')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		$this->load->model('setting/store');
		$this->load->model('sale/order');

		return !$this->error;
	}
}

