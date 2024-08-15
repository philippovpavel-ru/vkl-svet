<?php
// Support custom "anchor" values.
$anchor = '';
if (!empty($block['anchor'])) {
  $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'sd-text';
if (!empty($block['className'])) {
  $class_name .= ' ' . $block['className'];
}

if (!empty($block['align'])) {
  $class_name .= ' align' . $block['align'];
}

$template = array(
  array(
    'core/heading',
    array(
      'level'   => 1,
      'content' => 'Заголовок'
    ),
  ),
  array(
    'core/heading',
    array(
      'level'   => 2,
      'content' => 'Подзаголовок'
    ),
  ),
  array(
    'core/paragraph',
    array(
      'content' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Tempora accusamus est reprehenderit deserunt suscipit eaque temporibus magnam amet non autem dolore ducimus debitis in, doloremque enim quibusdam vel at sunt, labore voluptas voluptatibus? Dicta ipsam reiciendis aspernatur. Distinctio quas, quibusdam odit maxime, facilis voluptatem magnam, esse quo id maiores repellendus?',
    ),
  ),
);
?>
<main <?php echo $anchor; ?>class="<?php echo esc_attr($class_name); ?>">
  <InnerBlocks class="container" template="<?php echo esc_attr(wp_json_encode($template)); ?>" />
</main>