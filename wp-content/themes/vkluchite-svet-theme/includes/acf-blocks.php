<?php
add_filter('block_categories_all', 'vklsvet_block_categories');
function vklsvet_block_categories($categories)
{
  $include = true;
  $slug = 'snd-blocks';
  $title = 'VKLSVET Blocks';

  foreach ($categories as $category) {
    if ($slug === $category['slug']) {
      $include = false;
    }
  }

  if ($include) {
    $categories = array_merge(
      [
        [
          'slug'  => $slug,
          'title' => $title,
        ],
      ],
      $categories
    );
  }

  return $categories;
}

add_action('init', 'vklsvet_register_acf_blocks');
function vklsvet_register_acf_blocks()
{
  $blocks = glob(__DIR__ . '/acf-blocks/*');
  if (!$blocks) {
    return;
  }

  foreach ($blocks as $block) {
    register_block_type($block);
  }
}