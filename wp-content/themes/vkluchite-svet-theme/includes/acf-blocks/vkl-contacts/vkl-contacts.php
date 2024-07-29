<?php
// Support custom "anchor" values.
$anchor = '';
if (!empty($block['anchor'])) {
  $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'sd-map';
if (!empty($block['className'])) {
  $class_name .= ' ' . $block['className'];
}

if (!empty($block['align'])) {
  $class_name .= ' align' . $block['align'];
}

// Get Fields
$get_fields = get_fields();
$title = !empty( $get_fields['title'] ) ? esc_html($get_fields['title']) : '';

// Get Options Contacts
$get_options = get_fields('option');
$addresses = !empty($get_options['addresses']) ? $get_options['addresses'] : [];
$periods = !empty($get_options['periods']) ? $get_options['periods'] : [];
$phone = !empty($get_options['phone']) ? esc_html($get_options['phone']) : '';
$vk_url = !empty($get_options['vk_url']) ? esc_url($get_options['vk_url']) : '';
$telegram_url = !empty($get_options['telegram_url']) ? esc_url($get_options['telegram_url']) : '';
$whatsapp_url = !empty($get_options['whatsapp_url']) ? esc_url($get_options['whatsapp_url']) : '';
$instagram_url = !empty($get_options['instagram_url']) ? esc_url($get_options['instagram_url']) : '';
$email = !empty($get_options['email']) ? sanitize_email($get_options['email']) : '';
$map_xy = !empty($get_options['map_xy']) ? esc_html($get_options['map_xy']) : '';

$isSocTrue = $vk_url || $telegram_url || $whatsapp_url || $instagram_url;
?>

<section <?php echo $anchor; ?>class="<?php echo esc_attr($class_name); ?>">
  <div class="container">
    <div class="sd-map__text-box">
      <?php
      if ($title) {
        echo "<h2>{$title}</h2>";
      }
      ?>
      
      <div class="sd-map__contacts-box">
        <?php if ($addresses) : ?>
          <div class="sd-map__contact">
            <span>Адрес шоурума</span>
            <?php
            foreach ($addresses as $address_row) {
              $address = esc_html($address_row['address']);

              echo "<p>{$address}</p>";
            }
            ?>
          </div>
        <?php endif; ?>

        <?php if ($periods) : ?>
          <div class="sd-map__contact">
            <span>Режим работы</span>
            <?php
            foreach ($periods as $period_row) {
              $day = esc_html($period_row['day']);
              $time = esc_html($period_row['time']);

              echo "<div class=\"sd-map__contact-row\"><p>{$day}</p><p>{$time}</p></div>";
            }
            ?>
          </div>
        <?php endif; ?>

        <?php if ($phone) : ?>
          <div class="sd-map__contact">
            <span>Телефон</span>
            <?php
            $phone_url = 'tel:+' . preg_replace('![^0-9]+!', '', $phone);
            echo "<a href=\"$phone_url\">$phone</a>";
            ?>
          </div>
        <?php endif; ?>

        <?php if ($isSocTrue) : ?>
          <div class="sd-map__contact">
            <span>Соц. сети</span>
            <ul class="sd-map__contact-socials">
              <?php if ($instagram_url) : ?>
                <li>
                  <a href="<?php echo $instagram_url; ?>" target="_blank" title="Instagram" class="instagram"></a>
                </li>
              <?php endif; ?>

              <?php if ($vk_url) : ?>
                <li>
                  <a href="<?php echo $vk_url; ?>" target="_blank" title="VK" class="vk"></a>
                </li>
              <?php endif; ?>

              <?php if ($whatsapp_url) : ?>
                <li>
                  <a href="<?php echo $whatsapp_url; ?>" target="_blank" title="WhatsApp" class="whatsapp"></a>
                </li>
              <?php endif; ?>

              <?php if ($telegram_url) : ?>
                <li>
                  <a href="<?php echo $telegram_url; ?>" target="_blank" title="Telegram" class="telegram"></a>
                </li>
              <?php endif; ?>
            </ul>
          </div>
        <?php endif; ?>

        <?php if ($email) : ?>
          <div class="sd-map__contact">
            <span>E-mail</span>
            <?php
            $email_url = 'mailto:' . $email;
            echo "<a href=\"$email_url\">$email</a>";
            ?>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <?php if ($map_xy) : ?>
      <?php
      $data_address = !empty($addresses[0]['address']) ? esc_html($addresses[0]['address']) : '';
      $data_icon = VKLS_THEME_URL . '/assets/img/baloon.svg';

      $map_attributes = [
        'id = "map"',
        'class = "sd-map__map"',
        "data-coordinates = '{$map_xy}'",
        'data-zoom = "14"',
        "data-address = '{$data_address}'",
        "data-icon = '{$data_icon}'",
      ];

      $map_attributes_string = implode( ' ', $map_attributes );
      ?>
      <div <?php echo $map_attributes_string; ?>>
        <?php
        if ( is_admin() ) {
          $map_xy_array = explode( ',', $map_xy );
          echo '<div style="position:relative;overflow:hidden;">
            <iframe src="https://yandex.ru/map-widget/v1/?ll='. $map_xy_array[1] .'%2C'. $map_xy_array[0] .'&whatshere%5Bzoom%5D=14&z=14" width="805" height="684" frameborder="1" allowfullscreen="true" style="position:relative;"></iframe>
          </div>';
        }
        ?>
      </div>
    <?php endif; ?>
  </div>
</section>