<?php
// Support custom "anchor" values.
$anchor = '';
if (!empty($block['anchor'])) {
  $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'sd-blog';
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
$count_posts = !empty($get_fields['count_posts']) ? intval($get_fields['count_posts']) : 3;

$fadeInLeft_animated = $is_animate ? 'wow animate__animated animate__fadeInLeft' : '';

$get_posts = get_posts([
  'post_type' => 'post',
  'posts_per_page' => $count_posts,
]);
?>

<section <?php echo $anchor; ?>class="<?php echo esc_attr($class_name); ?>">
  <div class="container">
    <?php
    if ( $title ) {
      echo "<h2 class=\"{$fadeInLeft_animated}\">{$title}</h2>";
    }
    ?>

    <?php if ($get_posts) : ?>
      <?php global $post; ?>

      <div class="swiper swiper-blog">
        <div class="swiper-wrapper sd-blog__grid">
          <?php foreach ($get_posts as $post) {
            setup_postdata($post);

            get_template_part('partials/card', 'default');
          } ?>
        </div>
      </div>

      <?php $page_for_posts_id = get_option('page_for_posts'); ?>

      <?php if ($page_for_posts_id) : ?>
        <a href="<?php echo esc_url(get_permalink($page_for_posts_id)); ?>" class="sd-blog__all">СМОТРЕТЬ ВСЕ СТАТЬИ</a>
      <?php endif; ?>

      <?php wp_reset_postdata(); ?>
    <?php else : ?>
      <p>На сайте пока нет статей</p>
    <?php endif; ?>
  </div>
</section>