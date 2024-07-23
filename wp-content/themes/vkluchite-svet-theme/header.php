<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

  <header class="sd-header">
    <div class="container">
      <?php
      $homeurl = esc_url(get_bloginfo('url'));
      $sitetitle = esc_html(get_bloginfo('title'));

      echo "<a href=\"$homeurl\" title=\"$sitetitle\" class=\"sd-header__index\">$sitetitle</a>";
      ?>

      <?php
      wp_nav_menu([
        'theme_location' => 'primary',
        'container' => 'nav',
        'container_class' => 'sd-header__nav',
        'menu_class' => 'sd-header__menu',
        'depth' => 1,
        'fallback_cb' => '',
      ]);
      ?>

      <div class="sd-header__buttons">
        <a class="sd-header__search-button"></a>

        <?php if (class_exists('WooCommerce')) : ?>
          <a href="cart.html" class="sd-header__cart-button">
            100
          </a>
        <?php endif; ?>

        <div class="sd-header__tel-box">
          <a href="tel:+79150009081" class="sd-header__tel">+7 (915) 000-90-81</a>

          <a class="sd-header__modal-button">
            Заказать звонок
          </a>
        </div>
      </div>

      <a class="sd-header__burger-button">
        <span></span>
        <span></span>
      </a>
    </div>
  </header>

  <form action="<?php echo esc_url(home_url('/')); ?>" class="sd-search">
    <div class="container">
      <input type="search" name="s" placeholder="Я ищу" value="<?php the_search_query(); ?>" class="b-search__input">
      <button type="submit" class="b-search__button"></button>
    </div>
  </form>

  <nav class="sd-burger">
    <div class="sd-burger__bottom">
      <?php
      wp_nav_menu([
        'theme_location' => 'mobile',
        'container' => false,
        'menu_class' => 'sd-burger__menu',
        'depth' => 1,
        'fallback_cb' => '',
      ]);
      ?>

      <a href="tel:+79150009081" class="sd-burger__tel">+7 (915) 000-90-81</a>

      <div class="sd-form__social-box">
        <a href="https://t.me/NatalyLandyreva">
          tg
        </a>
        <a href="https://wa.me/79150009081">whats app</a>
        <a href="https://www.instagram.com/gnk_design">inst</a>
        <a href="https://vk.com/im?media=&sel=-211310209">vk</a>
      </div>
    </div>
  </nav>