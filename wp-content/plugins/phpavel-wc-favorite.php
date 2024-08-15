<?php

/**
 * Plugin Name: [ PHPavel Избранное в личном кабинете ]
 * Description: Страница избранное в личном кабинете, кнопки избранное в карточках товара
 *
 * Author URI: https://philippovpavel.ru
 * Author:     PhilippovPavel
 *
 *
 * Requires at least: 6.6
 * Requires PHP: 8.1
 *
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 *
 * Requires Plugins: woocommerce
 *
 * Version:     1.0
 */

function phpavel_wc_favorite_link()
{
  if (! is_user_logged_in()) return;

  $myaccount_page_id = get_option('woocommerce_myaccount_page_id');
  $myaccount_page_url = get_permalink($myaccount_page_id);
  $edit_account_endpoint = 'favorite-list';

  $link = esc_url($myaccount_page_url . $edit_account_endpoint);

  echo "<a href='$link' class='favorite'></a>";
}

// Favorite button to single product
add_action('woocommerce_single_product_summary', 'phpavel_wc_favorite', 35);
function phpavel_wc_favorite()
{
  if (! is_user_logged_in()) return;

  global $product;
  $product_id = (int)$product->get_id();
  $favorite_list_array = phpavel_wc_get_favorite_list() ?? [];

  $has_product = in_array($product_id, $favorite_list_array);
  $active_class = $has_product ? 'active' : '';

  echo "<a class='sd-card-page__favorite $active_class' data-id='$product_id'></a>";
}

// Кнопка добавления в избранное в каталоге
add_action('woocommerce_before_shop_loop_item', 'phpavel_wc_loop_item_favorite_button', 5);
function phpavel_wc_loop_item_favorite_button()
{
  if (! is_user_logged_in()) return;

  global $product;
  $product_id = (int)$product->get_id();
  $favorite_list_array = phpavel_wc_get_favorite_list() ?? [];

  $has_product = in_array($product_id, $favorite_list_array);
  $active_class = $has_product ? 'active' : '';

  echo "<a class='sd-card__favorite $active_class' data-id='$product_id'></a>";
}

// Пункт избранное в ЛК
add_filter('woocommerce_account_menu_items', 'phpavel_wc_favorite_list_link', 25);
function phpavel_wc_favorite_list_link($menu_links)
{
  $menu_links = array_slice($menu_links, 0, -1, true) + ['favorite-list' => 'Избранное'] + array_slice($menu_links, -1, NULL, true);

  return $menu_links;
}

// Страница избранное в ЛК
add_action('init', 'phpavel_wc_add_endpoint', 25);
function phpavel_wc_add_endpoint()
{
  add_rewrite_endpoint('favorite-list', EP_PAGES);
}

// Добавляю поле настройки пользователю для хранения значений 
add_action('show_user_profile', 'phpavel_wc_show_profile_fields');
add_action('edit_user_profile', 'phpavel_wc_show_profile_fields');
function phpavel_wc_show_profile_fields($user)
{
  $userID = $user->ID;

  $vklsvet_favorite_list = get_the_author_meta('vklsvet_favorite_list', $userID) ? esc_attr(get_the_author_meta('vklsvet_favorite_list', $userID)) : '';

  echo "<input id='vklsvet_favorite_list' name='vklsvet_favorite_list' type='hidden' value='$vklsvet_favorite_list' disabled />";
}

// Содержимое страницы избранное в ЛК
add_action('woocommerce_account_favorite-list_endpoint', 'phpavel_wc_content', 25);
function phpavel_wc_content()
{
  if (!is_user_logged_in()) {
    return;
  }

  $product_list = get_user_meta(get_current_user_id(), 'vklsvet_favorite_list', true) ?? '';
  echo '<h1>Избранное</h1>';

  if (!$product_list) {
    echo '<p>Вы еще не добавили ни одного товара в избранное.</p>';
    return;
  }

  $products = do_shortcode("[products ids='$product_list' limit='6' orderby='post__in' paginate='true']");
  $products = str_replace('swiper-wrapper', 'sd-catalog__catalog-grid', $products);

  echo $products;
}

// JS Скрипт избранного
add_action('wp_footer', function () {
  $wp_nonce = esc_html(wp_create_nonce('favorite_nonce'));
  $ajax_url = esc_url(admin_url('admin-ajax.php'));
?>
  <script>
    jQuery(document).ready(function($) {
      $('.sd-card-page__favorite').on('click', function() {
        favorite_ajax($(this));
      });

      $('.sd-card__favorite').on('click', function() {
        if ($(this).hasClass('locked')) {
          alert('Дождитесь завершения предыдущей операции');
          return false;
        }

        $('.sd-card__favorite').addClass('locked');

        favorite_ajax($(this));
      });

      function favorite_ajax(el) {
        const product_id = el.data('id');

        $.ajax({
          url: '<?php echo $ajax_url; ?>',
          method: 'POST',
          data: {
            action: 'favorite_click',
            product_id: product_id,
            nonce: '<?php echo $wp_nonce; ?>'
          },
          beforeSend: function() {
            el.toggleClass('processed');
          },
          success: function(response) {
            const json = JSON.parse(response);
            const status = json.status;

            if (status) {
              el.toggleClass('active');
            } else {
              console.log(json);
            }

            $('.sd-card__favorite').removeClass('locked');
            el.toggleClass('processed');
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
          }
        });
      }
    })
  </script>
<?php
});

// AJAX Запрос на добавление в избранное
add_action('wp_ajax_favorite_click', 'phpavel_wc_favorite_click');
function phpavel_wc_favorite_click()
{
  $is_true = !empty($_POST['action']) && $_POST['action'] === 'favorite_click' && !empty($_POST['nonce'] && wp_verify_nonce($_POST['nonce'], 'favorite_nonce'));

  if (!$is_true) {
    echo json_encode(array('status' => false, 'response' => 'Ошибка добавления в избранное'));
    wp_die();
  }

  if (empty($_POST['product_id'])) {
    echo json_encode(array('status' => false, 'response' => 'Не удалось добавить в избранное'));
    wp_die();
  }

  $product_id = (int)$_POST['product_id'];
  $favorite_list_array = phpavel_wc_get_favorite_list() ?? [];

  if (!in_array($product_id, $favorite_list_array)) {
    array_unshift($favorite_list_array, $product_id);

    phpavel_wc_update_favorite_list(implode(',', $favorite_list_array));
  } else {
    $key = array_search($product_id, $favorite_list_array);
    unset($favorite_list_array[$key]);

    phpavel_wc_update_favorite_list(implode(',', $favorite_list_array));
  }

  if (function_exists('wp_cache_clean_cache')) {
    global $file_prefix;
    wp_cache_clean_cache($file_prefix, true);
  }

  echo json_encode(array('status' => true, 'response' => 'Список избранное обновленно'));
  wp_die();
}

function phpavel_wc_get_favorite_list(): array
{
  $userID = get_current_user_id();
  $favorite_list = get_user_meta($userID, 'vklsvet_favorite_list', true) ?? '';

  $favorite_list_array = [];
  if ($favorite_list) {
    $favorite_list_array = explode(',', $favorite_list);
  }

  return $favorite_list_array;
}

function phpavel_wc_update_favorite_list(string $favorite_list)
{
  $userID = get_current_user_id();
  update_user_meta($userID, 'vklsvet_favorite_list', esc_attr($favorite_list));
}
