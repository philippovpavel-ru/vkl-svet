<?php
// Удаление лишних полей по умолчанию на странице офомления заказа
add_filter('woocommerce_checkout_fields', 'vklsvet_wc_edit_fields', 25);
function vklsvet_wc_edit_fields($fields)
{
  // удаляем лишние поля
  unset($fields['billing']['billing_state']);
  unset($fields['shipping']['shipping_state']);

  unset($fields['shipping']['shipping_company']);
  unset($fields['billing']['billing_company']);

  // редактируем свойства полей
  foreach ($fields as $section => $section_fields) {
    // для каждого поля внутри секции
    foreach ($section_fields as $section_field => $section_field_settings) {
      $fields[$section][$section_field]['placeholder'] = '';

      // учитываем обязательные поля
      if (! empty($fields[$section][$section_field]['required'])) {
        $fields[$section][$section_field]['placeholder'] = '*';
      }

      // удаляем обязательность поля "область"
      if ( $section_field === 'billing_state' || $section_field === 'shipping_state' ) {
        $fields[$section][$section_field]['required'] = '';
      }

      // перемещаем номер телефона и email в начало
      if ( $section_field === 'billing_phone' || $section_field === 'billing_email' ) {
        $fields[$section][$section_field]['priority'] = 25;
      }

      // перемещаем поле "индекс" после страны
      if ( $section_field === 'billing_postcode' || $section_field === 'shipping_postcode' ) {
        $fields[$section][$section_field]['priority'] = 42;
      }

      // перемещаем поле "город" после страны
      if ( $section_field === 'billing_city' || $section_field === 'shipping_city' ) {
        $fields[$section][$section_field]['priority'] = 45;
      }

      $fields[$section][$section_field]['placeholder'] .= $fields[$section][$section_field]['label'];
      $fields[$section][$section_field]['label'] = '';
    }
  }

  return $fields;
}