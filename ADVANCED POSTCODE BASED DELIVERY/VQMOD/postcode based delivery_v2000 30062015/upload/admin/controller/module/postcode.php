<?php
class ControllerModulePostcode extends Controller {
	private $error = array();
	
	public function index() {

		$this->load->language('module/postcode');

		$this->document->setTitle($this->language->get('heading_title'));	
		
        //$this->load->model('extension/extension');

        $this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

            $setting_array = array();
            $setting_array['postcode_name'] = $this->request->post['name'];
            $setting_array['postcode_theme_color'] = $this->request->post['theme_color'];
            $setting_array['postcode_header_text_color'] = $this->request->post['header_text_color'];
            $setting_array['postcode_error_text_color'] = $this->request->post['error_text_color'];
            $setting_array['postcode_success_text_color'] = $this->request->post['success_text_color'];
            $setting_array['postcode_header_font_size'] = $this->request->post['header_font_size'];
            $setting_array['postcode_height'] = $this->request->post['height'];
            $setting_array['postcode_status'] = $this->request->post['status'];

            $this->model_setting_setting->editSetting('postcode', $setting_array);

           /* if (!isset($this->request->get['module_id'])) {
                echo "dd";break;
                $this->model_extension_module->addModule('postcode', $this->request->post);
            } else {
                $this->model_extension_module->editModule($this->request->get['module_id'], $this->request->post);
            }*/

			$this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');
		
		
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_content_top'] = $this->language->get('text_content_top');
		$data['text_content_bottom'] = $this->language->get('text_content_bottom');		
		$data['text_column_left'] = $this->language->get('text_column_left');
		$data['text_column_right'] = $this->language->get('text_column_right');
		
		$data['entry_layout'] = $this->language->get('entry_layout');
		$data['entry_position'] = $this->language->get('entry_position');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_add_module'] = $this->language->get('button_add_module');
		$data['button_remove'] = $this->language->get('button_remove');

        $data['entry_name'] = $this->language->get('entry_name');
        $data['text_edit'] = $this->language->get('text_edit');
        $data['entry_product'] = $this->language->get('entry_product');
        $data['entry_height'] = $this->language->get('entry_height');
        $data['entry_status'] = $this->language->get('entry_status');

        $data['entry_theme_color'] = $this->language->get('Select Theme Color');
        $data['entry_header_text_color'] = $this->language->get('Select Header Text Color');
        $data['entry_error_text_color'] = $this->language->get('Select Error Text Color');
        $data['entry_success_text_color'] = $this->language->get('Select Success Text Color');
        $data['entry_header_font_size'] = $this->language->get('Enter Header Font Size');



        $data['help_product'] = $this->language->get('help_product');

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

        if (isset($this->error['layout'])) {
            $data['error_layout'] = $this->error['layout'];
        } else {
            $data['error_layout'] = '';
        }

        if (isset($this->error['height'])) {
            $data['error_height'] = $this->error['height'];
        } else {
            $data['error_height'] = '';
        }


  		$data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_module'),
            'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
        );


