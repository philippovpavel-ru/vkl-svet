<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<main class="sd-orders">
	<div class="container">

		<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

			<div class="u-columns col2-set" id="customer_login">
				<div class="u-column1 col-1">

		<?php endif; ?>
		<div class="inline-inner">
			<h4 class="text-center"><?php esc_html_e( 'Login', 'woocommerce' ); ?></h4>
	
			<form class="wpcf7-form woocommerce-form woocommerce-form-login login" method="post">

				<?php do_action( 'woocommerce_login_form_start' ); ?>

				<span class="wpcf7-form-control-wrap woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<input type="text" placeholder="*<?php esc_html_e( 'Username or email address', 'woocommerce' ); ?>" class="wpcf7-form-control wpcf7-text woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
				</span>

				<span class="wpcf7-form-control-wrap woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<input placeholder="*<?php esc_html_e( 'Password', 'woocommerce' ); ?>" class="wpcf7-form-control wpcf7-text woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
				</span>

				<?php do_action( 'woocommerce_login_form' ); ?>

				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
				</label>
				<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
				<button type="submit" class="wpcf7-form-control wpcf7-submit woocommerce-button button woocommerce-form-login__submit<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>

				<span class="woocommerce-LostPassword lost_password">
					<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
				</span>

				<?php do_action( 'woocommerce_login_form_end' ); ?>

			</form>
		</div>

		<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

				</div>

				<div class="u-column2 col-2">
					<div class="inline-inner">
						<h4 class="text-center"><?php esc_html_e( 'Register', 'woocommerce' ); ?></h4>
	
						<form method="post" class="wpcf7-form woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >
	
							<?php do_action( 'woocommerce_register_form_start' ); ?>
	
							<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
	
								<span class="wpcf7-form-control-wrap woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
									<input type="text" placeholder="*<?php esc_html_e( 'Username', 'woocommerce' ); ?>" class="wpcf7-form-control wpcf7-text woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
								</span>
	
							<?php endif; ?>
	
							<span class="wpcf7-form-control-wrap woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
								<input type="email" placeholder="*<?php esc_html_e( 'Email address', 'woocommerce' ); ?>" class="wpcf7-form-control wpcf7-text woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
							</span>
	
							<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
	
								<span class="wpcf7-form-control-wrap woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
									<input type="password" placeholder="*<?php esc_html_e( 'Password', 'woocommerce' ); ?>" class="wpcf7-form-control wpcf7-text woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
								</span>
	
							<?php else : ?>
	
								<span class="form-text-password-notice"><?php esc_html_e( 'A link to set a new password will be sent to your email address.', 'woocommerce' ); ?></span>
	
							<?php endif; ?>
	
							<?php do_action( 'woocommerce_register_form' ); ?>
	
							<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
							<button type="submit" class="wpcf7-form-control wpcf7-submit woocommerce-Button woocommerce-button button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?> woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
	
							<?php do_action( 'woocommerce_register_form_end' ); ?>
	
						</form>
					</div>

				</div>

			</div>

		<?php endif; ?>

	</div>
</main>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
