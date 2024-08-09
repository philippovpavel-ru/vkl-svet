<?php
defined('ABSPATH') || exit;

if ($cross_sells) : ?>
	<section class="sd-popular">
		<div class="cross-sells container">
			<?php
			$heading = apply_filters('woocommerce_product_cross_sells_products_heading', __('You may be interested in&hellip;', 'woocommerce'));

			if ($heading = esc_html($heading) ) {
				echo "<h2>$heading</h2>";
			}
			?>

			<div class="swiper swiper-pop">
				<?php
				woocommerce_product_loop_start();

				foreach ($cross_sells as $cross_sell) {
					$post_object = get_post($cross_sell->get_id());
					setup_postdata($GLOBALS['post'] = &$post_object); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found
					wc_get_template_part('content', 'product');
				}

				woocommerce_product_loop_end();
				?>
			</div>
		</div>
	</section>
<?php endif;

wp_reset_postdata();
