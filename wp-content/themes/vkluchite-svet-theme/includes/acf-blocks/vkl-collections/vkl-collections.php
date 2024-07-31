<?php
// Support custom "anchor" values.
$anchor = '';
if (!empty($block['anchor'])) {
  $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'sd-collections';
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
$collections = !empty($get_fields['collections']) ? $get_fields['collections'] : [];

$fadeInLeft_animated = $is_animate ? 'wow animate__animated animate__fadeInLeft' : '';
$fadeInRight_animated = $is_animate ? 'wow animate__animated animate__fadeInRight' : '';
$fadeInUp_animated = $is_animate ? 'wow animate__animated animate__fadeInUp' : '';
?>

<section <?php echo $anchor; ?>class="<?php echo esc_attr($class_name); ?>">
  <div class="container">
    <?php
    if ( $title ) {
      echo "<h2 class=\"{$fadeInLeft_animated}\">{$title}</h2>";
    }
    ?>

    <?php if ($collections) : ?>
      <?php $index = 0; ?>
      <div class="sd-collections__flex">
        <?php foreach ($collections as $collection_row) : ?>
          <?php
          $item_title = !empty($collection_row['title']) ? esc_html($collection_row['title']) : '';
          $item_subtitle = !empty($collection_row['subtitle']) ? esc_html($collection_row['subtitle']) : '';
          $item_desc = !empty($collection_row['desc']) ? wp_kses_post($collection_row['desc']) : '';
          $image_id_01 = !empty($collection_row['image_id_01']) ? intval($collection_row['image_id_01']) : '';
          $image_id_02 = !empty($collection_row['image_id_02']) ? intval($collection_row['image_id_02']) : '';

          $is_even = ( $index % 2 === 0 );
          ?>
          <div class="sd-collections__card">
            <div class="sd-collections__card-text">
              <?php
              if ($item_title) {
                echo "<p class=\"sd-collections__card-type\">{$item_title}</p>";
              }

              if ($item_subtitle) {
                echo "<h3>{$item_subtitle}</h3>";
              }

              if ($item_desc) {
                echo "<p class=\"sd-collections__card-description\">{$item_desc}</p>";
              }
              ?>
            </div>

            <div class="sd-collections__card-imgs">
              <?php
              if ( $image_id_01 ) {
                echo wp_get_attachment_image( $image_id_01, 'medium', false, array( 'class' => ( $is_even ? $fadeInUp_animated : $fadeInLeft_animated ) ) );
              }

              if ( $image_id_02 ) {
                echo wp_get_attachment_image( $image_id_02, 'medium', false, array( 'class' => ($is_even ? $fadeInRight_animated : $fadeInUp_animated) ) );
              }
              ?>
            </div>

            <?php
            if ($item_desc) {
              echo "<p class=\"sd-collections__card-description sd-collections__card-description_m\">{$item_desc}</p>";
            }
            ?>
          </div>
          <?php $index++; ?>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>