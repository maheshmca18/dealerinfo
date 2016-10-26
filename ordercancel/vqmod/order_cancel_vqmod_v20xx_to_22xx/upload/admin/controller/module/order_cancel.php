<?php
class ControllerModuleOrderCancel extends Controller {
	private $error = array();
    public function index() {
		$this->language->load('module/order_cancel');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

  
			$this->model_setting_setting->editSetting('ordercancel', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');


			$this->response->redirect($this->url->link('module/order_cancel', 'token=' . $this->session->data['token'], 'SSL'));

		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_module'] = $this->language->get('text_module');
		//$data['text_help'] = $this->language->get('text_help');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_returndate'] = $this->language->get('entry_returndate');
		$data['entry_cancel'] = $this->language->get('entry_cancel');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_adminmessagecontent'] = $this->language->get('entry_adminmessagecontent');
        $data['entry_usermessagecontent'] = $this->language->get('entry_usermessagecontent');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		
		//for add reason
		$data['action_heading__title'] = $this->language->get('action_heading__title');
		$data['entry_tab_reason'] = $this->language->get('entry_tab_reason');
		$data['entry_reason'] = $this->language->get('entry_reason');
		$data['entry_sort'] = $this->language->get('entry_sort');
		$data['entry_action'] = $this->language->get('entry_action');
		$data['entry_choose_reason'] = $this->language->get('entry_choose_reason');
		$data['entry_tab_setting'] = $this->language->get('entry_tab_setting');
		$data['entry_tab_return'] = $this->language->get('entry_tab_return');
		$data['entry_btn_remove'] = $this->language->get('entry_btn_remove');
		$data['entry_btn_add'] = $this->language->get('entry_btn_add');
		$data['entry_returnadminmessagecontent']= $this->language->get('entry_returnadminmessagecontent');
		$data['entry_returnusermessagecontent']= $this->language->get('entry_returnusermessagecontent');
		//for admin and customer return and cancel subjec
		
		$data['entryreturn_customersubject'] = $this->language->get('entryreturn_customersubject');
		$data['entryreturn_adminsubject']    = $this->language->get('entryreturn_adminsubject');
		$data['entrycancel_customersubject'] = $this->language->get('entrycancel_customersubject');
		$data['entrycancel_adminsubject']    = $this->language->get('entrycancel_adminsubject');

		
        $data['token'] = $this->session->data['token'];

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
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
			//'separator' => ' :: '
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/order_cancel', 'token=' . $this->session->data['token'], 'SSL'),
			//'separator' => ' :: '
		);

		$data['action'] = $this->url->link('module/order_cancel', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['ordercancel_returndate'])) {
			$data['ordercancel_returndate'] = $this->request->post['ordercancel_returndate'];
		} else {
			$data['ordercancel_returndate'] = $this->config->get('ordercancel_returndate');
		}

		if (isset($this->request->post['ordercancel_cancel'])) {
			$data['ordercancel_cancel'] = $this->request->post['ordercancel_cancel'];
		} else {
			$data['ordercancel_cancel'] = $this->config->get('ordercancel_cancel');
		}

        if (isset($this->request->post['ordercancel_adminmessagecontent'])) {
            $data['ordercancel_adminmessagecontent'] = $this->request->post['ordercancel_adminmessagecontent'];
        } else {
            $data['ordercancel_adminmessagecontent'] = $this->config->get('ordercancel_adminmessagecontent');
        }

        if (isset($this->request->post['ordercancel_usermessagecontent'])) {
            $data['ordercancel_usermessagecontent'] = $this->request->post['ordercancel_usermessagecontent'];
        } else {
            $data['ordercancel_usermessagecontent'] = $this->config->get('ordercancel_usermessagecontent');
        }
		
		if (isset($this->request->post['ordercancel_returnadminmessagecontent'])) {
            $data['ordercancel_returnadminmessagecontent'] = $this->request->post['ordercancel_returnadminmessagecontent'];
        } else {
            $data['ordercancel_returnadminmessagecontent'] = $this->config->get('ordercancel_returnadminmessagecontent');
        }

