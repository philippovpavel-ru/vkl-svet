<?php

if (! defined('ABSPATH')) exit;

// Скрипты и стили для админки
add_action('admin_enqueue_scripts', 'phpavel_wc_orders_pdf_generate_pdf_script');
function phpavel_wc_orders_pdf_generate_pdf_script()
{
	if (get_current_screen()->post_type !== 'phpavel_wc_offers') return;

	global $post;
	if (empty($post)) return;

	wp_enqueue_style(
		'admin-generate-pdf',
		PHPAVEL_WC_ORDER_URL . 'assets/css/admin.css'
	);

	wp_enqueue_script(
		'admin-generate-pdf',
		PHPAVEL_WC_ORDER_URL . 'assets/js/admin.js',
		['jquery'],
		filemtime(PHPAVEL_WC_ORDER_DIR . 'assets/js/admin.js'),
		true
	);

	wp_add_inline_script(
		'admin-generate-pdf',
		'var generate_pdf_object = {
			post_id: ' . intval($post->ID) . ',
			nonce: "' . wp_create_nonce('admin_generate_pdf') . '"
		};',
		'before'
	);
}

// Кнопка "Сгенерировать PDF" и "Скачать PDF"
add_action('post_submitbox_misc_actions', 'phpavel_wc_orders_pdf_custom_button_classic');
function phpavel_wc_orders_pdf_custom_button_classic()
{
	global $post;

	$is_true = !empty($post) && $post->post_type === 'phpavel_wc_offers' && $post->post_status === 'publish';
	if (! $is_true) return;

	$url = '#';
	$active_class = '';

	$paths = phpavel_wc_orders_pdf_paths($post->ID, 'admin');
	if (file_exists($paths['filenameDIR'])) {
		$url = esc_url($paths['filenameURL']);
		$active_class = 'active';
	}

	$html = <<<HTMLCONTENT
	<div id="major-publishing-actions">
		<ul id="generate-pdf-action">
			<li>
				<span class="dashicons dashicons-welcome-add-page"></span>
				<button id='generate-pdf-link'>Сгенерировать PDF</button>
			</li>
			<li class="download-pdf-link-item $active_class">
				<span class="dashicons dashicons-pdf"></span>
				<a id="download-pdf-link" href="$url" download>Скачать PDF</a>
			</li>
		</ul>
	</div>
	HTMLCONTENT;

	$content = apply_filters('wpautop', $html);
	$content = str_replace(']]>', ']]>', $content);

	echo $content;
}

// AJAX обработчик
add_action('wp_ajax_admin_generate_pdf', 'phpavel_wc_orders_pdf_generate_pdf_callback');
function phpavel_wc_orders_pdf_generate_pdf_callback()
{
	$isTrue = !empty($_POST['action'])
		&& $_POST['action'] === 'admin_generate_pdf'
		&& !empty($_POST['nonce'])
		&& wp_verify_nonce($_POST['nonce'], 'admin_generate_pdf')
		&& !empty($_POST['post_id']);

	if (! $isTrue) {
		echo json_encode(['status' => false, 'response' => 'Что-то пошло не так']);
		wp_die();
	}

	$postID = (int)$_POST['post_id'];

	$from = get_field('phpavel_wc_order_pdf_contacts', 'option') ?? '';
	$from_post = get_field('from', $postID) ?? '';
	if ($from_post) {
		$from = $from_post;
	}

	$data = [
		'to' => get_field('to', $postID),
		'from' => wp_kses_post($from),
		'date' => get_field('date', $postID) ?: get_the_date('d.m.Y', $postID),
		'rows' => phpavel_wc_orders_pdf_rows_table_from_post($postID),
		'blogName' => get_bloginfo('name'),
		'title' => get_the_title($postID),
		'total_products' => phpavel_get_total_products_template(get_field('type_row', $postID)),
	];

	$generate_pdf = phpavel_generate_dompdf($data, $postID);

	if (!$generate_pdf) {
		echo json_encode(['status' => false, 'response' => 'Не удалось создать PDF']);
		wp_die();
	}

	echo json_encode(['status' => true, 'response' => esc_url($generate_pdf)]);
	wp_die();
}

// Получить таблицу с товарами
function phpavel_wc_orders_pdf_rows_table_from_post($postID)
{
	if (empty($postID)) return '';

	$rows = get_field('type_row', $postID);
	if (empty($rows)) return '';

	$return = '';

	$index = 1;
	foreach ($rows as $row) {
		switch ($row['acf_fc_layout']) {
			case 'separator-01':
				$text = $row['text'] ? esc_html($row['text']) : '';
				$return .= "<tr><td class=\"td-floor\" colspan=\"8\">$text</td><tr>";
				break;

			case 'separator-02':
				$text = $row['text'] ? esc_html($row['text']) : '';
				$return .= "<tr><td class=\"td-room\" colspan=\"8\">$text</td><tr>";
				break;

			case 'products':
				$products = $row['product_row'] ?? [];
				if (! $products) {
					break;
				}

				foreach ($products as $product) {
					$productID = $product['product'];
					$productOBJ = wc_get_product($productID);

					$isVariation = get_post_type($productID) === 'product_variation';
					if ($isVariation) {
						$productPAR = $productOBJ->get_parent_id();
						$productParOBJ = wc_get_product($productPAR);
					}

					$product_description = $product['description'];
					if (!$product_description) {
						$product_full_description = $productOBJ->get_description() ?? '';
						$product_description = $productOBJ->get_short_description() ?? $product_full_description;

						if (!$product_description && $isVariation) {
							$product_full_description = $productParOBJ->get_description() ?? '';
							$product_description = $productParOBJ->get_short_description() ?? $product_full_description;
						}
					}

					$product_price = $productOBJ->get_price();
					$product_additional = $product['additional'] ?: '';
					$product_count = $product['count'] ?: 1;
					$product_attrs = phpavel_admin_pdf_get_attributes($productID);
					if ($isVariation) {
						$product_attrs = phpavel_admin_pdf_get_attributes($productPAR);
					}

					$thumb      = get_the_post_thumbnail($productID, [50, 50]);
					$name       = '<strong>' . esc_html($productOBJ->get_name()) . '</strong>';
					$attributes = $product_attrs ? '<li>' . implode('</li><li>', $product_attrs) . '</li>' : '';
					$desc       = explode(PHP_EOL, strip_tags($product_description));
					$desc       = $desc ? '<li>'. implode('</li><li>', $desc) .'</li>' : '';
					$subtotal   = wc_price((int)$product_price);
					$quantity   = (int) $product_count;
					$total      = wc_price((int)$product_price * (int)$quantity);
					$additional = wp_kses_post($product_additional);

					if ($isVariation && empty($thumb)) {
						$thumb = get_the_post_thumbnail($productPAR, [50, 50]);
					}

					if ($isVariation) {
						$name = phpavel_admin_pdf_get_variation_full_name($productID);
					}

					$return .= <<<RETURN
					<tr>
						<td>{$index}</td>
						<td class="thumb">{$thumb}</td>
						<td>{$name}</td>
						<td class="information-list">
							<ul>
								{$attributes}
								{$desc}
							</ul>
						</td>
						<td>{$subtotal}</td>
						<td>{$quantity}</td>
						<td>{$total}</td>
						<td>{$additional}</td>
					</tr>
					RETURN;

					$index++;
				}

				break;
		}
	}

	return $return;
}