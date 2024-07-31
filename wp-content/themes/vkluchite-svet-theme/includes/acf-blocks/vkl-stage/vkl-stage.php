<?php
// Support custom "anchor" values.
$anchor = '';
if (!empty($block['anchor'])) {
  $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'sd-stage';
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
$stages = !empty($get_fields['stages']) ? $get_fields['stages'] : [];

$fadeInLeft_animated = $is_animate ? 'wow animate__animated animate__fadeInLeft' : '';
?>

<section <?php echo $anchor; ?>class="<?php echo esc_attr($class_name); ?>">
  <div class="container">
    <?php
    if ( $title ) {
      echo "<h2 class=\"{$fadeInLeft_animated}\">{$title}</h2>";
    }

    if ( $subtitle ) {
      echo "<h3>{$subtitle}</h3>";
    }
    ?>

    <?php if ($stages ) : ?>
      <div class="swiper swiper-stage">
        <div class="swiper-wrapper">
          <?php $index = 0; ?>
          <?php foreach ($stages as $stage_row) : ?>
            <?php
            $number = ++$index . '. ';
            $stage_title = !empty($stage_row['title']) ? esc_html($number . $stage_row['title']) : $number;
            $stage_desc = !empty($stage_row['desc']) ? wp_kses_post($stage_row['desc']) : '';
            $has_button = !empty($stage_row['has_button']) ? (bool)$stage_row['has_button'] : false;
            ?>
            <div class="swiper-slide">
              <?php
              if ( $stage_title ) {
                echo "<h4>{$stage_title}</h4>";
              }

              if ( $stage_desc ) {
                echo "<p>{$stage_desc}</p>";
              }

              if ( $has_button ) {
                echo '<a class="sd-header__modal-button">Оставить заявку</a>';
              }
              ?>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endif; ?>
  </div>

  <?php
  if ($stages ) {
    echo '<div class="swiper-scrollbar swiper-scrollbar-stage"></div>';
  }
  ?>
</section>