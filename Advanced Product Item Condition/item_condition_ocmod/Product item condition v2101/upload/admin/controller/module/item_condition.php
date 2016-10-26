<?php
class ControllerModuleItemCondition extends Controller {
    private $error = array();

    public function index() {   // Default function
        $this->language->load('module/itemcondition'); // Loading the language file of helloworld

        $this->document->setTitle($this->language->get('heading_title')); // Set the title of the page to the heading title in the Language file i.e., Hello World

        $this->load->model('setting/setting'); // Load the Setting Model  (All of the OpenCart Module & General Settings are saved using this Model )



        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) { // Start If: Validates and check if data is coming by save (POST) method
            $this->model_setting_setting->editSetting('itemcondition', $this->request->post);      // Parse all the coming data to Setting Model to save it in database.

            $this->session->data['success'] = $this->language->get('text_success'); // To display the success text on data save

            $this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')); // Redirect to the Module Listing
        } // End If

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


        /*This Block returns the warning if any*/
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        /*This Block returns the error code if any*/
        if (isset($this->error['code'])) {
            $data['error_code'] = $this->error['code'];
        } else {
            $data['error_code'] = '';
        }
        /*End Block*/


        /* Making of Breadcrumbs to be displayed on site*/
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_module'),
            'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('module/itemcondition', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        /* End Breadcrumb Block*/

        $data['action'] = $this->url->link('module/itemcondition', 'token=' . $this->session->data['token'], 'SSL'); // URL to be directed when the save button is pressed

        $data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'); // URL to be redirected when cancel button is pressed


        /* This block checks, if the hello world text field is set it parses it to view otherwise get the default hello world text field from the database and parse it*/

        if (isset($this->request->post['helloworld_text_field'])) {
            $data['helloworld_text_field'] = $this->request->post['helloworld_text_field'];
        } else {
            $data['helloworld_text_field'] = $this->config->get('helloworld_text_field');
        }
        /* End Block*/

        $data['modules'] = array();

        /* This block parses the Module Settings such as Layout, Position,Status & Order Status to the view*/
        if (isset($this->request->post['helloworld_module'])) {
            $data['modules'] = $this->request->post['helloworld_module'];
        } elseif ($this->config->get('helloworld_module')) {
            $data['modules'] = $this->config->get('helloworld_module');
        }
        /* End Block*/

        // $this->load->model('design/layout'); // Loading the Design Layout Models

        // $data['layouts'] = $this->model_design_layout->getLayouts(); // Getting all the Layouts available on system

        // $this->template = 'module/helloworld.tpl'; // Loading the helloworld.tpl template

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        //    print_r ($data);

       
    }

    /* Function that validates the data when Save Button is pressed */
    protected function validate() {

        /* Block to check the user permission to manipulate the module*/
        if (!$this->user->hasPermission('modify', 'module/helloworld')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        /* End Block*/

        /* Block to check if the helloworld_text_field is properly set to save into database, otherwise the error is returned*/
        if (!$this->request->post['helloworld_text_field']) {
            $this->error['code'] = $this->language->get('error_code');
        }
        /* End Block*/

        /*Block returns true if no error is found, else false if any error detected*/
        if (!$this->error) {
            return true;
        } else {
            return false;
        }
        /* End Block*/

    }
    /* End Validation Function*/




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
