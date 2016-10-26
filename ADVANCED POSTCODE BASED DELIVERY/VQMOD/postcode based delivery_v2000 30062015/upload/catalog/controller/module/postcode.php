<?php  
class ControllerModulePostcode extends Controller {
    public function index() {

		$this->language->load('module/postcode');
		
		$this->load->model('module/postcode');

        $this->load->model('setting/setting');
			 
		$data['heading_title'] = $this->language->get('heading_title');
	 
		$data['postcodes'] = $this->model_module_postcode->getPostcodes(); 
		
		$data['text_search_postcode'] = $this->language->get('text_search_postcode');

        $data['postcode_style'] = $this->model_setting_setting->getSetting('postcode');

            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/postcode.tpl')) {
                return $this->load->view($this->config->get('config_template') . '/template/module/postcode.tpl', $data);
            } else {
                return $this->load->view('default/template/module/postcode.tpl', $data);
            }
	}
	
	 public function validate() {        
	 
        $this->load->model('module/postcode');
		
        $this->language->load('module/postcode');
        
    	if ($this->request->post['postcode'] != '') {
		
      		$this->error['postcode'] = $this->language->get('error_postcode');
			
    	}
		
    	if (!$this->error) {
		
      		$this->error['success']=1;
            
    	} else {
      		//return false;
    	}
        $this->response->setOutput(json_encode($this->error));
        //print_r($this->error);
        
  	}
	
	 public function searchpostcode() {   
     
        $this->load->model('module/postcode');
		
        $this->language->load('module/postcode');        		 
		
		$getdata=$this->model_module_postcode->getPostcode($this->request->post['postcode']); 
		if(count($getdata)>0){
		//$this->currency->format(10.00,'','',false)
        $returndata = "<div class='success'>Minimum Purchase amount is ".$this->currency->format($getdata['min_shipping']."</div>");	
		} else {
		$returndata = "<div class='warning'>Delivery has Unavailabe for this area</div>";
		}
    		
        $this->response->setOutput(json_encode($returndata));
	 
  	}
}
?>
