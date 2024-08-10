<?php
// Favorite button to single product
add_action('woocommerce_single_product_summary', 'vlksvet_wc_favorite', 35);
function vlksvet_wc_favorite()
{
  echo '<a class="sd-card-page__favorite"></a>';
}

// Кнопка добавления в избранное в каталоге
add_action('woocommerce_before_shop_loop_item', 'vlksvet_wc_loop_item_favorite_button', 5);
function vlksvet_wc_loop_item_favorite_button()
{
  echo '<a class="sd-card__favorite"></a>';
}