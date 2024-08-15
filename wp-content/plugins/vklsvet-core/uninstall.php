<?php
if (! defined('WP_UNINSTALL_PLUGIN')) {
  exit;
}

vklsvet_delete_acf_options();
vklsvet_delete_vacancies();

// Delete all options
function vklsvet_delete_acf_options() {
  if ( !function_exists('get_fields') ) return;

  $get_fields = get_fields( 'option' );
  $array_keys = array_keys($get_fields);

  foreach ($array_keys as $key) {
    delete_field($key, 'option');
  }
}

// Delete all vacancies
function vklsvet_delete_vacancies() {
  $get_posts = get_posts([
    'post_type' => 'vklsvet_vacancy',
    'numberposts' => -1,
    'post_status' => 'any'
  ]);

  foreach ($get_posts as $post) {
    wp_delete_post($post->ID, true);
  }
}