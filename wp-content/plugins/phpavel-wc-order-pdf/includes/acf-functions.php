<?php
if (! defined('ABSPATH')) exit;

// Disable ACF Options Page
add_filter('acf/settings/show_admin', '__return_false');

// Settings Page KP
if ( function_exists('acf_add_options_page') ) {
  acf_add_options_sub_page(array(
    'menu_title' => 'Настройки КП',
    'menu_slug'  => 'phpavel-wc-order-pdf-settings',
    'capability' => 'edit_posts',
    'update_button' => 'Сохранить',
    'parent_slug' => 'edit.php?post_type=phpavel_wc_offers',
  ));
}

// Fields for Settings Page KP
add_action('acf/init', 'phpavel_wc_order_pdf_acf_fields_settings_page');
function phpavel_wc_order_pdf_acf_fields_settings_page()
{
  if ( !function_exists('acf_add_local_field_group') ) {
    return;
  }

  acf_add_local_field_group([
    'key' => 'phpavel-wc-order-pdf-settings-fields',
    'title' => 'Настройки КП',
    'fields' => [
      [
        'key' => 'field_wc_order_pdf_contacts',
        'label' => 'Контакты',
        'name' => 'phpavel_wc_order_pdf_contacts',
        'type' => 'textarea',
        'new_lines' => '',
        'instructions' => 'Выводится по умолчанию в шапке PDF документа',
      ]
    ],
    'location' => [
      [
        [
          'param' => 'options_page',
          'operator' => '==',
          'value' => 'phpavel-wc-order-pdf-settings',
        ]
      ]
    ],
    'label_placement' => 'left',
  ]);
}

