<?php
class ControllerExtensionModuleCancel extends Controller {
    private $error = array();

    public function index() {
		
        if (!$this->customer->isLogged()) {
            $this->session->data['redirect'] = $this->url->link('account/order', '', 'SSL');
            
            $this->response->redirect($this->url->link('account/login', '', 'SSL'));
        }
		
        //processing the reason for cancel order
		if (isset($this->request->post['reason'])) {
            $return = $this->request->post['reason'];
        } else {
            $return = 0;
        }
		
        //check if order is less than 24h
        
        /*
         * get order id
         */
        //echo $this->request->get['order_id']; exit;
        if (isset($this->request->get['order_id'])) {
            $order_id = $this->request->get['order_id'];
        } else {
            $order_id = 0;
        }
        
        
        
        //cancel reason
        if (isset($this->request->post['cancel_reason_id'])) {
            $cancel_reason_id = $this->request->post['cancel_reason_id'];
        } else {
            $cancel_reason_id = '';
        }
        
        $this->load->model('account/order');
        $reason_description = $this->model_account_order->getParticularcanceldescription($cancel_reason_id);

        $customer_text   =  $this->language->get('cancel_order').$order_id.' '.strip_tags(html_entity_decode($this->config->get('ordercancel_usermessagecontent'), ENT_QUOTES, 'UTF-8')).' '.$reason_description;

        $order_info = $this->model_account_order->getOrder($order_id);

        if ($order_info) {
          //  if($this->order_cancellable($order_info['date_added'], $order_info['order_status_id'], $this)){
                
                //Cancel order.

                $this->load->model('extension/module/cancel');

                $this->model_extension_module_cancel->cancel_order($order_id,$reason_description);
                
                /*
                 * Back in stock
                 */
                //get list of products associated with the order.
                $products = $this->model_account_order->getOrderProducts($order_id);
                
                foreach ($products as $product) {

                    $this->model_extension_module_cancel->stock_back($product['quantity'], $product['product_id']);
                }
                
                /*
                 * Send email to admin
                 */
                $this->send_email_to_admin($order_info,$reason_description);
                
                $this->send_email_to_customer($order_info,$reason_description);
				 
            //}
        }
        
        $this->response->redirect($this->url->link('account/order', '', 'SSL'));
    }

