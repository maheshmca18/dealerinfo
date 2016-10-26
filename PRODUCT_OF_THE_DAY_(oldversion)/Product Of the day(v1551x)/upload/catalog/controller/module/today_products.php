

<?php
class ControllerModuleTodayProducts extends Controller {
    public function index($setting) {
//print_r($setting);exit;
        static $module = 0;
        $this->load->model('design/banner');
        $this->load->model('tool/image');

        $this->document->addScript('catalog/view/javascript/jquery/jquery.jcarousel.min.js');

        if (file_exists('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/carousel.css')) {
            $this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/carousel.css');
        } else {
            $this->document->addStyle('catalog/view/theme/default/stylesheet/carousel.css');
        }
        $this->data['limit'] = $setting['limit'];


        $today_day=date("l");
        $this->load->model('localisation/productoftheday');
        $getresults = $this->model_localisation_productoftheday->getid();
        foreach($getresults as $getresult) {
            if ($getresult['day'] == $today_day) {
                $explode_product_id = explode(" ", $getresult['product_ofthe_day_id']);
            }
        }
        $this->load->model('catalog/product');
//my code on product of the day

        //foreach ($products as $product_id) {
        foreach ($explode_product_id as $product_id) {
//echo $product_id;
//my code on product of the day

            $product_info = $this->model_catalog_product->getProduct($product_id);
//            print_r($product_info);exit;
            if ($product_info) {
                $this->load->model('tool/image');
                if ($product_info['image']) {
                    $image = $this->model_tool_image->resize($product_info['image'], $setting['image_width'], $setting['image_height']);
                } else {
                    $image = false;
                }

                if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                    $price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
                } else {
                    $price = false;
                }

                if ((float)$product_info['special']) {
                    $special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')));
                } else {
                    $special = false;
                }

                if ($this->config->get('config_tax')) {
                    $tax = $this->currency->format((float)$product_info['special'] ? $product_info['special'] : $product_info['price']);
                } else {
                    $tax = false;
                }

                if ($this->config->get('config_review_status')) {
                    $rating = $product_info['rating'];
                } else {
                    $rating = false;
                }

                $this->data['products'][] = array(
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
//print_r( $this->data['products']);exit;
        $this->data['button_cart'] = $this->language->get('button_cart');
        $this->data['button_wishlist'] = $this->language->get('button_wishlist');
        $this->data['button_compare'] = $this->language->get('button_compare');

        $this->data['modules'] = $module++;

        //$pageview = "horizontal";

        if($setting['position']=='content_top' || $setting['position']=="content_bottom"){
            $pageview = "horizontal";
        }
        elseif($setting['position']=='column_left' || $setting['position']=='column_right') {
            $pageview = "vertical";
        }

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/today_products_'.$pageview.'.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/module/today_products_'.$pageview.'.tpl';
        } else {
            $this->template = 'default/template/module/today_products_'.$pageview.'.tpl';
        }

        $this->render();

      /*  if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/today_products_'.$pageview.'.tpl')) {
                return $this->load->view($this->config->get('config_template') . '/template/module/today_products_'.$pageview.'.tpl', $data);
            } else {
                return $this->load->view('default/template/module/today_products_'.$pageview.'.tpl', $data);
            }*/



    }
}