<?php
if (! defined('ABSPATH')) exit;

define('WC_ORDERS_PDF_URI', wp_upload_dir()['baseurl'] . '/wc-pdf-orders');
define('WC_ORDERS_PDF_DIR', wp_upload_dir()['basedir'] . '/wc-pdf-orders');

// Пути до папки с PDF файлами (dir, url)
function phpavel_wc_orders_pdf_paths($ID, $slug = '')
{
  if (empty($ID)) return;

  if (!empty($slug)) {
    $slug = esc_attr($slug) . '-';
  }

  return [
    'filenameDIR' => WC_ORDERS_PDF_DIR . "/{$slug}schet-{$ID}.pdf",
    'filenameURL' => esc_url(WC_ORDERS_PDF_URI . "/{$slug}schet-{$ID}.pdf")
  ];
}

require_once PHPAVEL_WC_ORDER_DIR . 'includes/functions-generate-pdf/generate-dompdf.php';
require_once PHPAVEL_WC_ORDER_DIR . 'includes/functions-generate-pdf/admin-generate-pdf.php';
require_once PHPAVEL_WC_ORDER_DIR . 'includes/functions-generate-pdf/order-generate-pdf.php';

// Шаблон с таблицей
function phpavel_get_template_generate($data)
{
  $to       = $data['to'];
  $from     = $data['from'];
  $date     = $data['date'];
  $rows     = $data['rows'];
  $blogName = $data['blogName'];
  $title    = $data['title'];
  $total_products = $data['total_products'];

  $allCount    = $total_products['count'];
  $total_price = $total_products['total_price'];
  $additional = !empty($data['additional']) ? $data['additional'] : '';

  ob_start();
  require_once PHPAVEL_WC_ORDER_DIR . 'includes/template.php';
  $return = ob_get_contents();
  ob_end_clean();

  return $return;
}

// Общее количество продуктов и цена
function phpavel_get_total_products_template($rows)
{
  $total_count = 0;
  $total_price = 0;

  foreach ($rows as $row) {
    if ($row['acf_fc_layout'] !== 'products') {
      continue;
    }

    $products = $row['product_row'];
    if (!$products) {
      continue;
    }

    foreach ($products as $product) {
      $product_id = $product['product'];

      $productOBJ    = wc_get_product($product_id);
      $product_count = $product['count'] ? (int)$product['count'] : 1;
      $product_price = $productOBJ->get_price() ?: 0;
      $subtotal      = (int)$product_price * $product_count;

      $total_count += $product_count;
      $total_price += (int)$subtotal;
    }
  }

  return ['count' => $total_count, 'total_price' => $total_price];
}

// Атрибуты
function phpavel_admin_pdf_get_attributes($product_id = '')
{
  if (! $product_id) return;

  $product = wc_get_product($product_id);
  if (! $product->has_attributes()) return;

  $attributes = $product->get_attributes();
  $isVariable = $product->is_type('variable');

  $return = [];
  foreach ($attributes as $attribute) {
    $isAttrVariation = $attribute->get_variation();
    if ($isVariable && $isAttrVariation) continue;

    $attr_name = esc_html($attribute->get_name());
    $excludeAttrs = ['pa_chip', 'pa_series'];
    if (in_array($attr_name, $excludeAttrs)) continue;

    $attr_label  = esc_html(wc_attribute_label($attr_name));
    $attr_values = join(', ', wp_get_post_terms($product_id, $attr_name, array('fields' => 'names')));

    $return[] = "<b>$attr_label:</b> $attr_values";
  }

  return $return;
}

// // Полное название вариации
function phpavel_admin_pdf_get_variation_full_name($product_id = '')
{
  if (! $product_id) return;

  $variation_object = wc_get_product($product_id);
  $attributes = $variation_object->get_attributes();
  $attributes_keys = array_keys($attributes);
  $selected_attributes = array();

  // Перебираем выбранные атрибуты
  foreach ($attributes_keys as $attribute_name) {
    $attribute_label = esc_html(wc_attribute_label($attribute_name)); // Получаем название атрибута
    $term_name = esc_html($variation_object->get_attribute($attribute_name)); // Получаем название значения атрибута
    if ($term_name) {
      $selected_attributes[] = "{$attribute_label}: {$term_name}";
    }
  }

  // Получаем название вариации
  $parent_object = wc_get_product( $variation_object->get_parent_id() );
  $variation_name = $parent_object->get_name();

  // Формируем строку для отображения вариации с выбранными атрибутами
  $variation_with_selected_attributes = '<strong>' . esc_html($variation_name) . '</strong>';

  // Если есть выбранные атрибуты, добавляем их к строке
  if (!empty($selected_attributes)) {
    $variation_with_selected_attributes .= '<br><br>' . implode(', ', $selected_attributes);
  }

  return $variation_with_selected_attributes;
}