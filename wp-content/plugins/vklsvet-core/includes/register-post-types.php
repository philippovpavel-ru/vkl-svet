<?php
add_action('init', 'vklsvet_register_post_types');
function vklsvet_register_post_types()
{
  register_post_type('vklsvet_vacancy', [
    'label'  => null,
    'labels' => [
      'name'               => 'Вакансии', // основное название для типа записи
      'singular_name'      => 'Вакансия', // название для одной записи этого типа
      'add_new'            => 'Добавить Вакансию', // для добавления новой записи
      'add_new_item'       => 'Добавление Вакансии', // заголовка у вновь создаваемой записи в админ-панели.
      'edit_item'          => 'Редактирование Вакансии', // для редактирования типа записи
      'new_item'           => 'Новая Вакансия', // текст новой записи
      'view_item'          => 'Смотреть Вакансию', // для просмотра записи этого типа.
      'search_items'       => 'Искать Вакансию', // для поиска по этим типам записи
      'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
      'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
      'parent_item_colon'  => '', // для родителей (у древовидных типов)
      'menu_name'          => 'Вакансии', // название меню
    ],
    'public'                 => false,
    'show_ui'                => true,
    // 'show_in_menu'           => null, // показывать ли в меню админки
    // 'show_in_admin_bar'   => null, // зависит от show_in_menu
    'show_in_rest'        => false, // добавить в REST API. C WP 4.7
    'menu_position'       => 20,
    'menu_icon'           => 'dashicons-groups',
    'hierarchical'        => false,
    'supports'            => ['title', 'editor'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
    'has_archive'         => false,
  ]);
}