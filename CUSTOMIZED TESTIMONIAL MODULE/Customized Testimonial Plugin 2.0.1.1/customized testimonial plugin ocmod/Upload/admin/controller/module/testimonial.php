<?php
class ControllerModuleTestimonial extends Controller {
	private $error = array(); 
	
	public function index() {
	   
		$this->load->language('module/testimonial');

		$this->document->setTitle($this->language->get('heading_title'));
			
		$this->load->model('extension/module');
		
		$this->load->model('setting/setting');
		$this->load->model('module/testimonial');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			if (!isset($this->request->get['module_id'])) {
				$this->model_extension_module->addModule('testimonial', $this->request->post);
			} else {
				$this->model_extension_module->editModule($this->request->get['module_id'], $this->request->post);
			}
			$this->model_setting_setting->editSetting('testimonial', $this->request->post);
            
			$this->model_module_testimonial->editTestimonialCustom($this->request->post);
            		
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
				
		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['entry_height'] = $this->language->get('entry_height');
		$data['entry_name'] = $this->language->get('Name');
		$data['entry_name'] = $this->language->get('Name');
		$data['error_name'] = $this->language->get('Name must be 3 to 32 characters ');
		$data['button_save'] = $this->language->get('Save');
		$data['button_cancel'] = $this->language->get('Cancel');
		$data['text_form'] = "Add Testimonial";
       	$data['entry_customer'] = "Customer Id";
        $data['entry_added_on'] = "Added on";
		$data['entry_status'] = "Status";
		$data['text_edit'] = $this->language->get('Testimonial Edit');
		$data['entry_bgcolor'] = $this->language->get('entry_bgcolor');
		$data['entry_textcolor'] = $this->language->get('entry_textcolor');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_content_top'] = $this->language->get('text_content_top');
		$data['text_content_bottom'] = $this->language->get('text_content_bottom');
		$data['text_column_left'] = $this->language->get('text_column_left');
		$data['text_column_right'] = $this->language->get('text_column_right');
		$data['entry_height'] = $this->language->get('entry_height');
		$data['error_height'] = $this->language->get('error_height');
		$data['entry_layout'] = $this->language->get('entry_layout');
		$data['entry_position'] = $this->language->get('entry_position');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		
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

		if (isset($this->error['height'])) {
			$data['error_height'] = $this->error['height'];
		} else {
			$data['error_height'] = '';
		}
		
  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
   		);
		
   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/testimonial', 'token=' . $this->session->data['token'], 'SSL')
   		);
		
		if (!isset($this->request->get['module_id'])) {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('module/testimonial', 'token=' . $this->session->data['token'], 'SSL')
			);
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('module/testimonial', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL')
			);			
		}

		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('module/testimonial', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$data['action'] = $this->url->link('module/testimonial', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL');
		}

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_extension_module->getModule($this->request->get['module_id']);
		}
		
		$data['custom_settings']=array();
		
		$this->load->model('module/testimonial');
				
		$data['custom_settings']=$this->model_module_testimonial->getTestimonialCustom();

		$data['modules'] = array();
		
		if (isset($this->request->post['testimonial_module'])) {
			$data['modules'] = $this->request->post['testimonial_module'];
		} elseif ($this->config->get('testimonial_module')) { 
			$data['modules'] = $this->config->get('testimonial_module');
		}
		
		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($module_info)) {
			$data['name'] = $module_info['name'];
		} else {
			$data['name'] = '';
		}
		
		$this->load->model('design/banner');

		$data['banners'] = $this->model_design_banner->getBanners();

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($module_info)) {
			$data['status'] = $module_info['status'];
		} else {
			$data['status'] = '';
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('module/testimonial.tpl', $data));
		
	}

		protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'module/testimonial')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 32)) {
			$this->error['name'] ="Name must be 3 to 32 characters ";
		}
		return !$this->error;
	}


	
	public function install() {
		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "testimonial` (
                          `testimonial_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                          `name` varchar(45) NOT NULL,
                          `data` text NOT NULL,
                          `customer_id` int(10) unsigned NOT NULL,
                          `added_on` datetime NOT NULL,
                          `approved_on` datetime NOT NULL,
                          `status` int(10) unsigned NOT NULL COMMENT '0 -  deactive, 1 - Approve, 2 - Disapprove',
                          PRIMARY KEY (`testimonial_id`)
                        )");	

    /* Testimonial Setting */
    $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "testimonial_setting` (
                      `testimonial_setting_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                      `testimonial_label` varchar(255) NOT NULL,
                      `testimonial_key` varchar(45) NOT NULL,
                      `testimonial_value` varchar(45) NOT NULL,
                      PRIMARY KEY (`testimonial_setting_id`)
                    ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8");
              
    /* Testimonial Setting */	

	$this->db->query("INSERT INTO `" . DB_PREFIX . "testimonial_setting` (`testimonial_setting_id`, `testimonial_label`, `testimonial_key`, `testimonial_value`) VALUES
                    (1, 'Background Color', 'bgcolor', ''),
                    (2, 'Content Text Color', 'textcolor', ''),
                    (3, 'Heding Text Color', 'headtextcolor', ''),
                    (4, 'Heding Background Color', 'headbgcolor', ''),
                    (5, 'Name Text Color', 'nametextcolor', ''),
                    (6, 'ViewAll Button Text Color', 'viewalltextcolor', ''),
                    (7, 'ViewAll Button Background Color', 'viewallbgcolor', ''),
                    (8, 'Character Limit for Testimonial', 'limitchar', ''),
                    (9, 'Widget Height (pixel)', 'widgetheight', '')");	
	}
	
	public function uninstall() {
		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "testimonial`");
		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "testimonial_setting`");
	}
}
?>