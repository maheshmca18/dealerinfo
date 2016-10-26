<?php
class ModelExtensionAdvanceFilter extends Model {
	public function add($data) {
		$this->db->query("INSERT  INTO " . DB_PREFIX . "advance_filter SET af_categoryid = '".$data['category']."',	af_optionid = '".$data['optiondetails']."',	af_attributeid = '".$data['attri']."'");

		$query = $this->db->query("SELECT  * FROM " . DB_PREFIX . "advance_filter");
		foreach($query->rows as $row){
			$optiondetails=array();
			$attribdetails=array();
			$querycategory = $this->db->query("SELECT  name FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) WHERE c.category_id IN(".$row['af_categoryid'].") AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "'");
			if(!empty($row['af_optionid'])) {
				$queryoption = $this->db->query("SELECT  * FROM " . DB_PREFIX . "option o LEFT JOIN " . DB_PREFIX . "option_description od ON (o.option_id = od.option_id) WHERE o.option_id IN(" . $row['af_optionid'] . ") AND od.language_id = '" . (int)$this->config->get('config_language_id') . "'");
				$optiondetails=$queryoption->rows;
			}
			if(!empty($row['af_attributeid'])) {
				$queryattri = $this->db->query("SELECT  * FROM " . DB_PREFIX . "attribute_group_description WHERE attribute_group_id IN(" . $row['af_attributeid'] . ") AND language_id = '" . (int)$this->config->get('config_language_id') . "'");
				$attribdetails=$queryattri->rows;
			}
			$advancefilterdetails[]=array(
				'af_id'=>$row['af_id'],
				'af_category'=>$querycategory->row['name'],
				'af_option'=>$optiondetails,
				'af_attribute'=>$attribdetails
			);
		}
		return $advancefilterdetails;
	}
	public function delete($data) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "advance_filter WHERE af_id = '".$data['id']."'");

