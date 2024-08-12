<?php
remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20);

remove_all_actions('woocommerce_checkout_terms_and_conditions');

// Удаление лишних полей по умолчанию на странице офомления заказа
add_filter('woocommerce_checkout_fields', 'vklsvet_wc_edit_fields', 25);
function vklsvet_wc_edit_fields($fields)
{
  // удаляем лишние поля
  unset($fields['billing']['billing_state']);
  unset($fields['shipping']['shipping_state']);

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

add_filter('woocommerce_form_field', 'vklsvet_wc_textarea', 10, 4);
function vklsvet_wc_textarea($field, $key, $args, $value)
{
  if ($args['type'] !== 'textarea') {
    return $field;
  }

  return '<textarea
    name="' . esc_attr($key) . '"
    id="' . esc_attr($args['id']) . '"
    rows="5"
    ' . implode(' ', $args['input_class']) . '
  >' . esc_attr($value) . '</textarea>';
}