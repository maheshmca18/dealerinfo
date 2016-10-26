<?php
class ControllerModuleAdvanceFilter extends Controller {
	private $error = array();
       
  	public function index() {
		$this->language->load('module/advancefilter');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('setting/setting');
		$this->load->model('extension/advancefilter');
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
					$this->model_setting_setting->editSetting('advance', $this->request->post);
					$this->session->data['success'] = $this->language->get('text_success');
					$this->response->redirect($this->url->link('module/advancefilter', 'token=' . $this->session->data['token'], 'SSL'));
			}
		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_module'] = $this->language->get('text_module');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
		 $data['entry_theme'] = $this->language->get('entry_theme');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_brandstatus'] = $this->language->get('entry_brandstatus');
		$data['entry_pricestatus'] = $this->language->get('entry_pricestatus');
		$data['entry_optionstatus'] = $this->language->get('entry_optionstatus');
		$data['entry_attributestatus'] = $this->language->get('entry_attributestatus');
		$data['entry_customerstatus'] = $this->language->get('entry_customerstatus');
		$data['entry_discountstatus'] = $this->language->get('entry_discountstatus');
		$data['entry_avilablitystatus'] = $this->language->get('entry_avilablitystatus');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
        $data['token'] = $this->session->data['token'];
 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		if (isset($this->request->post['advance_colorpic'])) {
            $data['colorpic'] = $this->request->post['advance_colorpic'];
        } else {
            $data['colorpic'] = $this->config->get('advance_colorpic');
        }
 		if (isset($this->request->post['advance_status'])) {
            $data['advance_status'] = $this->request->post['advance_status'];

        } else {
            $data['advance_status'] = $this->config->get('advance_status');
        }
		if (isset($this->request->post['advance_brand_status'])) {
			$data['advance_brand_status'] = $this->request->post['advance_brand_status'];

		} else {
			$data['advance_brand_status'] = $this->config->get('advance_brand_status');
		}
		if (isset($this->request->post['advance_price_status'])) {
			$data['advance_price_status'] = $this->request->post['advance_price_status'];

		} else {
			$data['advance_price_status'] = $this->config->get('advance_price_status');
		}
		if (isset($this->request->post['advance_option_status'])) {
			$data['advance_option_status'] = $this->request->post['advance_option_status'];

		} else {
			$data['advance_option_status'] = $this->config->get('advance_option_status');
		}
		if (isset($this->request->post['advance_attribute_status'])) {
			$data['advance_attribute_status'] = $this->request->post['advance_attribute_status'];

		} else {
			$data['advance_attribute_status'] = $this->config->get('advance_attribute_status');
		}
		if (isset($this->request->post['advance_crating_status'])) {
			$data['advance_crating_status'] = $this->request->post['advance_crating_status'];

		} else {
			$data['advance_crating_status'] = $this->config->get('advance_crating_status');
		}
		if (isset($this->request->post['advance_discount_status'])) {
			$data['advance_discount_status'] = $this->request->post['advance_discount_status'];

		} else {
			$data['advance_discount_status'] = $this->config->get('advance_discount_status');
		}
		if (isset($this->request->post['advance_availabile_status'])) {
			$data['advance_availabile_status'] = $this->request->post['advance_availabile_status'];

		} else {
			$data['advance_availabile_status'] = $this->config->get('advance_availabile_status');
		}
		if (isset($this->request->post['advance_filterattributevalue'])) {
			$data['advance_filterattributevalue'] = $this->request->post['advance_filterattributevalue'];

		} else {
			$data['advance_filterattributevalue'] = $this->config->get('advance_filterattributevalue');
		}
		if (isset($this->request->post['advance_filteroptionvalue'])) {
			$data['advance_filteroptionvalue'] = $this->request->post['advance_filteroptionvalue'];

		} else {
			$data['advance_filteroptionvalue'] = $this->config->get('advance_filteroptionvalue');
		}
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);
		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
			);
		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/advancefilter', 'token=' . $this->session->data['token'], 'SSL'),
			);
		$data['action'] = $this->url->link('module/advancefilter', 'token=' . $this->session->data['token'], 'SSL');
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		$optiondetails=$this->model_extension_advancefilter->getProductOptions();
		$data['optiondetails']=$optiondetails;
		$category=$this->model_extension_advancefilter->getCategory();
		$data['category']=$category;
		$attribute=$this->model_extension_advancefilter->getAttribute();
		$data['attribute']=$attribute;
		$categorysetting=$this->model_extension_advancefilter->getfilter();
		if(!empty($categorysetting)) {
			$data['categorysetting'] = $categorysetting;
		} else{
			$data['categorysetting'] ='';
		}
		$this->template = 'module/advancefilter.tpl';
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/advancefilter.tpl', $data));
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/advancefilter')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		if($this->request->post['advance_attribute_status'] == 1) {
			if (!isset($this->request->post['advance_filterattributevalue'])) {
				$this->error['warning'] = "please select";
			}
		} //
		if($this->request->post['advance_option_status'] == 1) {
			if (!isset($this->request->post['advance_filteroptionvalue'])) {
				$this->error['warning'] = "please select ";
			}
		}
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
    public function install() {
		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "advance_filter` (
             `af_id` int(10)  unsigned NOT NULL AUTO_INCREMENT,
 			 `af_categoryid` varchar(255) NOT NULL,
 			 `af_optionid` varchar(255) NOT NULL,
 			 `af_attributeid` varchar(255) NOT NULL,
  		      PRIMARY KEY (`af_id`)
                        )");
 		$this->load->model('setting/setting');
		$color="#FAEAC6";
		$dbdate=array('advance_colorpic'=>$color);
		$this->model_setting_setting->editSetting('advance', $dbdate);
    }
    public function uninstall() {
		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "advance_filter`");
        $this->load->model('setting/setting');
        $this->model_setting_setting->deleteSetting('advance');
    }
	public function add() {
		$this->load->model('extension/advancefilter');
		$data=$this->model_extension_advancefilter->add($this->request->post);
		$this->response->setOutput(json_encode($data));
	}
	public function delete() {
		$this->load->model('extension/advancefilter');
		$data=$this->model_extension_advancefilter->delete($this->request->post);
		$this->response->setOutput(json_encode($data));
	}
	public function edit() {
		$this->load->model('extension/advancefilter');
		$data=$this->model_extension_advancefilter->editgetvalue($this->request->post);
		$this->response->setOutput(json_encode($data));
	}
	public function editcancel() {
		$this->load->model('extension/advancefilter');
		$data=$this->model_extension_advancefilter->editcancel($this->request->post);
		$this->response->setOutput(json_encode($data));
	}
	public function update() {
		$this->load->model('extension/advancefilter');
		$data=$this->model_extension_advancefilter->update($this->request->post);
		$this->response->setOutput(json_encode($data));
	}
	public function autosearch() {
		$this->load->model('extension/advancefilter');
		$data=$this->model_extension_advancefilter->autosearch($this->request->post);
		$this->response->setOutput(json_encode($data));
	}
    
}
?>
