<?php
// CF7 Options Page
if ( function_exists('acf_add_options_sub_page') && class_exists('WPCF7') ) {
  acf_add_options_sub_page(array(
    'page_title'    => 'Всплывающее окно',
    'menu_title'    => 'Всплывающее окно',
    'parent_slug'   => 'wpcf7',
    'menu_slug'     => 'vkl-cf7',
    'capability'    => 'edit_posts',
    'position'      => 8.1,
    'update_button' => 'Сохранить',
  ));
}

// CF7 Options Page Fields
add_action('acf/include_fields', function () {
  if (!function_exists('acf_add_local_field_group')) {
    return;
  }

  acf_add_local_field_group(array(
    'key' => 'group_66a14298d214f',
    'title' => 'Всплывающее окно',
    'fields' => array(
      array(
        'key' => 'field_66a1429909c8f',
        'label' => 'Контактная форма',
        'name' => 'contact_form_id',
        'aria-label' => '',
        'type' => 'post_object',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'post_type' => array(
          0 => 'wpcf7_contact_form',
        ),
        'post_status' => array(
          0 => 'publish',
        ),
        'taxonomy' => '',
        'return_format' => 'id',
        'multiple' => 0,
        'allow_null' => 0,
        'bidirectional' => 0,
        'ui' => 1,
        'bidirectional_target' => array(),
      ),
      array(
        'key' => 'field_66a143555b222',
        'label' => 'Текст кнопки вызова в шапке',
        'name' => 'cf7_text_button_to_header',
        'aria-label' => '',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_66a1429909c8f',
              'operator' => '!=empty',
            ),
          ),
        ),
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => 'Заказать звонок',
        'maxlength' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
      ),
      array(
        'key' => 'field_66a143c55b223',
        'label' => 'Изображение всплывающего окна',
        'name' => 'cf7_image_id',
        'aria-label' => '',
        'type' => 'image',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_66a1429909c8f',
              'operator' => '!=empty',
            ),
          ),
        ),
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'return_format' => 'id',
        'library' => 'all',
        'min_width' => '',
        'min_height' => '',
        'min_size' => '',
        'max_width' => '',
        'max_height' => '',
        'max_size' => '',
        'mime_types' => '',
        'preview_size' => 'thumbnail',
      ),
      array(
        'key' => 'field_66a143f85b224',
        'label' => 'Заголовок',
        'name' => 'cf7_title',
        'aria-label' => '',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_66a1429909c8f',
              'operator' => '!=empty',
            ),
          ),
        ),
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
      array(
        'key' => 'field_66a1441b5b225',
        'label' => 'Подзаголовок',
        'name' => 'cf7_subtitle',
        'aria-label' => '',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_66a1429909c8f',
              'operator' => '!=empty',
            ),
          ),
        ),
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
    'location' => array(
      array(
        array(
          'param' => 'options_page',
          'operator' => '==',
          'value' => 'vkl-cf7',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'seamless',
    'label_placement' => 'left',
    'instruction_placement' => 'field',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 1,
  ));
});

// Contacts Page
if ( function_exists('acf_add_options_sub_page') ) {
  acf_add_options_sub_page(array(
    'page_title'    => 'Контакты',
    'menu_title'    => 'Контакты',
    'parent_slug'   => 'options-general.php',
    'menu_slug'     => 'vkl-contacts',
    'capability'    => 'edit_posts',
    'position'      => 8.1,
    'update_button' => 'Сохранить',
  ));
}

