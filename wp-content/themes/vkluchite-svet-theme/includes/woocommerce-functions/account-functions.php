<?php
add_filter('woocommerce_default_address_fields', 'vklsvet_wc_change_fields');
function vklsvet_wc_change_fields($fields)
{
  // удаляем лишние поля
  unset($fields['state']);

  // редактируем свойства полей
  foreach ($fields as $section_field => $section_field_settings) {
    $fields[$section_field]['placeholder'] = '';

    if ($fields[$section_field]['required']) {
      $fields[$section_field]['placeholder'] = '*';
    }

    $fields[$section_field]['placeholder'] .= $fields[$section_field]['label'];
    $fields[$section_field]['label'] = '';
  }

  return $fields;
}