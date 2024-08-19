<?php

if (! defined('ABSPATH')) exit;

add_action('woocommerce_thankyou', 'phpavel_generate_pdf', 10, 1);
function phpavel_generate_pdf($order_id)
{
	if (! $order_id) return;

	$data = phpavel_get_data_order($order_id);

	$filename_exist = phpavel_generate_dompdf($data, $order_id, 'wc-order');
	if (!$filename_exist) {
		return;
	}

	$emails = [
		WC()->mailer()->get_emails()['WC_Email_New_Order']->settings['recipient']
	];

	$protocols = array('http://', 'https://', 'http://www.', 'https://www.', 'www.');
	$site_url  = str_replace($protocols, '', get_bloginfo('url'));
	$paths = phpavel_wc_orders_pdf_paths($order_id, 'wc-order');

	foreach ($emails as $email) {
		wp_mail(
			$email,
			get_bloginfo('name') . " КП №{$order_id}",
			"КП №{$order_id} прикреплено к сообщению",
			[
				'From: ' . get_bloginfo('name') . ' <no-reply@' . $site_url . '>',
				'Content-type: text/html; charset=utf-8'
			],
			[$paths['filenameDIR']]
		);
	}
}

function phpavel_get_data_order($order_id) // данные заказа
{
	if (! $order_id) return;
	$orderOBJ = wc_get_order($order_id); // WC_Order

	$to = phpavel_get_address_order($orderOBJ);

	$total_count = (int) $orderOBJ->get_item_count();
	$total_price = (int) $orderOBJ->get_total();

	return [
		'to' => $to,
		'from' => get_field('phpavel_wc_order_pdf_contacts', 'option'),
		'date' => esc_html($orderOBJ->get_date_created()->date('d.m.Y')),
		'rows' => phpavel_get_items($orderOBJ->get_items()),
		'blogName' => get_bloginfo('name'),
		'title' => 'Коммерческое предложение №' . $order_id,
		'total_products' => ['count' => $total_count, 'total_price' => $total_price],
		'additional' => phpavel_get_additional_order($orderOBJ)
	];
}

function phpavel_get_additional_order( $orderOBJ )
{
	if (! $orderOBJ) return;

	$note = $orderOBJ->get_customer_note() ? wp_kses_post( $orderOBJ->get_customer_note() ) . '<br><br>' : ''; // заметка
	$payment_method = $orderOBJ->get_payment_method_title() ? wp_kses_post( $orderOBJ->get_payment_method_title() ) . '<br>' : ''; // выбранный метод оплаты
	$shipping_method = wp_kses_post( $orderOBJ->get_shipping_to_display() ); // выбранный метод доставки

	return <<<ADDITIONAL
		$note
		$payment_method
		$shipping_method
	ADDITIONAL;
}

function phpavel_get_address_order( $orderOBJ )
{
	$address_billing = $orderOBJ->get_address('billing');
	$address_shipping = $orderOBJ->get_address('shipping');

	$first_name = $address_shipping['first_name'];
	$last_name = $address_shipping['last_name'];

	$email = $address_billing['email'];
	$phone = $address_billing['phone'];
	$postcode = $address_shipping['postcode'];
	$city = $address_shipping['city'];
	$address_1 = $address_shipping['address_1'];
	$address_2 = $address_shipping['address_2'];

	$to_string = '<br>';
	$to_string .= $first_name . ' ' . $last_name . '<br>';
	$to_string .= $phone . '<br>';
	$to_string .= $email . '<br>';
	$to_string .= $postcode . ' ' . $city . '<br>';
	$to_string .= $address_1 . $address_2;

	return $to_string;
}

function phpavel_get_items($items)
{
	$rows = '';

	$i = 0;
	foreach ($items as $item) {
		$index = $i + 1;

		$id = $item->get_product_id();
		$variation_id = $item->get_variation_id() ?: '';

		$thumb = phpavel_order_pdf_get_thumb($id, $variation_id);
		$name = get_the_title($id);
		$variation_name = phpavel_get_variations($variation_id);
		$attributes = phpavel_admin_pdf_get_attributes($id);
		$attributes = $attributes ? '<li>' . implode('</li><li>', $attributes) . '</li>' : '';
		$quantity = $item->get_quantity();
		$subtotal = wc_price($item->get_product()->get_price());
		$total = wc_price($item->get_total());

		$rows .= <<<row
		<tr>
			<td>{$index}</td>
			<td class="thumb">{$thumb}</td>
			<td>{$name}<br><br>{$variation_name}</td>
			<td class="information-list">
				<ul>
					{$attributes}
				</ul>
			</td>
			<td>{$subtotal}</td>
			<td>{$quantity}</td>
			<td>{$total}</td>
		</tr>
		row;

		$i++;
	}

	return $rows;
}

function phpavel_order_pdf_get_thumb($product_id = '', $variation_id = '', $size = [150, 150])
{
	if (!$product_id) return;

	$image_id = '';
	$isVariation = $variation_id ? true : false;

	if ($isVariation) {
		$image_id = get_post_meta($variation_id, '_thumbnail_id', true);

		if (! $image_id) {
			$image_id = get_post_thumbnail_id($product_id);
		}
	} else {
		$image_id = get_post_thumbnail_id($product_id);
	}

	if ($image_id) {
		$image = wp_get_attachment_image($image_id, $size);
	} else {
		$image = wc_placeholder_img_src($size);
	}

	return $image;
}

function phpavel_get_variations($variation_id = '')
{
	if (! $variation_id) return;

	return wc_get_product($variation_id)->get_attribute_summary();
}
