<?php
class ControllerModuleBirthdaycalendermodule extends Controller {
	private $error = array();
	public function index()
    {
	$this->load->language('module/birthdaycalendermodule');
        $this->document->setTitle($this->language->get('Birthday Reminder'));
        $data['heading_title'] = $this->language->get('Birthday Reminder');
    }
    public function install() {
        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "customer_birtdayreminder` (
                          `br_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                          `br_subject` varchar(255) NOT NULL,
                          `br_message` text NOT NULL,
                          `br_birthdayreminderstatus` int(10) unsigned NOT NULL,
                           `br_sendbCCtostoreowner` int(10) unsigned NOT NULL,
                          PRIMARY KEY (`br_id`)
                        )");
	$this->db->query("ALTER TABLE `" . DB_PREFIX . "customer` ADD `Dateofbirth`  date AFTER `telephone`");
        $this->load->model('setting/setting');
        $date = strtotime("+1 day", strtotime(date("Y-m-d")));
        $datecronchange= date("Y-m-d", $date);
        $dbdate=array('crondatevalue'=>$datecronchange);
        $this->model_setting_setting->editSetting('crondate', $dbdate);
    }
    public function uninstall() {
        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "customer_birtdayreminder`");
	$this->db->query("ALTER TABLE `" . DB_PREFIX . "customer` DROP COLUMN `Dateofbirth`");
	$this->load->model('setting/setting');
	$this->model_setting_setting->deleteSetting('crondate');
    }
}
