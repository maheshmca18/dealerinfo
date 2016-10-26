<?php 
class ControllerInformationTestimonial extends Controller {
	private $error = array(); 
	    
  	public function index() {
  	 
       	$this->document->setTitle("Testimonial");  
           
    if(file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/irstestimonial/testimonial.css')) {
        $this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template'). '/irstestimonial/testimonial.css');
    }  
        $this->load->model('information/testimonial');
        
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
					
	    $data['testimonials'] = array();
        
        $data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * 10,
			'limit' => 10
		);

		$testimonial_total = $this->model_information_testimonial->getTotalTestimonial();
			
		$results = $this->model_information_testimonial->getTestimonial($data);

		foreach ($results as $result) {
			$action = array();
			
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('information/testimonial/update', 'testimonial_id=' . $result['testimonial_id'] . $url, 'SSL')
			);
					
			$data['testimonials'][] = array(
                'testimonial_id'  => $result['testimonial_id'],
				'name'  => $result['name'],
                'testimonial'  => $result['data'],
                'added_on'  => $result['added_on'],
                'status'  => $result['status'], 			
			);
		}
	
		$data['heading_title'] = "Testimonial";

		$data['text_no_results'] = "No Results Found";
		$data['column_name'] = "Name";
        $data['column_testimonial'] = "Testimonial";
        $data['column_status'] = "Status";
		$data['column_action'] = $this->language->get('column_action');	

		$data['button_insert'] = $this->language->get('button_insert');
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
				
        $data['sort_testimonial_id'] = $this->url->link('information/testimonial', 'token=' . $this->session->data['token'] . '&sort=t.testimonial_id' . $url, 'SSL');
		$data['sort_name'] = $this->url->link('information/testimonial', 'token=' . $this->session->data['token'] . '&sort=t.name' . $url, 'SSL');
        $data['sort_testimonial'] = $this->url->link('localisation/testimonial',  'token=' . $this->session->data['token'] . '&sort=t.data' . $url, 'SSL');
        $data['sort_status'] = $this->url->link('information/testimonial', 'token=' . $this->session->data['token'] . '&sort=t.status' . $url, 'SSL');
		
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
		$pagination->url = $this->url->link('information/testimonial', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();
		$data['results'] = sprintf($this->language->get('text_pagination'), ($testimonial_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($testimonial_total - $this->config->get('config_limit_admin'))) ? $testimonial_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $testimonial_total, ceil($testimonial_total / $this->config->get('config_limit_admin')));
		
		$data['sort'] = $sort;
		$data['order'] = $order;

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/testimonial.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/information/testimonial.tpl';
		} else {
			$this->template = 'default/template/information/testimonial.tpl';
		}
        
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
          
        	$this->model_information_testimonial->addTestimonial($this->request->post);
			
      		$this->response->redirect($this->url->link('information/testimonial/success', 'token=' . $this->session->data['token'] . $url, 'SSL'));
    	}

      	$data['breadcrumbs'] = array();

      	$data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),        	
      	);

      	$data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('Testimonial'),
			'href'      => $this->url->link('information/testimonial'),
      	);	
			
    	$data['heading_title'] = $this->language->get('Testimonial');
		
        if(isset($this->request->post['name'])){
        $data['name']=$this->request->post['name'];
        }
        else{
            $data['name']='';
        }
        if(isset($this->request->post['testimonial'])){
        $data['testimonial']=$this->request->post['testimonial'];
        }
        else{
            $data['testimonial']='';
        }
    	$data['entry_name'] = 'Name';
    	$data['entry_testimonial'] = 'Testimonial';
        
		if (isset($this->error['error_login'])) {
    		$data['error_login'] = $this->error['error_login'];
		} else {
			$data['error_login'] = '';
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
		
		$data['action'] = $this->url->link('information/testimonial/testimonial_submit');
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/testimonial.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/information/testimonial.tpl';
		} else {
			$this->template = 'default/template/information/testimonial.tpl';
		}

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
		
		$this->response->setOutput($this->load->view('default/template/information/testimonial.tpl', $data));
  	}
    public function testimonial_single() {
       	$this->document->setTitle("Testimonial");  
        
    if(file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/irstestimonial/testimonial.css')) {
        $this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template'). '/irstestimonial/testimonial.css');
    }
    
        $this->load->model('information/testimonial');
        
/** ******************************************************************* */
         	$result = $this->model_information_testimonial->getTestimonialsingle($this->request->get['testimonialid']);

		if($result != 0 ){
			$action = array();
			
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('information/testimonial/update', 'testimonial_id=' . $result['testimonial_id'], 'SSL')
			);
					
			$data['testimonials'] = array(
                'testimonial_id'  => $result['testimonial_id'],
				'name'  => $result['name'],
                'testimonial'  => $result['data'],
                'added_on'  => $result['added_on'],
                'status'  => $result['status'], 			
			);
 
	}
		$data['heading_title'] = "Testimonial";

		$data['text_no_results'] = "No Results Found";
		$data['column_name'] = "Name";
        $data['column_testimonial'] = "Testimonial";
        $data['column_status'] = "Status";
		$data['column_action'] = $this->language->get('column_action');	

		$data['button_insert'] = $this->language->get('button_insert');
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
 
	
/** ******************************************************************* */
        
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
          
        	$this->model_information_testimonial->addTestimonial($this->request->post);
      		
      		$this->response->redirect($this->url->link('information/testimonial/success', 'token=' . $this->session->data['token'] . $url, 'SSL'));
    	}

      	$data['breadcrumbs'] = array();

      	$data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),        	
      	);

      	$data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('Testimonial'),
			'href'      => $this->url->link('information/testimonial'),
      	);	
			
        
    	$data['heading_title'] = $this->language->get('Testimonial');

        if(isset($this->request->post['name'])){
        $data['name']=$this->request->post['name'];
        }
        else{
            $data['name']='';
        }
        if(isset($this->request->post['testimonial'])){
        $data['testimonial']=$this->request->post['testimonial'];
        }
        else{
            $data['testimonial']='';
        }
    	$data['entry_name'] = 'Name';
    	$data['entry_testimonial'] = 'Testimonial';
        
		if (isset($this->error['error_login'])) {
    		$data['error_login'] = $this->error['error_login'];
		} else {
			$data['error_login'] = '';
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
		
		$data['action'] = $this->url->link('information/testimonial');
		

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/testimonial_single.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/information/testimonial_single.tpl';
		} else {
			$this->template = 'default/template/information/testimonial_single.tpl';
		}

        $data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
		$this->response->setOutput($this->load->view('default/template/information/testimonial_single.tpl', $data));
  	}


	 public function testimonial_submit() {
       	$this->document->setTitle("Testimonial");  
        
    if(file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/irstestimonial/testimonial.css')) {
        $this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template'). '/irstestimonial/testimonial.css');
    }
    
        $this->load->model('information/testimonial');
		$data['heading_title'] = "Testimonial";
		$data['text_no_results'] = "No Results Found";
		$data['column_name'] = "Name";
        $data['column_testimonial'] = "Testimonial";
        $data['column_status'] = "Status";
		$data['column_action'] = $this->language->get('column_action');	

		$data['button_insert'] = $this->language->get('button_insert');
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
 
	
/** ******************************************************************* */
        
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
          
        	$this->model_information_testimonial->addTestimonial($this->request->post);
      		
      		$this->response->redirect($this->url->link('information/testimonial/success', 'token=' . $this->session->data['token'] . $url, 'SSL'));
    	}

      	$data['breadcrumbs'] = array();

      	$data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),        	
      	);

      	$data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('Testimonial'),
			'href'      => $this->url->link('information/testimonial'),
      	);	
			
        
    	$data['heading_title'] = $this->language->get('Testimonial');

        if(isset($this->request->post['name'])){
        $data['name']=$this->request->post['name'];
        }
        else{
            $data['name']='';
        }
        if(isset($this->request->post['testimonial'])){
        $data['testimonial']=$this->request->post['testimonial'];
        }
        else{
            $data['testimonial']='';
        }
    	$data['entry_name'] = 'Name';
    	$data['entry_testimonial'] = 'Testimonial';
        
		if (isset($this->error['error_login'])) {
    		$data['error_login'] = $this->error['error_login'];
		} else {
			$data['error_login'] = '';
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
		
		$data['action'] = $this->url->link('information/testimonial');
		

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/testimonial_single.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/information/testimonial_single.tpl';
		} else {
			$this->template = 'default/template/information/testimonial_single.tpl';
		}

        $data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
		$this->response->setOutput($this->load->view('default/template/information/testimonial_single.tpl', $data));
  	}







  	public function success() {
    	$this->document->setTitle("Thank you for submitting your Testimonial.");
      	$data['breadcrumbs'] = array();

      	$data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
      	);

      	$data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('success for testimonial'),
			'href'      => $this->url->link('information/testimonial'),
      	);	
		
        $data['heading_title'] = $this->language->get('success for testimonial');
        
    	$data['text_message'] = "Thank you for submitting your Testimonial. Our Administrator will publish Your message Shortly.";
	  	$data['button_continue'] = $this->language->get('button_continue');

    	$data['continue'] = $this->url->link('common/home');


		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/success.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/common/success.tpl';
		} else {
			$this->template = 'default/template/common/success.tpl';
		}

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
				
 		$this->response->setOutput($this->load->view('default/template/common/success.tpl', $data));
	}
	
  	protected function validateForm() {

    	if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 32)) {
      		$this->error['name'] = "Name must be 3 to 32 characters";
    	}
        	if ((utf8_strlen($this->request->post['testimonial']) < 100) || (utf8_strlen($this->request->post['testimonial']) > 500)) {
      		$this->error['testimonial'] = "Testimonial must be 100 to 500 characters";
    	}
        if(!$this->customer->getId())
        {
            $this->error['error_login']= "You must login to add Testimonial";
        }

		return !$this->error;
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
			'href'      => $this->url->link('common/home'),        	
      	);

      	$data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('Testimonial'),
			'href'      => $this->url->link('information/testimonial'),
      	);	
			
	    $data['testimonials'] = array();
        
        $data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * 10,
			'limit' => 10
		);
 
		$testimonial_total = $this->model_information_testimonial->getTotalTestimonial();
			
		$results = $this->model_information_testimonial->getTestimonial($data);
		foreach ($results as $result) {
			$action = array();
			
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('information/testimonial/update', 'testimonial_id=' . $result['testimonial_id'] . $url, 'SSL')
			);
					
			$data['testimonials'][] = array(
                'testimonial_id'  => $result['testimonial_id'],
				'name'  => $result['name'],
                'testimonial'  => $result['data'],
                'added_on'  => $result['added_on'],
                'status'  => $result['status'], 			
			);
		}
	
		$data['heading_title'] = "Testimonial";

		$data['text_no_results'] = "No Results Found";
		$data['column_name'] = "Name";
        $data['column_testimonial'] = "Testimonial";
        $data['column_status'] = "Status";
		$data['column_action'] = $this->language->get('column_action');	

		$data['button_insert'] = $this->language->get('button_insert');
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
				
        $data['sort_testimonial_id'] = $this->url->link('information/testimonial', 'token=' . $this->session->data['token'] . '&sort=t.testimonial_id' . $url, 'SSL');
		$data['sort_name'] = $this->url->link('information/testimonial', 'token=' . $this->session->data['token'] . '&sort=t.name' . $url, 'SSL');
        $data['sort_testimonial'] = $this->url->link('localisation/testimonial',  'token=' . $this->session->data['token'] . '&sort=t.data' . $url, 'SSL');
        $data['sort_status'] = $this->url->link('information/testimonial', 'token=' . $this->session->data['token'] . '&sort=t.status' . $url, 'SSL');
		
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
		$pagination->url = $this->url->link('information/testimonial', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();
		$data['results'] = sprintf($this->language->get('text_pagination'), ($testimonial_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($testimonial_total - $this->config->get('config_limit_admin'))) ? $testimonial_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $testimonial_total, ceil($testimonial_total / $this->config->get('config_limit_admin')));
		
		$data['sort'] = $sort;
		$data['order'] = $order;

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/testimonial.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/information/testimonial.tpl';
		} else {
			$this->template = 'default/template/information/testimonial.tpl';
		}

		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
		$this->response->setOutput($this->load->view('default/template/information/testimonial.tpl', $data)); 
	}

}
?>
