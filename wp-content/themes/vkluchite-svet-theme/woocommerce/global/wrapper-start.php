<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}
?>

<?php if (is_shop() || is_product_taxonomy()) : ?>
	<div class="sd-catalog">
		<div class="container">
			<?php woocommerce_product_taxonomy_archive_header(); ?>
			<div class="sd-catalog__grid">
				<?php woocommerce_get_sidebar(); ?>

				<div class="sd-catalog__catalog-box">
<?php endif; ?>