        if (!isset($this->request->get['module_id'])) {
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link('module/postcode', 'token=' . $this->session->data['token'], 'SSL')
            );
        } else {
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link('module/postcode', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL')
            );
        }

        if (!isset($this->request->get['module_id'])) {
            $data['action'] = $this->url->link('module/postcode', 'token=' . $this->session->data['token'], 'SSL');
        } else {
            $data['action'] = $this->url->link('module/postcode', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL');
        }

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

/*        if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $module_info = $this->model_extension_module->getModule($this->request->get['module_id']);
        }*/

        /*if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $setting_info = $this->model_setting_setting->getSetting('postcode');
        }*/

        $setting_info = $this->model_setting_setting->getSetting('postcode');

        $data['token'] = $this->session->data['token'];

        /*if (isset($this->request->post['name'])) {
            $data['name'] = $this->request->post['name'];
        } elseif (!empty($module_info)) {
            $data['name'] = $module_info['name'];
        } else {
            $data['name'] = '';
        }*/

        if (isset($this->request->post['name'])) {
            $data['name'] = $this->request->post['name'];
        } elseif (!empty($setting_info)) {
            $data['name'] = $setting_info['postcode_name'];
        } else {
            $data['name'] = '';
        }

        if (isset($this->request->post['postcode_theme_color'])) {
            $data['postcode_theme_color'] = $this->request->post['postcode_theme_color'];
        } elseif (!empty($setting_info)) {
            $data['postcode_theme_color'] = $setting_info['postcode_theme_color'];
        } else {
            $data['postcode_theme_color'] = '';
        }

        /*if (isset($this->request->post['postcode_theme_color'])){
            $data['postcode_theme_color'] = $this->request->post['postcode_theme_color'];
        } elseif ($this->config->has('postcode')) {
            $data['postcode_theme_color'] = $this->config->get('carousel_module');
        } else {
            $modules = array();
        }*/


        if (isset($this->request->post['postcode_header_text_color'])) {
            $data['postcode_header_text_color'] = $this->request->post['postcode_header_text_color'];
        } elseif (!empty($setting_info)) {
            $data['postcode_header_text_color'] = $setting_info['postcode_header_text_color'];
        } else {
            $data['postcode_header_text_color'] = '';
        }

        if (isset($this->request->post['postcode_error_text_color'])) {
            $data['postcode_error_text_color'] = $this->request->post['postcode_error_text_color'];
        } elseif (!empty($setting_info)) {
            $data['postcode_error_text_color'] = $setting_info['postcode_error_text_color'];
        } else {
            $data['postcode_error_text_color'] = '';
        }

        if (isset($this->request->post['postcode_success_text_color'])) {
            $data['postcode_success_text_color'] = $this->request->post['postcode_success_text_color'];
        } elseif (!empty($setting_info)) {
            $data['postcode_success_text_color'] = $setting_info['postcode_success_text_color'];
        } else {
            $data['postcode_success_text_color'] = '';
        }

        if (isset($this->request->post['postcode_header_font_size'])) {
            $data['postcode_header_font_size'] = $this->request->post['postcode_header_font_size'];
        } elseif (!empty($setting_info)) {
            $data['postcode_header_font_size'] = $setting_info['postcode_header_font_size'];
        } else {
            $data['postcode_header_font_size'] = 20;
        }


	//	$this->load->model('module/postcode');
		
		$data['modules'] = array();

        if (isset($this->request->post['height'])) {
            $data['height'] = $this->request->post['height'];
        }else {
            $data['height'] = 150;
        }

        //print_r($this->request->post);break;

        if (isset($this->request->post['status'])) {
            $data['status'] = $this->request->post['status'];
        }elseif (!empty($setting_info)) {
            $data['status'] = $setting_info['postcode_status'];
        } else {
            $data['status'] = '';
        }


		if (isset($this->request->post['postcode_module'])) {
			$data['modules'] = $this->request->post['postcode_module'];
		} elseif ($this->config->get('postcode_module')) { 
			$data['modules'] = $this->config->get('postcode_module');
		}


		$this->load->model('design/layout');

		$data['layouts'] = $this->model_design_layout->getLayouts();

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');


		$this->response->setOutput($this->load->view('module/postcode.tpl',$data));

	}
	
	private function validate() {

        if (!$this->user->hasPermission('modify', 'module/postcode')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
            $this->error['name'] = $this->language->get('error_name');
        }

        return !$this->error;
	}
	
	public function install() {
		$this->db->query("CREATE TABLE  " . DB_PREFIX . "postcode_delivery (
  postcode_id int(11) NOT NULL AUTO_INCREMENT,
  postcode varchar(15) NOT NULL,
  min_shipping varchar(20) NOT NULL DEFAULT '300',
  status enum('1','0') DEFAULT '1',
  PRIMARY KEY (postcode_id)
)");	

	}
	
	public function uninstall() {
		$this->db->query("DROP TABLE IF EXISTS " . DB_PREFIX . "postcode_delivery");
	}
}
?>
