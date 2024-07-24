<?php
$options = $args['options'];

$cf7_id = isset($options['contact_form_id']) ? intval($options['contact_form_id']) : '';
$cf7_image_id = isset($options['cf7_image_id']) ? intval($options['cf7_image_id']) : '';
$cf7_title = isset($options['cf7_title']) ? esc_html($options['cf7_title']) : '';
$cf7_subtitle = isset($options['cf7_subtitle']) ? esc_html($options['cf7_subtitle']) : '';

$cf7_image = $cf7_image_id ? wp_get_attachment_image($cf7_image_id, 'large', false, array('class' => 'modal__img')) : '';
?>

<dialog id="modalDialog">
  <div class="sd-dialog__wrapper">
    <div class="sd-dialog__grid">
      <?php echo $cf7_image; ?>

      <div class="inline-inner">
        <h4 class="text-center"><?php echo $cf7_title; ?></h4>
        <h5><?php echo $cf7_subtitle; ?></h5>

        <?php echo do_shortcode('[contact-form-7 id="' . $cf7_id . '"]'); ?>

        <!-- <form action="#" class="wpcf7-form">
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
        </form> -->

        <a class="sd-dialog__close">
          <img src="<?= VKLS_THEME_URL; ?>/assets/img/close.svg" alt="">
        </a>
      </div>
    </div>
  </div>
</dialog>