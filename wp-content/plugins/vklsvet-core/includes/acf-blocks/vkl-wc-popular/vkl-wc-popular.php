<?php
// Support custom "anchor" values.
$anchor = '';
if (!empty($block['anchor'])) {
  $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'sd-popular';
if (!empty($block['className'])) {
  $class_name .= ' ' . $block['className'];
}

if (!empty($block['align'])) {
  $class_name .= ' align' . $block['align'];
}

if (!is_plugin_active('woocommerce/woocommerce.php')) {
  if (is_admin()) {
    echo '<p>Для работы требуется активировать плагин "WooCommerce"</p>';
  }

  return;
}

// Get Fields
$get_fields = get_fields();
$title = !empty($get_fields['title']) ? esc_html($get_fields['title']) : '';
$is_animate = !empty($get_fields['animate']) ? (bool)$get_fields['animate'] : false;
$select_products = !empty($get_fields['select_products']) ? $get_fields['select_products'] : [];

$fadeInLeft_animated = $is_animate ? 'wow animate__animated animate__fadeInLeft' : '';
?>

<section <?php echo $anchor; ?>class="<?php echo esc_attr($class_name); ?>">
  <div class="container">
    <?php
    if ($title) {
      echo "<h2 class='{$fadeInLeft_animated}'>{$title}</h2>";
    }
    ?>

    <?php
    if ($select_products) {
      $select_products_string = join(",", array_unique($select_products));

      echo do_shortcode("[products ids='$select_products_string' orderby='post__in' class='swiper swiper-pop']");
    }
    ?>
  </div>
</section>