<?php
defined('ABSPATH') || exit;

$cart_count = (int)WC()->cart->get_cart_contents_count();
$cart_discount = (int)vklsvet_wc_cart_total_sale(false);
?>
<div class="cart_totals <?php echo (WC()->customer->has_calculated_shipping()) ? 'calculated_shipping' : ''; ?>">

	<?php do_action('woocommerce_before_cart_totals'); ?>

	<h3>Ваш заказ <span><?php echo $cart_count; ?> шт</span></h3>

	<div class="cart-1-cart__order-border">
		<div class="cart-1-cart__order-row">
			<p class="cart-1-cart__order-text">Сумма заказа:</p>
			<p class="cart-1-cart__order-total"><?php echo vklsvet_wc_cart_full_sub_total(); ?></p>
		</div>

		<?php if ($cart_discount !== 0) : ?>
			<div class="cart-1-cart__order-row">
				<p class="cart-1-cart__order-stock">Скидка:</p>
				<p class="cart-1-cart__order-stock"><?php echo vklsvet_wc_cart_total_sale(); ?></p>
			</div>
		<?php endif; ?>

		<?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
			<div class="cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?> cart-1-cart__order-row">
				<p class="cart-1-cart__order-stock"><?php wc_cart_totals_coupon_label($coupon); ?></p>
				<p class="cart-1-cart__order-stock" data-title="<?php echo esc_attr(wc_cart_totals_coupon_label($coupon, false)); ?>"><?php wc_cart_totals_coupon_html($coupon); ?></p>
			</div>
		<?php endforeach; ?>

		<?php foreach (WC()->cart->get_fees() as $fee) : ?>
			<div class="cart-1-cart__order-row">
				<p class="cart-1-cart__order-text"><?php echo esc_html($fee->name); ?></p>
				<p class="cart-1-cart__order-total" data-title="<?php echo esc_attr($fee->name); ?>">
					<?php wc_cart_totals_fee_html($fee); ?>
				</p>
			</div>
		<?php endforeach; ?>

		<?php if (wc_tax_enabled() && ! WC()->cart->display_prices_including_tax()) : ?>
			<?php
			$taxable_address = WC()->customer->get_taxable_address();
			$estimated_text  = '';

			if (WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping()) {
				/* translators: %s location. */
				$estimated_text = sprintf(' <small>' . esc_html__('(estimated for %s)', 'woocommerce') . '</small>', WC()->countries->estimated_for_prefix($taxable_address[0]) . WC()->countries->countries[$taxable_address[0]]);
			}
			?>
			<?php if ('itemized' === get_option('woocommerce_tax_total_display')) : ?>

				<?php foreach (WC()->cart->get_tax_totals() as $code => $tax) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited 
				?>
					<div class="tax-rate tax-rate-<?php echo esc_attr(sanitize_title($code)); ?> cart-1-cart__order-row">
						<p class="cart-1-cart__order-text">
							<?php echo esc_html($tax->label) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
							?>
						</p>
						<p class="cart-1-cart__order-total" data-title=" <?php echo esc_attr($tax->label); ?>">
							<?php echo wp_kses_post($tax->formatted_amount); ?>
						</p>
					</div>
				<?php endforeach; ?>

			<?php else : ?>

				<div class="tax-total cart-1-cart__order-row">
					<p class="cart-1-cart__order-text">
						<?php echo esc_html(WC()->countries->tax_or_vat()) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
						?>
					</p>
					<p class="cart-1-cart__order-total" data-title=" <?php echo esc_attr(WC()->countries->tax_or_vat()); ?>">
						<?php wc_cart_totals_taxes_total_html(); ?>
					</p>
				</div>

			<?php endif; ?>
		<?php endif; ?>

		<?php do_action('woocommerce_cart_totals_before_order_total'); ?>

		<div class="cart-1-cart__row-total">
			<p class="cart-1-cart__order-text">Итого:</p>
			<p class="cart-1-cart__order-total"><?php wc_cart_totals_order_total_html(); ?></p>
		</div>

		<?php do_action('woocommerce_cart_totals_after_order_total'); ?>

		<div class="wc-proceed-to-checkout">
			<?php do_action('woocommerce_proceed_to_checkout'); ?>
		</div>
	</div>

	<?php do_action('woocommerce_after_cart_totals'); ?>
</div>