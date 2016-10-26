<?php
class ControllerExtensionModuleItemCondition extends Controller {
    private $error = array();

    public function index() {   // Default function
        $this->language->load('extension/module/itemcondition'); // Loading the language file of helloworld

        $this->document->setTitle($this->language->get('heading_title')); // Set the title of the page to the heading title in the Language file i.e., Hello World
       
        /*Assign the language data for parsing it to view*/
        $data['heading_title'] = $this->language->get('heading_title');
    }
    public function install() {

//product_itemcondition table create
        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "product_item_condition` (
                          `pic_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                          `product_id` int(10) unsigned NOT NULL,
                          `language_id` int(10) unsigned NOT NULL,
                          `ic_id` int(10) unsigned NOT NULL,
                          PRIMARY KEY (`pic_id`)
                        )");


        //product_item_condition_master table create

        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "product_item_condition_master` (
                          `ic_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                           `ic_name` varchar(255) NOT NULL,
                           sort int(10) NOT NULL,
                            status int(10) NOT NULL,
                            date date NOT NULL,
			    PRIMARY KEY (`ic_id`)

                        )");



    }


    public function uninstall() {

        //product_item_condition_master table delete

        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "product_item_condition`");

        //product_shortdescription table delete

        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "product_item_condition_master`");

    }
}
?>
