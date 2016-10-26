<?php
class ControllerModuleComboOfferm extends Controller {
	public function index($setting) {
		$comboofferenable_status = $this->config->get('combooffer_status');
		if(isset($comboofferenable_status)) {
			static $module = 0;
			$this->load->language('module/combo_offerm');

			$data['heading_title'] = $this->language->get('heading_title');

			$data['text_tax'] = $this->language->get('text_tax');

			$data['comboprice'] = $this->language->get('comboprice');
			$data['saveamount'] = $this->language->get('saveamount');

			$data['button_cart'] = $this->language->get('button_cart');
			$data['button_wishlist'] = $this->language->get('button_wishlist');
			$data['button_compare'] = $this->language->get('button_compare');
			$data['cart_url'] = $this->url->link('checkout/cart');

			$this->load->model('catalog/product');
			$this->load->model('design/layout');
			$this->load->model('module/combo_offerm');
			$this->load->model('tool/image');

			// get layout details start here
			if (isset($this->request->get['route'])) {
				$route = (string)$this->request->get['route'];
			} else {
				$route = 'common/home';
			}
			$layout_id = 0;

			if (!$layout_id) {
				$layout_id = $this->model_design_layout->getLayout($route);
			}

			if (!$layout_id) {
				$layout_id = $this->config->get('config_layout_id');
			}
			$modules = $this->model_module_combo_offerm->getLayoutModules($layout_id, 'combo_offerm');

			if ("column_right" == $modules || "column_left" == $modules) {
				$productlimit = 1;
			}
			if ("content_top" == $modules || "content_bottom" == $modules) {
				$productlimit = 4;
			}
			$data['limit'] = $productlimit;
			$data['carousel_status'] = $setting['carousel_status'];

			// get layout details end here
			$data['products'] = array();

			if (!$setting['limit']) {
				$setting['limit'] = 4;
			}
			$products = '';
			if (isset($this->request->get['product_id'])) {

				$product_iddetails = (int)$this->request->get['product_id'];

				$products = $this->model_module_combo_offerm->getcomboofferproductbase($product_iddetails);

			} elseif (isset($this->request->get['path'])) {
				$parts = explode('_', (string)$this->request->get['path']);

				$category_id = (int)array_pop($parts);
				echo $category_id;
				$products = $this->model_module_combo_offerm->getcombooffercategorybase($category_id);

			}
			if (empty($products)) {
				$products = array_slice($setting['product'], 0, (int)$setting['limit']);

			}

			if (isset($products)) {
				$productsdetail = array();
				$temp = 0;

				foreach ($products as $combo_id) {
					$combo_info = $this->model_module_combo_offerm->getComboofferdetails($combo_id);

					if (isset($combo_info['c_product'])) {
						$product_details = $this->model_module_combo_offerm->getProduct($combo_info['c_product']);
						$productsdetail[$temp]['c_name'] = $combo_info['c_name'];
						$productsdetail[$temp]['combo_product_id'] = $combo_info['c_product'];
						$i = 0;
						$plussymbol = '';
						$combo_price = 0;
						if ($product_details) {
							foreach ($product_details as $product_info) {
								if ($product_info['image']) {
									$image = $this->model_tool_image->resize($product_info['image'], $setting['width'], $setting['height']);
								} else {
									$image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
								}

								if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
									$price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);

									$combo_price = $combo_price + $this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax'));

								} else {
									$price = false;
								}

								if ((float)$product_info['special']) {

									$special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);

									$combo_price = $combo_price - $this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax'), $this->session->data['currency']);
									$combo_price = $combo_price + $this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax'), $this->session->data['currency']);

								} else {
									$special = false;
								}

								if ($this->config->get('config_tax')) {
									$tax = $this->currency->format((float)$product_info['special'] ? $product_info['special'] : $product_info['price'], $this->session->data['currency']);
								} else {
									$tax = false;
								}

								if ($this->config->get('config_review_status')) {
									$rating = $product_info['rating'];
								} else {
									$rating = false;
								}
								if ($i != 0) {
									$plussymbol = '+';
								}
								if (!$special) {

								} else {
									$combo_price = $combo_price + $special;
								}

								$productsdetail[$temp]['product_details'][] = array(
									'product_id' => $product_info['product_id'],
									'thumb' => $image,
									'name' => $product_info['name'],
									'description' => utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
									'price' => $price,
									'special' => $special,
									'tax' => $tax,
									'rating' => $rating,
									'plussymbol' => $plussymbol,
									'href' => $this->url->link('product/product', 'product_id=' . $product_info['product_id'])
								);
								$i++;
							}

						}
						$combo_price = $combo_price - $combo_info['c_discount_amount'];
						$combo_price = $this->currency->format($combo_price, $this->session->data['currency']);
						$productsdetail[$temp]['combo_price'] = $combo_price;
						$productsdetail[$temp]['discountamount'] = $this->currency->format($combo_info['c_discount_amount'], $this->session->data['currency']);
						$productsdetail[$temp]['combo_pro_id'] = str_replace(",", "_", $combo_info['c_product']);
						$temp++;
					}
				}
			}
			$data['products'] = $productsdetail;
			$data['modules'] = $module++;
			if ($data['products']) {
				/*if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/combo_offerm.tpl')) {
					return $this->load->view($this->config->get('config_template') . '/template/module/combo_offerm.tpl', $data);
				} else {
					return $this->load->view('default/template/module/combo_offerm.tpl', $data);
				}*/

				return $this->load->view('module/combo_offerm', $data);
			}
		}
	}

	public function comboofferlist() {
		$comboofferenable_status = $this->config->get('combooffer_status');
		if(isset($comboofferenable_status)) {
			$this->load->language('module/combo_offerm');

			$data['heading_title'] = $this->language->get('heading_title');
			$data['text_tax'] = $this->language->get('text_tax');
			$data['comboprice'] = $this->language->get('comboprice');
			$data['saveamount'] = $this->language->get('saveamount');
			$data['button_cart'] = $this->language->get('button_cart');
			$data['button_wishlist'] = $this->language->get('button_wishlist');
			$data['button_compare'] = $this->language->get('button_compare');
			$data['text_select'] = $this->language->get('text_select');
			$data['button_upload'] = $this->language->get('button_upload');
			$data['cart_url'] = $this->url->link('checkout/cart');

			$this->load->model('catalog/product');
			$this->load->model('module/combo_offerm');
			$this->load->model('tool/image');

			$data['products'] = array();
			$productsdetail = array();
			$combo_offerdetails = $this->model_module_combo_offerm->getcombooffer();

			if (!empty($combo_offerdetails)) {

				$temp = 0;
				foreach ($combo_offerdetails as $combo_info) {
					$product_details = $this->model_module_combo_offerm->getProduct($combo_info['c_product']);
					$productsdetail[$temp]['c_name'] = $combo_info['c_name'];
					$productsdetail[$temp]['combo_product_id'] = $combo_info['c_product'];
					$i = 0;
					$plussymbol = '';
					$combo_price = 0;
					if ($product_details) {
						foreach ($product_details as $product_info) {
							if ($product_info['image']) {
								$image = $this->model_tool_image->resize($product_info['image'], 100, 100);
							} else {
								$image = $this->model_tool_image->resize('placeholder.png', 100, 100);
							}

							if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
								$price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);

								$combo_price = $combo_price + $this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax'));

							} else {
								$price = false;
							}

							if ((float)$product_info['special']) {

								$special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);

								$combo_price = $combo_price - $this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax'));
								$combo_price = $combo_price + $this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax'));

							} else {
								$special = false;
							}

							if ($this->config->get('config_tax')) {
								$tax = $this->currency->format((float)$product_info['special'] ? $product_info['special'] : $product_info['price'], $this->session->data['currency']);
							} else {
								$tax = false;
							}

							if ($this->config->get('config_review_status')) {
								$rating = $product_info['rating'];
							} else {
								$rating = false;
							}
							if ($i != 0) {
								$plussymbol = '+';
							}
							if (!$special) {

							} else {
								$combo_price = $combo_price + $special;
							}

							$productsdetail[$temp]['product_details'][] = array(
								'product_id' => $product_info['product_id'],
								'thumb' => $image,
								'name' => $product_info['name'],
								'description' => utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
								'price' => $price,
								'special' => $special,
								'tax' => $tax,
								'rating' => $rating,
								'plussymbol' => $plussymbol,
								'href' => $this->url->link('product/product', 'product_id=' . $product_info['product_id'])
							);
$this->document->setTitle($product_info['meta_title']);
			$this->document->setDescription($product_info['meta_description']);
			$this->document->setKeywords($product_info['meta_keyword']);

							$i++;
						}

					}
					$combo_price = $combo_price - $combo_info['c_discount_amount'];

					$combo_price = $this->currency->format($combo_price, $this->session->data['currency']);
					$productsdetail[$temp]['combo_price'] = $combo_price;
					$productsdetail[$temp]['combo_pro_id'] = str_replace(",", "_", $combo_info['c_product']);
					$productsdetail[$temp]['discountamount'] = $this->currency->format($combo_info['c_discount_amount'], $this->session->data['currency']);
					$temp++;
				}
			}
			$data['products'] = $productsdetail;

			

			$this->document->addScript('catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js');
			$this->document->addStyle('catalog/view/javascript/jquery/magnific/magnific-popup.css');
			$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment.js');
			$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js');
			$this->document->addStyle('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css');


			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');


			/*if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/combo_offer_list.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/module/combo_offer_list.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/module/combo_offer_list.tpl', $data));
			}*/
		$this->response->setOutput($this->load->view('module/combo_offer_list', $data));
		}
	}
	public function add() {
		$cartis=explode("_",$this->request->post['proid']);
		$this->load->model('catalog/product');

		$json = array();

		foreach($cartis as $proid){
			$product_info = $this->model_catalog_product->getProduct($proid);
			if ($product_info) {

				$product_options = $this->model_catalog_product->getProductOptions($proid);

				foreach ($product_options as $product_option) {
					if ($product_option['required'] && empty($option[$product_option['product_option_id']])) {
						$json['error']['option'][$product_option['product_option_id']] = sprintf($this->language->get('error_required'), $product_option['name']);
					}
				}

			} //if end

		} //for loop end
		if (!$json) {

			foreach($cartis as $proid){
				$this->cart->add($proid, 1, array(), "");

			} //for loop end

			$json['combo_id'] = $this->request->post['proid'];
			$json['success'] = 1;
		}else{
			$json['option'] = $this->getoption($_POST['proid']);
		}
		$this->response->setOutput(json_encode($json));

	} //function end

	public function getoption($product_id){
		$comboofferenable_status = $this->config->get('combooffer_status');
		if(isset($comboofferenable_status)) {
			$this->load->language('module/combo_offerm');
			$data['text_select'] = $this->language->get('text_select');
			$data['button_upload'] = $this->language->get('button_upload');
			$data['button_cart'] = $this->language->get('button_cart');
			$data['combo_id'] = $product_id;
			$data['cart_url'] = $this->url->link('checkout/cart');
			$data['text_loading'] = $this->language->get('text_loading');
			$data['option_title'] = $this->language->get('option_title');
			$TotalPrice = 0;
			$this->load->model('module/combo_offerm');
			$this->load->model('tool/image');
			$this->load->model("catalog/product");
			$product_id = explode("_", $product_id);

			foreach ($product_id as $id) {
				$product_info = $this->model_catalog_product->getProduct($id);

				if ($product_info['image']) {
					$image = $this->model_tool_image->resize($product_info['image'], 80, 80);
				} else {
					$image = false;
				}
				if ($this->config->get('config_review_status')) {
					$rating = (int)$product_info['rating'];
				} else {
					$rating = false;
				}

				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
				} else {
					$price = false;
				}

				if ((float)$product_info['special']) {
					$special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
					$TotalPrice += $this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax'));
				} else {
					$TotalPrice += $this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax'));
					$special = false;
				}
				$product_options = $this->model_module_combo_offerm->getProductOptions($product_info['product_id']);

				$data['product_details'][] = array(
					'product_id' => $product_info['product_id'],
					'thumb' => $image,
					'name' => $product_info['name'],
					'price' => $price,
					'special' => $special,
					'rating' => $rating,
					'reviews' => sprintf($this->language->get('text_reviews'), (int)$product_info['reviews']),
					'href' => $this->url->link('product/product', 'product_id=' . $product_info['product_id']),
					'product_option' => $product_options
				);

			}
	/*if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/combo_offer_list_option.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/module/combo_offer_list_option.tpl', $data);

			} else { 
				return $this->load->view('default/template/module/combo_offer_list_option.tpl', $data);
			}*/
	return $this->load->view('module/combo_offer_list_option', $data);
		}
	}
	public function addcartoption(){

		$produtcoptiondetails=$this->request->post;
		$cartis=explode("_",$produtcoptiondetails['proid']);

		if($produtcoptiondetails['option']) {
			$option = $produtcoptiondetails['option'];
		}

		$this->load->model('catalog/product');

		$json = array();

		foreach($cartis as $proid=>$product_id) {
			$product_optioninfo = $this->model_catalog_product->getProductOptions($product_id);
			foreach($product_optioninfo as $product_option){
				if($product_option['required'] && empty($option[$proid][$product_option['product_option_id']]) ){
					if (empty($json['error']['option'][$product_option['product_option_id']])) {
						$json['error']['option'][$product_option['product_option_id']] = array();
					}
					$json['error']['option'][$product_option['product_option_id']][] = array(
						'message' => sprintf("File the required details", $product_option['name']),
						'key' 	 => $proid
					);
				}

			}

		}
		if (!$json) {
			foreach ($cartis as $key=>$p) {
				$p_option = $p_option = !empty($option[$key]) ? $option[$key] : array();
				$this->cart->add($p, 1, $p_option, "");
			}
			$json['combo_id'] = $produtcoptiondetails['proid'];
			$json['success'] = "1";
		}
		$this->response->setOutput(json_encode($json));

	}

}
