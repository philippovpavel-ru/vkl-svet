<?php get_header(); ?>

<main class="sd-article">
  <div class="container">
    <div class="sd-article__text">
      <span class="sd-article__date"><?php echo get_the_date(); ?></span>
      <?php the_title('<h1>', '</h1>'); ?>
      <?php the_content(); ?>
    </div>
    <div class="sd-article__imgs">
      <?php the_post_thumbnail('large'); ?>

      <?php
      $gallery = function_exists('get_field') ? get_field('gallery') : [];

      if ($gallery) {
        foreach ($gallery as $image_id) {
          echo wp_get_attachment_image($image_id, 'large');
        }
      }
      ?>
      <span class="sd-article__date"><?php echo get_the_date(); ?></span>
    </div>
  </div>
</main>

<?php if (class_exists('WooCommerce')) : ?>
  <?php
  $fields = get_fields();
  $product_title = !empty($fields['product_title']) ? esc_html($fields['product_title']) : 'Товары по теме статьи';
  $select_products = !empty($fields['select_products']) ? $fields['select_products'] : [];
  ?>
  <?php if ($select_products) : ?>
  <section class="sd-popular">
    <div class="container">
      <h2><?php echo $product_title; ?></h2>

      <?php
      $select_products_string = join(",", array_unique($select_products));
      echo do_shortcode("[products ids='$select_products_string' orderby='post__in' class='swiper swiper-pop']");
      ?>
    </div>
  </section>
  <?php endif; ?>
<?php endif; ?>

<?php
$get_posts = get_posts([
  'post_type' => 'post',
  'posts_per_page' => 3,
  'post__not_in' => [get_the_ID()],
]);
?>

<?php if ($get_posts) : ?>
  <?php global $post; ?>
  <section class="sd-blog">
    <div class="container">
      <h2>Другие статьи</h2>
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
    </div>
  </section>
  <?php wp_reset_postdata(); ?>
<?php endif; ?>

<?php get_footer();