    /**
     * 
     */
    private function send_email_to_customer($order_info,$reason_description){
        $this->load->language('extension/module/cancel');
        $order_id = $order_info['order_id'];
        /*
         * Email
         */

        $store_name = $order_info['store_name'];
        $store_url = $order_info['store_url'];
        $date_ordered = $order_info['date_added'];
        $date_modified = $order_info['date_modified'];
        $customer_id = $order_info['customer_id'];
        $firstname = $order_info['firstname'];
        $lastname = $order_info['lastname'];
        $email = $order_info['email'];
        $telephone = $order_info['telephone'];

        $find    = array('{order_id}', '{store_name}' ,'{store_url}','{order_id}','{date_ordered}','{date_modified}','{customer_id}','{firstname}','{lastname}','{email}','{telephone}');
        $replace = array('order_id' => $order_id, 'store_name' => $store_name, 'store_url' =>$store_url,
            'date_ordered' => $date_ordered,'date_modified' => $date_modified,'customer_id'=>$customer_id,'firstname'=>$firstname,'lastname'=>$lastname,'email'=>$email,'telephone'=>$telephone);

        //
        $subject = str_replace($find, $replace,  $this->language->get('cancel_customer_email_subject'));

        //$subject =  $this->language->get('cancel_customer_email_subject');
        // Text
        $text_body  = $this->config->get('ordercancel_usermessagecontent'). "\n\n";

        $text_body  .= $this->language->get('cancel_order').$order_id. '<br>';

        $text_body   .= $this->language->get('reason_for_cancellations').$reason_description;

        if ($order_info['customer_id']) {
            $text_body .= $this->language->get('text_update_link') . "\n";
            $text_body .= '<br>'.$order_info['store_url'] . 'index.php?route=account/order/info&order_id=' . $order_id . '</br>';
        }

        $text_body = str_replace($find, $replace, $text_body);

        $text = $text_body;

        $config_email = $this->config->get('config_mail');
        if(! empty($config_email)){
            $mail = new Mail($this->config->get('config_mail'));
        }else{
            $mail = new Mail();
            $mail->protocol = $this->config->get('config_mail_protocol');
            $mail->parameter = $this->config->get('config_mail_parameter');
            $mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
            $mail->smtp_username = $this->config->get('config_mail_smtp_username');
            $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
            $mail->smtp_port = $this->config->get('config_mail_smtp_port');
            $mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');
        }
        $mail->setTo($order_info['email']);
        $mail->setFrom($this->config->get('config_email'));
        $mail->setReplyTo($this->config->get('config_email'));
        $mail->setSender($order_info['store_name']);
        $mail->setSubject($subject);
        $mail->setHtml(html_entity_decode($text, ENT_QUOTES, 'UTF-8'));
        $mail->send();
    }
    
    
    /**
     * 
     */
    private function send_email_to_admin($order_info,$reason_description){
		$this->load->language('extension/module/cancel');
       /* $cancelor_email = $this->config->get('cancelor_cfg_ntfc_email');
        if(empty($cancelor_email)){
            if ($this->config->get('config_error_log')) $this->log->write("[smshare][cancelor] admin email empty! On order cancel email to admin not sent. Aborting!");
            return;
        }*/

        //
        $order_id = $order_info['order_id'];
        $store_name = $order_info['store_name'];
        $store_url = $order_info['store_url'];
        $date_ordered = $order_info['date_added'];
        $date_modified = $order_info['date_modified'];
        $customer_id = $order_info['customer_id'];
        $firstname = $order_info['firstname'];
        $lastname = $order_info['lastname'];
        $email = $order_info['email'];
        $telephone = $order_info['telephone'];

        $find    = array('{order_id}', '{store_name}' ,'{store_url}','{order_id}','{date_ordered}','{date_modified}','{customer_id}','{firstname}','{lastname}','{email}','{telephone}');
        $replace = array('order_id' => $order_id, 'store_name' => $store_name, 'store_url' =>$store_url,
            'date_ordered' => $date_ordered,'date_modified' => $date_modified,'customer_id'=>$customer_id,'firstname'=>$firstname,'lastname'=>$lastname,'email'=>$email,'telephone'=>$telephone);

        $subject = str_replace($find, $replace,  $this->language->get('cancel_admin_email_subject'));
		// Text
        $text_body  = $this->config->get('ordercancel_adminmessagecontent'). "\n\n";
       // $text .= "Order ID: " . $order_id . "\n\n";
        $text_body  .= $this->language->get('cancel_order').$order_id. '<br>';
        $text_body   .= $this->language->get('reason_for_cancellations').$reason_description;
        if ($order_info['customer_id']) {
            $text_body .= '<br>'.$this->language->get('text_update_link') . '<br>';
            $text_body .= $order_info['store_url'] . 'index.php?route=account/order/info&order_id=' . $order_id . "\n\n";
        }
        $text_body = str_replace($find, $replace, $text_body);

        $text = $text_body;
        //$text  .= $reason_description;
        $config_email = $this->config->get('config_mail');
       // if(! empty($config_email)){
            $mail = new Mail($this->config->get('config_mail'));
      //  }else{
       //     $mail = new Mail();
            $mail->protocol = $this->config->get('config_mail_protocol');
            $mail->parameter = $this->config->get('config_mail_parameter');
            $mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
            $mail->smtp_username = $this->config->get('config_mail_smtp_username');
            $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
            $mail->smtp_port = $this->config->get('config_mail_smtp_port');
            $mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');
      //  }
                 
        $mail->setTo($this->config->get('config_email'));
        $mail->setFrom($this->config->get('config_email'));
        $mail->setReplyTo($this->config->get('config_email'));
        $mail->setSender($order_info['store_name']);
        $mail->setSubject($subject);
        $mail->setHtml( html_entity_decode($text, ENT_QUOTES, 'UTF-8'));
        $mail->send();
        
    }
    
}
?>
