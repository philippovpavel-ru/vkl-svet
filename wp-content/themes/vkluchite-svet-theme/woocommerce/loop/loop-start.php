<?php
if (!defined('ABSPATH')) {
	exit;
}

$class = 'swiper-wrapper';
if (is_shop() || is_product_taxonomy()) {
	$class = 'sd-catalog__catalog-grid';
}
?>

<ul class="products columns-<?php echo esc_attr(wc_get_loop_prop('columns')); ?> <?php echo $class; ?>">