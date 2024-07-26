<?php
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_shop_loop_header', 'woocommerce_product_taxonomy_archive_header', 10);
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);

// обертка для шапки с заголовком и формой сортировки START
add_action('woocommerce_before_shop_loop', 'vlksvet_wc_catalog_header_start', 15);
function vlksvet_wc_catalog_header_start()
{
  echo '<div class="sd-catalog__catalog-header">';
}

// обертка для шапки с заголовком и формой сортировки END
add_action('woocommerce_before_shop_loop', 'vlksvet_wc_catalog_header_end', 40);
function vlksvet_wc_catalog_header_end()
{
  echo '</div>';
}

// Загаловок категории
add_action('woocommerce_before_shop_loop', 'vlksvet_wc_catalog_header_title', 20);
function vlksvet_wc_catalog_header_title()
{
  if (is_shop()) {
    echo '<span></span>';
    return;
  }

  $this_category = get_queried_object();
  $current_title = esc_html($this_category->name);
  $hasParent = $this_category->parent;

  if ($hasParent) {
    $parent = get_term($this_category->parent, 'product_cat');
    $current_title .= ' | ' . esc_html($parent->name);
  }

  echo "<h2>$current_title</h2>";
}

// Форма сортировки
add_action('woocommerce_before_shop_loop', 'vlksvet_wc_catalog_header_orderby', 25);
function vlksvet_wc_catalog_header_orderby()
{
  echo '<div class="b-header__currency">
    <div class="b-header__currency-now"></div>
    <div class="b-header__currency-menu"></div>
  </div>';
}

// Кнопка вызова фильтра
add_action('woocommerce_before_shop_loop', 'vlksvet_wc_catalog_header_filter_button', 35);
function vlksvet_wc_catalog_header_filter_button()
{
  echo '<button class="categ-1-categ__catalog-button"></button>';
}

// Класс карточки
add_filter('woocommerce_post_class', 'vlksvet_wc_catalog_loop_item_class', 10);
function vlksvet_wc_catalog_loop_item_class($classes)
{
  if (is_shop() || is_product_taxonomy()) {
    $classes[] = 'sd-card';
  }

  return $classes;
}

// Кнопка добавления в избранное
add_action('woocommerce_before_shop_loop_item', 'vlksvet_wc_loop_item_favorite_button', 5);
function vlksvet_wc_loop_item_favorite_button()
{
  echo '<a class="sd-card__favorite"></a>';
}

// Обертка для картинки START
add_action('woocommerce_before_shop_loop_item_title', 'vlksvet_wc_loop_item_link_wrapper_start', 5);
function vlksvet_wc_loop_item_link_wrapper_start()
{
  echo vlksvet_wc_get_loop_item_link_wrapper_start();
}

// Обертка для заголовка START
add_action('woocommerce_shop_loop_item_title', 'vlksvet_wc_loop_product_title_wrapper_start', 5);
function vlksvet_wc_loop_product_title_wrapper_start()
{
  echo vlksvet_wc_get_loop_item_link_wrapper_start('sd-card__name');
}

// Обертка для цены START
add_action('woocommerce_after_shop_loop_item_title', 'vlksvet_wc_loop_product_price_wrapper_start', 5);
function vlksvet_wc_loop_product_price_wrapper_start()
{
  echo vlksvet_wc_get_loop_item_link_wrapper_start('sd-card__price');
}

// Обертка для ссылки END echo
add_action('woocommerce_before_shop_loop_item_title', 'vlksvet_wc_loop_item_link_wrapper_end', 15);
add_action('woocommerce_shop_loop_item_title', 'vlksvet_wc_loop_item_link_wrapper_end', 15);
add_action('woocommerce_after_shop_loop_item_title', 'vlksvet_wc_loop_item_link_wrapper_end', 15);
function vlksvet_wc_loop_item_link_wrapper_end()
{
  echo "</a>";
}

// Обертка для ссылки START return
function vlksvet_wc_get_loop_item_link_wrapper_start($class = 'sd-card__img')
{
  $product_url = esc_url(get_the_permalink());
  $class = esc_attr($class);

  return "<a href=\"$product_url\" class=\"$class\">";
}

// Добавляю класс для Кнопки добавления в корзину
add_filter('woocommerce_loop_add_to_cart_link', 'vlksvet_wc_loop_add_to_cart_link', 10);
function vlksvet_wc_loop_add_to_cart_link($link)
{
  $link = str_replace('class="button', 'class="sd-card__cart button', $link);

  return $link;
}

add_action('woocommerce_after_shop_loop', 'vlksvet_wc_pagination', 10);
function vlksvet_wc_pagination()
{
  the_posts_pagination([
    'prev_text' => '',
    'next_text' => '',
  ]);
}