<?php
// remove actions
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );

// add default actions
add_action('woocommerce_after_cart', 'woocommerce_cross_sell_display');

// add custom actions
function vklsvet_wc_cart_product_permalink($product,$cart_item, $cart_item_key, $return = true)
{
  if ( !$product ) return;

  $product_permalink = apply_filters('woocommerce_cart_item_permalink', $product->is_visible() ? $product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);

  if ( $return ) {
    return esc_url($product_permalink);
  }

  echo esc_url($product_permalink);
}

function vklsvet_wc_cart_product_title( $product, $cart_item, $cart_item_key, $return = true )
{
  if ( !$product ) return;

  $product_name = esc_html($product->get_name());
  $product_permalink = vklsvet_wc_cart_product_permalink($product,$cart_item, $cart_item_key);

  $product_title = <<<NAME
  <div class="product-name" title="$product_name">
    $product_name
  </div>
  NAME;

  if ($product_permalink) {
    $product_title = <<<NAME
    <a href="$product_permalink" class="product-name" title="$product_name">
      $product_name
    </a>
    NAME;
  }

  if ( $return ) {
    return $product_title;
  }

  echo $product_title;
}

function vklsvet_wc_cart_product_del_button( $product, $cart_item, $cart_item_key, $return = true )
{
  if ( !$product ) return;

  $product_id = $product->get_id();
  $product_name = vklsvet_wc_cart_product_title( $product, $cart_item, $cart_item_key );

  $del_button = apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    'woocommerce_cart_item_remove_link',
    sprintf(
      '<a href="%s" class="remove sd-cart__del" aria-label="%s" data-product_id="%s" data-product_sku="%s"></a>',
      esc_url(wc_get_cart_remove_url($cart_item_key)),
      esc_attr(sprintf(__('Remove %s from cart', 'woocommerce'), wp_strip_all_tags($product_name))),
      esc_attr($product_id),
      esc_attr($product->get_sku())
    ),
    $cart_item_key
  );

  $product_delete = <<<DELETE
  <div class="remove-icon product-remove">
    $del_button
  </div>
  DELETE;

  if ( $return ) {
    return $product_delete;
  }

  echo $product_delete;
}

function vklsvet_wc_cart_product_thumbnail($product, $cart_item, $cart_item_key, $return = true)
{
  if ( !$product ) return;

  $product_permalink = vklsvet_wc_cart_product_permalink($product, $cart_item, $cart_item_key);
  $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $product->get_image(), $cart_item, $cart_item_key);

  $product_thumbnail = <<<THUMB
    <div class="product-thumbnail cart-1-cart__img-box">
      $thumbnail
    </div>
  THUMB;

  if ( $product_permalink ) {
    $product_thumbnail = <<<THUMB
      <a href="$product_permalink" class="product-thumbnail cart-1-cart__img-box">
        $thumbnail
      </a>
    THUMB;
  }

  if ( $return ) {
    return $product_thumbnail;
  }

  echo $product_thumbnail;
}

function vklsvet_wc_cart_product_price($product, $cart_item, $cart_item_key, $return = true)
{
  if ( !$product ) return;

  // $price = apply_filters(
  //   'woocommerce_cart_item_price',
  //   WC()->cart->get_product_price($product),
  //   $cart_item,
  //   $cart_item_key
  // ); // PHPCS: XSS ok.

  $price = $product->get_price_html();

  $product_price = <<<PRICE
  <p class="product-price cart-1-cart__price">
    $price
  </p>
  PRICE;

  if ( $return ) {
    return $product_price;
  }

  echo $product_price;
}

function vklsvet_wc_cart_product_attrs($product, $cart_item, $cart_item_key, $return = true)
{
  if ( !$product ) return;
  if ( ! wc_get_formatted_cart_item_data($cart_item) ) return;

  $product_id = $product->get_id();
  $metadata = wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.

  // Backorder notification.
  if ($product->backorders_require_notification() && $product->is_on_backorder($cart_item['quantity'])) {
    $metadata .= wp_kses_post(
      apply_filters(
        'woocommerce_cart_item_backorder_notification',
        '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>',
        $product_id
      )
    );
  }

  $product_attrs = <<<PRODUCT_ATTRS
  <p class="cart-1-cart__card-options">Характеристики</p>
  <div class="cart-1-cart__description">
    $metadata
  </div>
  PRODUCT_ATTRS;

  if ( $return ) {
    return $product_attrs;
  }

  echo $product_attrs;
}

function vklsvet_wc_cart_product_quantity($product, $cart_item, $cart_item_key, $return = true)
{
  if ( !$product ) return;

  $product_name = vklsvet_wc_cart_product_title( $product, $cart_item, $cart_item_key );

  if ($product->is_sold_individually()) {
    $min_quantity = 1;
    $max_quantity = 1;
    $before_input = '';
    $after_input = '';
  } else {
    $min_quantity = 0;
    $max_quantity = $product->get_max_purchase_quantity();
    $before_input = '<button class="number-minus" type="button">–</button>';
    $after_input = '<button class="number-plus" type="button">+</button>';
  }

  $quantity = woocommerce_quantity_input(
    array(
      'input_name'   => "cart[{$cart_item_key}][qty]",
      'input_value'  => $cart_item['quantity'],
      'max_value'    => $max_quantity,
      'min_value'    => $min_quantity,
      'product_name' => $product_name,
      'classes'      => 'input-small qty',
    ),
    $product,
    false
  );

  $item_quantity = apply_filters('woocommerce_cart_item_quantity', $quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.

  $product_quantity = <<<PRODUCT_QUANTITY
  <div class="product-quantity card-1-card__number">
    $before_input
    $item_quantity
    $after_input
  </div>
  PRODUCT_QUANTITY;

  if ( $return ) {
    return $product_quantity;
  }

  echo $product_quantity;
}

function vklsvet_wc_cart_product_subtotal($product, $cart_item, $cart_item_key, $return = true)
{
  if ( !$product ) return;

  $subtotal = apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($product, $cart_item['quantity']), $cart_item, $cart_item_key); // PHPCS: XSS ok.

  $product_subtotal = <<<SUBTOTAL
  <p class="product-subtotal cart-1-cart__total">
    $subtotal
  </p>
  SUBTOTAL;

  if ( $return ) {
    return $product_subtotal;
  }

  echo $product_subtotal;
}

function vklsvet_wc_cart_total_sale( $wc_price = true,$return = true )
{
  // Получаем общую скидку
  $cart = WC()->cart;
  $cart_discount = 0;

  foreach ($cart->get_cart() as $cart_item_key => $cart_item) {
    $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);

    if (
      $_product &&
      $_product->exists() &&
      $cart_item['quantity'] > 0 &&
      $_product->get_sale_price() &&
      apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)
    ) {

      $sale_price    = (int)$_product->get_sale_price();
      $regular_price = (int)$_product->get_regular_price();
      $single_diff   = (int)$regular_price - $sale_price;
      $count         = (int)$cart_item['quantity'];

      $cart_discount += $single_diff * $count;
    }
  }

  if ($wc_price) {
    $cart_discount = wc_price($cart_discount);
  }

  if ( $return ) {
    return $cart_discount;
  }

  echo $cart_discount;
}

function vklsvet_wc_cart_full_sub_total($wc_price = true, $return = true)
{
  $cart_subtotal = (int)WC()->cart->subtotal;
  $cart_subtotal += (int)vklsvet_wc_cart_total_sale( false );

  if ($wc_price) {
    $cart_subtotal = wc_price($cart_subtotal);
  }

  if ( $return ) {
    return $cart_subtotal;
  }

  echo $cart_subtotal;
}
