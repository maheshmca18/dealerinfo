<?php
class ControllerLocalisationDeliverytimeslot extends Controller {
	private $error = array();

	public function index() { 
		$this->load->language('localisation/deliverytimeslot');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/deliverytimeslot');

                $this->getList();

       	}

        public function add() { 

		$this->load->language('localisation/deliverytimeslot');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/deliverytimeslot');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {    
                        $this->model_localisation_deliverytimeslot->addTimeslot($this->request->post);

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

			$this->response->redirect($this->url->link('localisation/deliverytimeslot', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('localisation/deliverytimeslot');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/deliverytimeslot');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_localisation_deliverytimeslot->editTimeslot($this->request->get['deliverytime_id'], $this->request->post);

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

			$this->response->redirect($this->url->link('localisation/deliverytimeslot', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('localisation/deliverytimeslot');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/deliverytimeslot');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $deliverytime_id) {
				$this->model_localisation_deliverytimeslot->deleteTimeslot($deliverytime_id);
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

			$this->response->redirect($this->url->link('localisation/deliverytimeslot', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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
			'href' => $this->url->link('localisation/deliverytimeslot', 'token=' . $this->session->data['token'] . $url, 'SSL'),           
		);

		$data['add'] = $this->url->link('localisation/deliverytimeslot/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('localisation/deliverytimeslot/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['deliveryitmeslot_arrays'] = array();

		$filter_data = array(
			'title'  => $sort,
			'status' => ($page - 1) * $this->config->get('config_limit_admin')			

		);

            $records_total = $this->model_localisation_deliverytimeslot->getTotalrecords();     

            $results = $this->model_localisation_deliverytimeslot->getTimeslots($filter_data);

            foreach ($results as $result) {
			$data['deliveryitmeslot_arrays'][] = array(                
				'deliverytime_id' => $result['deliverytime_id'],				
				'title'  => $result['title'],
                                'from_time'  => $result['from_time'],
                                'to_time'  => $result['to_time'],
				'status'  => $result['status'],		
				'edit'        => $this->url->link('localisation/deliverytimeslot/edit', 'token=' . $this->session->data['token'] . '&deliverytime_id=' . $result['deliverytime_id'] . $url, 'SSL')
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

		$data['text_addtimeslot'] = $this->language->get('text_addtimeslot');
		$data['text_timeslot_title'] = $this->language->get('text_timeslot_title');
		$data['text_timeslot_status'] = $this->language->get('text_timeslot_status');

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

		$data['sort_name'] = $this->url->link('localisation/deliverytimeslot', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
		$data['sort_code'] = $this->url->link('localisation/deliverytimeslot', 'token=' . $this->session->data['token'] . '&sort=code' . $url, 'SSL');
		$data['sort_sort_order'] = $this->url->link('localisation/deliverytimeslot', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, 'SSL');

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
		$pagination->url = $this->url->link('localisation/deliverytimeslot', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		
		$data['sort'] = $sort;
		$data['order'] = $order;
         
                $data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('localisation/deliverytimeslot_list.tpl', $data));
       

    }

	protected function getForm() { 
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['language_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_addtimeslot'] = $this->language->get('text_addtimeslot');

		$data['text_timeslot_title'] = $this->language->get('text_timeslot_title');
		$data['text_timeslot_status'] = $this->language->get('text_timeslot_status');
		$data['text_isrecursive'] = $this->language->get('text_isrecursive');
		$data['text_createdon'] = $this->language->get('text_createdon');
		$data['text_lasteditedon'] = $this->language->get('text_lasteditedon');
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

        if (isset($this->error['date'])) {
            $data['error_date'] = $this->error['date'];
        } else {
            $data['error_date'] = '';
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
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('localisation/deliverytimeslot', 'token=' . $this->session->data['token'] . $url, 'SSL'),
            'separator' => '::'
		);

		if (!isset($this->request->get['deliverytime_id'])) {
			$data['action'] = $this->url->link('localisation/deliverytimeslot/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else { 
			$data['action'] = $this->url->link('localisation/deliverytimeslot/edit', 'token=' . $this->session->data['token'] . '&deliverytime_id=' . $this->request->get['deliverytime_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('localisation/deliverytimeslot', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['deliverytime_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$timeslot_info = $this->model_localisation_deliverytimeslot->getTimeslot($this->request->get['deliverytime_id']);
		}


               if (isset($this->request->post['from_time'])) {
			$data['from_time'] = $this->request->post['from_time'];
		} elseif (!empty($timeslot_info)) {
			$data['from_time'] = $timeslot_info['from_time'];
		} else {
			$data['from_time'] = '';
		}

               if (isset($this->request->post['to_time'])) {
			$data['to_time'] = $this->request->post['to_time'];
		} elseif (!empty($timeslot_info)) {
			$data['to_time'] = $timeslot_info['to_time'];
		} else {
			$data['to_time'] = '';
		}

		if (isset($this->request->post['status'])) {
	      		$data['status'] = $this->request->post['status'];
	    	} elseif (!empty($timeslot_info)) {
			$data['status'] = $timeslot_info['status'];
		} else {
	      		$data['status'] = 1;
	    	}

       
                $data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('localisation/deliverytimeslot_form.tpl', $data));

    }

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'localisation/deliverytimeslot')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}



		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'localisation/deliverytimeslot')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		$this->load->model('setting/store');
		$this->load->model('sale/order');

		return !$this->error;
	}
    
}
