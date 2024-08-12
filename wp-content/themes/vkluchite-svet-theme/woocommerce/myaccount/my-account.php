<?php defined('ABSPATH') || exit; ?>

<main class="sd-orders">
	<div class="container">
		<div class="sd-orders__grid">
			<?php
			/**
			 * My Account navigation.
			 *
			 * @since 2.6.0
			 */
			do_action('woocommerce_account_navigation');
			?>

			<div class="sd-orders__orders woocommerce-MyAccount-content">
				<?php
				/**
				 * My Account content.
				 *
				 * @since 2.6.0
				 */
				do_action('woocommerce_account_content');
				?>
			</div>
		</div>
	</div>
</main>