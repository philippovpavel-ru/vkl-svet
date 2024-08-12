<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_account_navigation' );
?>

<nav class="woocommerce-MyAccount-navigation" aria-label="<?php esc_html_e( 'Account pages', 'woocommerce' ); ?>">
	<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
		<?php
		$link_url = esc_url(wc_get_account_endpoint_url($endpoint));

		$current_url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		$current_url = explode('?', $current_url);
		$current_url = $current_url[0];

		$active_class = $current_url === $link_url ? 'active' : '';
		?>
		<a href="<?php echo $link_url; ?>" class="<?php echo $active_class; ?>"><?php echo esc_html( $label ); ?></a>
	<?php endforeach; ?>
</nav>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>
