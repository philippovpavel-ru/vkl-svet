<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}
?>

<?php
global $wp_registered_sidebars;
$sidebar_name = esc_html($wp_registered_sidebars['shop']['name']);
?>
<div class="categ-1-categ__filter">
	<h3 class="sd-catalog__filter-heading">
		<?php echo $sidebar_name; ?>
		<button class="categ-1-categ__filteres-close"></button>
	</h3>

	<?php if (is_active_sidebar('shop')) : ?>
		<?php dynamic_sidebar('shop'); ?>
	<?php endif; ?>
</div>