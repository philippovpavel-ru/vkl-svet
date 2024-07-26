<?php
// Удаление 'grouped' и 'external' из списка типов товаров
add_filter('product_type_selector', 'vklsvet_wc_remove_product_types');
function vklsvet_wc_remove_product_types($product_types)
{
  // Удаление 'grouped' и 'external' из списка типов товаров
  unset($product_types['grouped']);
  unset($product_types['external']);

  return $product_types;
}