<?php
class ControllerInformationProductofthedayTodayproducts extends Controller {
    public function index($setting) {
      
        $url='';

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('Product Of The Day'),
            'href' => $this->url->link('information/productoftheday_todayproducts')
        );

            $data['text_refine'] = $this->language->get('text_refine');
            $data['text_empty'] = $this->language->get('text_empty');
            $data['text_quantity'] = $this->language->get('text_quantity');
            $data['text_manufacturer'] = $this->language->get('text_manufacturer');
            $data['text_model'] = $this->language->get('text_model');
            $data['text_price'] = $this->language->get('text_price');
            $data['text_tax'] = $this->language->get('text_tax');
            $data['text_points'] = $this->language->get('text_points');
            $data['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));
            $data['text_sort'] = $this->language->get('text_sort');
            $data['text_limit'] = $this->language->get('text_limit');

            $data['button_cart'] = $this->language->get('button_cart');
            $data['button_wishlist'] = $this->language->get('button_wishlist');
            $data['button_compare'] = $this->language->get('button_compare');
            $data['button_continue'] = $this->language->get('button_continue');
            $data['button_list'] = $this->language->get('button_list');
            $data['button_grid'] = $this->language->get('button_grid');

            $today_day=date("l");
            $this->load->model('localisation/productoftheday');
            $getresults = $this->model_localisation_productoftheday->getid();

            foreach($getresults as $getresult) {
                if ($getresult['day'] == $today_day) {
                    $explode_product_id = explode(" ", $getresult['product_ofthe_day_id']);
                }
            }
            $this->load->model('catalog/product');

            foreach ($explode_product_id as $product_id) {

                $product_info = $this->model_catalog_product->getProduct($product_id);

                if ($product_info) {

                    $this->load->model('tool/image');

                   if ($product_info['image']) {
                        $image = $this->model_tool_image->resize($product_info['image'], $this->config->get($this->config->get('config_theme') . '_image_related_width'), $this->config->get($this->config->get('config_theme') . '_image_related_height'));
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $this->config->get($this->config->get('config_theme') . '_image_related_width'), $this->config->get($this->config->get('config_theme') . '_image_related_height'));
                    }

                     if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                         $price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
                     } else {
                         $price = false;
                     }

                     if ((float)$product_info['special']) {
                         $special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
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

                     $data['products'][] = array(
                         'product_id'  => $product_info['product_id'],
                         'thumb'       => $image,
                         'name'        => $product_info['name'],
                         'description' => utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
                         'price'       => $price,
                         'special'     => $special,
                         'tax'         => $tax,
                         'rating'      => $rating,
                         'href'        => $this->url->link('product/product', 'product_id=' . $product_info['product_id'])
                     );
                 }
             }

            $this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');
            $data['column_left'] = $this->load->controller('common/column_left');
            $data['column_right'] = $this->load->controller('common/column_right');
            $data['content_top'] = $this->load->controller('common/content_top');
            $data['content_bottom'] = $this->load->controller('common/content_bottom');
            $data['footer'] = $this->load->controller('common/footer');
            $data['header'] = $this->load->controller('common/header');

            $data['continue'] = $this->url->link('common/home');
            $data['column_left'] = $this->load->controller('common/column_left');
            $data['column_right'] = $this->load->controller('common/column_right');
            $data['content_top'] = $this->load->controller('common/content_top');
            $data['content_bottom'] = $this->load->controller('common/content_bottom');
            $data['footer'] = $this->load->controller('common/footer');
            $data['header'] = $this->load->controller('common/header');

            
                $this->response->setOutput($this->load->view('information/productoftheday_todayproducts', $data));
            

        }
}
