<?php
if (! defined('ABSPATH')) {
	exit;
}
?>

<section class="cart-1-cart">
	<div class="container">
		<h2>Оформление заказа</h2>

		<?php
		do_action('woocommerce_before_checkout_form', $checkout);

		// If checkout registration is disabled and not logged in, the user cannot checkout.
		if (! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in()) {
			echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
			return;
		}
		?>

		<form name="checkout" method="post" class="checkout woocommerce-checkout cart-1-cart__grid" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">
			<div class="sd-cart__order">
				<?php if ($checkout->get_checkout_fields()) : ?>
					<?php do_action('woocommerce_checkout_before_customer_details'); ?>

					<?php do_action('woocommerce_checkout_billing'); ?>

					<?php do_action('woocommerce_checkout_shipping'); ?>

					<div class="sd-cart__order-grid">
						<?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>
							<div class="sd-cart__order-box">
								<h3 class="sd-cart__order-delivery">Способ доставки</h3>

								<?php do_action('woocommerce_review_order_before_shipping'); ?>

								<?php wc_cart_totals_shipping_html(); ?>

								<?php do_action('woocommerce_review_order_after_shipping'); ?>
							</div>
						<?php elseif (WC()->cart->needs_shipping() && 'yes' === get_option('woocommerce_enable_shipping_calc')) : ?>
							<div class="sd-cart__order-box">
								<div class="shipping sd-cart__order-checkboxes">
									<p class="cart-1-cart__order-total sd-cart__order-checkboxes--shipping" data-title="<?php esc_attr_e('Shipping', 'woocommerce'); ?>">
										<?php woocommerce_shipping_calculator(); ?>
									</p>
								</div>
							</div>
						<?php endif; ?>

						<div class="sd-cart__order-box">
							<h3 class="sd-cart__order-pay">Способ оплаты</h3>

							<?php woocommerce_checkout_payment(); ?>
						</div>
					</div>

					<?php do_action('woocommerce_checkout_after_customer_details'); ?>
				<?php endif; ?>
			</div>

			<?php
			$cart_count = (int)WC()->cart->get_cart_contents_count();
			?>
			<div class="cart-1-cart__order-box">
				<?php do_action('woocommerce_checkout_before_order_review_heading'); ?>

				<h3 id="order_review_heading"><?php esc_html_e('Your order', 'woocommerce'); ?> / <span><?php echo $cart_count; ?> шт</span></h3>

				<?php do_action('woocommerce_checkout_before_order_review'); ?>

				<div id="order_review" class="woocommerce-checkout-review-order cart-1-cart__order-border">
					<?php do_action('woocommerce_checkout_order_review'); ?>
				</div>

				<div class="form-row place-order">
					<?php
					$order_button_text = apply_filters('woocommerce_order_button_text', esc_html__('Place order', 'woocommerce'));
					?>
					<noscript>
						<?php
						/* translators: $1 and $2 opening and closing emphasis tags respectively */
						printf(esc_html__('Since your browser does not support JavaScript, or it is disabled, please ensure you click the %1$sUpdate Totals%2$s button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce'), '<em>', '</em>');
						?>
						<br /><button type="submit" class="button cart-1-cart__order alt<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e('Update totals', 'woocommerce'); ?>"><?php esc_html_e('Update totals', 'woocommerce'); ?></button>
					</noscript>

					<?php wc_get_template('checkout/terms.php'); ?>

					<?php do_action('woocommerce_review_order_before_submit'); ?>

					<?php echo apply_filters(
						'woocommerce_order_button_html',
						'<button type="submit" class="button cart-1-cart__order alt' . esc_attr(
							wc_wp_theme_get_element_class_name('button')
								? ' ' . wc_wp_theme_get_element_class_name('button')
								: ''
						) . '" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr($order_button_text) . '" data-value="' . esc_attr($order_button_text) . '">' . esc_html($order_button_text) . '</button>'
					); // @codingStandardsIgnoreLine 
					?>

					<?php do_action('woocommerce_review_order_after_submit'); ?>

					<?php wp_nonce_field('woocommerce-process_checkout', 'woocommerce-process-checkout-nonce'); ?>

					<?php wc_checkout_privacy_policy_text(); ?>
					<?php wc_terms_and_conditions_page_content(); ?>
				</div>

				<?php do_action('woocommerce_checkout_after_order_review'); ?>
			</div>

		</form>

	</div>
</section>

<?php do_action('woocommerce_after_checkout_form', $checkout); ?>