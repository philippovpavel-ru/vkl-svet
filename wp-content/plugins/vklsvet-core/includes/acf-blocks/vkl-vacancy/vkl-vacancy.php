<?php
// Support custom "anchor" values.
$anchor = '';
if (!empty($block['anchor'])) {
  $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'sd-vacantions';
if (!empty($block['className'])) {
  $class_name .= ' ' . $block['className'];
}

if (!empty($block['align'])) {
  $class_name .= ' align' . $block['align'];
}

// Get Fields
$get_fields = get_fields();
$title = !empty($get_fields['title']) ? esc_html($get_fields['title']) : '';

$get_posts = get_posts([
  'posts_per_page' => -1,
  'post_type' => 'vklsvet_vacancy',
  'post_status' => 'publish',
])
?>

<main <?php echo $anchor; ?>class="<?php echo esc_attr($class_name); ?>">
  <div class="container">
    <?php
    if ($title) {
      echo "<h1>{$title}</h1>";
    }
    ?>

    <?php if ($get_posts) : ?>
      <?php global $post; ?>
      <div class="sd-vacantions__grid">
        <?php foreach ($get_posts as $post) : ?>
          <?php
          setup_postdata($post);

          $vacancyID = get_the_ID();
          $get_fields_vacancy = get_fields($vacancyID);
          $vacancy_phone = !empty($get_fields_vacancy['phone']) ? esc_html($get_fields_vacancy['phone']) : '';
          $vacancy_email = !empty($get_fields_vacancy['email']) ? sanitize_email($get_fields_vacancy['email']) : '';
          ?>

          <div class="sd-vacantions__card">
            <div>
              <?php the_title('<h2>', '</h2>')?>
            </div>
            <div>
              <?php the_content(); ?>
            </div>

            <?php if ($vacancy_phone) : ?>
              <div>
                <p>Записаться на собеседование</p>
                <a href="tel:+<?php echo preg_replace('![^0-9]+!', '', $vacancy_phone); ?>">
                  <?php echo $vacancy_phone; ?>
                </a>
              </div>
            <?php endif; ?>

            <?php if ($vacancy_email) : ?>
              <div>
                <p>Подать резюме на электронную почту</p>
                <a href="mailto:<?php echo $vacancy_email; ?>">
                  <?php echo $vacancy_email; ?>
                </a>
              </div>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
      <?php wp_reset_postdata(); ?>
    <?php endif; ?>
  </div>
</main>