<?php
// Support custom "anchor" values.
$anchor = '';
if (!empty($block['anchor'])) {
  $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'sd-stocks';
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
$slider = !empty($get_fields['slider']) ? $get_fields['slider'] : [];

$fadeInLeft_animated = $is_animate ? 'wow animate__animated animate__fadeInLeft' : '';
?>

<section <?php echo $anchor; ?>class="<?php echo esc_attr($class_name); ?>">
  <div class="container">
    <?php
    if ( $title ) {
      echo "<h2 class=\"{$fadeInLeft_animated}\">{$title}</h2>";
    }
    ?>

    <?php if ($slider) : ?>
      <div class="swiper swiper-main">
        <div class="swiper-wrapper">
          <?php
          foreach ($slider as $slide_row) {
            $image_id = !empty($slide_row['image_id']) ? intval($slide_row['image_id']) : '';
            $url_array = !empty($slide_row['url_array']) ? $slide_row['url_array'] : [];
            $title = !empty($slide_row['title']) ? esc_html($slide_row['title']) : '';
            $subtitle_01 = !empty($slide_row['subtitle_01']) ? esc_html($slide_row['subtitle_01']) : '';
            $subtitle_02 = !empty($slide_row['subtitle_02']) ? esc_html($slide_row['subtitle_02']) : '';

            $content = '';
            $subtitle = '';

            if ($title ) {
              $content .= "<h3>{$title}</h3>";
            }

            if ($subtitle_01 || $subtitle_02) {
              if ( $subtitle_01 ) {
                $subtitle .= "<span>{$subtitle_01}</span>";
              }

              if ( $subtitle_02 ) {
                $subtitle .= $subtitle_02;
              }

              $content .= "<h4>{$subtitle}</h4>";
            }

            if ($image_id) {
              $image = esc_url( wp_get_attachment_image_url($image_id, '2048x2048') );
            } else {
              $image = VKLS_THEME_URL . '/assets/img/s1.jpeg';
            }

            if ( $url_array ) {
              $url = !empty($url_array['url']) ? esc_url($url_array['url']) : '#';
              $target = !empty($url_array['target']) ? esc_attr($url_array['target']) : '_self';
              $link_title = !empty($url_array['title']) ? esc_html($url_array['title']) : 'Подробнее';

              echo "<a href='{$url}' target='{$target}' title='{$title}' class='swiper-slide' style='background-image: url($image);'>$content</a>";
            } else {
              echo "<div class='swiper-slide' style='background-image: url($image);'>$content</div>";
            }
          }
          ?>
        </div>
        <div class="swiper-pagination swiper-pagination-main"></div>
      </div>
    <?php endif; ?>
  </div>
</section>