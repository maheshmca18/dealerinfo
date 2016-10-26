<?php  
class ControllerModuleTestimonial extends Controller {
	public function index() {
		$this->language->load('module/testimonial');
		$this->load->model('information/testimonial');
		
		$this->document->addStyle('catalog/view/theme/default/irstestimonial/style.css');
		$this->document->addScript('catalog/view/theme/default/irstestimonial/js/jquery-1.5.2.min.js');
		$this->document->addScript('catalog/view/theme/default/irstestimonial/jquery.quovolver.js');
		
		$data = array(
			'page' => 1,
			'limit' => 5,
			'start' => 0,
		);
	 
		$data['heading_title'] = $this->language->get('heading_title');
	 
		$all_testimonial = $this->model_information_testimonial->getTestimonial($data); 

        $this->load->model('module/testimonial');
        $data['allstyles'] = $this->model_module_testimonial->getTestimonialCustom();

		$data['all_testimonial'] = array();
	 
		foreach ($all_testimonial as $testimonial) {
		  //testimonial_id, name, data, customer_id, added_on, approved_on, status
          if(isset($data['allstyles']['limitchar']) && $data['allstyles']['limitchar'] != '' )
          $displaydata = (strlen(strip_tags(html_entity_decode($testimonial['data']))) > $data['allstyles']['limitchar'] ? substr(strip_tags(html_entity_decode($testimonial['data'])), 0, $data['allstyles']['limitchar']) . '...' : strip_tags(html_entity_decode($testimonial['data'])));
          else
          $displaydata = (strlen(strip_tags(html_entity_decode($testimonial['data']))) > 100 ? substr(strip_tags(html_entity_decode($testimonial['data'])), 0, 100) . '...' : strip_tags(html_entity_decode($testimonial['data'])));
          
			$data['all_testimonial'][] = array (
				'name' => $testimonial['name'],
                'data' => $displaydata,
                'view' => $this->url->link('information/testimonial/testimonial_single&testimonialid='.$testimonial['testimonial_id']),
				'date_added' => date('d M Y', strtotime($testimonial['added_on']))
			);
		}
		
		$data['showall'] = $this->url->link('information/testimonial/');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/testimonial.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/testimonial.tpl', $data);
		} else {
			return $this->load->view('default/template/module/testimonial.tpl', $data); 
		}
	}
}
?>