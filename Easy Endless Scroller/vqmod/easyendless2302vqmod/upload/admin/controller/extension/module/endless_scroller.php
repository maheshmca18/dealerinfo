<?php
class ControllerExtensionModuleEndlessscroller extends Controller {
	private $error = array();
	public function index()
    {
	$this->load->language('extension/module/endless_scroller');
        $this->document->setTitle($this->language->get('heading_title'));
        $data['heading_title'] = $this->language->get('heading_title');
    }
    public function install() {
 		$this->load->model('setting/setting');
		$status="1";
		$endlessstatus=array('endless_status'=>$status);
		$this->model_setting_setting->editSetting('endless', $endlessstatus);    

    }
    public function uninstall() {       
        $this->load->model('setting/setting');
        $this->model_setting_setting->deleteSetting('endless');
    }
}
