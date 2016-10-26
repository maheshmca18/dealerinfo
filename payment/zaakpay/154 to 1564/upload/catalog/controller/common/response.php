<?php
class ControllerCommonResponse extends Controller { 
public function index() { 

 $this->load->language('common/Zaakpay');
$this->data['button_confirm'] = $this->language->get('button_confirm');
$this->data['button_continue'] = $this->language->get('button_continue');
$this->data['heading_title'] = $this->language->get('heading_title');
$this->data['continue'] = HTTP_SERVER . 'index.php?route=common/home';

$secret_key = $this->config->get('Zaakpay_secret_key');
if(isset($_REQUEST['orderId'])) {

	 $response = array();
				$orderId=$_REQUEST['orderId'];
	 $response['orderId']=$orderId;
	 $response['responseCode']=$_REQUEST['responseCode'];
	 $response['responseDescription']=$_REQUEST['responseDescription'];
	 $response['checksum']=$_REQUEST['checksum'];
	 $this->data['response']=$response;


	$all = ControllerCommonResponse::getAllParams();
$bool = 0;
$bool = ControllerCommonResponse::verifyChecksum($response['checksum'], $all, $secret_key);
if($this->config->get('Zaakpay_log') == "on")
	{			
		error_log("AllParams : ".$all);
		error_log("Secret Key : ".$secret_key);
	}					
	$this->load->model('checkout/order');
if($bool==1)
{

	if($response['responseCode']=='100')
{
		if (isset($this->session->data['order_id'])) {
			$this->cart->clear();
			
			unset($this->session->data['shipping_method']);
			unset($this->session->data['shipping_methods']);
			unset($this->session->data['payment_method']);
			unset($this->session->data['payment_methods']);
			unset($this->session->data['guest']);
			unset($this->session->data['comment']);
			unset($this->session->data['order_id']);	
			unset($this->session->data['coupon']);
		}


$this->model_checkout_order->confirm($orderId,'5');

	 $this->data['responseMsg']='<div style="width:965px;float:left;padding:5px;margin:10px 0px;background-color:#66CCFF;color:#000000;-webkit-border-radius:5px;-moz-border-radius:5px;-o-border-radius:5px;border-radius:5px;" class="box-box"><p><center>Thank you for shopping with us. Your account has been charged and your transaction is successful. We will be shipping your order to you soon.</center></p></div><br/><br/>';
}
else
{	
	$this->model_checkout_order->confirm($orderId,'10');
	 $this->data['responseMsg']='<div style="width:965px;float:left;padding:5px;margin:10px 0px;background-color:#66CCFF;color:#000000;-webkit-border-radius:5px;-moz-border-radius:5px;-o-border-radius:5px;border-radius:5px;" class="box-box"><p><center>Thank you for shopping with us. However, the transaction has been declined!!.</center><p/></div><br/><br/><h2> ';
}
		}
		else
		{
		$this->model_checkout_order->confirm($orderId,'10');
		 $this->data['responseMsg']='<div style="width:965px;float:left;padding:5px;margin:10px 0px;background-color:#66CCFF;color:#000000;-webkit-border-radius:5px;-moz-border-radius:5px;-o-border-radius:5px;border-radius:5px;" class="box-box"><p><center>Security Error. Illegal access detected.</center><p/></div><br/><br/><h2> ';
		}
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/response.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/common/response.tpl';
		} else {
			$this->template = 'default/template/common/response.tpl';
		}
	
			$this->children = array(
			'common/header',
			'common/footer',
			'common/column_left',
			'common/column_right'
		);
		$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
	 }
	 
	 }
	 	function calculateChecksum($secret_key, $all) {
		$hash = hash_hmac('sha256', $all , $secret_key);
		$checksum = $hash;
		return $checksum;
	}

	function getAllParams() {
		//ksort($_POST);
		$all = '';
		foreach($_POST as $key => $value)	{
			if($key != 'checksum') {
				$all .= "'";
				if ($key == 'returnUrl') {
					$all .= ControllerCommonResponse::sanitizedURL($value);
				} else {
					$all .= ControllerCommonResponse::sanitizedParam($value);
				}
				$all .= "'";
			}
		}
		
		return $all;
	}

		function verifyChecksum($checksum, $all, $secret) {
		$cal_checksum = ControllerCommonResponse::calculateChecksum($secret, $all);
		$bool = 0;
		if($checksum == $cal_checksum)	{
			$bool = 1;
		}

		return $bool;
	}

	function sanitizedParam($param) {
		$pattern[0] = "%,%";
	        $pattern[1] = "%#%";
	        $pattern[2] = "%\(%";
       		$pattern[3] = "%\)%";
	        $pattern[4] = "%\{%";
	        $pattern[5] = "%\}%";
	        $pattern[6] = "%<%";
	        $pattern[7] = "%>%";
	        $pattern[8] = "%`%";
	        $pattern[9] = "%!%";
	        $pattern[10] = "%\\$%";
	        $pattern[11] = "%\%%";
	        $pattern[12] = "%\^%";
	        $pattern[13] = "%=%";
	        $pattern[14] = "%\+%";
	        $pattern[15] = "%\|%";
	        $pattern[16] = "%\\\%";
	        $pattern[17] = "%:%";
	        $pattern[18] = "%'%";
	        $pattern[19] = "%\"%";
	        $pattern[20] = "%;%";
	        $pattern[21] = "%~%";
	        $pattern[22] = "%\[%";
	        $pattern[23] = "%\]%";
	        $pattern[24] = "%\*%";
	        $pattern[25] = "%&%";
        	$sanitizedParam = preg_replace($pattern, "", $param);
		return $sanitizedParam;
	}

	function sanitizedURL($param) {
		$pattern[0] = "%,%";
	        $pattern[1] = "%\(%";
       		$pattern[2] = "%\)%";
	        $pattern[3] = "%\{%";
	        $pattern[4] = "%\}%";
	        $pattern[5] = "%<%";
	        $pattern[6] = "%>%";
	        $pattern[7] = "%`%";
	        $pattern[8] = "%!%";
	        $pattern[9] = "%\\$%";
	        $pattern[10] = "%\%%";
	        $pattern[11] = "%\^%";
	        $pattern[12] = "%\+%";
	        $pattern[13] = "%\|%";
	        $pattern[14] = "%\\\%";
	        $pattern[15] = "%'%";
	        $pattern[16] = "%\"%";
	        $pattern[17] = "%;%";
	        $pattern[18] = "%~%";
	        $pattern[19] = "%\[%";
	        $pattern[20] = "%\]%";
	        $pattern[21] = "%\*%";
        	$sanitizedParam = preg_replace($pattern, "", $param);
		return $sanitizedParam;
	}

}
?>