		$query = $this->db->query("SELECT  * FROM " . DB_PREFIX . "advance_filter");
$advancefilterdetails=array();
		foreach($query->rows as $row){
			$optiondetails=array();
			$attribdetails=array();
			$querycategory = $this->db->query("SELECT  name FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) WHERE c.category_id IN(".$row['af_categoryid'].") AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "'");
			if(!empty($row['af_optionid'])) {
				$queryoption = $this->db->query("SELECT  * FROM " . DB_PREFIX . "option o LEFT JOIN " . DB_PREFIX . "option_description od ON (o.option_id = od.option_id) WHERE o.option_id IN(" . $row['af_optionid'] . ") AND od.language_id = '" . (int)$this->config->get('config_language_id') . "'");
				$optiondetails=$queryoption->rows;
			}
			if(!empty($row['af_attributeid'])) {
				$queryattri = $this->db->query("SELECT  * FROM " . DB_PREFIX . "attribute_group_description WHERE attribute_group_id IN(" . $row['af_attributeid'] . ") AND language_id = '" . (int)$this->config->get('config_language_id') . "'");
				$attribdetails=$queryattri->rows;
			}
			$advancefilterdetails[]=array(
				'af_id'=>$row['af_id'],
				'af_category'=>$querycategory->row['name'],
				'af_option'=>$optiondetails,
				'af_attribute'=>$attribdetails
			);
		}
		return $advancefilterdetails;
			}
	public function editcancel($data) {
		$query = $this->db->query("SELECT  * FROM " . DB_PREFIX . "advance_filter WHERE af_id = '".$data['id']."'");

		$advancefilterdetails='';
		foreach($query->rows as $row){
			$optiondetails=array();
			$attribdetails=array();
			$querycategory = $this->db->query("SELECT  name FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) WHERE c.category_id IN(".$row['af_categoryid'].") AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "'");
			if(!empty($row['af_optionid'])) {
				$queryoption = $this->db->query("SELECT  * FROM " . DB_PREFIX . "option o LEFT JOIN " . DB_PREFIX . "option_description od ON (o.option_id = od.option_id) WHERE o.option_id IN(" . $row['af_optionid'] . ") AND od.language_id = '" . (int)$this->config->get('config_language_id') . "'");
				$optiondetails=$queryoption->rows;
			}
			if(!empty($row['af_attributeid'])) {
				$queryattri = $this->db->query("SELECT  * FROM " . DB_PREFIX . "attribute_group_description WHERE attribute_group_id IN(" . $row['af_attributeid'] . ") AND language_id = '" . (int)$this->config->get('config_language_id') . "'");
				$attribdetails=$queryattri->rows;
			}
			$advancefilterdetails[]=array(
				'af_id'=>$row['af_id'],
				'af_category'=>$querycategory->row['name'],
				'af_option'=>$optiondetails,
				'af_attribute'=>$attribdetails
			);
		}
		return $advancefilterdetails;
	}
	public function editgetvalue($data) {
		$query = $this->db->query("SELECT  * FROM " . DB_PREFIX . "advance_filter WHERE af_id = '".$data['id']."'");

			foreach($query->rows as $row){
			$querycategory = $this->db->query("SELECT  name FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) WHERE c.category_id IN(".$row['af_categoryid'].")");
			$advancefilterdetails[]=array(
				'af_id'=>$row['af_id'],
				'af_category'=>$querycategory->row['name'],
				'af_option'=>explode(",",$row['af_optionid']),
				'af_attribute'=>explode(",",$row['af_attributeid'])
			);
		}
		return $advancefilterdetails;
	}
	public function update($data) {
		$this->db->query("UPDATE  " . DB_PREFIX . "advance_filter SET af_optionid = '".$data['optiondetails']."',	af_attributeid = '".$data['attri']."' WHERE af_id = '".$data['category']."'");

		$query = $this->db->query("SELECT  * FROM " . DB_PREFIX . "advance_filter");
		foreach($query->rows as $row){
			$optiondetails=array();
			$attribdetails=array();
			$querycategory = $this->db->query("SELECT  name FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) WHERE c.category_id IN(".$row['af_categoryid'].") AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "'");
			if(!empty($row['af_optionid'])) {
				$queryoption = $this->db->query("SELECT  * FROM " . DB_PREFIX . "option o LEFT JOIN " . DB_PREFIX . "option_description od ON (o.option_id = od.option_id) WHERE o.option_id IN(" . $row['af_optionid'] . ") AND od.language_id = '" . (int)$this->config->get('config_language_id') . "'");
				$optiondetails=$queryoption->rows;
			}
			if(!empty($row['af_attributeid'])) {
				$queryattri = $this->db->query("SELECT  * FROM " . DB_PREFIX . "attribute_group_description WHERE attribute_group_id IN(" . $row['af_attributeid'] . ") AND language_id = '" . (int)$this->config->get('config_language_id') . "'");
				$attribdetails=$queryattri->rows;
			}
			$advancefilterdetails[]=array(
				'af_id'=>$row['af_id'],
				'af_category'=>$querycategory->row['name'],
				'af_option'=>$optiondetails,
				'af_attribute'=>$attribdetails
			);
		}
		return $advancefilterdetails;
	}
	public function getfilter() {
		$advancefilterdetails=array();
		$query = $this->db->query("SELECT  * FROM " . DB_PREFIX . "advance_filter");
		foreach($query->rows as $row){
			$optiondetails=array();
			$attribdetails=array();
			$querycategory = $this->db->query("SELECT  name FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) WHERE c.category_id IN(".$row['af_categoryid'].")");
			if(!empty($row['af_optionid'])) {
				$queryoption = $this->db->query("SELECT  * FROM " . DB_PREFIX . "option o LEFT JOIN " . DB_PREFIX . "option_description od ON (o.option_id = od.option_id) WHERE o.option_id IN(" . $row['af_optionid'] . ") AND od.language_id = '" . (int)$this->config->get('config_language_id') . "'");
				$optiondetails=$queryoption->rows;
			}
			if(!empty($row['af_attributeid'])) {
				$queryattri = $this->db->query("SELECT  * FROM " . DB_PREFIX . "attribute_group_description WHERE attribute_group_id IN(" . $row['af_attributeid'] . ") AND language_id = '" . (int)$this->config->get('config_language_id') . "'");
				$attribdetails=$queryattri->rows;
			}
			$advancefilterdetails[]=array(
				'af_id'=>$row['af_id'],
				'af_category'=>$querycategory->row['name'],
				'af_option'=>$optiondetails,
				'af_attribute'=>$attribdetails
			);
		}
		return $advancefilterdetails;
	}
	public function getProductOptions() {
		$product_option_data = array();

		$product_option_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "option o  LEFT JOIN " . DB_PREFIX . "option_description od ON (o.option_id = od.option_id) WHERE  o.type in('radio','select','checkbox') AND od.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY o.sort_order");

		foreach ($product_option_query->rows as $product_option) {

			$product_option_data[] = array(
				'option_id'            => $product_option['option_id'],
				'name'                 => $product_option['name'],
				'type'                 => $product_option['type']
			);
		}

		return $product_option_data;
	}
	public function getCategory() {
		$query = $this->db->query("SELECT  * FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd2 ON (c.category_id = cd2.category_id) WHERE c.status = 1 AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->rows;
	}
	public function getAttribute() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "attribute_group_description WHERE language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->rows;
	}
	public function autosearch($data) {
		$query = $this->db->query("SELECT  * FROM " . DB_PREFIX . "advance_filter WHERE af_categoryid ='".$data['category']."'");
if(!empty($query->row)){
	$advancefilterdetails=1;
} else {

	$advancefilterdetails='';
}
		return $advancefilterdetails;
	}

}
