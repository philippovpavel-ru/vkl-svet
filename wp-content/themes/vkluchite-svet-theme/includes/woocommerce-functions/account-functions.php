<?php
// удаляем автоматический вход при регистрации
add_filter('woocommerce_registration_auth_new_customer', '__return_false');

// Редирект на страницу ЛК
add_filter('woocommerce_login_redirect', 'vklsvet_wc_login_redirect', 25, 2);
function vklsvet_wc_login_redirect($redirect, $user)
{
  $myaccount_page_id = get_option('woocommerce_myaccount_page_id');
  $myaccount_page_url = get_permalink($myaccount_page_id);
  $edit_account_endpoint = get_option('woocommerce_myaccount_edit_account_endpoint');

  $redirect = esc_url($myaccount_page_url . $edit_account_endpoint);

  return $redirect;
}

// Редактируем свойства полей
add_filter('woocommerce_default_address_fields', 'vklsvet_wc_change_fields');
function vklsvet_wc_change_fields($fields)
{
  // удаляем лишние поля
  unset($fields['state']);

  // редактируем свойства полей
  foreach ($fields as $section_field => $section_field_settings) {
    if ( empty($fields[$section_field]['label']) ) {
      continue;
    }

    $fields[$section_field]['placeholder'] = '';

    if ($fields[$section_field]['required']) {
      $fields[$section_field]['placeholder'] = '*';
    }

    $fields[$section_field]['placeholder'] .= $fields[$section_field]['label'];
    $fields[$section_field]['label'] = '';
  }

  return $fields;
}

// Удаляем ненужные табы
add_filter('woocommerce_account_menu_items', 'vklsvet_wc_remove_tabs', 25);
function vklsvet_wc_remove_tabs($menu_links)
{
  unset($menu_links['dashboard']);
  unset($menu_links['downloads']);
  unset($menu_links['edit-address']);

  return $menu_links;
}

// Переименовываем и перемещаем табы
add_filter('woocommerce_account_menu_items', 'vlksvet_wc_rename_links', 25);
function vlksvet_wc_rename_links($menu_links)
{
  $menu_links['orders'] = 'Мои заказы';
  $menu_links['edit-account'] = 'Личные данные';

  $edit_account = array_splice($menu_links, array_search('edit-account', array_keys($menu_links)), 1);
  $orders = array_splice($menu_links, array_search('orders', array_keys($menu_links)), 1);
  $menu_links = array_merge($edit_account, $orders, $menu_links);

  return $menu_links;
}

// Перемещаем содержимое табов
add_action('woocommerce_account_edit-account_endpoint', 'woocommerce_account_edit_address');
add_action('woocommerce_account_orders_endpoint', 'woocommerce_account_downloads');

// Добавляем разделитель
add_action('woocommerce_after_edit_account_form', 'vklsvet_wc_add_separator');
add_action('woocommerce_after_account_orders', 'vklsvet_wc_add_separator');
function vklsvet_wc_add_separator()
{
  echo '<div class="wc-account-separator-sections"></div>';
}