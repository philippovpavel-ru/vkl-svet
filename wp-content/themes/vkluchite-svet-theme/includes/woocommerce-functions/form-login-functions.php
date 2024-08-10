<?php
add_action('wp_footer', 'vklsvet_wc_form_login_to_footer');
function vklsvet_wc_form_login_to_footer()
{
  if (is_user_logged_in() || 'no' === get_option('woocommerce_enable_checkout_login_reminder')) {
    return;
  }

  $current_url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
  $current_url = explode('?', $current_url);
  $current_url = $current_url[0];

  woocommerce_login_form(
    array(
      'redirect' => is_checkout() ? wc_get_checkout_url() : esc_url($current_url),
      'hidden'   => false,
    )
  );
}