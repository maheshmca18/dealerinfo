<?php
class ControllerModuleBirthdaycalendermodule extends Controller {
	private $error = array();

	public function index()
    {


        $this->load->language('module/birthdaycalendermodule');

        $this->document->setTitle($this->language->get('heading_title'));

        /*$this->load->model('extension/module');
        $this->load->model('module/birthdaycalender');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {


            if ($this->request->post['id']=="") {
                $this->model_module_birthdaycalender->addProduct($this->request->post);
            } else {

                $this->model_module_birthdaycalender->editProduct($this->request->post);
            }

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';


            $this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }*/

        $data['heading_title'] = $this->language->get('heading_title');

       /* $data['tab_setting'] = $this->language->get('tab_setting');
        $data['tab_calender'] = $this->language->get('tab_calender');
        $data['tab_mail'] = $this->language->get('tab_mail');
        $data['entry_birthdayreminderstatus'] = $this->language->get('entry_birthdayreminderstatus');
        $data['entry_storestatus'] = $this->language->get('entry_storestatus');
        $data['entry_subject'] = $this->language->get('entry_subject');
        $data['entry_message'] = $this->language->get('entry_message');

        $data['text_edit'] = $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');

        $data['help_product'] = $this->language->get('help_product');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');


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
                'href' => $this->url->link('module/birthdaycalender', 'token=' . $this->session->data['token'], 'SSL')
            );
        } else {
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link('module/birthdaycalender', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL')
            );
        }

        if (!isset($this->request->get['module_id'])) {
            $data['action'] = $this->url->link('module/birthdaycalender', 'token=' . $this->session->data['token'], 'SSL');
        } else {
            $data['action'] = $this->url->link('module/birthdaycalender', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL');
        }

        $data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');


        $data['token'] = $this->session->data['token'];

        $this->load->model('module/birthdaycalender');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['subject'])) {
            $data['error_subject'] = $this->error['subject'];
        } else {
            $data['error_subject'] = '';
        }


        if (isset($this->error['message'])) {
            $data['error_message'] = $this->error['message'];
        } else {
            $data['error_message'] = '';
        }


        $product_info = $this->model_module_birthdaycalender->getProducts();



        if (isset($this->request->post['id'])) {
            $data['id'] = $this->request->post['id'];
        } elseif (!empty($product_info)) {
            $data['id'] = $product_info['br_id'];
        } else {
            $data['id'] = '';
        }

        if (isset($this->request->post['subject'])) {
            $data['subject'] = $this->request->post['subject'];
        } elseif (!empty($product_info)) {
            $data['subject'] = $product_info['br_subject'];
        } else {
            $data['subject'] = '';
        }

        if (isset($this->request->post['message'])) {
            $data['message'] = $this->request->post['message'];
        } elseif (!empty($product_info)) {
            $data['message'] = $product_info['br_message'];
        } else {
            $data['message'] = '';
        }

        $data['shopownername'] = $this->config->get('config_name');

        if (isset($this->request->post['birthstatus'])) {
            $data['birthstatus'] = $this->request->post['birthstatus'];
        } elseif (!empty($product_info)) {
            $data['birthstatus'] = $product_info['br_birthdayreminderstatus'];
        } else {
            $data['birthstatus'] = '';
        }

        if (isset($this->request->post['ownerstatus'])) {
            $data['ownerstatus'] = $this->request->post['ownerstatus'];
        } elseif (!empty($product_info)) {
            $data['ownerstatus'] = $product_info['br_sendbCCtostoreowner'];
        } else {
            $data['ownerstatus'] = '';
        }



		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/birthdaycalender.tpl', $data));
	}

    public function getBirthdaydate() {

        $this->load->model('module/birthdaycalender');
        $data1 = $this->model_module_birthdaycalender->getbirthdaydate();


        $jsonvalue=array();
        foreach($data1 as $key => $totaldata ){

            $date = date("Y");

            $datevalue=$date."-".date("m-d",strtotime($totaldata["Dateofbirth"]));

            $jsonvalue[]=array(

                'title'=>$totaldata['firstname'].$totaldata['lastname'],
               // 'url'=> 'index.php?route=module/birthdaycalender/sendmail&token='. $this->session->data["token"].'&dbdate='.$totaldata["Dateofbirth"],
                'start'=>$datevalue
            );

        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($jsonvalue));


    }

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/birthdaycalender')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

        if ((utf8_strlen($this->request->post['subject']) == '')) {
            $this->error['subject'] = $this->language->get('error_subject');
        }

        if ((utf8_strlen($this->request->post['message']) == '')) {
            $this->error['message'] = $this->language->get('error_message');
        }

		return !$this->error;*/
	}


    public function install() {



        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "cusmer_birtdayreminder` (
                          `br_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                          `br_subject` varchar(255) NOT NULL,
                          `br_message` text NOT NULL,
                          `br_birthdayreminderstatus` int(10) unsigned NOT NULL,
                           `br_sendbCCtostoreowner` int(10) unsigned NOT NULL,
                          PRIMARY KEY (`br_id`)
                        )");


        $this->load->model('setting/setting');
        $dbdate=date("Y-m-d");
        $date = strtotime("+1 day", strtotime($dbdate));
        $datecronchange= date("Y-m-d", $date);
        $dbdate=array(

            'crondatevalue'=>$datecronchange);

        $this->model_setting_setting->editSetting('crondate', $dbdate);

    	$this->db->query("ALTER TABLE `" . DB_PREFIX . "customer` ADD `Dateofbirth`  date AFTER `telephone`");



    }


    public function uninstall() {



        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "cusmer_birtdayreminder`");


	$this->db->query("ALTER TABLE `" . DB_PREFIX . "customer` DROP COLUMN `Dateofbirth`");

$this->model_setting_setting->deleteSetting('crondate');


    }
}
