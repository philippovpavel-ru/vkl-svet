<?php
if (! defined('WP_UNINSTALL_PLUGIN')) {
  exit;
}

phpavel_wc_orders_pdf_delete_acf_options();
phpavel_wc_orders_pdf_delete_posts();
phpavel_wc_orders_pdf_delete_folder();

// Delete all options
function phpavel_wc_orders_pdf_delete_acf_options() {
  if ( !function_exists('get_fields') ) return;

  $get_fields = get_fields( 'option' );
  $array_keys = array_keys($get_fields);
  $delete_keys = ['phpavel_wc_order_pdf_contacts'];

  foreach ($array_keys as $value) {
    if ( ! in_array($value, $delete_keys) ) {
      continue;
    }

    delete_field($value, 'option');
  }
}

// Delete all posts
function phpavel_wc_orders_pdf_delete_posts() {
  $get_posts = get_posts([
    'post_type' => 'phpavel_wc_offers',
    'numberposts' => -1,
    'post_status' => 'any'
  ]);

  foreach ($get_posts as $post) {
    wp_delete_post($post->ID, true);
  }
}

// Delete folder and files
function phpavel_wc_orders_pdf_delete_folder() {
  define('WC_ORDERS_PDF_DIR', wp_upload_dir()['basedir'] . '/wc-pdf-orders');

  if ( !is_dir( WC_ORDERS_PDF_DIR ) ) {
    return;
  }

  $dir = opendir( WC_ORDERS_PDF_DIR );
  while (false !== ($entry = readdir($dir))) {
    if ($entry != "." && $entry != "..") {
      unlink(WC_ORDERS_PDF_DIR . '/' . $entry);
    }
  }
  closedir($dir);
  rmdir(WC_ORDERS_PDF_DIR);

  return true;
}