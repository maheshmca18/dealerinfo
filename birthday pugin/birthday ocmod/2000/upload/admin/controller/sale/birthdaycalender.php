<?php
class ControllerSaleBirthdaycalender extends Controller {
	private $error = array();

	public function index()
    {


        $this->load->language('sale/birthdaycalender');

        $this->document->setTitle($this->language->get('heading_title'));

        //$this->load->model('extension/module');
        $this->load->model('sale/birthdaycalender');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {


            if ($this->request->post['id']=="") {
                $this->model_sale_birthdaycalender->addProduct($this->request->post);
            } else {

                $this->model_sale_birthdaycalender->editProduct($this->request->post);
            }

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';


            $this->response->redirect($this->url->link('sale/birthdaycalender', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $data['heading_title'] = $this->language->get('heading_title');

        $data['tab_setting'] = $this->language->get('tab_setting');
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



        $url = '';

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('sale/birthdaycalender', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );

        /*if (!isset($this->request->get['customer_id'])) {
            $data['action'] = $this->url->link('sale/birthdaycalender', 'token=' . $this->session->data['token'] , 'SSL');
        } else {
            $data['action'] = $this->url->link('sale/birthdaycalender', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . $url, 'SSL');
        }*/
$data['action'] = $this->url->link('sale/birthdaycalender', 'token=' . $this->session->data['token'], 'SSL');
        $data['token'] = $this->session->data['token'];

        $this->load->model('sale/birthdaycalender');

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


        $product_info = $this->model_sale_birthdaycalender->getProducts();



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

		$this->response->setOutput($this->load->view('sale/birthdaycalender.tpl', $data));
	}

    public function getBirthdaydate() {

        $startmonth=$_POST['start'];
        $startmonth=date("m",strtotime($startmonth));

        $endmonth=$_POST['end'];
        $endmonth=date("m",strtotime($endmonth));


        $this->load->model('sale/birthdaycalender');

      $data1 = $this->model_sale_birthdaycalender->getbirthdaydate($startmonth,$endmonth);

        $jsonvalue=array();
       foreach($data1 as $key => $totaldata ){
            $date = date("Y");
            $datevalue=$date."-".date("m-d",strtotime($totaldata["Dateofbirth"]));
            $jsonvalue[]=array(
                'title'=>$totaldata['firstname'].$totaldata['lastname'],
                'start'=>$datevalue
            );
        }

       $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($jsonvalue));


    }

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'sale/birthdaycalender')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

        if ((utf8_strlen($this->request->post['subject']) == '')) {
            $this->error['subject'] = $this->language->get('error_subject');
        }

        if ((utf8_strlen($this->request->post['message']) == '')) {
            $this->error['message'] = $this->language->get('error_message');
        }

		return !$this->error;
	}


   
}

