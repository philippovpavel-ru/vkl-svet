<?php
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

// базовые настройки Woocommerce
add_action('after_setup_theme', 'vklsvet_wc_theme_setup');
function vklsvet_wc_theme_setup()
{
  add_theme_support(
    'woocommerce',
    array(
      'thumbnail_image_width' => 910,
      'gallery_thumbnail_image_width' => 100,
      'single_image_width'    => 950,
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

add_filter('use_block_editor_for_post_type', 'vklsvet_wc_disable_gutenberg', 10, 2);
function vklsvet_wc_disable_gutenberg($current_status, $post_type)
{
  $disabled_post_types = ['product'];

  return !in_array($post_type, $disabled_post_types, true);
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

require_once VKLS_THEME_DIR . '/includes/woocommerce-functions/catalog-functions.php'; // Каталог
require_once VKLS_THEME_DIR . '/includes/woocommerce-functions/content-single-product-functions.php'; // Карточка товара
require_once VKLS_THEME_DIR . '/includes/woocommerce-functions/cart-functions.php'; // Работа с корзиной
require_once VKLS_THEME_DIR . '/includes/woocommerce-functions/checkout-functions.php'; // Работа с оформлением заказа

require_once VKLS_THEME_DIR . '/includes/woocommerce-functions/register-sidebar-shop-functions.php'; // Подключение сайдбаров
require_once VKLS_THEME_DIR . '/includes/woocommerce-functions/products-functions.php'; // Работа с товарами
require_once VKLS_THEME_DIR . '/includes/woocommerce-functions/favorite-functions.php'; // Избранное
require_once VKLS_THEME_DIR . '/includes/woocommerce-functions/form-login-functions.php'; // Форма авторизации