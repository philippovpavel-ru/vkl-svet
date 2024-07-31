<?php
// Support custom "anchor" values.
$anchor = '';
if (!empty($block['anchor'])) {
  $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'sd-popular';
if (!empty($block['className'])) {
  $class_name .= ' ' . $block['className'];
}

if (!empty($block['align'])) {
  $class_name .= ' align' . $block['align'];
}

if ( !class_exists('WooCommerce') ) {
  if ( is_admin() ) {
    echo '<p>Для работы требуется активировать плагин "WooCommerce"</p>';
  }

  return;
}

// Get Fields
$get_fields = get_fields();
$title = !empty($get_fields['title']) ? esc_html($get_fields['title']) : '';
$is_animate = !empty($get_fields['animate']) ? (bool)$get_fields['animate'] : false;

$fadeInLeft_animated = $is_animate ? 'wow animate__animated animate__fadeInLeft' : '';
?>

<section <?php echo $anchor; ?>class="<?php echo esc_attr($class_name); ?>">
  <div class="container">
    <?php
    if ($title) {
      echo "<h2 class='{$fadeInLeft_animated}'>{$title}</h2>";
    }
    ?>

    <div class="swiper swiper-pop">
      <div class="swiper-wrapper">
        <div class="swiper-slide sd-card">
          <a class="sd-card__favorite"></a>
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
          <a class="sd-card__favorite"></a>
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
          <a class="sd-card__favorite"></a>
          <a href="card.html" class="sd-card__img">
            <img src="img/c3.jpeg" alt="">
          </a>
          <a href="card.html" class="sd-card__name">Настенный светильник Aqua Copper</a>
          <a href="card.html" class="sd-card__price">19 300 — 22 300 ₽</a>
          <a href="card.html" class="sd-card__old-price">119 300 — 222 300 ₽</a>
          <a class="sd-card__cart"></a>
        </div>

        <div class="swiper-slide sd-card">
          <a class="sd-card__favorite"></a>
          <a href="card.html" class="sd-card__img">
            <img src="img/c1.jpeg" alt="">
          </a>
          <a href="card.html" class="sd-card__name">Настенный светильник Voa Porch Copper silumin</a>
          <a href="card.html" class="sd-card__price">16 500 ₽</a>
          <a href="card.html" class="sd-card__old-price">44 120 ₽</a>
          <a class="sd-card__cart"></a>
        </div>

        <div class="swiper-slide sd-card">
          <a class="sd-card__favorite"></a>
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
          <a class="sd-card__favorite"></a>
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