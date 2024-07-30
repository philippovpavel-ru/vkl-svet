<?php
// Support custom "anchor" values.
$anchor = '';
if (!empty($block['anchor'])) {
  $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'sd-question';
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
$faq = !empty($get_fields['faq']) ? $get_fields['faq'] : [];

$fadeInLeft_animated = $is_animate ? 'wow animate__animated animate__fadeInLeft' : '';
?>

<section <?php echo $anchor; ?>class="<?php echo esc_attr($class_name); ?>">
  <div class="container">
    <?php if ($title) : ?>
      <h2 class="<?php echo $fadeInLeft_animated; ?>"><?php echo $title; ?></h2>
    <?php endif; ?>

    <?php if ($faq) : ?>
      <div class="sd-question__details">
        <?php foreach ($faq as $faq_row) : ?>
          <?php
          $fag_title = !empty($faq_row['title']) ? esc_html($faq_row['title']) : '';
          $fag_text = !empty($faq_row['text']) ? wp_kses_post($faq_row['text']) : '';
          ?>
          <div class="b-protocol__details">
            <h4 class="b-protocol__details-button"><?php echo $fag_title; ?></h4>
            <div class="b-protocol__details-box">
              <p><?php echo $fag_text; ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>