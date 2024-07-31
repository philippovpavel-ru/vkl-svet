<?php
// Support custom "anchor" values.
$anchor = '';
if (!empty($block['anchor'])) {
  $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'sd-studio';
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
$subtitle_01 = !empty($get_fields['subtitle_01']) ? esc_html($get_fields['subtitle_01']) : '';
$subtitle_02 = !empty($get_fields['subtitle_02']) ? esc_html($get_fields['subtitle_02']) : '';
$image_bg_id = !empty($get_fields['image_bg_id']) ? intval($get_fields['image_bg_id']) : '';
$image_decor_id = !empty($get_fields['image_decor_id']) ? intval($get_fields['image_decor_id']) : '';
$link_array = !empty($get_fields['link_array']) ? $get_fields['link_array'] : [];

$fadeInLeft_animated = $is_animate ? 'wow animate__animated animate__fadeInLeft' : '';
$fadeInRight_animated = $is_animate ? 'wow animate__animated animate__fadeInRight' : '';

$content = '';
$headline = '';

if ($image_bg_id) {
  $image_bg_url = wp_get_attachment_image_url($image_bg_id, 'full');
} else {
  $image_bg_url = VKLS_THEME_URL . '/assets/img/studio1.jpeg';
}

$default_attrs = [
  'class="sd-studio__wrapper"',
  'style="background: url(' . $image_bg_url . ') no-repeat center; background-size: cover;"'
];
?>

<section <?php echo $anchor; ?>class="<?php echo esc_attr($class_name); ?>">
  <?php
  // Наполняем $headline
  if ($title) {
    $headline .= $title;
  }

  if ($subtitle_01) {
    $headline .= "<span class='sd-studio__span1 {$fadeInRight_animated}'>{$subtitle_01}</span>";
  }

  if ($subtitle_02) {
    $headline .= "<span class='sd-studio__span2'>{$subtitle_02}</span>";
  }
  ?>

  
  <?php
  // Наполняем $content
  $content .= "<h2 class='{$fadeInLeft_animated}'>$headline</h2>";

  if ($image_decor_id) {
    $content .= wp_get_attachment_image($image_decor_id, 'medium', false, ['class' => 'sd-studio__decor']);
  } else {
    $content .= '<img src="' . VKLS_THEME_URL . '/assets/img/studio2.png" class="sd-studio__decor">';
  }
  ?>

  <?php if ($link_array) : // Выводим результат ?>
    <?php
    $link_attrs = [
      'href="' . ( esc_url($link_array['url']) ?: '#' ) . '"',
      'target="' . ( $link_array['target'] ? esc_attr($link_array['target']) : '_self' ) . '"',
      'title="' . ( esc_attr($link_array['title']) ) . '"',
    ];

    $attrs = array_merge($link_attrs, $default_attrs );
    ?>
    <a <?php echo implode(' ', $attrs); ?>>
      <div class="container"><?php echo $content; ?></div>
    </a>
  <?php else : ?>
    <div <?php echo implode(' ', $default_attrs); ?>>
      <div class="container"><?php echo $content; ?></div>
    </div>
  <?php endif; ?>
</section>