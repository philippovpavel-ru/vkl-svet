<?php
defined('ABSPATH') || exit;

$cart_discount = (int)vklsvet_wc_cart_total_sale(false);
$shipping_total = (int)WC()->cart->get_shipping_total();
?>

<div class="woocommerce-checkout-review-order-table">
	<?php do_action('woocommerce_review_order_before_cart_contents'); ?>
	
	<?php do_action('woocommerce_review_order_after_cart_contents'); ?>
	
	<div class="cart-1-cart__order-row cart-subtotal">
		<p class="cart-1-cart__order-text">Сумма заказа:</p>
		<p class="cart-1-cart__order-total"><?php echo vklsvet_wc_cart_full_sub_total(); ?></p>
	</div>
	
	<?php if ($cart_discount) : ?>
		<div class="cart-1-cart__order-row cart-discount">
			<p class="cart-1-cart__order-stock">Скидка:</p>
			<p class="cart-1-cart__order-stock"><?php echo wc_price($cart_discount); ?></p>
		</div>
	<?php endif; ?>
	
	<?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
		<div class="cart-1-cart__order-row cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?>">
			<p class="cart-1-cart__order-stock"><?php wc_cart_totals_coupon_label($coupon); ?></p>
			<p class="cart-1-cart__order-stock"><?php wc_cart_totals_coupon_html($coupon); ?></p>
		</div>
	<?php endforeach; ?>
	
	<?php foreach (WC()->cart->get_fees() as $fee) : ?>
		<div class="fee">
			<p class="cart-1-cart__order-text"><?php echo esc_html($fee->name); ?></p>
			<p class="cart-1-cart__order-total"><?php wc_cart_totals_fee_html($fee); ?></p>
		</div>
	<?php endforeach; ?>
	
	<?php if (wc_tax_enabled() && ! WC()->cart->display_prices_including_tax()) : ?>
		<?php if ('itemized' === get_option('woocommerce_tax_total_display')) : ?>
			<?php foreach (WC()->cart->get_tax_totals() as $code => $tax) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited 
			?>
				<div class="cart-1-cart__order-row tax-rate tax-rate-<?php echo esc_attr(sanitize_title($code)); ?>">
					<p class="cart-1-cart__order-text"><?php echo esc_html($tax->label); ?></p>
					<p class="cart-1-cart__order-total"><?php echo wp_kses_post($tax->formatted_amount); ?></p>
				</div>
			<?php endforeach; ?>
		<?php else : ?>
			<div class="cart-1-cart__order-row tax-total">
				<p class="cart-1-cart__order-text"><?php echo esc_html(WC()->countries->tax_or_vat()); ?></p>
				<p class="cart-1-cart__order-total"><?php wc_cart_totals_taxes_total_html(); ?></p>
			</div>
		<?php endif; ?>
	<?php endif; ?>
	
	<div class="cart-1-cart__order-row">
		<p class="cart-1-cart__order-text">Стоимость доставки:</p>
		<p class="cart-1-cart__order-total"><?php echo wc_price($shipping_total); ?></p>
	</div>
	
	<?php do_action('woocommerce_review_order_before_order_total'); ?>
	
	<div class="cart-1-cart__row-total order-total">
		<p class="cart-1-cart__order-text"><?php esc_html_e('Total', 'woocommerce'); ?></p>
		<p class="cart-1-cart__order-total"><?php wc_cart_totals_order_total_html(); ?></p>
	</div>
	
	<?php do_action('woocommerce_review_order_after_order_total'); ?>
</div>