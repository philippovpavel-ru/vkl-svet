  <?php
  $options = [];
  if (function_exists('get_fields')) {
    $options = get_fields('option');
  }

  $cf7_id = isset($options['contact_form_id']) ? intval($options['contact_form_id']) : '';
  ?>
  <footer class="sd-footer">
    <div class="container">
      <div class="sd-footer__logo-box">
        <?php
        $homeurl = esc_url(get_bloginfo('url'));
        $sitetitle = esc_html(get_bloginfo('title'));

        echo "<a href=\"$homeurl\" title=\"$sitetitle\" class=\"sd-footer__logo\">$sitetitle</a>";
        ?>

        <?php if (get_privacy_policy_url()) : ?>
          <a href="<?php echo esc_url(get_privacy_policy_url()); ?>" class="sd-footer__politic">
            Политика конфиденциальности
          </a>
        <?php endif; ?>

        <a href="http://sitesanddesign.ru/" class="sd-footer__politic" target="_blank">
          Разработка сайта - СайтыиДизайн.рф
        </a>
      </div>

      <?php
      wp_nav_menu([
        'theme_location' => 'footer',
        'container' => 'nav',
        'container_class' => 'sd-footer__nav',
        'menu_class' => 'sd-footer__menu',
        'depth' => 1,
        'fallback_cb' => '',
      ]);
      ?>

      <div class="sd-footer__contacts">
        <?php
        $phone = isset($options['phone']) ? esc_html($options['phone']) : '';
        $email = isset($options['email']) ? sanitize_email($options['email']) : '';

        if ($phone) {
          $phone_url = 'tel:+' . preg_replace('![^0-9]+!', '', $phone);
          echo "<a href=\"$phone_url\" class=\"sd-footer__tel\">$phone</a>";
        }

        if ($email) {
          $email_url = 'mailto:' . $email;
          echo "<a href=\"$email_url\" class=\"sd-footer__mail\">$email</a>";
        }
        ?>

        <?php
        $vk_url = isset($options['vk_url']) ? esc_url($options['vk_url']) : '';
        $telegram_url = isset($options['telegram_url']) ? esc_url($options['telegram_url']) : '';
        $whatsapp_url = isset($options['whatsapp_url']) ? esc_url($options['whatsapp_url']) : '';
        $instagram_url = isset($options['instagram_url']) ? esc_url($options['instagram_url']) : '';

        $is_true = $vk_url || $telegram_url || $whatsapp_url || $instagram_url || $cf7_id;
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

            <?php if ($cf7_id) : ?>
              <a class="sd-header__modal-button"></a>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>

      <div class="sd-footer__copy-mob">
        <?php if (get_privacy_policy_url()) : ?>
          <a href="<?php echo esc_url(get_privacy_policy_url()); ?>" class="sd-footer__politic">
            Политика конфиденциальности
          </a>
        <?php endif; ?>

        <a href="http://sitesanddesign.ru/" class="sd-footer__politic" target="_blank">
          Разработка сайта - СайтыиДизайн.рф
        </a>
      </div>
    </div>
  </footer>

  <div class="sd-mobail-panel">
    <a class="sd-header__search-button"></a>
    <?php if (class_exists('WooCommerce')) : ?>

      <?php
      if ( function_exists('phpavel_wc_favorite_link') ) {
        phpavel_wc_favorite_link();
      }
      ?>

      <?php
      if ( function_exists('vklsvet_wc_cart_link') ) {
        vklsvet_wc_cart_link('cart', false);
      }
      ?>
    <?php endif; ?>

    <?php if ($cf7_id) : ?>
      <a class="sd-header__modal-button"></a>
    <?php endif; ?>
  </div>

  <?php if ($cf7_id) {
    get_template_part('partials/dialog', 'cf7', ['options' => $options]);
  } ?>

  <?php wp_footer(); ?>
  </body>

  </html>