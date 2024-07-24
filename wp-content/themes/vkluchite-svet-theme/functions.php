<?php
define('VKLS_THEME_DIR', get_template_directory());
define('VKLS_THEME_URL', get_template_directory_uri());
define('VKLS_THEME_VERSION', '1.0.0');

add_action('wp_enqueue_scripts', 'vklsvet_enqueue_styles');
function vklsvet_enqueue_styles()
{
  wp_enqueue_style('font-jost', 'https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap');
  wp_enqueue_style('swiper', VKLS_THEME_URL . '/assets/css/swiper-bundle.min.css');
  wp_enqueue_style('animate', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');
  wp_enqueue_style('glightbox', VKLS_THEME_URL . '/assets/css/glightbox.min.css');
  wp_enqueue_style('nouislider', VKLS_THEME_URL . '/assets/css/nouislider.min.css');
  wp_enqueue_style('main-style', VKLS_THEME_URL . '/assets/css/style.css', null, filemtime(VKLS_THEME_DIR . '/assets/css/style.css'));
  wp_enqueue_style('theme-style', get_stylesheet_uri(), null, filemtime(VKLS_THEME_DIR . '/style.css'));

  wp_enqueue_script('wow', VKLS_THEME_URL . '/assets/js/wow.js', null, VKLS_THEME_VERSION, true);
  wp_enqueue_script('swiper', VKLS_THEME_URL . '/assets/js/swiper-bundle.min.js', null, '7.4.1', true);
  wp_enqueue_script('glightbox', VKLS_THEME_URL . '/assets/js/glightbox.min.js', null, VKLS_THEME_VERSION, true);
  wp_enqueue_script('nouislider', VKLS_THEME_URL . '/assets/js/nouislider.min.js', null, VKLS_THEME_VERSION, true);
  wp_enqueue_script('main-script', VKLS_THEME_URL . '/assets/js/main.js', null, filemtime(VKLS_THEME_DIR . '/assets/js/main.js'), true);
}

add_action('after_setup_theme', 'vklsvet_theme_setup');
function vklsvet_theme_setup()
{
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');

  register_nav_menus(
    array(
      'primary' => 'Верхняя область навигации',
      'mobile'  => 'Мобильная область навигации',
      'footer'  => 'Нижняя область навигации',
    )
  );

  add_theme_support(
    'html5',
    array(
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
      'style',
      'script',
      'navigation-widgets',
      'search-form',
    )
  );

  add_theme_support('wp-block-styles');
  add_theme_support('align-wide');
  add_theme_support('editor-styles');

  add_editor_style([
    'assets/css/swiper-bundle.min.css',
    'editor-style.css'
  ]);

  add_theme_support('responsive-embeds');
  add_theme_support('link-color');
  add_theme_support('custom-spacing');

  add_filter('rss_widget_feed_link', '__return_empty_string');
}

add_filter('use_block_editor_for_post_type', 'vklsvet_disable_gutenberg', 10, 2);
function vklsvet_disable_gutenberg($current_status, $post_type)
{
  $disabled_post_types = ['post'];

  return !in_array($post_type, $disabled_post_types, true);
}

add_filter('wpcf7_autop_or_not', '__return_false');

require_once('includes/breadcrumbs.php');

if (class_exists('acf_pro')) {
  require_once('includes/acf-functions.php');
}

if (class_exists('WooCommerce')) {
  require_once('includes/woocommerce-functions.php');
}
