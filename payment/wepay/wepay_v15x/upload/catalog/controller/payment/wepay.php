<?php
class ControllerPaymentWePay extends Controller {
	protected function index() {

		$this->language->load('payment/wepay');
        
        $this->load->model('checkout/order');
        
        $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
        
        require DIR_APPLICATION.'controller/payment/wepaysdk.php';

 
        $client_id = $this->config->get('wepay_clientid');
        $client_secret = $this->config->get('wepay_clientsecret');
        $access_token = $this->config->get('wepay_accesstoken');
        $account_id = $this->config->get('wepay_accountid');
        
        $modetouse = $this->config->get('wepay_staging');
        
        if ($modetouse == 'S') {$whattouse = 'useStaging';} elseif ($modetouse == 'P') {$whattouse = 'useProduction';}
        
        
        $total = 0;
             $taxes = $this->cart->getTaxes();
             
             $this->load->model('setting/extension');
             
             $sort_order = array();
             
             $results = $this->model_setting_extension->getExtensions('total');
             
             foreach ($results as $key => $value) {
                $sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
             }
             
             array_multisort($sort_order, SORT_ASC, $results);
             
             foreach ($results as $result) {
                if ($this->config->get($result['code'] . '_status')) {
                   $this->load->model('total/' . $result['code']);
          
                   $this->{'model_total_' . $result['code']}->getTotal($total_data, $total, $taxes);
                }
             }

        
        
        $order_info = $this->session->data['order_id'];
        $order_value = $this->currency->format($total, $order_info['currency_code'], $order_info['currency_value'], false);
        $feepayer = $this->config->get('wepay_feepayer');
$feepayer = strtolower($feepayer);
 
Wepay::$whattouse($client_id, $client_secret);
$wepay = new WePay($access_token);
 
try {


/*
$checkout = $wepay->request('/checkout/create', array(
'account_id' => $account_id, // ID of the account that you want the money to go to
'amount' => $total, // dollar amount you want to charge the user
'short_description' => "Order ".$order_info, // a short description of what the payment is for
'reference_id' => $order_info, // A reference id for your application to use.
'type' => "GOODS", // the type of the payment - choose from GOODS SERVICE DONATION or PERSONAL
'mode' => "regular", // put iframe here if you want the checkout to be in an iframe, regular if you want the user to be sent to WePay
'fee_payer' => $feepayer, // Here you put who is paying the fees you or your client. Payee = client, Payer = account holder
'redirect_uri' => $this->url->link('checkout/success'), // The page where you want clients to go after the transaction is completed.
'callback_uri' => $this->url->link('payment/wepay/callback', '', 'SSL'), // Location of the file that handles IPN requests

)
);*/



$checkout = $wepay->request('/checkout/create', array(
  //"checkout_id"=> 649945633,
  "account_id"=> $account_id,
  "type"=> "donation",
  "short_description"=> "Order ".$order_info,
  "currency"=> "USD",
  "amount"=> $total,
  //"state"=> "new",
 // "soft_descriptor"=> "WPY*Wolverine",
  //"auto_capture"=> true,
 // "create_time"=> 1439582388,
  "delivery_type"=> "point_of_sale",
  "long_description"=> "test",
  //"callback_uri"=> "http://irssoft.com/",
  "callback_uri" => $this->url->link('payment/wepay/callback', '', 'SSL'),
  "reference_id"=> null,
  "fee"=> array(
   // "app_fee"=> 1,
   "fee_payer"=> $feepayer,
   // "processing_fee"=> 0
  ),
 // "gross"=> 0,
 /* "chargeback"=> array(
    "amount_charged_back"=> 0,
    "dispute_uri"=> null
  ),*/
 /* "refund"=> array(
    "amount_refunded"=> 0,
    "refund_reason"=> null
  ),*/
  "hosted_checkout"=> array(
   // "checkout_uri"=> "http://wepay.com/api/iframe/649945633/51e59317/api_checkout?iframe=1",
    "redirect_uri"=> $this->url->link('checkout/success'),
   // "shipping_fee"=> 2,
   // "require_shipping"=> true,
   // "shipping_address"=> null,
    /*"theme_object"=> array(
      "theme_id"=> 96914023,
      "name"=> "test",
      "primary_color"=> "ffffff",
      "secondary_color"=> "000000",
      "background_color"=> "ffffff",
      "button_color"=> "000000"
    ),*/
   "mode"=> "regular"
 ),
  /*"payer"=> array(
    "name"=> null,
    "email"=> null,
    "home_address"=> null
  ),*/
)
);


} catch (WePayException $e) { // if the API call returns an error, get the error message for display later
$error = $e->getMessage();}

$this->data['text_instruction'] = $this->language->get('text_instruction');
$this->data['text_instruction_2'] = $this->language->get('text_instruction_2');
$this->data['button_confirm'] = $this->language->get('button_confirm');
if(isset($error)){
//print_r($error);
$this->data['error']=	$error;
}else{
$this->data['redirect_wepay'] = $checkout->hosted_checkout->checkout_uri;
}



	if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/wepay.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/payment/wepay.tpl';
		} else {
			$this->template = 'default/template/payment/wepay.tpl';
		}	
		
		$this->render(); 
	
	}
    

    public function callback() {
   
    if (isset($this->request->post['checkout_id'])) {
			$checkout_id = $this->request->post['checkout_id'];
		} else {
			$checkout_id = 0;
		}		
        
    $this->load->model('checkout/order');
    
    require DIR_APPLICATION.'controller/payment/wepaysdk.php';

        $client_id = $this->config->get('wepay_clientid');
        $client_secret = $this->config->get('wepay_clientsecret');
        $access_token = $this->config->get('wepay_accesstoken');
        $account_id = $this->config->get('wepay_accountid');
        
        $modetouse = $this->config->get('wepay_staging');
        
        if ($modetouse == 'S') {$whattouse = 'useStaging';} elseif ($modetouse == 'P') {$whattouse = 'useProduction';}
        
        Wepay::$whattouse($client_id, $client_secret);
        $wepay = new WePay($access_token);

        try {
            $checkout = $wepay->request('checkout', array(
            'checkout_id' => $checkout_id, ));
        } catch (WePayException $e) {$error = $e->getMessage();
        }

    if (isset($checkout)) {
        //$order_id = $checkout->reference_id;
		$order = $checkout->short_description;
		$id_explort=explode(" ",$order);
		$order_id = $id_explort[1];
    } else {
        $order_id = 0;
    }
        $order_info = $this->model_checkout_order->getOrder($order_id);
        
        $order_status_id = $this->config->get('config_order_status_id');
        
        if ($checkout->state == "captured") {
	    $order_status_id = $this->config->get('wepay_processed_status_id');
        } elseif ($checkout->state == "authorized") {
        $order_status_id = $this->config->get('wepay_pending_status_id');
        }
                    
        if (!$order_info['order_status_id']) {
					$this->model_checkout_order->confirm($order_id, $order_status_id);
				} else {
					$this->model_checkout_order->update($order_id, $order_status_id);
				}
    }
}
?>
