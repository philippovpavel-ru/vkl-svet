<?php defined( 'ABSPATH' ) || exit; ?>

<?php do_action( 'woocommerce_before_lost_password_form' ); ?>
<main class="sd-orders">
	<div class="container">

		<div class="inline-inner">
			<form method="post" class="woocommerce-ResetPassword lost_reset_password">
		
				<h4 class="text-center">Забыли пароль?</h4>
				<p class="lost-password-text-form"><?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'woocommerce' ) ); ?></p><?php // @codingStandardsIgnoreLine ?>
		
				<span class="wpcf7-form-control-wrap woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
					<input placeholder="*<?php esc_html_e( 'Username or email', 'woocommerce' ); ?>" class="wpcf7-form-control wpcf7-text woocommerce-Input woocommerce-Input--text input-text" type="text" name="user_login" id="user_login" autocomplete="username" aria-required="true" />
				</span>

				<div class="clear"></div>

				<?php do_action( 'woocommerce_lostpassword_form' ); ?>

				<input type="hidden" name="wc_reset_password" value="true" />
				<button type="submit" class="wpcf7-form-control wpcf7-submit woocommerce-Button button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" value="<?php esc_attr_e( 'Reset password', 'woocommerce' ); ?>"><?php esc_html_e( 'Reset password', 'woocommerce' ); ?></button>

				<?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>

			</form>
		</div>

	</div>
</main>
<?php
do_action( 'woocommerce_after_lost_password_form' );
