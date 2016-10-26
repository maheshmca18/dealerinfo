<?php
class ControllerLocalisationProductshipping extends Controller {
	private $error = array();

	public function index() { 
		$this->load->language('localisation/productshipping');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/productshipping');

                $this->getList();

       	}

        public function add() { 

		$this->load->language('localisation/productshipping');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/productshipping');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {    
                        $this->model_localisation_productshipping->addproductshipping($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('localisation/productshipping', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('localisation/productshipping');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/productshipping');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->editvalidateForm()) {
			//echo 111; print_r($this->request->post);exit;
			$this->model_localisation_productshipping->editproductshipping($this->request->get['product_basedshipping_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('localisation/productshipping', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('localisation/productshipping');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/productshipping');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $deliverytime_id) {
				$this->model_localisation_productshipping->deleteproductshipping($deliverytime_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('localisation/productshipping', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getList();
	}

	protected function getList() { 
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'name';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('localisation/productshipping', 'token=' . $this->session->data['token'] . $url, true)
		);
		
		$data['add'] = $this->url->link('localisation/productshipping/add', 'token=' . $this->session->data['token'] . $url, true);
		$data['delete'] = $this->url->link('localisation/productshipping/delete', 'token=' . $this->session->data['token'] . $url, true);

		$data['productshipping_arrays'] = array();

		$filter_data = array(
			'title'  => $sort,
			'status' => ($page - 1) * $this->config->get('config_limit_admin')			

		);

            $records_total = $this->model_localisation_productshipping->getTotalrecords();     

            $results = $this->model_localisation_productshipping->getzones($filter_data);

            foreach ($results as $result) {
			$data['productshipping_arrays'][] = array(                
				'product_basedshipping_id' => $result['product_basedshipping_id'],
				'zone_name'  => $result['zone_name'],
				'status'  => $result['status'],
				'edit'        => $this->url->link('localisation/productshipping/edit', 'token=' . $this->session->data['token'] . '&product_basedshipping_id=' . $result['product_basedshipping_id'] . $url, 'SSL')
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_name'] = $this->language->get('column_name');
		$data['column_code'] = $this->language->get('column_code');
		$data['column_sort_order'] = $this->language->get('column_sort_order');
		$data['column_action'] = $this->language->get('column_action');

		$data['text_addtimeslot'] = $this->language->get('text_addtimeslot');
		$data['text_timeslot_title'] = $this->language->get('text_timeslot_title');
		$data['text_timeslot_status'] = $this->language->get('text_timeslot_status');

		$data['text_createdon'] = $this->language->get('text_createdon');
		$data['text_lasteditedon'] = $this->language->get('text_lasteditedon');

		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_name'] = $this->url->link('localisation/productshipping', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
		$data['sort_code'] = $this->url->link('localisation/productshipping', 'token=' . $this->session->data['token'] . '&sort=code' . $url, 'SSL');
		$data['sort_sort_order'] = $this->url->link('localisation/productshipping', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $records_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('localisation/productshipping', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		
		$data['sort'] = $sort;
		$data['order'] = $order;
         
        $data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('localisation/productshipping_list.tpl', $data));       

    }	

	protected function getForm()
	{	
		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_form'] = !isset($this->request->get['language_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_addtimeslot'] = $this->language->get('text_addtimeslot');

		$data['text_timeslot_title'] = $this->language->get('text_timeslot_title');
		$data['text_timeslot_status'] = $this->language->get('text_timeslot_status');
		$data['text_isrecursive'] = $this->language->get('text_isrecursive');
		$data['text_createdon'] = $this->language->get('text_createdon');
		$data['text_lasteditedon'] = $this->language->get('text_lasteditedon');
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_code'] = $this->language->get('entry_code');
		$data['entry_locale'] = $this->language->get('entry_locale');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_directory'] = $this->language->get('entry_directory');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['text_add'] = $this->language->get('text_add');
		$data['text_edit'] = $this->language->get('text_edit');

		$data['help_code'] = $this->language->get('help_code');
		$data['help_locale'] = $this->language->get('help_locale');
		$data['help_image'] = $this->language->get('help_image');
		$data['help_directory'] = $this->language->get('help_directory');
		$data['help_status'] = $this->language->get('help_status');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}

		if (isset($this->error['date'])) {
			$data['error_date'] = $this->error['date'];
		} else {
			$data['error_date'] = '';
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		if (isset($this->error['error_zone_name'])) {
            $data['error_zonename'] = $this->error['error_zone_name'];
        } else {
            $data['error_zonename'] = '';
        }
        
      /*  if (isset($this->error['error_zonename_exist'])) {
            $data['error_zonenameexist'] = $this->error['error_zonename_exist'];
        } else {
            $data['error_zonenameexist'] = '';
        }*/

		$data['error_zonenameexist'] = '';
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('localisation/productshipping', 'token=' . $this->session->data['token'] . $url, true)
		);

		if (!isset($this->request->get['product_basedshipping_id'])) {
			$data['action'] = $this->url->link('localisation/productshipping/add', 'token=' . $this->session->data['token'] . $url, true);
		} else {
			$data['action'] = $this->url->link('localisation/productshipping/edit', 'token=' . $this->session->data['token'] . '&product_basedshipping_id=' . $this->request->get['product_basedshipping_id'] . $url, true);
		}

		$data['cancel'] = $this->url->link('localisation/productshipping', 'token=' . $this->session->data['token'] . $url, true);

		if (isset($this->request->get['product_basedshipping_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$shipping_info = $this->model_localisation_productshipping->getzone($this->request->get['product_basedshipping_id']);
		}

		$data['token'] = $this->session->data['token'];
		
		//import
		$data['button_import'] = "Import";
		
		if(isset($this->request->get['product_basedshipping_id'])){
        $data['import'] = $this->url->link('localisation/productshipping/import','product_basedshipping_id='.$this->request->get['product_basedshipping_id']. '&token=' . $this->session->data['token'] . $url, true);
	    }
	    else{
	    $data['import'] = $this->url->link('localisation/productshipping/import','token=' . $this->session->data['token'] . $url, true);
	}
        //import

		if (isset($this->request->post['zone_name'])) {			
			$data['zone_name'] = $this->request->post['zone_name'];
		} elseif (!empty($shipping_info)) {
			$data['zone_name'] = $shipping_info['zone_name'];
		} else {
			$data['zone_name'] = '';
		}

		if (isset($this->request->post['product_basedshipping_id'])) {
			$data['product_basedshipping_id'] = $this->request->post['product_basedshipping_id'];
		} elseif (!empty($shipping_info)) {
			$data['product_basedshipping_id'] = $shipping_info['product_basedshipping_id'];
		} else {
			$data['product_basedshipping_id'] = '';
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($shipping_info)) {
			$data['status'] = $shipping_info['status'];
		} else {
			$data['status'] = 1;
		}

		$location_infos = "";
		$data['zonelocation_arrays'] = array();
		
		if (isset($this->request->get['product_basedshipping_id'])) {
			$location_infos = $this->model_localisation_productshipping->getlocationinfo($this->request->get['product_basedshipping_id']);
		}
		
		if ($location_infos) {
			foreach ($location_infos as $location_info) {
				$data['zonelocation_arrays'][] = array(
					'product_basedshipping_id' => $location_info['product_basedshipping_id'],
					'zone_id' => $location_info['zone_id'],
					'zone_location' => $location_info['zone_location'],
					'postcode' => $location_info['postcode']
				);
			}
	    }
	    
		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

       
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');


		$this->response->setOutput($this->load->view('localisation/productshipping_form.tpl', $data));
		

    }   
  
//******************************
public function import() {     	
   
		//$data['product_basedshipping_id'] = $this->request->get['product_basedshipping_id'];
   
        $excel_field_error = 0;
		
        $_SESSION['zonearraylist']=array();

        $this->load->language('localisation/productshipping');
        //$this->load->model('sale/order');

        $data['heading_title'] = "Import Zonelocations Data";

        $data['entry_import'] = $this->language->get('Upload CSV File');

        $data['entry_insertonly'] = $this->language->get('Insert Only');

        $data['action'] = $this->url->link('localisation/productshipping/import','product_basedshipping_id='.$this->request->get['product_basedshipping_id']. '&token=' . $this->session->data['token'], true);
		
        $data['importdataurl'] = $this->url->link('localisation/productshipping/importzones', 'token=' . $this->session->data['token'], true);
        $data['sampleexport'] = $this->url->link('localisation/productshipping/customersampleexport', 'token=' . $this->session->data['token'], true);
        $data['sample_export'] = $this->language->get('Sample Csv File');

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], true),
            'separator' => false
        );

        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('localisation/productshipping', 'token=' . $this->session->data['token'], true),
            'separator' => ' :: '
        );


        if(isset($_POST['submit']))
        {		
        		
            $insertonly=0;

            if(isset($_POST['insertonly']) && $_POST['insertonly']==1)
                $insertonly=1;

            if($this->validateImport())
            {  // import form validate start

                if ((isset($this->request->files['file'])) && (is_uploaded_file($this->request->files['file']['tmp_name'])))
                { //file upload start                   
			            
			        @set_time_limit(3600);
                    if (substr(@ini_get("memory_limit"), 0, -1) < "512") {
                        @ini_set("memory_limit", "512M");
                    }
                    ini_set("memory_limit", "512M");
                    ini_set("max_execution_time", 180);
                    ini_set('display_errors', 1);
                    ini_set('log_errors', 1);
                    error_reporting(E_ALL);
                    //set_time_limit( 60 );

                    $filename = $this->request->files['file']['tmp_name'];

                    //chdir('../system/library/PHPExcel'); // change directory to PHPExcel library
                    //require_once( 'Classes/PHPExcel.php' );
                    //chdir('../../../admin');

                    require_once('../system/library/PHPExcel/Classes/PHPExcel.php' );

                    $inputFileType = PHPExcel_IOFactory::identify($filename);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    //$objReader->setReadDataOnly(true);
                    $reader = $objReader->load($filename);
                    $reader = &$reader;
                    //$this->clearCache();

                    $xldata = $reader->getSheet(0);

                    $isFirstRow = TRUE;

                    $i = 0;

                    $temp=0;//declared
                    $b=0;//declared
                    $temp_add=0;
                    
                   

                    $k = $xldata->getHighestRow();
					
                    $customer_array = array();
				    $customer_array_add=array();
					
                    $columns = PHPExcel_Cell::columnIndexFromString($xldata->getHighestColumn());

                    if($columns == 2)
                    {
                        for ($i = 0; $i < $k; $i++) {  // Excel row loop start
                            //Skip the header row
                            if ($isFirstRow) {
                                $isFirstRow = FALSE;
                                continue;
                            }

                            $zone_location = $this->getCell($xldata, $i, 1);
                            $postcode = $this->getCell($xldata, $i, 2);                            
                            $product_basedshipping_id = $this->request->get['product_basedshipping_id'];
							if($zone_location!==''){
								$temp++;
								$temp_add=0;
								$customer_array[$temp]['zone_location'] = $zone_location;
                                $customer_array[$temp]['postcode'] = $postcode;                               
                                $customer_array[$temp]['product_basedshipping_id'] = $product_basedshipping_id; 
								}
								else{
								$temp_add++;
								$customer_array_add[$temp_add]['zone_location'] = $zone_location;
								$customer_array_add[$temp_add]['postcode'] = $postcode;	
								$customer_array[$temp_add]['product_basedshipping_id'] = $product_basedshipping_id; 							
								}							   
                     
                            } // Excel row loop end                          
                        $order_list_data=$customer_array;

                    }
                    else
                    {
                        $excel_field_error = 1;
                    }					
                                      
                } //file upload end

                if(!$excel_field_error)
                {

                    $data['sampletabledata']= $order_list_data;

                    $_SESSION['zonearraylist'] = $order_list_data;
                }

            } // import form validate end

       
        }
        
        
        
        
         $data['getzonename_validations']=array();
         
		 $this->load->model('localisation/productshipping'); 
		  
		 $getzonename_validations = $this->model_localisation_productshipping->getZonevalidationlist($this->request->get['product_basedshipping_id']);	
		
		if ($getzonename_validations) {
			foreach ($getzonename_validations as $getzonename_validation) {
				$data['getzonename_validations'][] = array(
					'product_basedshipping_id' => $getzonename_validation['product_basedshipping_id'],
					'zone_id' => $getzonename_validation['zone_id'],
					'zone_location' => $getzonename_validation['zone_location'],
					'postcode' => $getzonename_validation['postcode']
				);
			}
	    }	  
				
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['errorfile'])) {
            $data['error_file'] = $this->error['errorfile'];
        } else {
            $data['error_file'] = '';
        }
	
        if($excel_field_error)
        {
            $data['error_fields'] = 'Upload like our Sample Excel File';
        }
        else
        {
            $data['error_fields'] = '';
        }

        /* $this->load->model('design/layout');
       $data['layouts']=$this->model_design_layout->getLayouts();*/

        $data['header']=$this->load->controller('common/header');
        $data['footer']=$this->load->controller('common/footer');
        $data['column_left']=$this->load->controller('common/column_left');

        $this->response->setOutput($this->load->view('localisation/zones_import.tpl',$data));

    }



    public function importzones(){
		//print_r($_SESSION['zonearraylist']);exit;
		 $this->load->model('localisation/productshipping');  
						    
	     foreach($_SESSION['zonearraylist'] as $data) {				

			$impot_zones_values = $this->model_localisation_productshipping->addzonesdetail($data);	
		
	     }

        unset($_SESSION['zonearraylist']);
        $url = '';
        $this->response->redirect($this->url->link('localisation/productshipping', 'token=' . $this->session->data['token'] . $url, true));
    }

    function getCell(&$worksheet, $row, $col, $default_val = '') {
        $col -= 1; // we use 1-based, PHPExcel uses 0-based column index
        $row += 1; // we use 0-based, PHPExcel used 1-based row index
        return ($worksheet->cellExistsByColumnAndRow($col, $row)) ? $worksheet->getCellByColumnAndRow($col, $row)->getValue() : $default_val;
    }

    public function customersampleexport()
    {
        /* Include PHPExcel class */
        //chdir('../system/library/PHPExcel');
        //require_once( 'Classes/PHPExcel.php' );
        //chdir('../../../admin');

        require_once('../system/library/PHPExcel/Classes/PHPExcel.php' );

        // Instantiate a new PHPExcel object
        $objPHPExcel = new PHPExcel();
        // Set the active Excel worksheet to sheet 0
        $objPHPExcel->setActiveSheetIndex(0);
        // Initialise the Excel row number
        $rowCount = 1;
		
       //customer field
        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, 'Zone ');
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, 'Zone Postcode');     
        //voucher

        header("Content-Type: text/csv; charset=utf-8");
        header('Content-Disposition: attachment;filename="zoneslocations_list_'.date("Y m d G i s").'.csv"');
        //header('Content-Disposition: attachment;filename="category_list_'.date("Y m d G i s").'.xlsx"');
        header('Cache-Control: max-age=0');

        // Instantiate a Writer to create an OfficeOpenXML Excel .xlsx file
        //$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'CSV');
        // Write the Excel file to filename some_excel_file.xlsx in the current directory
        //$objWriter->save('some_excel_file.xlsx');

        /* Download CsV file in downloads */
        $objWriter->save('php://output');

//        chdir('../../..');
    }
    protected function validateImport() {
       
        if (!$this->request->files['file']['tmp_name']) {
            $this->error['errorfile'] = $this->language->get('Please Upload a Excel/CSV file');
        }
        elseif($_FILES["file"]["name"])
        {
            $allowedExts = array("csv", "xlsx", "xls");
            $temp = explode(".", $_FILES["file"]["name"]);
            $extension = end($temp);

            if(!in_array($extension, $allowedExts))
                $this->error['errorfile'] = $this->language->get('Please Upload a Excel/CSV file');
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }
    //*******************
	public function ajaxupdateurl(){
		
		$this->load->model('localisation/productshipping');
		
		$data_insert_or_exist = $this->model_localisation_productshipping->getvalidationlocation($this->request->post);

	
		if($data_insert_or_exist=="true"){
			
		$data=$this->model_localisation_productshipping->ajaxeditproductshipping($this->request->post);
		}		
		else{
			
			$data = "This location or postcode already exists";
			
		}
		  $this->response->addHeader('Content-Type: application/json');
          $this->response->setOutput(json_encode($data));
     }
	public function ajaxdelete(){

		$this->load->model('localisation/productshipping');
		$data=$this->model_localisation_productshipping->ajaxdeletezone($this->request->post['locationid']);

	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'localisation/productshipping')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		$this->load->model('localisation/productshipping');
		$datas = $this->model_localisation_productshipping->getvalidationzonename($this->request->post['zone_name']);
		
		if($datas){
			$this->error['error_zone_name']=" This zonename is already exists ";
		}	
										
		if(!$this->request->post['zone_name'])
        {
            $this->error['error_zone_name']=" Please enter zonename ";
        }

		return !$this->error;
	}
	protected function editvalidateForm() {
		if (!$this->user->hasPermission('modify', 'localisation/productshipping')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		$this->load->model('localisation/productshipping');
		/*$datas = $this->model_localisation_productshipping->getvalidationzonename($this->request->post['zone_name']);
		
		if($datas){
			$this->error['error_zone_name']=" This zonename is already exists ";
		}	*/
										
		if(!$this->request->post['zone_name'])
        {
            $this->error['error_zone_name']=" Please enter zonename ";
        }

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'localisation/productshipping')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		$this->load->model('setting/store');
		$this->load->model('localisation/productshipping');

		return !$this->error;
	}
    
}