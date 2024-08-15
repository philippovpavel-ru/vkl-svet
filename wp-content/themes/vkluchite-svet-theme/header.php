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

  <?php
  $options = [];
  if (function_exists('get_fields')) {
    $options = get_fields('option');
  }
  ?>

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

        <?php
        if (class_exists('WooCommerce') && function_exists('vklsvet_wc_cart_link')) {
          vklsvet_wc_cart_link();
        }
        ?>

        <div class="sd-header__tel-box">
          <?php
          $phone = isset($options['phone']) ? esc_html($options['phone']) : '';
          $cf7_id = isset($options['contact_form_id']) ? esc_html($options['contact_form_id']) : '';
          $cf7_text_button = 
            isset($options['cf7_text_button_to_header']) && $options['cf7_text_button_to_header']
            ? esc_html($options['cf7_text_button_to_header'])
            : 'Заказать звонок';

          if ($phone) {
            $phone_url = 'tel:+' . preg_replace('![^0-9]+!', '', $phone);
            echo "<a href=\"$phone_url\" class=\"sd-header__tel\">$phone</a>";
          }

          if ($cf7_id) {
            echo "<a class=\"sd-header__modal-button\">$cf7_text_button</a>";
          }
          ?>
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

      <?php
      $phone = isset($options['phone']) ? esc_html($options['phone']) : '';
      if ($phone) {
        $phone_url = 'tel:+' . preg_replace('![^0-9]+!', '', $phone);
        echo "<a href=\"$phone_url\" class=\"sd-burger__tel\">$phone</a>";
      }
      ?>

      <?php
      $vk_url = isset($options['vk_url']) ? esc_url($options['vk_url']) : '';
      $telegram_url = isset($options['telegram_url']) ? esc_url($options['telegram_url']) : '';
      $whatsapp_url = isset($options['whatsapp_url']) ? esc_url($options['whatsapp_url']) : '';
      $instagram_url = isset($options['instagram_url']) ? esc_url($options['instagram_url']) : '';

      $is_true = $vk_url || $telegram_url || $whatsapp_url || $instagram_url;
      ?>

      <?php if ($is_true) : ?>
        <div class="sd-form__social-box">
          <?php if ($telegram_url) : ?>
            <a href="<?php echo $telegram_url; ?>" target="_blank" title="Telegram">tg</a>
          <?php endif; ?>

          <?php if ($whatsapp_url) : ?>
            <a href="<?php echo $whatsapp_url; ?>" target="_blank" title="WhatsApp">whats app</a>
          <?php endif; ?>

          <?php if ($instagram_url) : ?>
            <a href="<?php echo $instagram_url; ?>" target="_blank" title="Instagram">inst</a>
          <?php endif; ?>

          <?php if ($vk_url) : ?>
            <a href="<?php echo $vk_url; ?>" target="_blank" title="VK">vk</a>
          <?php endif; ?>
        </div>
      <?php endif; ?>
    </div>
  </nav>

  <?php
  if (!is_front_page()) {
    snd_breadcrumbs();
  }
  ?>