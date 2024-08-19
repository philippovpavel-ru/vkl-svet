<?php

/**
 * Plugin Name: [ PHPavel Заказ в PDF счёт ]
 * Description: Создание PDF счёта в админке
 *
 * Author URI: https://philippovpavel.ru
 * Author:     PhilippovPavel
 *
 *
 * Requires at least: 6.6
 * Requires PHP: 8.1
 *
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 *
 * Requires Plugins: woocommerce, advanced-custom-fields-pro
 *
 * Version:     1.0
 */

if (!defined('ABSPATH')) exit;

define('PHPAVEL_WC_ORDER_DIR', plugin_dir_path(__FILE__));
define('PHPAVEL_WC_ORDER_URL', plugin_dir_url(__FILE__));
define('PHPAVEL_WC_ORDER_VERSION', '1.0.0');

require_once PHPAVEL_WC_ORDER_DIR . 'includes/register_post_types.php'; // Регистрация типов записей

if ( function_exists('get_field') ) {
  require_once PHPAVEL_WC_ORDER_DIR . 'includes/acf-functions.php';
  require_once PHPAVEL_WC_ORDER_DIR . 'includes/functions-generate-pdf.php';
}