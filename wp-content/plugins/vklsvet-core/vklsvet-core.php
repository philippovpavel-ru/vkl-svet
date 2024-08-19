<?php

/**
 * Plugin Name: [ CORE Влючите свет ]
 * Description: Функционал темы "Включите свет": блоки, настройки, дополнительные параметры
 *
 * Author URI: https://sitesanddesign.ru
 * Author:     S&D
 *
 *
 * Requires at least: 6.6
 * Requires PHP: 8.1
 *
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 *
 * Requires Plugins: advanced-custom-fields-pro, contact-form-7
 *
 * Version:     1.0
 */

if (!defined('ABSPATH')) exit;

define('VKLS_CORE_DIR', plugin_dir_path(__FILE__) ); // D://OSPAnel6/home/доменсайта/wp-content/plugins/vklsvet-core/
define('VKLS_CORE_URL', plugin_dir_url(__FILE__)); // https://доменсайта/wp-content/plugins/vklsvet-core/
define('VKLS_CORE_VERSION', '1.0.0');

$active_plugins_option = function_exists('get_option') && get_option('active_plugins') ?: '';
$active_plugins_array = $active_plugins_option ? apply_filters('active_plugins', $active_plugins_option) : [];

require_once VKLS_CORE_DIR . 'includes/register-post-types.php';
require_once VKLS_CORE_DIR . 'includes/class-snd-identica.php';

if ( function_exists('get_field') ) {
  require_once VKLS_CORE_DIR . 'includes/acf-functions.php';
  require_once VKLS_CORE_DIR . 'includes/acf-blocks.php';
}