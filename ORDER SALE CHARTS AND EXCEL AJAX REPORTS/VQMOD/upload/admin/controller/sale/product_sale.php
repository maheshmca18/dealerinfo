<?php
class ControllerSaleProductSale extends Controller {
    public function index()
    {
        // load language
        $this->language->load('sale/product_sale');
        $this->document->setTitle($this->language->get('heading_title'));
        // load model and other functionalities
        $this->load->model('sale/order');
 	
	$this->load->model('extension/extension');
        $installed_name = $this->model_extension_extension->getInstalledCheck('module','dashboard_chart');
        if($installed_name == 'dashboard_chart'){
            $this->getList();
        }else{
            echo "Extension not installed!";
        }
    }
    protected function getList(){
        //$this->load->model('sale/order');
        $data['entry_product_category'] = $this->language->get('entry_product_category');
        $data['text_list'] = $this->language->get('text_list');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['heading_title'] = $this->language->get('heading_title');
        $data['text_product_sale'] = $this->language->get('text_product_sale');
        $data['entry_date_added'] = $this->language->get('entry_date_added');
        $data['entry_date_added'] = $this->language->get('entry_date_added');
        $data['entry_date_modified'] = $this->language->get('entry_date_modified');
        $data['entry_product_name'] = $this->language->get('entry_product_name');
        $data['entry_product_id'] = $this->language->get('entry_product_id');
        $data['entry_total_quantity'] = $this->language->get('entry_total_quantity');
        $data['entry_orders'] = $this->language->get('entry_orders');
        $data['entry_category_id'] = $this->language->get('entry_category_id');
        $data['entry_category_name'] = $this->language->get('entry_category_name');
        $data['text_no_results'] = $this->language->get('text_no_results');
        $data['button_cancel'] = "Back";
        $data['button_export'] = "Export CSV";
        $data['button_export_link'] = $this->url->link("sale/product_sale/dataExport", 'token='.$this->session->data['token'], 'SSL');
        // get order_status
        $status_where = 'where language_id = '.$this->config->get('config_language_id').' order by order_status_id asc';
        $get_status = $this->model_sale_order->getOrderStatus($status_where);
        foreach ($get_status as $result) {
            $data['order_status'][] = array(
                'orderstatusid'      => $result['order_status_id'],
                'ordername'      => $result['name'],
            );
        }
        // get product_details
        $category_where = 'where language_id = '.$this->config->get('config_language_id').' order by category_id asc';
        $get_category = $this->model_sale_order->getProductCategory($category_where);
        foreach ($get_category as $result) {
            $data['category_details'][] = array(
                'categoryid'      => $result['category_id'],
                'name'      => $result['name'],
            );
        }
        //get total records by join
        // pagination
        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }
        $data['def_selected_start_date'] = date('d-m-Y', strtotime('last year'));
        $data['def_selected_end_date'] = date('d-m-Y');
        $start_date = date('Y-m-d',strtotime($data['def_selected_start_date']));
        $end_date = date('Y-m-d',strtotime($data['def_selected_end_date']));
        $pagination_where = "where CAST(ord.date_added as DATE) between "."'$start_date'"." AND "."'$end_date'"." GROUP BY opr.product_id ORDER BY tot_quantity DESC ";
        // set query to session for data export
        $this->session->data['where_query'] = $pagination_where;
        $total_product_sales = $this->model_sale_order->getAllProductSaleDetails($pagination_where);
        $details_where = "where CAST(ord.date_added as DATE) between "."'$start_date'"." AND "."'$end_date'"." GROUP BY opr.product_id ORDER BY tot_quantity DESC LIMIT ". ($page - 1) * $this->config->get('config_limit_admin').','.$this->config->get('config_limit_admin');
        $product_sales = $this->model_sale_order->getAllProductSaleDetails($details_where);
        if(!empty($product_sales)){
            foreach ($product_sales as $result) {
                $data['product_sales'][] = array(
                    //'categoryid'      => $result['category_id'],
                    'product_name'      => $result['name'],
                    //'productid'      => $result['product_id'],
                    'totquantity'      => $result['tot_quantity'],
                    'total_orders'      => $result['total_orders'],
                    'categoryname'      => $result['cat_name'],
                );
            }
        }else{
            $data['product_sales'] = '';
        }
        $data['final_record'] = ceil(count($total_product_sales) / $this->config->get('config_limit_admin'));
        $data['limit_record'] = $this->config->get('config_limit_admin');
        $data['cancel'] = $this->url->link('common/dashboard', 'token=' . $this->session->data['token'] , 'SSL');
        $url = '';
        $data['breadcrumbs'] = array();
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
        );
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('sale/product_sale', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );
        // load design layout
        $this->load->model('design/layout');
        $data['layouts'] = $this->model_design_layout->getLayouts();
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        $this->response->setOutput($this->load->view('sale/product_sale.tpl',$data));
    } // eo index
    // to process alll ajax in this controller
    public function ajaxProcess(){
        // load model
        $this->load->model('sale/order');
        //get total records by join
        // pagination
        if (isset($_POST['current_record'])) {
            $page = $_POST['current_record'];
        } else {
            $page = 1;
        }
        // for sorting
        if(isset($_GET['sort'])){
            $sort_by = 'ORDER BY '.$_GET['sort'].' ';
        }else{
            $sort_by = 'ORDER BY tot_quantity ';
        }
        // for order
        if(isset($_GET['order'])){
            $order_by = $_GET['order'];
        }else{
            $order_by = 'DESC';
        }
        $start_date = date('Y-m-d',strtotime($_POST['start_date']));
        $end_date = date('Y-m-d',strtotime($_POST['end_date']));
        $productCategory = ($_POST['product-category'] == "All") ? '' : 'cad.category_id ='.$_POST['product-category'].' AND';
        $dateAdded = 'CAST(ord.date_added as DATE) between'."'$start_date'".'AND '."'$end_date'";
        $productSaleStatus = ($_POST['product_sale_status'] == "All") ? '' :  'AND ord.order_status_id in('.$_POST['product_sale_status'].')';
        $pagination_where = 'where '.$productCategory.' '.$dateAdded.' '.$productSaleStatus.' GROUP BY opr.product_id '.$sort_by.$order_by;
        $total_product_sales = $this->model_sale_order->getAllProductSaleDetails($pagination_where);
        // set query to session for data export
        $this->session->data['where_query'] = $pagination_where;
        $details_where = 'where '.$productCategory.' '.$dateAdded.' '.$productSaleStatus.' GROUP BY opr.product_id '.$sort_by.$order_by.' LIMIT '. ($page - 1) * $this->config->get('config_limit_admin').','.$this->config->get('config_limit_admin');
        $product_sales = $this->model_sale_order->getAllProductSaleDetails($details_where);
        $returnData = array();
        if(!empty($product_sales)){
            $returnData['status'] = 'success';
            $returnData['records'] = $product_sales;
            $returnData['totals'] = count($total_product_sales);
        }else{
            $returnData['status'] = 'failed';
        } // eo else
        print json_encode($returnData);
    } // eo ajaxprocess function

    public function dataExport(){
        $this->load->model('sale/order');
        $total_product_sales = $this->model_sale_order->getAllProductSaleDetails($this->session->data['where_query']);
        $headerarray = array ( 'name' => "Product Name", "cat_name" => "Category Name", "tot_quantity" => "Total Quantity", "total_orders" => "Total Orders") ;
        array_unshift($total_product_sales,$headerarray);
        $fichier = 'productsale-'.date('d-M-Y_H_i_s').'.csv';
        header( "Content-Type: text/csv;charset=utf-8" );
        header( "Content-Disposition: attachment;filename=\"$fichier\"" );
        header("Pragma: no-cache");
        header("Expires: 0");
        $fp= fopen('php://output', 'w');
        foreach ($total_product_sales as $fields)
        {
            fputcsv($fp, $fields);
        }
        fclose($fp);
        exit();
    } // eo function
}// eo class

