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

			$this->redirect($this->url->link('localisation/categorydiscount', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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

			$this->redirect($this->url->link('localisation/categorydiscount', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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

			$this->redirect($this->url->link('localisation/categorydiscount', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('localisation/categorydiscount', 'token=' . $this->session->data['token'] . $url, 'SSL'),
			'separator' => ' :: '
		);

		$this->data['insert'] = $this->url->link('localisation/categorydiscount/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['delete'] = $this->url->link('localisation/categorydiscount/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$this->data['categorydiscounts'] = array();

		$data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit' => $this->config->get('config_admin_limit')
		);
		
		$categorydiscount_total = $this->model_localisation_categorydiscount->getTotalCategoryDiscounts();

		$results = $this->model_localisation_categorydiscount->getCategoryDiscounts($data);

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
				
		
			$this->data['categorydiscounts'][] = array(
				'category_discount_id' => $result['category_discount_id'],
				'category_id'       => $category_name,//$result['category_id'],
				'customer_group_id' => $customer_group_name,//$result['customer_group_id'],
				'percentage' => $result['percentage'],
				//'date_start'   => $result['date_start'],
				//'date_end'   => $result['date_end'],
				'status'   => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),//$result['status'],
				'selected'   => isset($this->request->post['selected']) && in_array($result['category_discount_id'], $this->request->post['selected']),				
				'action'     => $action
			);
		}

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_no_results'] = $this->language->get('text_no_results');

		$this->data['column_category'] = $this->language->get('column_category');
		$this->data['column_customer_group'] = $this->language->get('column_customer_group');
		$this->data['column_percentage'] = $this->language->get('column_percentage');
		$this->data['column_date_start'] = $this->language->get('column_date_start');
		$this->data['column_date_end'] = $this->language->get('column_date_end');
		$this->data['column_status'] = $this->language->get('column_status');
		$this->data['column_action'] = $this->language->get('column_action');	

		$this->data['button_insert'] = $this->language->get('button_insert');
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

		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$this->data['sort_name'] = $this->url->link('localisation/categorydiscount', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
		$this->data['sort_iso_code_2'] = $this->url->link('localisation/categorydiscount', 'token=' . $this->session->data['token'] . '&sort=iso_code_2' . $url, 'SSL');
		$this->data['sort_iso_code_3'] = $this->url->link('localisation/categorydiscount', 'token=' . $this->session->data['token'] . '&sort=iso_code_3' . $url, 'SSL');

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

		$this->data['pagination'] = $pagination->render();

		$this->data['sort'] = $sort;
		$this->data['order'] = $order;

		$this->template = 'localisation/categorydiscount_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}

	protected function getForm() {
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');

		$this->data['entry_category'] = $this->language->get('entry_category');
		$this->data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$this->data['entry_percentage'] = $this->language->get('entry_percentage');
		$this->data['entry_date_start'] = $this->language->get('entry_date_start');
		$this->data['entry_date_end'] = $this->language->get('entry_date_end');
		$this->data['entry_status'] = $this->language->get('entry_status');

		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->error['category'])) {
			$this->data['error_category'] = $this->error['category'];
		} else {
			$this->data['error_category'] = '';
		}
		
		if (isset($this->error['customer_group'])) {
			$this->data['error_customer_group'] = $this->error['customer_group'];
		} else {
			$this->data['error_customer_group'] = '';
		}
		
		if (isset($this->error['percentage'])) {
			$this->data['error_percentage'] = $this->error['percentage'];
		} else {
			$this->data['error_percentage'] = '';
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
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('localisation/categorydiscount', 'token=' . $this->session->data['token'] . $url, 'SSL'),
			'separator' => ' :: '
		);

		if (!isset($this->request->get['category_discount_id'])) { 
			$this->data['action'] = $this->url->link('localisation/categorydiscount/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('localisation/categorydiscount/update', 'token=' . $this->session->data['token'] . '&category_discount_id=' . $this->request->get['category_discount_id'] . $url, 'SSL');
		}	

		$this->data['cancel'] = $this->url->link('localisation/categorydiscount', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['category_discount_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$category_discount_info = $this->model_localisation_categorydiscount->getCategoryDiscount($this->request->get['category_discount_id']);
		}
		


		// Categories
		$this->load->model('catalog/category');
			
		if (isset($this->request->post['category_id'])) {
			$this->data['category_id'] = $this->request->post['category_id'];
		} elseif (!empty($category_discount_info)) {
			$this->data['category_id'] = $category_discount_info['category_id'];
		} else {
			$this->data['category_id'] = '';
		}
		
		$this->data['categories'] = array();
		
		//$this->data['categories'] = $this->model_catalog_category->getCategories(array());					

		$category_info = $this->model_catalog_category->getCategory($this->data['category_id']);
				
		$this->data['category_name'] = "";
		
		if ($category_info) {
			
			$this->data['category_name'] = ($category_info['path'] ? $category_info['path'] . ' &gt; ' : '') . $category_info['name'];			
			
			$this->data['categories'][] = $category_info;
			
		}
		
/*
		if (isset($this->request->post['category'])) {
			$this->data['category'] = $this->request->post['category'];
		} elseif (!empty($category_discount_info)) {
			$this->data['category'] = $category_discount_info['category'];
		} else {
			$this->data['category'] = '';
		}
*/
		//Customer Group
		$this->load->model('sale/customer_group');

		$this->data['customer_groups'] = $this->model_sale_customer_group->getCustomerGroups();

		if (isset($this->request->post['customer_group_id'])) {
			$this->data['customer_group_id'] = $this->request->post['customer_group_id'];
		} elseif (!empty($customer_info)) {
			$this->data['customer_group_id'] = $customer_info['customer_group_id'];
		} else {
			$this->data['customer_group_id'] = $this->config->get('config_customer_group_id');
		}
		
		/*
		if (isset($this->request->post['customer_group'])) {
			$this->data['customer_group'] = $this->request->post['customer_group'];
		} elseif (!empty($category_discount_info)) {
			$this->data['customer_group'] = $category_discount_info['customer_group'];
		} else {
			$this->data['customer_group'] = '';
		}
		*/

		if (isset($this->request->post['percentage'])) {
			$this->data['percentage'] = $this->request->post['percentage'];
		} elseif (!empty($category_discount_info)) {
			$this->data['percentage'] = $category_discount_info['percentage'];
		} else {
			$this->data['percentage'] = '';
		}

		/*if (isset($this->request->post['date_start'])) {
			$this->data['date_start'] = $this->request->post['date_start'];
		} elseif (!empty($category_discount_info)) {
			$this->data['date_start'] = $category_discount_info['date_start'];
		} else {
			$this->data['date_start'] = '';
		}

		if (isset($this->request->post['date_end'])) {
			$this->data['date_end'] = $this->request->post['date_end'];
		} elseif (!empty($category_discount_info)) {
			$this->data['date_end'] = $category_discount_info['date_end'];
		} else {
			$this->data['date_end'] = '';
		}*/

		if (isset($this->request->post['status'])) {
			$this->data['status'] = $this->request->post['status'];
		} elseif (!empty($category_discount_info)) {
			$this->data['status'] = $category_discount_info['status'];
		} else {
			$this->data['status'] = '1';
		}
		$this->data['token'] = $this->session->data['token'];
		$this->template = 'localisation/categorydiscount_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
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
}
?>
