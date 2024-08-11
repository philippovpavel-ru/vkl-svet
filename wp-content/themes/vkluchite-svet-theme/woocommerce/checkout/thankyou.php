<?php defined('ABSPATH') || exit; ?>

<main class="sd-vacantions">
	<div class="container">

		<?php
		if ($order) :
			do_action('woocommerce_before_thankyou', $order->get_id());
		?>

			<?php if ($order->has_status('failed')) : ?>
				<div class="woocommerce-order sd-vacantions__grid order-done">
					<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e('Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce'); ?></p>

					<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
						<a href="<?php echo esc_url($order->get_checkout_payment_url()); ?>" class="button pay"><?php esc_html_e('Pay', 'woocommerce'); ?></a>
						<?php if (is_user_logged_in()) : ?>
							<a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>" class="button pay"><?php esc_html_e('My account', 'woocommerce'); ?></a>
						<?php endif; ?>
					</p>
				</div>

			<?php else : ?>

				<?php wc_get_template('checkout/order-received.php', array('order' => $order)); ?>
				<div class="woocommerce-order sd-vacantions__grid order-done">
					<div class="sd-vacantions__card">
						<div>
							<div class="sd-vacantions__card-row">
								<h2>Заказ № <?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
														?></h2>
								<p>Дата: <?php echo wc_format_datetime($order->get_date_created()); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
													?></p>
							</div>
						</div>

						<?php if (is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email()) : ?>
							<div>
								<p>
									<?php esc_html_e('Email:', 'woocommerce'); ?> <span> <?php echo $order->get_billing_email(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
																																				?></span>
								</p>
							</div>
						<?php endif; ?>

						<div>
							<p>
								Итого: <span> <?php echo $order->get_formatted_order_total(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
															?></span>
							</p>
						</div>

						<?php if ($order->get_payment_method_title()) : ?>
							<div>
								<p>
									Способ оплаты: <span><?php echo wp_kses_post($order->get_payment_method_title()); ?></span>
								</p>
							</div>
						<?php endif; ?>
					</div>

					<?php do_action('woocommerce_thankyou', $order->get_id()); ?>
				</div>
			<?php endif; ?>



		<?php else : ?>
			<div class="woocommerce-order sd-vacantions__grid order-done">
				<div class="sd-vacantions__card">
					<?php wc_get_template('checkout/order-received.php', array('order' => false)); ?>
				</div>
			</div>

		<?php endif; ?>
	</div>
</main>