// Contacts Fields
add_action('acf/include_fields', function () {
  if (!function_exists('acf_add_local_field_group')) {
    return;
  }

  acf_add_local_field_group(array(
    'key' => 'group_66a115565d57d',
    'title' => 'Контакты',
    'fields' => array(
      array(
        'key' => 'field_66a1155741e2d',
        'label' => 'Телефон',
        'name' => 'phone',
        'aria-label' => '',
        'type' => 'text',
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
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
      ),
      array(
        'key' => 'field_66a117d0f6e8a',
        'label' => 'Email',
        'name' => 'email',
        'aria-label' => '',
        'type' => 'email',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
      ),
      array(
        'key' => 'field_66a117e7f6e8b',
        'label' => 'Вконтакте',
        'name' => 'vk_url',
        'aria-label' => '',
        'type' => 'url',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'placeholder' => '',
      ),
      array(
        'key' => 'field_66a1180df6e8d',
        'label' => 'Telegram',
        'name' => 'telegram_url',
        'aria-label' => '',
        'type' => 'url',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'placeholder' => '',
      ),
      array(
        'key' => 'field_66a1181ef6e8e',
        'label' => 'WhatsApp',
        'name' => 'whatsapp_url',
        'aria-label' => '',
        'type' => 'url',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'placeholder' => '',
      ),
      array(
        'key' => 'field_66a1182af6e8f',
        'label' => 'Instagram',
        'name' => 'instagram_url',
        'aria-label' => '',
        'type' => 'url',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'placeholder' => '',
      ),
      array(
        'key' => 'field_66a11858f6e90',
        'label' => 'Адрес шоурума',
        'name' => 'addresses',
        'aria-label' => '',
        'type' => 'repeater',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'layout' => 'block',
        'pagination' => 0,
        'min' => 0,
        'max' => 0,
        'collapsed' => '',
        'button_label' => 'Добавить',
        'rows_per_page' => 20,
        'sub_fields' => array(
          array(
            'key' => 'field_66a11887f6e91',
            'label' => 'Адрес',
            'name' => 'address',
            'aria-label' => '',
            'type' => 'text',
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
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'parent_repeater' => 'field_66a11858f6e90',
          ),
        ),
      ),
      array(
        'key' => 'field_66a118b9f6e92',
        'label' => 'Режим работы',
        'name' => 'periods',
        'aria-label' => '',
        'type' => 'repeater',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'layout' => 'table',
        'pagination' => 0,
        'min' => 0,
        'max' => 0,
        'collapsed' => '',
        'button_label' => 'Добавить',
        'rows_per_page' => 20,
        'sub_fields' => array(
          array(
            'key' => 'field_66a118d0f6e93',
            'label' => 'Дени недели',
            'name' => 'day',
            'aria-label' => '',
            'type' => 'text',
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
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'parent_repeater' => 'field_66a118b9f6e92',
          ),
          array(
            'key' => 'field_66a118e2f6e94',
            'label' => 'Время работы',
            'name' => 'time',
            'aria-label' => '',
            'type' => 'text',
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
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'parent_repeater' => 'field_66a118b9f6e92',
          ),
        ),
      ),
      array(
        'key' => 'field_66a118f7f6e95',
        'label' => 'Координаты карты',
        'name' => 'map_xy',
        'aria-label' => '',
        'type' => 'text',
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
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'options_page',
          'operator' => '==',
          'value' => 'vkl-contacts',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'seamless',
    'label_placement' => 'left',
    'instruction_placement' => 'field',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 1,
  ));
});

// Gallery for posts
add_action('acf/include_fields', function () {
  if (!function_exists('acf_add_local_field_group')) {
    return;
  }

  acf_add_local_field_group(array(
    'key' => 'group_66a1049333074',
    'title' => 'Галерея',
    'fields' => array(
      array(
        'key' => 'field_66a104934eec0',
        'label' => 'Галерея',
        'name' => 'gallery',
        'aria-label' => '',
        'type' => 'gallery',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'return_format' => 'id',
        'library' => 'all',
        'min' => '',
        'max' => '',
        'min_width' => '',
        'min_height' => '',
        'min_size' => '',
        'max_width' => '',
        'max_height' => '',
        'max_size' => '',
        'mime_types' => '',
        'insert' => 'append',
        'preview_size' => 'thumbnail',
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'post',
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
    'show_in_rest' => 1,
  ));
});