<?php
// Удаление лишних полей по умолчанию на странице офомления заказа
add_filter('woocommerce_checkout_fields', 'vklsvet_wc_del_fields', 25);
function vklsvet_wc_del_fields($fields)
{
  unset($fields['billing']['billing_state']);
  unset($fields['billing']['billing_company']);

  return $fields;
}