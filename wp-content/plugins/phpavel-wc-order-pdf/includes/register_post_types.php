<?php

if (! defined('ABSPATH')) exit;

add_action('init', 'phpavel_wc_register_post_types');
function phpavel_wc_register_post_types()
{
	register_post_type('phpavel_wc_offers', [
		'label'  => null,
		'labels' => [
			'name'               => 'Коммерческие предложения', // основное название для типа записи
			'singular_name'      => 'Коммерческое предложение', // название для одной записи этого типа
			'add_new'            => 'Добавить КП', // для добавления новой записи
			'add_new_item'       => 'Добавление КП', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование КП', // для редактирования типа записи
			'new_item'           => 'Новое КП', // текст новой записи
			'view_item'          => 'Смотреть КП', // для просмотра записи этого типа.
			'search_items'       => 'Искать партнера', // для поиска по этим типам записи
			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
			'parent_item_colon'  => 'Коммерческие предложения', // для родителей (у древовидных типов)
			'menu_name'          => 'Коммерческие предложения', // название меню
		],
		'public'                 => false,
		'show_ui'                => true,
		'show_in_menu'           => true, // показывать ли в меню админки
		'show_in_rest'        => false, // добавить в REST API. C WP 4.7
		'menu_position'       => 56,
		'menu_icon'           => 'dashicons-list-view',
		'hierarchical'        => false,
		'supports'            => ['title'],
		'rewrite'             => false,
		'query_var'           => false,
	]);
}
