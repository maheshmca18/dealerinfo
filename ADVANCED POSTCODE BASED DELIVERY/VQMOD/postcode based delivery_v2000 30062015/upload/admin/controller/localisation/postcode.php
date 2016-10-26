<?php 
class ControllerLocalisationPostcode extends Controller {
	private $error = array(); 

	public function index() {

	
		$this->language->load('localisation/postcode');

		$this->document->setTitle("Postcode");
		
		$this->load->model('localisation/postcode');
		
		$this->getList();
	}

	public function insert() {

		$this->language->load('localisation/postcode');
		
		$this->document->setTitle("Postcode");
		
		$this->load->model('localisation/postcode');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_localisation_postcode->addPostcode($this->request->post);
	
			$this->session->data['success'] = "Success : You have added new Postcode";
			
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
			
			$this->response->redirect($this->url->link('localisation/postcode', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function update() {		
	
		$this->language->load('localisation/postcode');

		$this->document->setTitle("Postcode");
		
		$this->load->model('localisation/postcode');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_localisation_postcode->editPostcode($this->request->get['postcode_id'], $this->request->post);			
			
			$this->session->data['success'] = "Success : You have modified Postcode";
			
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
			
			$this->response->redirect($this->url->link('localisation/postcode', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {

		$this->document->setTitle("postcodes");
		
		$this->load->model('localisation/postcode');
		
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
		 
			foreach ($this->request->post['selected'] as $postcode_id) {
				$this->model_localisation_postcode->deletePostcode($postcode_id);
			}			
			
			$this->session->data['success'] ="Success : You have Deleted Postcode";
			
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

			$this->response->redirect($this->url->link('localisation/postcode', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

        $this->getList();
	}

	protected function getList() {

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'p.name';
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
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('Postcode'),
            'href'      => $this->url->link('localisation/postcode', 'token=' . $this->session->data['token'] . $url, 'SSL'),
            'separator' => ' :: '
        );

        $data['insert'] = $this->url->link('localisation/postcode/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $data['delete'] = $this->url->link('localisation/postcode/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

        $data['postcodes'] = array();

        $data['cancel'] = $this->url->link('localisation/postcode', 'token=' . $this->session->data['token'] . $url, 'SSL');

        $filter_data = array(
			'sort'  => $sort,
			'order' => $order,
            'start' => ($page - 1) * $this->config->get('config_limit_admin'),
            'limit' => $this->config->get('config_limit_admin')
		);
		
		$postcode_total = $this->model_localisation_postcode->getTotalpostcodes();
			
		$results = $this->model_localisation_postcode->getPostcodes($filter_data);

		foreach ($results as $result) {
			$action = array();
			
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('localisation/postcode/update', 'token=' . $this->session->data['token'] . '&postcode_id=' . $result['postcode_id'] . $url, 'SSL')
			);
					
			$data['postcodes'][] = array(
                'postcode_id'  => $result['postcode_id'],
				'postcode'  => $result['postcode'],
				'min_shipping'  => $this->currency->format($result['min_shipping']),
                'status'  => ($result['status']=="1")?"Enabled":"Disabled",
                'selected' => isset($this->request->post['selected']) && in_array($result['postcode_id'], $this->request->post['selected']),
				'action'   => $action			
			);
		}
	
		$data['heading_title'] = "Postcodes";
        $data['button_add'] = $this->language->get('button_add');
		$data['text_no_results'] = $this->language->get('text_no_results');

		$data['column_postcode'] = "Postcode";
        $data['column_min_shipping'] = "Minimum Shipping Price";
        $data['column_status'] = "Status";
		$data['column_action'] = $this->language->get('column_action');	

		$data['button_insert'] = $this->language->get('button_insert');
		$data['button_delete'] = $this->language->get('button_delete');
        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_edit'] = $this->language->get('button_edit');
		
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
 
		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		 
		$data['sort_postcode'] = $this->url->link('localisation/postcode', 'token=' . $this->session->data['token'] . '&sort=p.postcode' . $url, 'SSL');
        $data['sort_status'] = $this->url->link('localisation/postcode', 'token=' . $this->session->data['token'] . '&sort=p.status' . $url, 'SSL');
		
		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
												
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

        $pagination = new Pagination();
        $pagination->total = $postcode_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_limit_admin');
        $pagination->url = $this->url->link('localisation/postcode', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($postcode_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($postcode_total - $this->config->get('config_limit_admin'))) ? $postcode_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $postcode_total, ceil($postcode_total / $this->config->get('config_limit_admin')));

        $data['sort'] = $sort;
        $data['order'] = $order;

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        $this->response->setOutput($this->load->view('localisation/postcode_list.tpl',$data));
	}

	protected function getForm() {
		$data['heading_title'] = "Postcodes";

		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_postcode'] = "Postcode";
        $data['entry_min_shipping'] = "Minimum Shipping Price";
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
 		if (isset($this->error['postcode'])) {
			$data['error_postcode'] = $this->error['postcode'];
		} else {
			$data['error_postcode'] = '';
		}
        
        if (isset($this->error['min_shipping'])) {
            $data['error_min_shipping'] = $this->error['min_shipping'];
        } else {
            $data['error_min_shipping'] = '';
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
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),  		
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('localisation/postcode', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
									
		if (!isset($this->request->get['postcode_id'])) {
			$data['action'] = $this->url->link('localisation/postcode/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('localisation/postcode/update', 'token=' . $this->session->data['token'] . '&postcode_id=' . $this->request->get['postcode_id'] . $url, 'SSL');
		}
		 
		$data['cancel'] = $this->url->link('localisation/postcode', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['postcode_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$postcode_info = $this->model_localisation_postcode->getpostcodeById($this->request->get['postcode_id']);
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($postcode_info )) {
			$data['status'] = $postcode_info['status'];
		} else {
			$data['status'] = '1';
		}
		
		if (isset($this->request->post['postcode'])) {
			$data['postcode'] = $this->request->post['postcode'];
		} elseif (!empty($postcode_info)) {
			$data['postcode'] = $postcode_info['postcode'];
		} else {
			$data['postcode'] = '';
		}

        if (isset($this->request->post['min_shipping'])) {
            $data['min_shipping'] = $this->request->post['min_shipping'];
        } elseif (!empty($postcode_info)) {
            $data['min_shipping'] = $postcode_info['min_shipping'];
        } else {
            $data['min_shipping'] = '';
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        $this->response->setOutput($this->load->view('localisation/postcode_form.tpl',$data));

	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'localisation/postcode')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		if (utf8_strlen($this->request->post['postcode']) == 0) {
			$this->error['postcode'] ="Post Code is Mandotary";
		}
/*
		if ((utf8_strlen($this->request->post['postcode']) < 5) || (utf8_strlen($this->request->post['postcode']) > 12)) {
			$this->error['postcode'] ="postcode Minimum 6 and Maximum 12";
		}
  */      
        if ((utf8_strlen($this->request->post['min_shipping']) == "" )) {
            $this->error['min_shipping'] ="Minimum Shipping Price is Mandatory";
        }else if (utf8_strlen(is_numeric($this->request->post['min_shipping'])) == false){
            $this->error['min_shipping'] ="Please enter a valid Minimum Shipping Price";
        }
        
        $postcode_info = $this->model_localisation_postcode->getPostcode($this->request->post['postcode']);
		
        /*if ($postcode_info) {
				$this->error['warning'] ="postcode Already Exists";
			}*/
        if (!isset($this->request->get['postcode_id'])) {
			if ($postcode_info) {
				$this->error['warning'] ="Postcode has already exists";
			}
		} 
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'localisation/postcode')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}		
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
}
?>
