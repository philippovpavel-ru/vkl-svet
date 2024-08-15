<?php
// Support custom "anchor" values.
$anchor = '';
if (!empty($block['anchor'])) {
  $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'sd-main';
if (!empty($block['className'])) {
  $class_name .= ' ' . $block['className'];
}

if (!empty($block['align'])) {
  $class_name .= ' align' . $block['align'];
}

// Get Fields
$get_fields = get_fields();
$is_animate = !empty($get_fields['animate']) ? (bool)$get_fields['animate'] : false;
$title = !empty($get_fields['title']) ? esc_html($get_fields['title']) : '';
$subtitle = !empty($get_fields['subtitle']) ? esc_html($get_fields['subtitle']) : '';
$image_id_01 = !empty($get_fields['image_id_01']) ? intval($get_fields['image_id_01']) : '';
$image_id_02 = !empty($get_fields['image_id_02']) ? intval($get_fields['image_id_02']) : '';

$fadeInLeft_animated = $is_animate ? 'wow animate__animated animate__fadeInLeft' : '';
$fadeInRight_animated = $is_animate ? 'wow animate__animated animate__fadeInRight' : '';
$fadeInUp_animated = $is_animate ? 'wow animate__animated animate__fadeInUp' : '';
?>

<main <?php echo $anchor; ?>class="<?php echo esc_attr($class_name); ?>">
  <div class="container">
    <?php
    if ( $title ) {
      echo "<h1 class=\"{$fadeInLeft_animated}\">{$title}</h1>";
    }

    if ( $subtitle ) {
      echo "<h2 class=\"{$fadeInRight_animated}\">{$subtitle}</h2>";
    }

    if ( $image_id_01 || $image_id_02 ) {
      $images = '';

      if ( $image_id_01 ) {
        $images .= wp_get_attachment_image( $image_id_01, 'medium', false, array( 'class' => $fadeInLeft_animated ) );
      }

      if ( $image_id_02 ) {
        $images .= wp_get_attachment_image( $image_id_02, '1536x1536', false, array( 'class' => $fadeInUp_animated ) );
      }

      echo "<div class=\"sd-main__img-box\">{$images}</div>";
    }
    ?>
  </div>
</main>