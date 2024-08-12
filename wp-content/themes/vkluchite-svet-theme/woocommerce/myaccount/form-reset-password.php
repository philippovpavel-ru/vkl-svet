<?php defined( 'ABSPATH' ) || exit; ?>

<?php do_action( 'woocommerce_before_reset_password_form' ); ?>
<main class="sd-orders">
	<div class="container">

		<div class="inline-inner">
			<form method="post" class="wpcf7-form woocommerce-ResetPassword lost_reset_password">

				<h4 class="text-center">
					<?php echo apply_filters( 'woocommerce_reset_password_message', esc_html__( 'Enter a new password below.', 'woocommerce' ) ); ?>
				</h4><?php // @codingStandardsIgnoreLine ?>

				<span class="wpcf7-form-control-wrap woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
					<input type="password" placeholder="*<?php esc_html_e( 'New password', 'woocommerce' ); ?>" class="wpcf7-form-control wpcf7-text woocommerce-Input woocommerce-Input--text input-text" name="password_1" id="password_1" autocomplete="new-password" />
				</span>

				<span class="wpcf7-form-control-wrap woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
					<input type="password" placeholder="*<?php esc_html_e( 'Re-enter new password', 'woocommerce' ); ?>" class="wpcf7-form-control wpcf7-text woocommerce-Input woocommerce-Input--text input-text" name="password_2" id="password_2" autocomplete="new-password" />
				</span>

				<input type="hidden" name="reset_key" value="<?php echo esc_attr( $args['key'] ); ?>" />
				<input type="hidden" name="reset_login" value="<?php echo esc_attr( $args['login'] ); ?>" />

				<div class="clear"></div>

				<?php do_action( 'woocommerce_resetpassword_form' ); ?>

				<input type="hidden" name="wc_reset_password" value="true" />
				<button type="submit" class="wpcf7-form-control wpcf7-submit woocommerce-Button button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" value="<?php esc_attr_e( 'Save', 'woocommerce' ); ?>"><?php esc_html_e( 'Save', 'woocommerce' ); ?></button>

				<?php wp_nonce_field( 'reset_password', 'woocommerce-reset-password-nonce' ); ?>

			</form>
		</div>

	</div>
</main>
<?php
do_action( 'woocommerce_after_reset_password_form' );

