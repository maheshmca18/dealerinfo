<?php
class ControllerModulePdfinvoice extends Controller {
	private $error = array();


    public function pdftax() {


        //insert query function here
        if($_POST['action']=='insert') {

            $pdftaxname=$_POST['tax_name'];
            $pdftaxnumber=$_POST['tax_number'];


            $this->load->model('extension/pdfinvoice');

                $data=$this->model_extension_pdfinvoice->addpdfinvoice($pdftaxname,$pdftaxnumber);


                $this->session->data['success'] = $this->language->get('text_success');

                $this->response->setOutput(json_encode($data));

        }

        //delete query function here
        if($_POST['action']=='delete') {

            $pdftaxid = $_POST['info'];

            $this->load->model('extension/pdfinvoice');


            $data=$this->model_extension_pdfinvoice->deletepdfinvoice($pdftaxid);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->setOutput(json_encode($data));
        }

        //update query function here
        if($_POST['action']=='update') {


            $pdftaxid=$_POST['tax_id'];
            $pdftaxname=$_POST['tax_name'];
            $pdftaxnumber=$_POST['tax_number'];


            $this->load->model('extension/pdfinvoice');


            $data=$this->model_extension_pdfinvoice->editpdfinvoice($pdftaxid,$pdftaxname,$pdftaxnumber);


            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->setOutput(json_encode($data));
        }


    }

  	public function index() {
		$this->language->load('module/pdfinvoice');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

            //print_r($this->request->post); exit;
			$this->model_setting_setting->editSetting('pdfinvoice', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');


			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));

		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_module'] = $this->language->get('text_module');
		//$data['text_help'] = $this->language->get('text_help');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_logo'] = $this->language->get('entry_logo');
		$data['entry_attach_email'] = $this->language->get('entry_attach_email');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_authorized'] = $this->language->get('entry_authorized');
        $data['entry_orderstatus'] = $this->language->get('entry_orderstatus');
        $data['entry_automailstatus'] = $this->language->get('entry_automailstatus');
        $data['entry_messagecontent'] = $this->language->get('entry_messagecontent');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

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
			'href'      => $this->url->link('module/pdfinvoice', 'token=' . $this->session->data['token'], 'SSL'),
			//'separator' => ' :: '
		);

		$data['action'] = $this->url->link('module/pdfinvoice', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['pdfinvoice_logo_status'])) {
			$data['pdfinvoice_logo_status'] = $this->request->post['pdfinvoice_logo_status'];
		} else {
			$data['pdfinvoice_logo_status'] = $this->config->get('pdfinvoice_logo_status');
		}

		if (isset($this->request->post['pdfinvoice_attach_email_status'])) {
			$data['pdfinvoice_attach_email_status'] = $this->request->post['pdfinvoice_attach_email_status'];
		} else {
			$data['pdfinvoice_attach_email_status'] = $this->config->get('pdfinvoice_attach_email_status');
		}

        if (isset($this->request->post['pdfinvoice_authorized_status'])) {
            $data['pdfinvoice_authorized_status'] = $this->request->post['pdfinvoice_authorized_status'];
        } else {
            $data['pdfinvoice_authorized_status'] = $this->config->get('pdfinvoice_authorized_status');
        }

        if (isset($this->request->post['pdfinvoice_image'])) {
            $data['pdfinvoice_image'] = $this->request->post['pdfinvoice_image'];
        } else {
            $data['pdfinvoice_image'] = $this->config->get('pdfinvoice_image');
        }

        $pdfinvoice_image=$this->config->get('pdfinvoice_image');

        $this->load->model('tool/image');

        if (isset($this->request->post['pdfinvoice_image']) && is_file(DIR_IMAGE . $this->request->post['pdfinvoice_image'])) {
            $data['thumb'] = $this->model_tool_image->resize($this->request->post['pdfinvoice_image'], 100, 100);
        } elseif (!empty($pdfinvoice_image) && is_file(DIR_IMAGE . $pdfinvoice_image)) {
            $data['thumb'] = $this->model_tool_image->resize($pdfinvoice_image, 100, 100);
        } else {
            $data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
        }

        $data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

        if (isset($this->request->post['pdfinvoice_status'])) {
            $data['status'] = $this->request->post['pdfinvoice_status'];

        } else {
            $data['pdfinvoice_status'] = $this->config->get('pdfinvoice_status');
        }

        if (isset($this->request->post['pdfinvoice_automailstatus'])) {
            $data['pdfinvoice_automailstatus'] = $this->request->post['pdfinvoice_automailstatus'];

        } else {
            $data['pdfinvoice_automailstatus'] = $this->config->get('pdfinvoice_automailstatus');
        }
        $this->load->model('localisation/order_status');

        $data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

        if (isset($this->request->post['pdfinvoice_orderstatus'])) {
            $data['pdfinvoice_orderstatus'] = $this->request->post['pdfinvoice_orderstatus'];
        } else {
            $data['pdfinvoice_orderstatus'] = $this->config->get('pdfinvoice_orderstatus');
        }


        if (isset($this->request->post['pdfinvoice_messagecontent'])) {
            $data['pdfinvoice_messagecontent'] = $this->request->post['pdfinvoice_messagecontent'];
        } else {
            $data['pdfinvoice_messagecontent'] = $this->config->get('pdfinvoice_messagecontent');
        }


        $this->load->model('extension/pdfinvoice');

        $data['taxdetails'] = $this->model_extension_pdfinvoice->getpdfinvoice();

		$this->template = 'module/pdfinvoice.tpl';

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');


		//$this->response->setOutput($this->render());
		$this->response->setOutput($this->load->view('module/pdfinvoice.tpl', $data));
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/pdfinvoice')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}



		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

    public function install() {


        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "pdf_invoice` (
                          `pdf_invoice_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                          `pdf_invoice_taxname` varchar(255) NOT NULL,
                           `pdf_invoice_taxnumber` int(10) unsigned NOT NULL,
                           PRIMARY KEY (`pdf_invoice_id`)
                        )");



    }

    public function uninstall() {

        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "pdf_invoice`");

        $this->load->model('setting/setting');
        $this->model_setting_setting->deleteSetting('pdfinvoice');

    }
}
?>
