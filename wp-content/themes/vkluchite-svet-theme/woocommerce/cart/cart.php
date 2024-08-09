<?php
defined('ABSPATH') || exit;

do_action('woocommerce_before_cart'); ?>

<section class="cart-1-cart">
	<div class="container">
		<h2>Корзина</h2>
		<div class="cart-1-cart__grid">

			<form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
				<?php do_action('woocommerce_before_cart_table'); ?>

				<div class="shop_table shop_table_responsive cart woocommerce-cart-form__contents cart-1-cart__list">
					<div class="cart-1-cart__list-grid">
						<div class="cart-1-cart__list-del">
							<label class="cart-1-cart__checkbox">
								<input type="checkbox" value="value-1" class="checkbox-cart-all">
								<span>Выбрать всё</span>
							</label>
							<a id="remove-selected-btn">Удалить выбранное</a>
						</div>
						<p class="product-price">Цена за шт</p>
						<p class="product-quantity">Количество</p>
						<p class="product-subtotal">Сумма</p>
					</div>

					<?php do_action('woocommerce_before_cart_contents'); ?>

					<?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) : ?>
						<?php
						$_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
						$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

						$product_name = vklsvet_wc_cart_product_title($_product, $cart_item, $cart_item_key);
						?>

						<?php if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) : ?>
							<?php
							$product_permalink = vklsvet_wc_cart_product_permalink($_product, $cart_item, $cart_item_key);
							$button_del = vklsvet_wc_cart_product_del_button($_product, $cart_item, $cart_item_key);
							$thumbnail = vklsvet_wc_cart_product_thumbnail($_product, $cart_item, $cart_item_key);
							$product_attrs = vklsvet_wc_cart_product_attrs($_product, $cart_item, $cart_item_key);
							$product_price = vklsvet_wc_cart_product_price($_product, $cart_item, $cart_item_key);
							$quantity = vklsvet_wc_cart_product_quantity($_product, $cart_item, $cart_item_key);
							$subtotal = vklsvet_wc_cart_product_subtotal($_product, $cart_item, $cart_item_key);
							?>
							<div class="woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?> cart-1-cart__list-grid">
								<div class="cart-1-cart__card">
									<label class="cart-1-cart__checkbox">
										<input type="checkbox" name="remove_product_id[]" value="<?php echo $product_id; ?>" class="checkbox-cart">
										<span></span>
									</label>

									<?php echo $thumbnail; ?>

									<div class="cart-1-cart__card-text">
										<div class="cart-1-cart__mobile-price">
											<?php echo $product_price; ?>
										</div>

										<?php
										echo $product_name;

										do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);

										echo $product_attrs;
										echo $button_del;
										?>
									</div>
								</div>

								<div class="cart-1-cart__mobile-buttons">
									<?php
									echo $button_del;
									echo $quantity;
									echo $subtotal;
									?>
								</div>

								<?php
								echo $product_price;
								echo $quantity;
								echo $subtotal;
								?>
							</div>
						<?php endif; ?>
					<?php endforeach; ?>

					<?php do_action('woocommerce_cart_contents'); ?>

					<div class="wc-footer-cart">
						<?php if (wc_coupons_enabled()) { ?>
							<div class="coupon">
								<label for="coupon_code" class="screen-reader-text">
									<?php esc_html_e('Coupon:', 'woocommerce'); ?>
								</label>

								<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e('Coupon code', 'woocommerce'); ?>" />

								<button type="submit" class="button<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>" name="apply_coupon" value="<?php esc_attr_e('Apply coupon', 'woocommerce'); ?>">
									<?php esc_html_e('Apply coupon', 'woocommerce'); ?>
								</button>

								<?php do_action('woocommerce_cart_coupon'); ?>
							</div>
						<?php } ?>

						<button type="submit" class="button<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>" name="update_cart" value="<?php esc_attr_e('Update cart', 'woocommerce'); ?>">
							<?php esc_html_e('Update cart', 'woocommerce'); ?>
						</button>

						<?php do_action('woocommerce_cart_actions'); ?>

						<?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
					</div>

					<?php do_action('woocommerce_after_cart_contents'); ?>
				</div>

				<?php do_action('woocommerce_after_cart_table'); ?>
			</form>

			<div class="cart-1-cart__order-box">
				<?php
				do_action('woocommerce_before_cart_collaterals');

				/**
				 * Cart collaterals hook.
				 *
				 * @hooked woocommerce_cart_totals - 10
				 */
				do_action('woocommerce_cart_collaterals');
				?>
			</div>
		</div>
	</div>
</section>

<?php do_action('woocommerce_after_cart'); ?>