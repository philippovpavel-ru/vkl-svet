<?php
add_action('after_setup_theme', 'vklsvet_wc_theme_setup');
function vklsvet_wc_theme_setup()
{
  add_theme_support(
    'woocommerce',
    array(
      'thumbnail_image_width' => 315,
      'gallery_thumbnail_image_width' => 200,
      'single_image_width'    => 958,
      'product_grid'          => array(
        'default_rows'    => 2,
        'min_rows'        => 1,
        'default_columns' => 4,
        'min_columns'     => 2,
        'max_columns'     => 4,
      ),
    )
  );
}
