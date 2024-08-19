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
  $delete_keys = ['addresses', 'cf7_image_id', 'cf7_subtitle', 'cf7_text_button_to_header', 'cf7_title', 'contact_form_id', 'email', 'map_xy', 'periods', 'phone', 'instagram_url', 'telegram_url', 'vk_url', 'whatsapp_url'];

  foreach ($array_keys as $value) {
    if ( ! in_array($value, $delete_keys) ) {
      continue;
    }

    delete_field($value, 'option');
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