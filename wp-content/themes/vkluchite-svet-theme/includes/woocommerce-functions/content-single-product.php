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

  $content = wp_kses_post($product->get_description());

  echo <<<TABS
  <div class="sd-card-page__specifications">
    <nav class="b-tabs__nav">
      <a class="b-tabs__nav-button active">
        Характеристики
      </a>
      <a class="b-tabs__nav-button">
        Описание
      </a>
    </nav>

    <div class="b-tabs__boxes">
      <div class="b-tabs__box active">
        <div class="b-tabs__box-table">
          <div class="b-tabs__box-row">
            <p>Коллекция</p>
            <p>Aqua Waterfall</p>
          </div>
          <div class="b-tabs__box-row">
            <p>Цвет плафона</p>
            <p>Прозрачный</p>
          </div>
          <div class="b-tabs__box-row">
            <p>Материал корпуса</p>
            <p>Натуральная латунь</p>
          </div>
          <div class="b-tabs__box-row">
            <p>Материал абажура</p>
            <p>Стекло ручной работы</p>
          </div>
          <div class="b-tabs__box-row">
            <p>Место назначения</p>
            <p>Гостиная, детская, ресторан, спальня</p>
          </div>
        </div>
      </div>

      <div class="b-tabs__box">
        <div class="b-tabs__box-text">$content</div>
      </div>
    </div>
  </div>
  TABS;
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