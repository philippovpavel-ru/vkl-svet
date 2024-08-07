<?php
remove_all_actions('woocommerce_before_single_product_summary');

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating');
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price');
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);

remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs');

add_action('woocommerce_before_single_product', function () {
  echo '<main class="sd-card-page">';
}, 5);

add_action('woocommerce_after_single_product_summary', function () {
  echo '</main>';
}, 5);

// Gallery
add_action('woocommerce_before_single_product_summary', 'vlksvet_wc_gallery');
function vlksvet_wc_gallery()
{
  global $product;

  $gallery = '';

  $product_id = $product->get_id();
  $thumnail_id = get_post_thumbnail_id($product_id);
  $thumbnail_image = wp_get_attachment_image($thumnail_id, 'single-post-thumbnail');
  $thumbnail_full_url = esc_url(wp_get_attachment_image_url($thumnail_id, 'full'));

  $gallery_ids = $product->get_gallery_image_ids();

  if ($thumnail_id) {
    $gallery .= <<<ITEM
    <div class="swiper-slide">
      <a href="$thumbnail_full_url" class="glightbox">
        $thumbnail_image
      </a>
    </div>
    ITEM;
  }

  if ($gallery_ids) {
    foreach ($gallery_ids as $image_id) {
      $image = wp_get_attachment_image($image_id, 'single-post-thumbnail');
      $image_url = esc_url(wp_get_attachment_image_url($image_id, 'full'));
      $gallery .= <<<ITEM
      <div class="swiper-slide">
        <a href="$image_url" class="glightbox">
          $image
        </a>
      </div>
      ITEM;
    }
  }

  echo <<<GALLERY
  <div class="swiper swiper-card-page">
    <div class="swiper-wrapper sd-card-page__swiper-grid">
      $gallery
    </div>
  </div>
  GALLERY;
}

add_filter('woocommerce_product_related_products_heading', function( $heading ) {
  return 'Вам может понравится';
});

// SKU
add_action('woocommerce_single_product_summary', 'vlksvet_wc_sku', 10);
function vlksvet_wc_sku()
{
  global $product;

  $sku = esc_html( $product->get_sku() );

  if ($sku) {
    echo "<p class='sd-card-page__article'>Артикул: $sku</p>";
  }
}

// Favorite button
add_action('woocommerce_single_product_summary', 'vlksvet_wc_favorite', 35);
function vlksvet_wc_favorite()
{
  echo '<a class="sd-card-page__favorite"></a>';
}

// Tabs
add_action('woocommerce_single_product_summary', 'vlksvet_wc_tabs', 35);
function vlksvet_wc_tabs()
{
  global $product;

  $product_id = $product->get_id();

  $tabs_array = [
    [
      'display' => vklsvet_wc_tabs_get_attributes($product_id) ? true : false,
      'name' => 'Характеристики',
      'content' => vklsvet_wc_tabs_get_attributes($product_id)
    ],
    [
      'display' => $product->get_description() ? true : false,
      'name' => 'Описание',
      'content' => wp_kses_post($product->get_description())
    ]
  ];

  $nav_tabs = '';
  $box_tabs = '';
  $index = 0;

  foreach ($tabs_array as $key => $tab_row) {
    if ( ! $tab_row['display'] ) continue;

    $active_class = $index === 0 ? 'active' : '';

    $nav_tabs .= "<a class=\"b-tabs__nav-button $active_class\">{$tab_row['name']}</a>";
    $box_tabs .= "<div class=\"b-tabs__box $active_class\">{$tab_row['content']}</div>";

    $index++;
  }

  echo <<<TABS
  <div class="sd-card-page__specifications">
    <nav class="b-tabs__nav">$nav_tabs</nav>
    <div class="b-tabs__boxes">$box_tabs</div>
  </div>
  TABS;
}

function vklsvet_wc_tabs_get_attributes( $product_id = '' )
{
  if (!$product_id) return;

  $product = wc_get_product($product_id);
  global $product;

  $rows = '';

  $sku = esc_attr($product->get_sku());
  if ($sku) {
    $rows .= "<div class=\"b-tabs__box-row\"><p>Артикул</p><p>{$sku}</p></div>";
  }

  $categories = wc_get_product_category_list($product_id, ', ');
  if ($categories) {
    $rows .= "<div class=\"b-tabs__box-row\"><p>Категория</p><p>{$categories}</p></div>";
  }

  $weight = $product->get_weight();
  if ($weight) {
    $weight_unit = get_option('woocommerce_weight_unit');
    $weight_unit = ($weight_unit === 'kg' ? 'кг' : $weight_unit);

    $rows .= "<div class=\"b-tabs__box-row\"><p>Вес</p><p>{$weight} {$weight_unit}</p></div>";
  }

  $height = $product->get_height();
  $width = $product->get_width();
  $length = $product->get_length();
  $dimensions = ($height && $width && $length ? "{$length}x{$width}x{$height}" : '');

  if ($dimensions) {
    $dimensions_unit = get_option('woocommerce_dimension_unit');
    $dimensions_unit = ($dimensions_unit === 'cm' ? 'см' : $dimensions_unit);

    $rows .= "<div class=\"b-tabs__box-row\"><p>Размер</p><p>{$dimensions} {$dimensions_unit}</p></div>";
  }

  if ( $product->has_attributes() ) {
    $attributes = $product->get_attributes();
    foreach ($attributes as $attribute) {
      if ($attribute['id'] === 0) {
        $attr_label  = esc_html($attribute['name']);
        $attr_values = join(', ', $attribute['options']);
      } else {
        $attr_name = esc_html($attribute->get_name());
        $excludeAttrs = [];
  
        if (in_array($attr_name, $excludeAttrs)) continue;
  
        $attr_label  = esc_html(wc_attribute_label($attr_name));
        $attr_values = join(', ', wp_get_post_terms($product_id, $attr_name, array('fields' => 'names')));
      }
  
      $rows .= "<div class=\"b-tabs__box-row\"><p>$attr_label</p><p>$attr_values</p></div>";
    }
  }

  return "<div class=\"b-tabs__box-table\">$rows</div>";
}

// Меняем текст кнопки
add_filter('woocommerce_product_single_add_to_cart_text', 'vlksvet_wc_single_product_btn_text');
function vlksvet_wc_single_product_btn_text($text)
{
  global $product;
  $price = strip_tags( $product->get_price_html() );

  $text = $price;
  return $text;
}

// JS для карточки
add_action('wp_footer', 'vklsvet_wc_single_product_js');
function vklsvet_wc_single_product_js()
{
  if ( ! ( is_product() && is_single() ) ) return;

  global $product;

  $script = <<<SCRIPT
  <script>
    jQuery(document).ready(function ($) {
      $(document).on('found_variation', '.sd-card-page__text form.cart', function (event, variation) {
        const button_to_cart = $('.sd-card-page__text .single_add_to_cart_button');
        const description_block = $('.sd-card-page__text .b-tabs__box-text');

        button_to_cart.html(variation.price_html);
        description_block.html(variation.variation_description);
      });
    });
  </script>
  SCRIPT;

  echo $script;
}