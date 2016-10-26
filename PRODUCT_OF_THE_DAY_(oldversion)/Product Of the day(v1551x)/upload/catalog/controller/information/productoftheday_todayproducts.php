<?php
class ControllerInformationProductofthedayTodayproducts extends Controller {
    public function index() {
        $this->language->load('product/category');
        $url='';

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home'),
            'separator' => false
        );
        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('Product Of The Day'),
            'href' => $this->url->link('information/productoftheday_todayproducts'),
            'separator' => ' :: '
        );

            $this->data['text_refine'] = $this->language->get('text_refine');
            $this->data['text_empty'] = $this->language->get('text_empty');
            $this->data['text_quantity'] = $this->language->get('text_quantity');
            $this->data['text_manufacturer'] = $this->language->get('text_manufacturer');
            $this->data['text_model'] = $this->language->get('text_model');
            $this->data['text_price'] = $this->language->get('text_price');
            $this->data['text_tax'] = $this->language->get('text_tax');
            $this->data['text_points'] = $this->language->get('text_points');
            $this->data['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));
            $this->data['text_sort'] = $this->language->get('text_sort');
            $this->data['text_limit'] = $this->language->get('text_limit');

            $this->data['button_cart'] = $this->language->get('button_cart');
            $this->data['button_wishlist'] = $this->language->get('button_wishlist');
            $this->data['button_compare'] = $this->language->get('button_compare');
            $this->data['button_continue'] = $this->language->get('button_continue');
            $this->data['button_list'] = $this->language->get('button_list');
            $this->data['button_grid'] = $this->language->get('button_grid');

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
                        $image = $this->model_tool_image->resize($product_info['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
                    } else {
                        $image = $this->model_tool_image->resize('placeholder.png', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
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

            //$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');
          //  $this->data['column_left'] = $this->load->controller('common/column_left');
           // $this->data['column_right'] = $this->load->controller('common/column_right');
           // $this->data['content_top'] = $this->load->controller('common/content_top');
          //  $this->data['content_bottom'] = $this->load->controller('common/content_bottom');
           // $this->data['footer'] = $this->load->controller('common/footer');
           // $this->data['header'] = $this->load->controller('common/header');

           // $this->data['continue'] = $this->url->link('common/home');
          //  $this->data['column_left'] = $this->load->controller('common/column_left');
            //$this->data['column_right'] = $this->load->controller('common/column_right');
           // //$this->data['content_top'] = $this->load->controller('common/content_top');
           // $this->data['content_bottom'] = $this->load->controller('common/content_bottom');
           // $this->data['footer'] = $this->load->controller('common/footer');
           // $this->data['header'] = $this->load->controller('common/header');

        $this->data['continue'] = $this->url->link('common/home');


        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/productoftheday_todayproducts.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/information/productoftheday_todayproducts.tpl';
        } else {
            $this->template = 'default/template/information/productoftheday_todayproducts.tpl';
        }


        $this->children = array(
            'common/column_left',
            'common/column_right',
            'common/content_top',
            'common/content_bottom',
            'common/footer',
            'common/header'
        );
        $this->response->setOutput($this->render());

        /*
        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/productoftheday_todayproducts.tpl')) {
                 $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/information/productoftheday_todayproducts.tpl', $data));
             } else {
                 $this->response->setOutput($this->load->view('default/template/information/productoftheday_todayproducts.tpl', $data));
             }
        }
        */
}

}