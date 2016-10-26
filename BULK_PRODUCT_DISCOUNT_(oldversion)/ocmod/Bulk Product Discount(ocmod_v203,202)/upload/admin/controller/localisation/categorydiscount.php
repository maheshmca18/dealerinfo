<?php 
class ControllerLocalisationCategorydiscount extends Controller {
	private $error = array();

	public function index() { 
		$this->language->load('localisation/categorydiscount');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/categorydiscount');
		
		$this->getList();
	}

	public function insert() {
		$this->language->load('localisation/categorydiscount');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/categorydiscount');
//print_r($this->request->post);exit;
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_localisation_categorydiscount->addCategoryDiscount($this->request->post);

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

			$this->response->redirect($this->url->link('localisation/categorydiscount', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function update() {
		$this->language->load('localisation/categorydiscount');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/categorydiscount');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_localisation_categorydiscount->editCategoryDiscount($this->request->get['category_discount_id'], $this->request->post);

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

			$this->response->redirect($this->url->link('localisation/categorydiscount', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->language->load('localisation/categorydiscount');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/categorydiscount');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $category_discount_id) {
				$this->model_localisation_categorydiscount->deleteCategoryDiscount($category_discount_id);
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

			$this->response->redirect($this->url->link('localisation/categorydiscount', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	protected function getList() { 
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'category_id';
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

		

		$data['insert'] = $this->url->link('localisation/categorydiscount/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('localisation/categorydiscount/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		
	        $data['categorydiscounts'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit' => $this->config->get('config_admin_limit')
		);

		$categorydiscount_total = $this->model_localisation_categorydiscount->getTotalCategoryDiscounts();

		$results = $this->model_localisation_categorydiscount->getCategoryDiscounts($filter_data);

		foreach ($results as $result) {
			$action = array();

			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('localisation/categorydiscount/update', 'token=' . $this->session->data['token'] . '&category_discount_id=' . $result['category_discount_id'] . $url, 'SSL')
			);
			
		$this->load->model('catalog/category');
		
		$category_info = $this->model_catalog_category->getCategory($result['category_id']);
		
		$category_name = "";
		
		if ($category_info) {
			$category_name = ($category_info['path'] ? $category_info['path'] . ' &gt; ' : '') . $category_info['name'];			
		}
		
		$this->load->model('sale/customer_group');
		
		$customer_group_info = $this->model_sale_customer_group->getCustomerGroup($result['customer_group_id']);
		
		$customer_group_name = "";
		
		if ($customer_group_info) {
			$customer_group_name = $customer_group_info['name'];			
		}
		
			$data['categorydiscounts'][] = array(
				'category_discount_id' => $result['category_discount_id'],
				'category_id'       => $category_name,
				'customer_group_id' => $customer_group_name,
				'percentage' => $result['percentage'],				
				'status'   => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'selected'   => isset($this->request->post['selected']) && in_array($result['category_discount_id'], $this->request->post['selected']),				
				'action'     => $action
			);
		}

//print_r($data);exit;
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_no_results'] = $this->language->get('text_no_results');
$data['text_confirm'] = $this->language->get('text_confirm');
		$data['column_category'] = $this->language->get('column_category');
		$data['column_customer_group'] = $this->language->get('column_customer_group');
		$data['column_percentage'] = $this->language->get('column_percentage');
		$data['column_date_start'] = $this->language->get('column_date_start');
		$data['column_date_end'] = $this->language->get('column_date_end');
		$data['column_status'] = $this->language->get('column_status');
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

		$data['sort_name'] = $this->url->link('localisation/categorydiscount', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
		$data['sort_iso_code_2'] = $this->url->link('localisation/categorydiscount', 'token=' . $this->session->data['token'] . '&sort=iso_code_2' . $url, 'SSL');
		$data['sort_iso_code_3'] = $this->url->link('localisation/categorydiscount', 'token=' . $this->session->data['token'] . '&sort=iso_code_3' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $categorydiscount_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('localisation/categorydiscount', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('localisation/categorydiscount', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

	        $data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
//print_r($data);exit;
		$this->response->setOutput($this->load->view('localisation/categorydiscount_list.tpl', $data));
	}

	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');

		$data['entry_category'] = $this->language->get('entry_category');
		$data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$data['entry_percentage'] = $this->language->get('entry_percentage');
		$data['entry_date_start'] = $this->language->get('entry_date_start');
		$data['entry_date_end'] = $this->language->get('entry_date_end');
		$data['entry_status'] = $this->language->get('entry_status');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['category'])) {
			$data['error_category'] = $this->error['category'];
		} else {
			$data['error_category'] = '';
		}
		
		if (isset($this->error['customer_group'])) {
			$data['error_customer_group'] = $this->error['customer_group'];
		} else {
			$data['error_customer_group'] = '';
		}
		
		if (isset($this->error['percentage'])) {
			$data['error_percentage'] = $this->error['percentage'];
		} else {
			$data['error_percentage'] = '';
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
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL')
			
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('localisation/categorydiscount', 'token=' . $this->session->data['token'] . $url, 'SSL')
			
		);

		if (!isset($this->request->get['category_discount_id'])) { 
			$data['action'] = $this->url->link('localisation/categorydiscount/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {  //echo $this->request->get['category_discount_id']."hai";exit;
			$data['action'] = $this->url->link('localisation/categorydiscount/update', 'token=' . $this->session->data['token'] . '&category_discount_id=' . $this->request->get['category_discount_id'] . $url, 'SSL');
		}	

		$data['cancel'] = $this->url->link('localisation/categorydiscount', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['category_discount_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$category_discount_info = $this->model_localisation_categorydiscount->getCategoryDiscount($this->request->get['category_discount_id']);
		}
		
//print_r($category_discount_info);

		// Categories
		$this->load->model('catalog/category');
			
		if (isset($this->request->post['category_id'])) {
			$data['category_id'] = $this->request->post['category_id'];
		} elseif (!empty($category_discount_info)) {
			$data['category_id'] = $category_discount_info['category_id'];
		} else {
			$data['category_id'] = '';
		}
		
		$data['categories'] = array();
		
		$data['categories'] = $this->model_catalog_category->getCategories(array());					
//echo $data['category_id'];
		$category_info = $this->model_catalog_category->getCategory($data['category_id']);
		//print_r($category_info);
		$data['category_name'] = "";
		
		if ($category_info) {
			
			$data['category_name'] = ($category_info['path'] ? $category_info['path'] . ' &gt; ' : '') . $category_info['name'];	

                        //$data['category_id1']	=$data['category_id'];	
echo $data['category_id'] ;
			$data['categories'][] = $category_info;
			//print_r($data['categories']);
		}
		
	//Customer Group
		$this->load->model('sale/customer_group');

		$data['customer_groups'] = $this->model_sale_customer_group->getCustomerGroups();

		if (isset($this->request->post['customer_group_id'])) {
			$data['customer_group_id'] = $this->request->post['customer_group_id'];
		} elseif (!empty($customer_info)) {
			$data['customer_group_id'] = $customer_info['customer_group_id'];
		} else {
			$data['customer_group_id'] = $this->config->get('config_customer_group_id');
		}
	
//echo $this->request->post['percentage'];exit;
		if (isset($this->request->post['percentage'])) {
			$data['percentage'] = $this->request->post['percentage'];
		} elseif (!empty($category_discount_info)) {
			$data['percentage'] = $category_discount_info['percentage'];
		} else {
			$data['percentage'] = '';
		}

	

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($category_discount_info)) {
			$data['status'] = $category_discount_info['status'];
		} else {
			$data['status'] = '1';
		}
		$data['token'] = $this->session->data['token'];

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
//print_r($data);
		$this->response->setOutput($this->load->view('localisation/categorydiscount_form.tpl', $data));

	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'localisation/categorydiscount')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if(!isset($this->request->post['category_id'])){
			$this->error['category'] = $this->language->get('error_category');			
		}
		else if ($this->request->post['category_id'] == '') {
			$this->error['category'] = $this->language->get('error_category');
		}
		
		if ($this->request->post['percentage'] == '') {
			$this->error['percentage'] = $this->language->get('error_percentage');
		}
		
		if ($this->request->post['customer_group_id'] == '' || $this->request->post['customer_group_id'] == 0) {
			$this->error['customer_group'] = $this->language->get('error_customer_group');
		}
		

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'localisation/categorydiscount')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}


	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name'])) {
			$this->load->model('catalog/category');

			$filter_data = array(
				'filter_name' => $this->request->get['filter_name'],
				'sort'        => 'name',
				'order'       => 'ASC',
				'start'       => 0,
				'limit'       => 5
			);

			$results = $this->model_catalog_category->getCategories($filter_data);

			foreach ($results as $result) {
				$json[] = array(
					'category_id' => $result['category_id'],
					'name'        => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
				);
			}
		}

		$sort_order = array();

		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['name'];
		}

		array_multisort($sort_order, SORT_ASC, $json);

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}


}
?>
