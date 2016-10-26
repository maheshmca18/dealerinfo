<?php
class ControllerLocalisationOrdertracking extends Controller {
	private $error = array();

	public function index() { 

		$this->load->language('localisation/ordertracking');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/ordertracking');

                $this->getList();

       	}

        public function add() { 

		$this->load->language('localisation/ordertracking');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/ordertracking');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {    //print_r($this->request->post);exit;
                        $this->model_localisation_ordertracking->addOrdertrack($this->request->post);

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

			$this->response->redirect($this->url->link('localisation/ordertracking', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('localisation/ordertracking');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/ordertracking');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) { 
			$this->model_localisation_ordertracking->editOrdertrack($this->request->get['ordertracking_id'], $this->request->post);

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

			$this->response->redirect($this->url->link('localisation/ordertracking', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('localisation/ordertracking');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/ordertracking');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $ordertracking_id) {
				$this->model_localisation_ordertracking->deleteOrdertrack($ordertracking_id);
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

			$this->response->redirect($this->url->link('localisation/ordertracking', 'token=' . $this->session->data['token'] . $url, true));
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
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('localisation/ordertracking', 'token=' . $this->session->data['token'] . $url, true)
		);

			$data['add'] = $this->url->link('localisation/ordertracking/add', 'token=' . $this->session->data['token'] . $url, true);
			
			$data['delete'] = $this->url->link('localisation/ordertracking/delete', 'token=' . $this->session->data['token'] . $url, true);

		$data['ordertrack_arrays'] = array();

		$filter_data = array(
			'title'  => $sort,
			'status' => ($page - 1) * $this->config->get('config_limit_admin')			

		);

            $records_total = $this->model_localisation_ordertracking->getTotalrecords();     

            $results = $this->model_localisation_ordertracking->getOrdertracks($filter_data);

            foreach ($results as $result) {
			$data['ordertrack_arrays'][] = array(                
				'ordertracking_id' => $result['ordertracking_id'],				
				'courier_company_name'  => $result['courier_company_name'],
                                'tracking_url'  => $result['tracking_url'],
                                'status'  => $result['status'],		
				'edit'        => $this->url->link('localisation/ordertracking/edit', 'token=' . $this->session->data['token'] . '&ordertracking_id=' . $result['ordertracking_id'] . $url, 'SSL')
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

		$data['text_addordertrackcompany'] = $this->language->get('text_addordertrackcompany');
		$data['text_courier_name'] = $this->language->get('text_courier_name');
		$data['text_courier_url'] = $this->language->get('text_courier_url');
		$data['text_courier_status'] = $this->language->get('text_courier_status');

		$data['text_createdon'] = $this->language->get('text_createdon');
		$data['text_lasteditedon'] = $this->language->get('text_lasteditedon');

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

		$data['sort_name'] = $this->url->link('localisation/ordertracking', 'token=' . $this->session->data['token'] . '&sort=name' . $url, true);
		$data['sort_code'] = $this->url->link('localisation/ordertracking', 'token=' . $this->session->data['token'] . '&sort=code' . $url, true);
		$data['sort_sort_order'] = $this->url->link('localisation/ordertracking', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, true);

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $records_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('localisation/ordertracking', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		
		$data['sort'] = $sort;
		$data['order'] = $order;
         
                $data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('localisation/ordertracking_list.tpl', $data));
       

    }

	protected function getForm() { 
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['language_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		//$data['text_addtimeslot'] = $this->language->get('text_addtimeslot');

		$data['text_courier_name'] = $this->language->get('text_courier_name');
		$data['text_courier_url'] = $this->language->get('text_courier_url');
		$data['text_courier_status'] = $this->language->get('text_courier_status');
		

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

		 if (isset($this->error['error_courier_company_name'])) {
                 $data['error_courier_company_name'] = $this->error['error_courier_company_name'];
                 } else {
                 $data['error_courier_company_name'] = '';
                 } 

 		if (isset($this->error['error_tracking_url'])) {
                 $data['error_tracking_url'] = $this->error['error_tracking_url'];
                 } else {
                 $data['error_tracking_url'] = '';
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
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('localisation/ordertracking', 'token=' . $this->session->data['token'] . $url, true)
		);

		if (!isset($this->request->get['ordertracking_id'])) { 
			$data['action'] = $this->url->link('localisation/ordertracking/add', 'token=' . $this->session->data['token'] . $url, true);
		} else {  
			$data['action'] = $this->url->link('localisation/ordertracking/edit', 'token=' . $this->session->data['token'] . '&ordertracking_id=' . $this->request->get['ordertracking_id'] . $url, true);//echo 123;exit;
		}

		$data['cancel'] = $this->url->link('localisation/ordertracking', 'token=' . $this->session->data['token'] . $url, true);

		if (isset($this->request->get['ordertracking_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$courier_info = $this->model_localisation_ordertracking->getOrdertrack($this->request->get['ordertracking_id']);
		}

		if (isset($this->request->post['courier_company_name'])) {
	      		$data['courier_company_name'] = $this->request->post['courier_company_name'];
	    	} elseif (!empty($courier_info)) {
			$data['courier_company_name'] = $courier_info['courier_company_name'];
		} else {
	      		$data['courier_company_name'] = "";
	    	}

		if (isset($this->request->post['tracking_url'])) {
	      		$data['tracking_url'] = $this->request->post['tracking_url'];
	    	} elseif (!empty($courier_info)) {
			$data['tracking_url'] = $courier_info['tracking_url'];
		} else {
	      		$data['tracking_url'] = "";
	    	}

		if (isset($this->request->post['status'])) {
	      		$data['status'] = $this->request->post['status'];
	    	} elseif (!empty($courier_info)) {
			$data['status'] = $courier_info['status'];
		} else {
	      		$data['status'] = 1;
	    	}

       
                $data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('localisation/ordertracking_form.tpl', $data));

    }

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'localisation/ordertracking')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

       if(!$this->request->post['courier_company_name'])
        {
            $this->error['error_courier_company_name']=$this->language->get('error_courier_company_name');

        }
        if(!$this->request->post['tracking_url'])
        {
            $this->error['error_tracking_url']=$this->language->get('error_tracking_url');
        }

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'localisation/ordertracking')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		$this->load->model('setting/store');
		$this->load->model('sale/order');

		return !$this->error;
	}
    
}
