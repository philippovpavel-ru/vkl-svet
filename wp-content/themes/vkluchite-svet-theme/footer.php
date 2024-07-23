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
        <a href="tel:+79150009081" class="sd-footer__tel">+7 (915) 000-90-81</a>
        <a href="mailto:svet@mail.ru" class="sd-footer__mail">svet@mail.ru</a>

        <div class="sd-form__social-box">
          <a href="https://t.me/NatalyLandyreva">tg</a>
          <a href="https://wa.me/79150009081">whats app</a>
          <a href="https://www.instagram.com/gnk_design">inst</a>
          <a href="https://vk.com/im?media=&sel=-211310209">vk</a>
          <a class="sd-header__modal-button"></a>
        </div>
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
      <a href="favorite.html" class="favorite"></a>
      <a href="cart.html" class="cart"></a>
    <?php endif; ?>
    <a class="sd-header__modal-button"></a>
  </div>

  <dialog id="modalDialog">
    <div class="sd-dialog__wrapper">
      <div class="sd-dialog__grid">
        <img src="<?= VKLS_THEME_URL; ?>/assets/img/modal.jpeg" alt="" class="modal__img">
        <div class="inline-inner">
          <h4 class="text-center">
            Заполните форму обратной связи
          </h4>
          <h5>
            и мы свяжемся с вами в ближайшее время
          </h5>
          <form action="#" class="wpcf7-form">

            <span class="wpcf7-form-control-wrap">
              <input class="wpcf7-form-control wpcf7-text" placeholder="Имя" value="" type="text" name="square" />
            </span>

            <span class="wpcf7-form-control-wrap">
              <input class="wpcf7-form-control wpcf7-tel" placeholder="Телефон" value="" type="tel" name="user-tel" />
            </span>

            <input class="wpcf7-form-control wpcf7-submit" type="submit" value="Оставить заявку" />
            <p class="sd-form__description">
              Отправляя, форму обратной связи, вы&nbsp;соглашаетесь с&nbsp;политикой обработки персональных данных
            </p>
          </form>

          <a class="sd-dialog__close">
            <img src="<?= VKLS_THEME_URL; ?>/assets/img/close.svg" alt="">
          </a>
        </div>
      </div>
    </div>
  </dialog>

  <?php wp_footer(); ?>
  </body>

  </html>