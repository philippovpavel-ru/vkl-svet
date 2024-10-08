<?php
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

// Отключает редактирование виджетов блоков Gutenberg
add_filter('gutenberg_use_widgets_block_editor', '__return_false');
add_filter('use_widgets_block_editor', '__return_false');

// Регистрация боковых колонок
add_action('widgets_init', 'vklsvet_wc_register_wp_sidebars');
function vklsvet_wc_register_wp_sidebars()
{
  register_sidebar(
    array(
      'id' => 'shop', // уникальный id
      'name' => 'Фильтр по параметрам', // название сайдбара
      'description' => 'Перетащите сюда виджеты, чтобы добавить их в сайдбар.', // описание
      'before_widget' => '', // по умолчанию виджеты выводятся <li>-списком
      'after_widget' => '',
      'before_title' => '', // по умолчанию заголовки виджетов в <h2>
      'after_title' => ''
    )
  );
}