        if (isset($this->request->post['ordercancel_returnusermessagecontent'])) {
            $data['ordercancel_returnusermessagecontent'] = $this->request->post['ordercancel_usermessagecontent'];
        } else {
            $data['ordercancel_returnusermessagecontent'] = $this->config->get('ordercancel_returnusermessagecontent');
        }

        if (isset($this->request->post['ordercancel_status'])) {
            $data['ordercancel_status'] = $this->request->post['ordercancel_status'];

        } else {
            $data['ordercancel_status'] = $this->config->get('ordercancel_status');
        }

		if (isset($this->request->post['ordercancel_returnadminmessagecontent'])) {
			$data['ordercancel_returnadminmessagecontent'] = $this->request->post['ordercancel_returnadminmessagecontent'];
		} else {
			$data['ordercancel_returnadminmessagecontent'] = $this->config->get('ordercancel_returnadminmessagecontent');
		}
		
		//for cancel admin and customer subject
		if (isset($this->request->post['ordercancel_customersubject'])) {
			$data['ordercancel_customersubject'] = $this->request->post['ordercancel_customersubject'];
		} else {
			$data['ordercancel_customersubject'] = $this->config->get('ordercancel_customersubject');
		}
		if (isset($this->request->post['ordercancel_adminsubject'])) {
			$data['ordercancel_adminsubject'] = $this->request->post['ordercancel_adminsubject'];
		} else {
			$data['ordercancel_adminsubject'] = $this->config->get('ordercancel_adminsubject');
		}
		
		//for return admin and customer subject
		if (isset($this->request->post['ordercancel_returnadminsubject'])) {
			$data['orderreturn_adminsubject'] = $this->request->post['ordercancel_returnadminsubject'];
		} else {
			$data['orderreturn_adminsubject'] = $this->config->get('ordercancel_returnadminsubject');
		}

		if (isset($this->request->post['ordercancel_returncustomersubject'])) {
			$data['orderreturn_customersubject'] = $this->request->post['ordercancel_returncustomersubject'];
		} else {
			$data['orderreturn_customersubject'] = $this->config->get('ordercancel_returncustomersubject');
		}
		
		// add reason
       $this->load->model('extension/order_cancel');

        $data['cancel_reason'] = $this->model_extension_order_cancel->getordercancelreason();

		//$data['enable_customer'] = $this->model_extension_order_cancel->enableCustomerOrderCancellations();

        

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('module/order_cancel.tpl', $data));
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/order_cancel')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
	
	// to install
	public function install() 
		{
			//cancel_order table create
			$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "cancel_order` (
									  `cancel_description_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
									  `cance_description` varchar(255) NOT NULL,
									  `sort` int(10) NOT NULL,
									  PRIMARY KEY (`cancel_description_id`)
									)");
			$this->load->model('setting/setting');
			$date = strtotime("+1 day", strtotime(date("Y-m-d")));
			$datecronchange= date("Y-m-d", $date);
			$dbdate=array('crondatevalue'=>$datecronchange);
			$this->model_setting_setting->editSetting('crondate', $dbdate);
		}
	// for uninstall
	public function uninstall() {
		$this->load->model('setting/setting');
        $this->model_setting_setting->deleteSetting('ordercancel');
        //cancel_order table delete

		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "cancel_order`");
		
	}
	//for inserting new reason
	public function order_cancel_action() {
		//insert query function here
		if($_POST['action']=='insert') {
			$reason_name=$_POST['reason_name'];
			$sort=$_POST['sort'];
			$this->load->model('extension/order_cancel');
			$data = $this->model_extension_order_cancel->insertordercancelreason($reason_name,$sort);
			$this->response->setOutput(json_encode($data));
		}
		//delete query function here
		if($_POST['action']=='delete') {
			$reason_id=$_POST['reason_id'];
			$this->load->model('catalog/product');
			$this->load->model('extension/order_cancel');
			$data = $this->model_extension_order_cancel->deleteordercancelreason($reason_id);
			$this->response->setOutput(json_encode($data));
		}
	}

}
?>