// Fields for custom post
add_action('acf/init', 'phpavel_wc_order_pdf_acf_fields_custom_post');
function phpavel_wc_order_pdf_acf_fields_custom_post()
{
  if ( !function_exists('acf_add_local_field_group') ) {
    return;
  }

  acf_add_local_field_group(array(
    'key' => 'group_66bf86e95aeb4',
    'title' => 'Настройки КП',
    'fields' => array(
      array(
        'key' => 'field_66bf86eb73044',
        'label' => 'Таблица',
        'name' => '',
        'aria-label' => '',
        'type' => 'tab',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'placement' => 'top',
        'endpoint' => 0,
      ),
      array(
        'key' => 'field_66bf8b0b73045',
        'label' => 'Тип ряда',
        'name' => 'type_row',
        'aria-label' => '',
        'type' => 'flexible_content',
        'instructions' => '',
        'required' => 1,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'layouts' => array(
          'layout_66bf8b1d2284b' => array(
            'key' => 'layout_66bf8b1d2284b',
            'name' => 'products',
            'label' => 'Товары',
            'display' => 'table',
            'sub_fields' => array(
              array(
                'key' => 'field_66bf8c597304a',
                'label' => 'Товар',
                'name' => 'product_row',
                'aria-label' => '',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => '',
                ),
                'layout' => 'table',
                'min' => 1,
                'max' => 0,
                'collapsed' => '',
                'button_label' => 'Добавить',
                'rows_per_page' => 20,
                'sub_fields' => array(
                  array(
                    'key' => 'field_66bf8b5973046',
                    'label' => 'Товар',
                    'name' => 'product',
                    'aria-label' => '',
                    'type' => 'select',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                      'width' => '',
                      'class' => '',
                      'id' => '',
                    ),
                    'default_value' => false,
                    'return_format' => 'value',
                    'multiple' => 0,
                    'allow_null' => 0,
                    'ui' => 1,
                    'ajax' => 0,
                    'placeholder' => '',
                    'parent_repeater' => 'field_66bf8c597304a',
                  ),
                  array(
                    'key' => 'field_66bf8bd973047',
                    'label' => 'Описание товара',
                    'name' => 'description',
                    'aria-label' => '',
                    'type' => 'textarea',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                      'width' => '',
                      'class' => '',
                      'id' => '',
                    ),
                    'default_value' => '',
                    'maxlength' => '',
                    'rows' => 4,
                    'placeholder' => '',
                    'new_lines' => '',
                    'parent_repeater' => 'field_66bf8c597304a',
                  ),
                  array(
                    'key' => 'field_66bf8bf873048',
                    'label' => 'Количество',
                    'name' => 'count',
                    'aria-label' => '',
                    'type' => 'number',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                      'width' => '',
                      'class' => '',
                      'id' => '',
                    ),
                    'default_value' => 1,
                    'min' => 1,
                    'max' => '',
                    'placeholder' => '',
                    'step' => 1,
                    'prepend' => '',
                    'append' => '',
                    'parent_repeater' => 'field_66bf8c597304a',
                  ),
                  array(
                    'key' => 'field_66bf8c1373049',
                    'label' => 'Примечание',
                    'name' => 'additional',
                    'aria-label' => '',
                    'type' => 'textarea',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                      'width' => '',
                      'class' => '',
                      'id' => '',
                    ),
                    'default_value' => '',
                    'maxlength' => '',
                    'rows' => 4,
                    'placeholder' => '',
                    'new_lines' => '',
                    'parent_repeater' => 'field_66bf8c597304a',
                  ),
                ),
              ),
            ),
            'min' => '',
            'max' => '',
          ),
          'layout_66bf8d02bf9d6' => array(
            'key' => 'layout_66bf8d02bf9d6',
            'name' => 'separator-01',
            'label' => 'Текстовой разделитель 01',
            'display' => 'table',
            'sub_fields' => array(
              array(
                'key' => 'field_66bf8d2ebf9d8',
                'label' => 'Текст',
                'name' => 'text',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => '',
                ),
                'default_value' => '',
                'maxlength' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
              ),
            ),
            'min' => '',
            'max' => '',
          ),
          'layout_66bf8d6bb0cca' => array(
            'key' => 'layout_66bf8d6bb0cca',
            'name' => 'separator-02',
            'label' => 'Текстовой разделитель 02',
            'display' => 'table',
            'sub_fields' => array(
              array(
                'key' => 'field_66bf8d6bb0ccb',
                'label' => 'Текст',
                'name' => 'text',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => '',
                ),
                'default_value' => '',
                'maxlength' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
              ),
            ),
            'min' => '',
            'max' => '',
          ),
        ),
        'min' => '',
        'max' => '',
        'button_label' => 'Добавить',
      ),
      array(
        'key' => 'field_66bf8d7ffc444',
        'label' => 'Реквизиты',
        'name' => '',
        'aria-label' => '',
        'type' => 'tab',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'placement' => 'top',
        'endpoint' => 0,
      ),
      array(
        'key' => 'field_66bf8d8efc445',
        'label' => 'Дата',
        'name' => 'date',
        'aria-label' => '',
        'type' => 'date_picker',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'display_format' => 'd.m.Y',
        'return_format' => 'd.m.Y',
        'first_day' => 1,
      ),
      array(
        'key' => 'field_66bf8dc0fc446',
        'label' => 'Кому',
        'name' => 'to',
        'aria-label' => '',
        'type' => 'textarea',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'maxlength' => '',
        'rows' => 4,
        'placeholder' => '',
        'new_lines' => '',
      ),
      array(
        'key' => 'field_66bf8deffc447',
        'label' => 'От кого',
        'name' => 'from',
        'aria-label' => '',
        'type' => 'textarea',
        'instructions' => 'По умолчанию заполняется из <a href="'. admin_url('edit.php?post_type=phpavel_wc_offers&page=phpavel-wc-order-pdf-settings') .'">настроек КП</a>',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'maxlength' => '',
        'rows' => 4,
        'placeholder' => '',
        'new_lines' => '',
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'phpavel_wc_offers',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
  ));
}

add_filter("acf/load_field/key=field_66bf8b5973046", 'filter_field_66bf8b5973046_products', 10, 1);
function filter_field_66bf8b5973046_products(array $field): array
{
  $products = wc_get_products(array(
    'status' => 'publish',
    'limit' => -1,
    'type' => array('simple', 'variable'),
  ));

  $product_list = [];

  foreach ($products as $product) {
    $current_group = '';
    $product_title = esc_html($product->get_title());
    $product_id = esc_attr($product->get_id());

    if ($product->is_type('variable')) {
      $current_group = $product_title;
      $product_list[$current_group] = [];

      if (!empty($current_group)) {
        foreach ($product->get_available_variations() as $variation) {
          $variation_id = $variation['variation_id'];
          $variation_obj = wc_get_product($variation_id);
          $variation_title = esc_html($variation_obj->get_name());

          $product_list[$current_group][$variation_id] = "- {$variation_title}";
        }
      }
    } else {
      $product_list[$product_id] = $product_title;
    }
  }

  $field['choices'] = $product_list;

  return $field;
}