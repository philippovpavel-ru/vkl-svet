<?php
defined('ABSPATH') || exit;

if (is_user_logged_in() || 'no' === get_option('woocommerce_enable_checkout_login_reminder')) {
	return;
}
?>

<div class="woocommerce-form-login-toggle">
	<?php
	wc_print_notice(
		apply_filters('woocommerce_checkout_login_message', esc_html__('Returning customer?', 'woocommerce'))
		. ' <a href="#" class="sd-header__modal-button_aut">'
		. esc_html__('Click here to login', 'woocommerce')
		. '</a>',
		'notice'
	);
	?>
</div>

