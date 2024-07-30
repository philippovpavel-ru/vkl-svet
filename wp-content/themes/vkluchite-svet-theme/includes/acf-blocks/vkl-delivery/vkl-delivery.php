<?php
// Support custom "anchor" values.
$anchor = '';
if (!empty($block['anchor'])) {
  $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'sd-delivery';
if (!empty($block['className'])) {
  $class_name .= ' ' . $block['className'];
}

if (!empty($block['align'])) {
  $class_name .= ' align' . $block['align'];
}

// Get Fields
$get_fields = get_fields();
$is_animate = !empty($get_fields['animate']) ? (bool)$get_fields['animate'] : false;
$image_id_01 = !empty($get_fields['image_id_01']) ? intval($get_fields['image_id_01']) : false;
$image_id_02 = !empty($get_fields['image_id_02']) ? intval($get_fields['image_id_02']) : false;

$fadeInRight_animated = $is_animate ? 'wow animate__animated animate__fadeInRight' : '';
$fadeInUp_animated = $is_animate ? 'wow animate__animated animate__fadeInUp' : '';

$allowedBlocks = [
  'core/paragraph',
  'core/heading',
  'core/list',
  'core/list-item'
];

$template = array(
  array(
    'core/heading',
    array(
      'level'   => 2,
      'content' => 'Заголовок',
      'className' => $fadeInUp_animated
    ),
  ),
  array(
    'core/heading',
    array(
      'level'   => 3,
      'content' => 'Подзаголовок'
    ),
  ),
  array(
    'core/heading',
    array(
      'level'   => 4,
      'content' => 'Список'
    ),
  ),
  array(
    'core/list',
    array(
      'ordered' => true,
    )
  ),
  array(
    'core/paragraph',
    array(
      'content' => 'Абзац текста',
    ),
  ),
);
?>

<section <?php echo $anchor; ?>class="<?php echo esc_attr($class_name); ?>">
  <div class="container">
    <?php
    $innerblocks_attrs = [
      'class="sd-delivery__text"',
      'allowedBlocks="'. esc_attr(wp_json_encode($allowedBlocks)) .'"',
      'template="'. esc_attr(wp_json_encode($template)) .'"',
    ];
    ?>
    <InnerBlocks <?php echo implode(' ', $innerblocks_attrs); ?> />

    <?php
    if ($image_id_01) {
      echo wp_get_attachment_image($image_id_01, 'large', false, ['class' => 'sd-delivery__img1 '. $fadeInRight_animated]);
    }

    if ($image_id_01) {
      echo wp_get_attachment_image($image_id_02, 'medium', false, ['class' => 'sd-delivery__img2 ' . $fadeInUp_animated]);
    }
    ?>
  </div>
</section>