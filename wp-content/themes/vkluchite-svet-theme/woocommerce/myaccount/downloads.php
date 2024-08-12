<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php
$downloads     = WC()->customer->get_downloadable_products();
$has_downloads = (bool) $downloads;
$title = __( 'Downloads', 'woocommerce' );

do_action( 'woocommerce_before_account_downloads', $has_downloads );

// echo '<pre>'. print_r($downloads, 1) .'</pre>';
?>

<h1><?php echo esc_html( $title ); ?></h1>

<?php if ( $has_downloads ) : ?>

	<?php do_action( 'woocommerce_before_available_downloads' ); ?>
	<?php do_action( 'woocommerce_available_downloads', $downloads ); ?>
	<?php do_action( 'woocommerce_after_available_downloads' ); ?>

<?php else : ?>

	<div class="sd-orders__orders--text">
		<?php

		$wp_button_class = wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '';
		wc_print_notice( esc_html__( 'No downloads available yet.', 'woocommerce' ) . ' <a class="button wc-forward' . esc_attr( $wp_button_class ) . '" href="' . esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ) . '">' . esc_html__( 'Browse products', 'woocommerce' ) . '</a>', 'notice' ); // phpcs:ignore WooCommerce.Commenting.CommentHooks.MissingHookComment 
		?>
	</div>

<?php endif; ?>

<?php do_action( 'woocommerce_after_account_downloads', $has_downloads ); ?>
