<?php
class ControllerLocalisationDeliverytimeslot extends Controller {
	private $error = array();

	public function index() { 
		$this->load->language('localisation/deliverytimeslot');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/deliverytimeslot');
//echo 111;exit;
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

			$this->redirect($this->url->link('localisation/deliverytimeslot', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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

			$this->redirect($this->url->link('localisation/deliverytimeslot', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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

			$this->redirect($this->url->link('localisation/deliverytimeslot', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL'),
                        'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('localisation/deliverytimeslot', 'token=' . $this->session->data['token'] . $url, 'SSL'),
            'separator' => '::'
		);

		$this->data['add'] = $this->url->link('localisation/deliverytimeslot/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['delete'] = $this->url->link('localisation/deliverytimeslot/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$this->data['deliveryitmeslot_arrays'] = array();

		$filter_data = array(
			'title'  => $sort,
			'status' => ($page - 1) * $this->config->get('config_limit_admin')			

		);

        $records_total = $this->model_localisation_deliverytimeslot->getTotalrecords();
        //print_r($language_total);exit;

            $results = $this->model_localisation_deliverytimeslot->getTimeslots($filter_data);

            foreach ($results as $result) {
			$this->data['deliveryitmeslot_arrays'][] = array(                
				'deliverytime_id' => $result['deliverytime_id'],				
				'title'  => $result['title'],
                                'from_time'  => $result['from_time'],
                                'to_time'  => $result['to_time'],
				'status'  => $result['status'],		
				'edit'        => $this->url->link('localisation/deliverytimeslot/edit', 'token=' . $this->session->data['token'] . '&deliverytime_id=' . $result['deliverytime_id'] . $url, 'SSL')
			);
		}

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_list'] = $this->language->get('text_list');
		$this->data['text_no_results'] = $this->language->get('text_no_results');
		$this->data['text_confirm'] = $this->language->get('text_confirm');

		$this->data['column_name'] = $this->language->get('column_name');
		$this->data['column_code'] = $this->language->get('column_code');
		$this->data['column_sort_order'] = $this->language->get('column_sort_order');
		$this->data['column_action'] = $this->language->get('column_action');

        $this->data['text_addtimeslot'] = $this->language->get('text_addtimeslot');
        $this->data['text_timeslot_title'] = $this->language->get('text_timeslot_title');
        $this->data['text_timeslot_status'] = $this->language->get('text_timeslot_status');

        $this->data['text_createdon'] = $this->language->get('text_createdon');
        $this->data['text_lasteditedon'] = $this->language->get('text_lasteditedon');

		$this->data['button_add'] = $this->language->get('button_add');
		$this->data['button_edit'] = $this->language->get('button_edit');
		$this->data['button_delete'] = $this->language->get('button_delete');

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$this->data['selected'] = (array)$this->request->post['selected'];
		} else {
			$this->data['selected'] = array();
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

		$this->data['sort_name'] = $this->url->link('localisation/deliverytimeslot', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
		$this->data['sort_code'] = $this->url->link('localisation/deliverytimeslot', 'token=' . $this->session->data['token'] . '&sort=code' . $url, 'SSL');
		$this->data['sort_sort_order'] = $this->url->link('localisation/deliverytimeslot', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, 'SSL');

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

		$this->data['pagination'] = $pagination->render();

		//$this->data['results'] = sprintf($this->language->get('text_pagination'), ($records_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($records_total - $this->config->get('config_limit_admin'))) ? $records_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $records_total, ceil($records_total / $this->config->get('config_limit_admin')));

		$this->data['sort'] = $sort;
		$this->data['order'] = $order;
         

        $this->template = 'localisation/deliverytimeslot_list.tpl';
        $this->children = array(
            'common/header',
            'common/footer',
        );
        $this->response->setOutput($this->render());

    }

	protected function getForm() { 
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_form'] = !isset($this->request->get['language_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_addtimeslot'] = $this->language->get('text_addtimeslot');

        $this->data['text_timeslot_title'] = $this->language->get('text_timeslot_title');
        $this->data['text_timeslot_status'] = $this->language->get('text_timeslot_status');
        $this->data['text_isrecursive'] = $this->language->get('text_isrecursive');
        $this->data['text_createdon'] = $this->language->get('text_createdon');
        $this->data['text_lasteditedon'] = $this->language->get('text_lasteditedon');
		$this->data['entry_name'] = $this->language->get('entry_name');
		$this->data['entry_code'] = $this->language->get('entry_code');
		$this->data['entry_locale'] = $this->language->get('entry_locale');
		$this->data['entry_image'] = $this->language->get('entry_image');
		$this->data['entry_directory'] = $this->language->get('entry_directory');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['entry_status'] = $this->language->get('entry_status');

		$this->data['help_code'] = $this->language->get('help_code');
		$this->data['help_locale'] = $this->language->get('help_locale');
		$this->data['help_image'] = $this->language->get('help_image');
		$this->data['help_directory'] = $this->language->get('help_directory');
		$this->data['help_status'] = $this->language->get('help_status');

		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$this->data['error_name'] = $this->error['name'];
		} else {
			$this->data['error_name'] = '';
		}

        if (isset($this->error['date'])) {
            $this->data['error_date'] = $this->error['date'];
        } else {
            $this->data['error_date'] = '';
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

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('localisation/deliverytimeslot', 'token=' . $this->session->data['token'] . $url, 'SSL'),
            'separator' => '::'
		);

		if (!isset($this->request->get['deliverytime_id'])) {
			$this->data['action'] = $this->url->link('localisation/deliverytimeslot/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else { 
			$this->data['action'] = $this->url->link('localisation/deliverytimeslot/edit', 'token=' . $this->session->data['token'] . '&deliverytime_id=' . $this->request->get['deliverytime_id'] . $url, 'SSL');
		}

		$this->data['cancel'] = $this->url->link('localisation/deliverytimeslot', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['deliverytime_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$timeslot_info = $this->model_localisation_deliverytimeslot->getTimeslot($this->request->get['deliverytime_id']);
		}

		/*if (isset($this->request->post['title'])) {
			$this->data['title'] = $this->request->post['title'];
		} elseif (!empty($timeslot_info)) {
			$this->data['title'] = $timeslot_info['title'];
		} else {
			$this->data['title'] = '';
		}*/

               if (isset($this->request->post['from_time'])) {
			$this->data['from_time'] = $this->request->post['from_time'];
		} elseif (!empty($timeslot_info)) {
			$this->data['from_time'] = $timeslot_info['from_time'];
		} else {
			$this->data['from_time'] = '';
		}

               if (isset($this->request->post['to_time'])) {
			$this->data['to_time'] = $this->request->post['to_time'];
		} elseif (!empty($timeslot_info)) {
			$this->data['to_time'] = $timeslot_info['to_time'];
		} else {
			$this->data['to_time'] = '';
		}

		if (isset($this->request->post['status'])) {
	      		$this->data['status'] = $this->request->post['status'];
	    	} elseif (!empty($timeslot_info)) {
			$this->data['status'] = $timeslot_info['status'];
		} else {
	      		$this->data['status'] = 1;
	    	}

        $this->template = 'localisation/deliverytimeslot_form.tpl';
        $this->children = array(
            'common/header',
            'common/footer',
        );
        $this->response->setOutput($this->render());

    }

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'localisation/deliverytimeslot')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		/* if ($this->request->post['title']=="") {
			$this->error['name'] = $this->language->get('error_name');
		}*/


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
