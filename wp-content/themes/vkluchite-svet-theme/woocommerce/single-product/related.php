<?php
if (!defined('ABSPATH')) {
  exit;
}

global $product;
$upsells = wc_get_related_products($product->get_id(), $posts_per_page) ?: [];

shuffle($upsells);

if ($upsells) : ?>
  <section class="related products sd-popular">
    <div class="container">
      <?php
      $heading = apply_filters('woocommerce_product_related_products_heading', __('Related products', 'woocommerce'));

      if ($heading) :
      ?>
        <h2><?php echo esc_html($heading); ?></h2>
      <?php endif; ?>

      <div class="swiper swiper-pop">
        <?php woocommerce_product_loop_start(); ?>

        <?php foreach ($upsells as $upsell_id) : ?>

          <?php
          $post_object = get_post($upsell_id);

          setup_postdata($GLOBALS['post'] = &$post_object); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

          wc_get_template_part('content', 'product');
          ?>

        <?php endforeach; ?>

        <?php woocommerce_product_loop_end(); ?>
      </div>
    </div>
  </section>
<?php
endif;

wp_reset_postdata();
