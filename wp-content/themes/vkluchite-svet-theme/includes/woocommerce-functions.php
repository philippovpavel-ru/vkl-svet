<?php
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

// базовые настройки Woocommerce
add_action('after_setup_theme', 'vklsvet_wc_theme_setup');
function vklsvet_wc_theme_setup()
{
  add_theme_support(
    'woocommerce',
    array(
      'thumbnail_image_width' => 315,
      'gallery_thumbnail_image_width' => 200,
      'single_image_width'    => 958,
      'product_grid'          => array(
        'default_rows'    => 2,
        'min_rows'        => 1,
        'default_columns' => 3,
        'min_columns'     => 2,
        'max_columns'     => 3,
      ),
    )
  );
}

// Фрагмент для корзины
add_filter('woocommerce_add_to_cart_fragments', 'vklsvet_wc_add_to_cart_fragment');
function vklsvet_wc_add_to_cart_fragment($fragments)
{
  $fragments['.sd-header__cart-button'] = vklsvet_wc_cart_link('sd-header__cart-button', true, true);
  return $fragments;
}

// Выводит или возвращает ссылку на корзину
function vklsvet_wc_cart_link( $class = 'sd-header__cart-button', $show_count = true, $return = false )
{
  $count = $show_count ? (int)WC()->cart->get_cart_contents_count() : '';
  $class = esc_attr($class);
  $cart_url = esc_url(wc_get_cart_url());
  $cart_link = "<a href=\"$cart_url\" title=\"Корзина\" class=\"$class\">$count</a>";

  if ($return) {
    return $cart_link;
  } else {
    echo $cart_link;
  }
}

require_once VKLS_THEME_DIR . '/includes/woocommerce-functions/catalog.php'; // Каталог
require_once VKLS_THEME_DIR . '/includes/woocommerce-functions/widgets_sidebars.php'; // Подключение сайдбаров
require_once VKLS_THEME_DIR . '/includes/woocommerce-functions/products.php'; // Работа с товарами
require_once VKLS_THEME_DIR . '/includes/woocommerce-functions/checkout.php'; // Работа с оформлением заказа