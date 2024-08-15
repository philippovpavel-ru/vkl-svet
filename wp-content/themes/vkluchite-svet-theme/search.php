<?php get_header(); ?>

<section class="sd-blog">
  <div class="container">
    <h2>Поиск "<?php echo get_search_query(); ?>"</h2>

    <?php if (have_posts()) : ?>

      <div class="sd-blog__page-grid">
        <?php
        while (have_posts()) {
          the_post();

          if (get_post_type() === 'product') {
            echo wc_get_template_part( 'content', 'product' );
          } else {
            get_template_part('partials/card', 'default', ['isSwiper' => false]);
          }
        }
        ?>
      </div>

      <?php
      the_posts_pagination([
        'prev_text' => '',
        'next_text' => '',
      ]);
      ?>

    <?php else: ?>
      <p>Ничего не найдено</p>
    <?php endif; ?>
  </div>
</section>

<?php get_footer();
