<?php
defined('ABSPATH') || exit;

do_action('woocommerce_before_account_orders', $has_orders);

$title = __('Orders', 'woocommerce');
?>

<h1><?php echo esc_html($title); ?></h1>

<?php if ($has_orders) : ?>

	<div class="sd-orders__orders-rows">
		<?php foreach ($customer_orders->orders as $customer_order) : ?>
			<?php
			$order      = wc_get_order($customer_order); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
			$item_count = $order->get_item_count() - $order->get_item_count_refunded();
			$columns    = wc_get_account_orders_columns();

			$order_number = number_format((int)$order->get_order_number(), 0, '', ' ');
			$order_status = $order->get_status();
			$order_date = esc_html(wc_format_datetime($order->get_date_created()));
			$order_total = wc_price($order->get_total());
			$order_items = $order->get_items(apply_filters('woocommerce_purchase_order_item_types', 'line_item'));

			$status_title = esc_html(wc_get_order_status_name($order->get_status()));
			switch ($order_status) {
				case 'completed': // выполнен
					$status_class = 'done';
					break;

				case 'cancelled': // отменен
				case 'refunded': // возрат
				case 'failed': // не удался
					$status_class = 'cancel';
					break;

				default:
					$status_class = 'delivery';
					break;
			}
			?>

			<div class="sd-orders__orders-row woocommerce-orders-table__row woocommerce-orders-table__row--status-<?php echo esc_attr($order->get_status()); ?> order">
				<div class="sd-orders__orders-text">
					<div class="sd-orders__order">
						<p>Заказ <span>№ <?php echo $order_number; ?></span></p>
						<p class="<?php echo $status_class; ?>"><?php echo $status_title; ?></p>

						<?php
						$actions = wc_get_account_orders_actions($order);

						if (! empty($actions)) {
							foreach ($actions as $key => $action) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
								echo '<a href="' . esc_url($action['url']) . '" class="woocommerce-button' . esc_attr($wp_button_class) . ' button ' . sanitize_html_class($key) . '">' . esc_html($action['name']) . '</a>';
							}
						}
						?>
					</div>
					<p>Сумма <span><?php echo $order_total; ?></span></p>
					<p>Дата <span><?php echo $order_date; ?></span></p>
				</div>

				<?php if ( $order_items ) : ?>
					<div class="sd-orders__structure">
						<p>Состав:</p>
						<div class="sd-orders__structure-grid">
							<?php foreach ( $order_items as $item ) : ?>
								<?php
								$product = $item->get_product();
								$product_thumbnail = $product->get_image('thumbnail');
								$product_link = get_permalink($product->get_id());
								$product_title = esc_attr( $product->get_title() );
								?>
								<a href="<?php echo esc_url( $product_link ); ?>" title="<?php echo $product_title; ?>">
									<?php echo $product_thumbnail; ?>
								</a>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>
			</div>

		<?php endforeach; ?>
	</div>

	<?php do_action('woocommerce_before_account_orders_pagination'); ?>

	<?php if (1 < $customer_orders->max_num_pages) : ?>
		<div class="woocommerce-pagination woocommerce-pagination--without-numbers woocommerce-Pagination">
			<?php if (1 !== $current_page) : ?>
				<a class="woocommerce-button woocommerce-button--previous woocommerce-Button woocommerce-Button--previous button<?php echo esc_attr($wp_button_class); ?>" href="<?php echo esc_url(wc_get_endpoint_url('orders', $current_page - 1)); ?>"><?php esc_html_e('Previous', 'woocommerce'); ?></a>
			<?php endif; ?>

			<?php if (intval($customer_orders->max_num_pages) !== $current_page) : ?>
				<a class="woocommerce-button woocommerce-button--next woocommerce-Button woocommerce-Button--next button<?php echo esc_attr($wp_button_class); ?>" href="<?php echo esc_url(wc_get_endpoint_url('orders', $current_page + 1)); ?>"><?php esc_html_e('Next', 'woocommerce'); ?></a>
			<?php endif; ?>
		</div>
	<?php endif; ?>

<?php else : ?>

	<div class="sd-orders__orders--text">
		<?php wc_print_notice(esc_html__('No order has been made yet.', 'woocommerce') . ' <a class="woocommerce-Button wc-forward button' . esc_attr($wp_button_class) . '" href="' . esc_url(apply_filters('woocommerce_return_to_shop_redirect', wc_get_page_permalink('shop'))) . '">' . esc_html__('Browse products', 'woocommerce') . '</a>', 'notice'); // phpcs:ignore WooCommerce.Commenting.CommentHooks.MissingHookComment 
		?>
	</div>

<?php endif; ?>

<?php do_action('woocommerce_after_account_orders', $has_orders); ?>