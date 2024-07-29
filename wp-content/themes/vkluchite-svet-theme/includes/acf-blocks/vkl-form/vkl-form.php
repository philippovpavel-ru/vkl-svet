<?php
// Support custom "anchor" values.
$anchor = '';
if (!empty($block['anchor'])) {
  $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'sd-form';
if (!empty($block['className'])) {
  $class_name .= ' ' . $block['className'];
}

if (!empty($block['align'])) {
  $class_name .= ' align' . $block['align'];
}

// Get Fields
$get_fields = get_fields();
$title = !empty($get_fields['title']) ? esc_html($get_fields['title']) : '';
$subtitle = !empty($get_fields['subtitle']) ? esc_html($get_fields['subtitle']) : '';
$contact_form_id = !empty($get_fields['contact_form_id']) ? intval($get_fields['contact_form_id']) : 0;
$bg_image_url = !empty($get_fields['bg_image_url']) ? esc_url($get_fields['bg_image_url']) : '';
$is_animate = !empty($get_fields['animate']) ? (bool)$get_fields['animate'] : false;

// Get Options Contacts
$get_options = get_fields('option');
$vk_url = !empty($get_options['vk_url']) ? esc_url($get_options['vk_url']) : '';
$telegram_url = !empty($get_options['telegram_url']) ? esc_url($get_options['telegram_url']) : '';
$whatsapp_url = !empty($get_options['whatsapp_url']) ? esc_url($get_options['whatsapp_url']) : '';
$instagram_url = !empty($get_options['instagram_url']) ? esc_url($get_options['instagram_url']) : '';

$isSocTrue = $vk_url || $telegram_url || $whatsapp_url || $instagram_url;
$wrapper_bg = $bg_image_url ? 'style="background: url(' . $bg_image_url . ') no-repeat center; background-size: cover;"' : ''; 
?>

<section <?php echo $anchor; ?>class="<?php echo esc_attr($class_name); ?>">
  <div class="sd-form__wrapper" <?php echo $wrapper_bg; ?>>
    <div class="container">
      <div class="sd-form__heading">
        <h2 <?php echo $is_animate ? 'class="wow animate__animated animate__fadeInLeft"' : ''; ?>>Заполните форму</h2>
        <h3>или Свяжитесь с&nbsp;нами любым удобным способом, чтобы подобрать освещение для вашего проекта</h3>
      </div>

      <?php if ( $contact_form_id ) : ?>
        <div class="sd-form__form-box">
          <h4>Оставьте заявку</h4>
          <h5>и&nbsp;мы&nbsp;перезвоним вам в&nbsp;ближайшее время</h5>

          <?php echo do_shortcode('[contact-form-7 id="' . $contact_form_id . '"]'); ?>
        </div>
      <?php endif; ?>

      <?php if ($isSocTrue) : ?>
        <div class="sd-form__social-box">
          <?php
          $classses = $is_animate ? 'class="wow animate__animated animate__fadeInUp"' : '';
          ?>
          <?php if ($telegram_url) : ?>
            <a href="<?php echo $telegram_url; ?>" target="_blank" title="Telegram" <?php echo $classses; ?>>tg</a>
          <?php endif; ?>

          <?php if ($whatsapp_url) : ?>
            <a href="<?php echo $whatsapp_url; ?>" target="_blank" title="WhatsApp" <?php echo $classses; ?>>whats app</a>
          <?php endif; ?>

          <?php if ($instagram_url) : ?>
            <a href="<?php echo $instagram_url; ?>" target="_blank" title="Instagram" <?php echo $classses; ?>>inst</a>
          <?php endif; ?>

          <?php if ($vk_url) : ?>
            <a href="<?php echo $vk_url; ?>" target="_blank" title="VK" <?php echo $classses; ?>>vk</a>
          <?php endif; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>