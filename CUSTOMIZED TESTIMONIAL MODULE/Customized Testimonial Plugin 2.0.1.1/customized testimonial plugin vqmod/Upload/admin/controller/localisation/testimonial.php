<?php 
class ControllerLocalisationTestimonial extends Controller {

	private $error = array(); 
    
	public function index() {
		$this->language->load('localisation/zone');

		$this->document->setTitle("Testimonial");
        
		$this->load->model('localisation/testimonial');
        $this->getList();
	}
    
    

	public function add() {
		$this->load->language('localisation/zone');

		$this->document->setTitle("Testimonial");
		
		$this->load->model('localisation/testimonial');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm() ){
			$this->model_localisation_testimonial->addTestimonial($this->request->post);
	
			$this->session->data['success'] = "Success : You have modified Testimonial ";
			
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
    				
		
			$this->response->redirect($this->url->link('localisation/testimonial', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function edit() {
 	  
		$this->load->language('localisation/zone');

		$this->document->setTitle("Testimonial Update");
		
		$this->load->model('localisation/testimonial');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

			$this->model_localisation_testimonial->editTestimonial($this->request->get['testimonial_id'], $this->request->post);			
			
			$this->session->data['success'] = "Success : You have modified Testimonial ";
			
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
			
			$this->response->redirect($this->url->link('localisation/testimonial', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
        
		$this->getForm();
	}

	public function delete() {
		$this->load->language('localisation/zone');

		$this->document->setTitle("Testimonial Delete");
		
		$this->load->model('localisation/testimonial');
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $testimonial_id) {
				$this->model_localisation_testimonial->deleteTestimonial($testimonial_id);
			}			
			
			$this->session->data['success'] = "Success : You have Deleted Testimonial";
			
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

			$this->response->redirect($this->url->link('localisation/testimonial', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

        $this->getList();
	}

	protected function getList() {
		
       
        if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 't.testimonial_id';
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
			'href'      => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('Testimonial'),
			'href'      => $this->url->link('localisation/testimonial', 'token=' . $this->session->data['token'] . $url, 'SSL')
   		);

		$data['add'] = $this->url->link('localisation/testimonial/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('localisation/testimonial/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
	
		$data['testimonials'] = array();

	
        $filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * 10,
			'limit' => 10
		);
		$testimonial_total = $this->model_localisation_testimonial->getTotalTestimonial();
			
		$results = $this->model_localisation_testimonial->getTestimonial($filter_data);
		foreach ($results as $result) {
			$editaction = array();
			
			/*$editaction[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('localisation/testimonial/edit', 'token=' . $this->session->data['token'] . '&testimonial_id=' . $result['testimonial_id'] . $url, 'SSL')
			);*/
					
			$data['testimonials'][] = array(
                'testimonial_id'  => $result['testimonial_id'],
				'name'  => $result['name'],
                'testimonial'  => $result['data'],
                'added_on'  => $result['added_on'],
                'status'  => ($result['status']=="0")?"DeActive":(($result['status']=="1")?"Approved":"DisApproved"),
                'selected' => isset($this->request->post['selected']) && in_array($result['testimonial_id'], $this->request->post['selected']),
				'edit'   => $this->url->link('localisation/testimonial/edit', 'token=' . $this->session->data['token'] . '&testimonial_id=' . $result['testimonial_id'] . $url, 'SSL'),			
			);
		}
	
		$data['heading_title'] = "Testimonial";
		$data['text_list'] = $this->language->get('Testimonial List');
		$data['text_confirm'] = $this->language->get('text_confirm');
		$data['text_no_results'] = $this->language->get('text_no_results');

		$data['column_name'] = "Name";
        $data['column_testimonial'] = "Testimonial";
        $data['column_added_on'] = "Added_on";
        $data['column_status'] = "Status";
		$data['column_action'] = $this->language->get('column_action');	

		$data['button_add'] = $this->language->get('button_add');
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
 
		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
        $data['sort_testimonial_id'] = $this->url->link('localisation/testimonial', 'token=' . $this->session->data['token'] . '&sort=t.testimonial_id' . $url, 'SSL');
		$data['sort_name'] = $this->url->link('localisation/testimonial', 'token=' . $this->session->data['token'] . '&sort=t.name' . $url, 'SSL');
        $data['sort_testimonial'] = $this->url->link('localisation/testimonial', 'token=' . $this->session->data['token'] . '&sort=t.data' . $url, 'SSL');
        $data['sort_status'] = $this->url->link('localisation/testimonial', 'token=' . $this->session->data['token'] . '&sort=t.status' . $url, 'SSL');
		$data['sort_added_on']=$this->url->link('localisation/testimonial', 'token='.$this->session->data['token'] . '&sort=t.added_on'. $url, 'SSL');
		
		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
												
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $testimonial_total;
		$pagination->page = $page;
        $pagination->limit = 10;
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('localisation/testimonial', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();
		
		$data['results'] = sprintf($this->language->get('text_pagination'), ($testimonial_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($testimonial_total - $this->config->get('config_limit_admin'))) ? $testimonial_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $testimonial_total, ceil($testimonial_total / $this->config->get('config_limit_admin')));
		
		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('localisation/testimonial_list.tpl', $data));
	}

	protected function getForm() {
		$data['heading_title'] = "Testimonial";
		
		$data['text_form'] = "Add Testimonial";
		$data['entry_status'] = "Status";
		$data['entry_name'] = "Name";
        $data['entry_testimonial'] = "Testimonial";
       	$data['entry_customer'] = "Customer Id";
        $data['entry_added_on'] = "Added on";
       	$data['entry_name'] = "Name";
        $data['entry_testimonial'] = "Testimonial";
        $data['text_deactive'] = $this->language->get('DeActive');
		$data['text_approved'] = $this->language->get('Approved');
		$data['text_disapproved'] = $this->language->get('DisApproved');
		
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
        
        if (isset($this->error['testimonial'])) {
			$data['error_testimonial'] = $this->error['testimonial'];
		} else {
			$data['error_testimonial'] = '';
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
			'href'      => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('Testimonial'),
			'href'      => $this->url->link('localisation/testimonial', 'token=' . $this->session->data['token'] . $url, 'SSL')
   		);
				
					
		if (!isset($this->request->get['testimonial_id'])) {
			$data['action'] = $this->url->link('localisation/testimonial/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
      
			$data['action'] = $this->url->link('localisation/testimonial/edit', 'token=' . $this->session->data['token'] . '&testimonial_id=' . $this->request->get['testimonial_id'] . $url, 'SSL');
		}
		
		$data['cancel'] = $this->url->link('localisation/testimonial', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['testimonial_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$testimonial_info = $this->model_localisation_testimonial->getTestimonial_id($this->request->get['testimonial_id']); 
                   
		}
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($testimonial_info )) {
			$data['status'] = $testimonial_info['status'];
		} else {
			$data['status'] = '0';
		}
		
		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($testimonial_info )) {
        	$data['name'] = $testimonial_info['name'];
		} else {
			$data['name'] = '';
		}
        
        if (isset($this->request->post['testimonial'])) {
			$data['testimonial'] = $this->request->post['testimonial'];
		} elseif (!empty($testimonial_info )) {
			$data['testimonial'] = $testimonial_info['data'];
		} else {
			$data['testimonial'] = '';
		}
         if (isset($this->request->post['customer'])) {
			$data['customer'] = $this->request->post['customer'];
		} elseif (!empty($testimonial_info )) {
			$data['customer'] = $testimonial_info['customer_id'];
		} else {
			$data['customer'] = '';
		}
        
        
         if (isset($this->request->post['added_on'])) {
			$data['added_on'] = $this->request->post['added_on'];
		} elseif (!empty($testimonial_info )) {
			$data['added_on'] = $testimonial_info['added_on'];
		} else {
			$data['added_on'] = '';
		}
        

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($testimonial_info)) {
			$data['status'] = $testimonial_info['status'];
		} else {
			$data['status'] = '';
		}
        
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
					
		$this->response->setOutput($this->load->view('localisation/testimonial_form.tpl', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'localisation/testimonial')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 32)) {
			$this->error['name'] ="Name must be 3 to 32 characters ";
		}
        
        if ((utf8_strlen($this->request->post['testimonial']) < 100) || (utf8_strlen($this->request->post['testimonial']) > 500)) {
			$this->error['testimonial'] ="Testimonial must be 100 to 500 characters";
		}

		return !$this->error;
	}
	
	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'localisation/testimonial')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}  

		return !$this->error;
	}
   
}
?>