<?php
$post_id = $post->ID;
$thumbnail_id = get_post_thumbnail_id($post_id);
$image_default = '<img src="'. VKLS_THEME_URL . '/assets/img/b1.jpeg" alt="" loading="lazy">';
$image = $thumbnail_id ? wp_get_attachment_image($thumbnail_id, 'medium') : $image_default;
$title = esc_html(get_the_title());
$description = esc_html(get_the_excerpt());
$post_url = esc_url(get_the_permalink());

$isSwiper = ( isset($args['isSwiper']) && $args['isSwiper'] === false ? false : true );
?>

<div class="sd-blog__card<?php echo $isSwiper ? ' swiper-slide' : ''; ?>" title="<?php echo $title; ?>">
  <?php echo $image; ?>
  <h3><?php echo $title; ?></h3>
  <p><?php echo $description; ?></p>
  <a href="<?php echo $post_url; ?>" title="Читать <?php echo $title; ?>">Читать статью</a>
</div>