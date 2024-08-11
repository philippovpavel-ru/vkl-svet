<?php
if (! defined('ABSPATH')) {
	exit;
}

$description = $gateway->get_title();
if ($gateway->has_fields() || $gateway->get_description()) {
	ob_start();
	$gateway->payment_fields();

	$description = strip_tags(ob_get_contents());
	ob_end_clean();
} ?>



<label for="payment_method_<?php echo esc_attr($gateway->id); ?>" class="custom-radio" title="<?php echo $description; ?>">
	<input id="payment_method_<?php echo esc_attr($gateway->id); ?>" type="radio" class="input-radio" name="payment_method" value="<?php echo esc_attr($gateway->id); ?>" <?php checked($gateway->chosen, true); ?> data-order_button_text="<?php echo esc_attr($gateway->order_button_text); ?>" />
	<?php echo "<span>{$gateway->get_title()}</span>"; /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ ?> <?php echo $gateway->get_icon(); /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ ?>
</label>