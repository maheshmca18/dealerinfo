<?php
class ControllerExtensionModuleKeyfeatures extends Controller {
	private $error = array(); 

  public function index() {   // Default function
        $this->language->load('extension/module/keyfeatures'); // Loading the language file of helloworld

        $this->document->setTitle($this->language->get('heading_title')); // Set the title of the page to the heading title in the Language file i.e., Hello World

        $this->load->model('setting/setting'); // Load the Setting Model  (All of the OpenCart Module & General Settings are saved using this Model )


       /*Assign the language data for parsing it to view*/
        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_content_top'] = $this->language->get('text_content_top');
        $data['text_content_bottom'] = $this->language->get('text_content_bottom');
        $data['text_column_left'] = $this->language->get('text_column_left');
        $data['text_column_right'] = $this->language->get('text_column_right');

        $data['entry_code'] = $this->language->get('entry_code');
        $data['entry_layout'] = $this->language->get('entry_layout');
        $data['entry_position'] = $this->language->get('entry_position');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_sort_order'] = $this->language->get('entry_sort_order');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_add_module'] = $this->language->get('button_add_module');
        $data['button_remove'] = $this->language->get('button_remove');


      }
	public function install() {

//product_keyfeatures table create

$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "product_keyfeatures` (
                          `product_keyfeatures_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                          `product_id` int(10) unsigned NOT NULL,
                          `language_id` int(10) unsigned NOT NULL,
                          `product_keyfeatures` varchar(255) NOT NULL,
                         sort int(10) NOT NULL,
                          PRIMARY KEY (`product_keyfeatures_id`)
                        )");


        //product_shortdescription table create

$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "product_shortdescription` (
                          `product_id` int(10) unsigned NOT NULL,
                          `language_id` int(10) unsigned NOT NULL,
                          `product_shortdescription` varchar(255) NOT NULL

                        )");

    }

	public function uninstall() {

        //product_keyfeatures table delete

		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "product_keyfeatures`");

        //product_shortdescription table delete

        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "product_shortdescription`");
		
	}
}
?>
