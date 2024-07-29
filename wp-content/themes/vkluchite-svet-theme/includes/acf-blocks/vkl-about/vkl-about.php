<?php
// Support custom "anchor" values.
$anchor = '';
if (!empty($block['anchor'])) {
  $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'sd-about';
if (!empty($block['className'])) {
  $class_name .= ' ' . $block['className'];
}

if (!empty($block['align'])) {
  $class_name .= ' align' . $block['align'];
}

// Get Fields
$get_fields = get_fields();
$is_animate = !empty($get_fields['animate']) ? (bool)$get_fields['animate'] : false;

$fadeInLeft_animated = $is_animate ? 'wow animate__animated animate__fadeInLeft' : '';
$fadeInRight_animated = $is_animate ? 'wow animate__animated animate__fadeInRight' : '';
$fadeInUp_animated = $is_animate ? 'wow animate__animated animate__fadeInUp' : '';
?>

<section <?php echo $anchor; ?>class="<?php echo esc_attr($class_name); ?>">
  <div class="container">
    <?php if (!empty($get_fields['type']) && have_rows('type')) : ?>
      <?php while (have_rows('type')) : the_row(); ?>
        <?php if (get_row_layout() === 'top') : ?>
          <?php
          $title = get_sub_field('title') ? esc_html(get_sub_field('title')) : '';
          $subtitle = get_sub_field('subtitle') ? esc_html(get_sub_field('subtitle')) : '';
          $desc = get_sub_field('desc') ? esc_html(get_sub_field('desc')) : '';
          $image_id = get_sub_field('image_id') ? intval(get_sub_field('image_id')) : '';
          $text = get_sub_field('text') ? wp_kses_post(get_sub_field('text')) : '';
          $big_image_id = get_sub_field('big_image_id') ? intval(get_sub_field('big_image_id')) : '';
          ?>
          <div class="sd-about__top">
            <div class="sd-about__text-box">
              <?php
              echo $title ? "<h2 class='{$fadeInLeft_animated}'>{$title}</h2>" : '';
              echo $subtitle ? "<h3>{$subtitle}</h3>" : '';
              echo $desc ? "<h4>{$desc}</h4>" : '';
              ?>

              <div class="sd-about__description-box">
                <?php
                if ($image_id) {
                  echo wp_get_attachment_image($image_id, 'medium', null, ['class' => $fadeInLeft_animated]);
                }

                echo $text ? "<div class='sd-about__description-text'>$text</div>" : '';
                ?>
              </div>
            </div>

            <?php
            if ($big_image_id) {
              echo wp_get_attachment_image($big_image_id, 'large', null, ['class' => 'sd-about__img-big ' . $fadeInRight_animated]);
            }
            ?>

            <div class="sd-about__description-box sd-about__description-box_mob">
              <?php echo $text ? "<div class='sd-about__description-text'>$text</div>" : ''; ?>
            </div>
          </div>
        <?php endif; ?>

        <?php if (get_row_layout() === 'bottom') : ?>
          <?php
          $image_is = get_sub_field('image_is') ? intval(get_sub_field('image_is')) : '';
          $desc = get_sub_field('desc') ? wp_kses_post(get_sub_field('desc')) : '';
          $ins = get_sub_field('desc') ? esc_html(get_sub_field('ins')) : '';
          ?>
          <div class="sd-about__bottom">
            <?php
            if ($image_is) {
              echo wp_get_attachment_image($image_is, 'medium', null, ['class' => $fadeInUp_animated]);
            }

            if ( $desc ) {
              $ins = $ins ? "<span>$ins</span>" : '';
              echo "<h5>{$desc} {$ins}</h5>";
            }
            ?>
          </div>
        <?php endif; ?>
      <?php endwhile; ?>
    <?php endif; ?>
  </div>
</section>