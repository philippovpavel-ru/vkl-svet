<?php
defined('ABSPATH') || exit;
?>

<?php do_action('woocommerce_before_checkout_billing_form', $checkout); ?>

<?php
$fields = $checkout->get_checkout_fields('billing');

$index = 0;
// echo '<pre>' . print_r($fields, 1) . '</pre>';
?>

<div class="sd-cart__order-box">
	<h3 class="sd-cart__order-personal">Личные данные</h3>
	<div class="sd-cart__order-inputs">
		<?php
		foreach ($fields as $key => $field) {
			if ($index === 4) {
				break;
			}

			woocommerce_form_field($key, $field, $checkout->get_value($key));

			$index++;
		}
		?>
	</div>

	<?php if (! is_user_logged_in() && $checkout->is_registration_enabled()) : ?>
		<?php if (! $checkout->is_registration_required()) : ?>

			<p class="form-row form-row-wide create-account">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="createaccount" <?php checked((true === $checkout->get_value('createaccount') || (true === apply_filters('woocommerce_create_account_default_checked', false))), true); ?> type="checkbox" name="createaccount" value="1" /> <span><?php esc_html_e('Create an account?', 'woocommerce'); ?></span>
				</label>
			</p>

		<?php endif; ?>

		<?php do_action('woocommerce_before_checkout_registration_form', $checkout); ?>

		<?php if ($checkout->get_checkout_fields('account')) : ?>

			<div class="create-account sd-cart__order-inputs">
				<?php foreach ($checkout->get_checkout_fields('account') as $key => $field) : ?>
					<?php woocommerce_form_field($key, $field, $checkout->get_value($key)); ?>
				<?php endforeach; ?>
				<div class="clear"></div>
			</div>

		<?php endif; ?>

		<?php do_action('woocommerce_after_checkout_registration_form', $checkout); ?>
	<?php endif; ?>
</div>

<div class="sd-cart__order-box">
	<h3 class="sd-cart__order-region">Регион доставки</h3>
	<div class="sd-cart__order-inputs">
		<?php
		$index = 0;
		foreach ($fields as $key => $field) {
			if ($index < 4) {
				$index++;
				continue;
			}

			woocommerce_form_field($key, $field, $checkout->get_value($key));

			$index++;
		}
		?>
	</div>
</div>

<?php do_action('woocommerce_after_checkout_billing_form', $checkout); ?>