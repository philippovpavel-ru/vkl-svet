<?php
if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

if (is_user_logged_in()) {
	return;
}

?>
<dialog id="modalDialogAut">
	<div class="sd-dialog__wrapper">
		<div class="sd-dialog__grid">
			<div class="inline-inner">
				<h4 class="text-center">Авторизация</h4>

				<form class="woocommerce-form woocommerce-form-login login wpcf7-form" method="post" <?php echo ($hidden) ? 'style="display:none;"' : ''; ?>>

					<?php do_action('woocommerce_login_form_start'); ?>

					<?php echo ($message) ? wpautop(wptexturize($message)) : ''; // @codingStandardsIgnoreLine 
					?>

					<span class="form-row form-row-first wpcf7-form-control-wrap">
						<input type="text" class="input-text wpcf7-form-control wpcf7-text" name="username" id="username" autocomplete="username" placeholder="* <?php esc_html_e('Username or email', 'woocommerce'); ?>" />
					</span>

					<span class="form-row form-row-last wpcf7-form-control-wrap">
						<input class="input-text woocommerce-Input wpcf7-form-control wpcf7-text" type="password" name="password" id="password" autocomplete="current-password" placeholder="* <?php esc_html_e('Password', 'woocommerce'); ?>" />
					</span>
					<div class="clear"></div>

					<?php do_action('woocommerce_login_form'); ?>

					<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
						<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e('Remember me', 'woocommerce'); ?></span>
					</label>

					<?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>

					<input type="hidden" name="redirect" value="<?php echo esc_url($redirect); ?>" />

					<button type="submit" class="woocommerce-button button woocommerce-form-login__submit<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?> wpcf7-form-control wpcf7-submit" name="login" value="<?php esc_attr_e('Login', 'woocommerce'); ?>"><?php esc_html_e('Login', 'woocommerce'); ?></button>

					<p class="lost_password">
						<a href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php esc_html_e('Lost your password?', 'woocommerce'); ?></a>
					</p>

					<div class="clear"></div>

					<?php do_action('woocommerce_login_form_end'); ?>

				</form>

				<a class="sd-dialog__close" onclick="window.modalDialogAut.close()">
					<img src="<?php echo VKLS_THEME_URL; ?>/assets/img/close.svg" alt="">
				</a>
			</div>
		</div>
	</div>
</dialog>