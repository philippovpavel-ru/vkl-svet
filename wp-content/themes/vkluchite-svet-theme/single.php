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
  <section class="sd-popular">
    <div class="container">
      <h2>Товары по теме статьи</h2>
      <div class="swiper swiper-pop">
        <div class="swiper-wrapper">
          <div class="swiper-slide sd-card">
            <a href="card.html" class="sd-card__img">
              <img src="img/c1.jpeg" alt="">
            </a>
            <a href="card.html" class="sd-card__name">Люстра потолочная светодиодная
              в кухню и гостиную</a>
            <a href="card.html" class="sd-card__price">44 120 ₽</a>
            <a href="card.html" class="sd-card__old-price">144 120 ₽</a>
            <a class="sd-card__cart"></a>
          </div>
          <div class="swiper-slide sd-card">
            <a href="card.html" class="sd-card__img">
              <img src="img/c2.jpeg" alt="">
            </a>
            <a href="card.html" class="sd-card__name">
              Люстра эксклюзивная ручная работа Aqua luxury brass
            </a>
            <a href="card.html" class="sd-card__price">135 000 — 250 000р.</a>
            <a class="sd-card__cart"></a>
          </div>
          <div class="swiper-slide sd-card">
            <a href="card.html" class="sd-card__img">
              <img src="img/c3.jpeg" alt="">
            </a>
            <a href="card.html" class="sd-card__name">Настенный светильник Aqua Copper</a>
            <a href="card.html" class="sd-card__price">19 300 — 22 300 ₽</a>
            <a href="card.html" class="sd-card__old-price">119 300 — 222 300 ₽</a>
            <a class="sd-card__cart"></a>
          </div>
          <div class="swiper-slide sd-card">
            <a href="card.html" class="sd-card__img">
              <img src="img/c1.jpeg" alt="">
            </a>
            <a href="card.html" class="sd-card__name">Настенный светильник Voa Porch Copper silumin</a>
            <a href="card.html" class="sd-card__price">16 500 ₽</a>
            <a href="card.html" class="sd-card__old-price">44 120 ₽</a>
            <a class="sd-card__cart"></a>
          </div>
          <div class="swiper-slide sd-card">
            <a href="card.html" class="sd-card__img">
              <img src="img/c2.jpeg" alt="">
            </a>
            <a href="card.html" class="sd-card__name">Люстра потолочная светодиодная
              в кухню и гостиную</a>
            <a href="card.html" class="sd-card__price">44 120 ₽</a>
            <a href="card.html" class="sd-card__old-price">144 120 ₽</a>
            <a class="sd-card__cart"></a>
          </div>
          <div class="swiper-slide sd-card">
            <a href="card.html" class="sd-card__img">
              <img src="img/c3.jpeg" alt="">
            </a>
            <a href="card.html" class="sd-card__name">Люстра потолочная светодиодная
              в кухню и гостиную</a>
            <a href="card.html" class="sd-card__price">44 120 ₽</a>
            <a href="card.html" class="sd-card__old-price">144 120 ₽</a>
            <a class="sd-card__cart"></a>
          </div>
        </div>
      </div>
    </div>
  </section>
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
