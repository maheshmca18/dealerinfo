<?php
class ModelExtensionShippingIrsshippingproduct extends Model {
	function getQuote($address) {

		$this->load->language('extension/shipping/irsshippingproduct');

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$this->config->get('free_geo_zone_id') . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");

		if (!$this->config->get('irsshippingproduct_geo_zone_id')) {
			$status = true;
		} elseif ($query->num_rows) {
			$status = true;
		} else {
			$status = false;
		}

		if ($this->cart->getSubTotal() < $this->config->get('irsshippingproduct_total')) {
			$status = false;
		}
//*****
if (isset($this->session->data['shipping_address']['postcode'])) {

			$quantity_total = array();

			$products = $this->cart->getProducts();

			foreach ($products as $product) {

				$product_id = $product['product_id'];

				$user_enter_postcode = $this->session->data['shipping_address']['postcode'];

				$this->load->model('checkout/order');
				$shipping_info = $this->model_checkout_order->selectProductbasedshippingid($product_id, $user_enter_postcode);
				$quantity_total[]=$shipping_info*$product['quantity'];
			}
			$product_shipping_total = "";

			foreach ($quantity_total as $shipping_amout) {
				$product_shipping_total += $shipping_amout;
			}
		}

//*****
		$method_data = array();

		if ($status) {
			$quote_data = array();

			$quote_data['irsshippingproduct'] = array(
				'code'         => 'irsshippingproduct.irsshippingproduct',
				'title'        => $this->config->get('product_based_shipping_text'),
				'cost'         => $product_shipping_total,
				'tax_class_id' => 0,
				'text'         => $this->currency->format($product_shipping_total, $this->session->data['currency'])
			);

			$method_data = array(
				'code'       => 'irsshippingproduct',
				'title'      => $this->config->get('product_based_shipping_text'),
				'quote'      => $quote_data,
				'sort_order' => $this->config->get('irsshippingproduct_sort_order'),
				'error'      => false
			);
		}
		return $method_data;
	}
}
