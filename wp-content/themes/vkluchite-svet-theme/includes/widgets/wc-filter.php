<?php
if (!defined('ABSPATH')) {
	exit;
}

class SND_WC_Filter_Widget extends WP_Widget
{
	// создание виджета
	public function __construct()
	{
		parent::__construct(
			'snd_wc_filter_widget',
			'SND Фильтр',
			array('description' => 'Фильтр по атрибутам, фильтр по цене')
		);
	}

	// фронтэнд виджета
	public function widget($args, $instance)
	{
		// вывод формы фильтрации
		$price_title = !empty($instance['snd-wc-filter-price-title']) ? esc_html($instance['snd-wc-filter-price-title']) : 'Фильтровать по цене';
		$price_check = !empty($instance['snd-wc-filter-price-checkbox']) ? (bool)$instance['snd-wc-filter-price-checkbox'] : '';
		$price_show_list = !empty($instance['snd-wc-filter-price-show-list']) ? (bool)$instance['snd-wc-filter-price-show-list'] : '';

		// получаем все атрибуты
		$attributes = wc_get_attribute_taxonomies();
		$current_category_attrs = $this->get_current_attrs($attributes, $instance) ?: [];

		if (is_shop()) {
			$shop_page_id = wc_get_page_id('shop');
			$form_action = get_permalink($shop_page_id);
		} else {
			$form_action = get_term_link(get_queried_object()->term_id);
		}

		$filter_price = $this->get_filter_price($price_title, $price_check, $price_show_list);
		$filter_category_attrs = $this->get_filter_category_attrs($current_category_attrs);
		$filter_buttons = $this->get_filter_buttons();

		echo $args['before_widget'];

		echo <<<FORM
			<form method="get" action="$form_action" class="snd_wc_filter_form categ-1-categ__filteres">
				$filter_price
				$filter_category_attrs
				$filter_buttons
			</form>
		FORM;

		echo $args['after_widget'];
	}

	// бэкэнд виджета
	public function form($instance)
	{
		$inpud_id_name = $this->get_field_name('snd-wc-filter-id');
		$inpud_id_val = !empty($item_id) ? esc_attr($item_id) : '';

		$widget_title = '';
		if (!empty($instance['title'])) {
			$widget_title = esc_html($instance['title']);
		}

		$widget_title_label_name = $this->get_field_name('title');
		$widget_title_label_val = !empty($widget_title) ? esc_attr($widget_title) : '';

		// фильтр по цене
		$price_checkbox = '';
		$price_title = '';
		$price_show_list = '';

		if (!empty($instance['snd-wc-filter-price-checkbox'])) {
			$price_checkbox = $instance['snd-wc-filter-price-checkbox'];
		}

		if (!empty($instance['snd-wc-filter-price-title'])) {
			$price_title = $instance['snd-wc-filter-price-title'];
		}

		if (!empty($instance['snd-wc-filter-price-show-list'])) {
			$price_show_list = $instance['snd-wc-filter-price-show-list'];
		}

		$price_checkbox_name = $this->get_field_name('snd-wc-filter-price-checkbox');
		$price_checkbox_val = !empty($price_checkbox) ? 'checked' : '';

		$price_show_list_name = $this->get_field_name('snd-wc-filter-price-show-list');
		$price_show_list_val = !empty($price_show_list) ? 'checked' : '';

		$price_title_name = $this->get_field_name('snd-wc-filter-price-title');
		$price_title_val = !empty($price_title) ? esc_attr($price_title) : '';

		// фильтр атрибуты
		$attributes = wc_get_attribute_taxonomies();
		$filter_attrs = '';

		if ($attributes) {
			foreach ($attributes as $attribute) {
				$attr_name  = esc_attr($attribute->attribute_name);
				$attr_label = esc_attr($attribute->attribute_label);

				if (!empty($instance['snd-wc-filter-' . $attr_name . '-checkbox'])) {
					$attr_checkbox = $instance['snd-wc-filter-' . $attr_name . '-checkbox'];
				}

				if (!empty($instance['snd-wc-filter-' . $attr_name . '-show-list'])) {
					$attr_show_list = $instance['snd-wc-filter-' . $attr_name . '-show-list'];
				}

				if (!empty($instance['snd-wc-filter-' . $attr_name . '-title'])) {
					$attr_title = $instance['snd-wc-filter-' . $attr_name . '-title'];
				}

				$attr_checkbox_name = $this->get_field_name('snd-wc-filter-' . $attr_name . '-checkbox');
				$attr_checkbox_val = !empty($attr_checkbox) ? 'checked' : '';

				$attr_show_list_name = $this->get_field_name('snd-wc-filter-' . $attr_name . '-show-list');
				$attr_show_list_val = !empty($attr_show_list) ? 'checked' : '';

				$attr_title_name = $this->get_field_name('snd-wc-filter-' . $attr_name . '-title');
				$attr_title_val = !empty($attr_title) ? esc_attr($attr_title) : '';

				$filter_attrs .= <<<FILTER_ATTR
				<div class="snd-wc-filter-row">
					<div class="snd-wc-filter-labels-list">
						<label>
							<input type="checkbox" name="$attr_checkbox_name" value="filter_$attr_name" $attr_checkbox_val>
							$attr_label
						</label>

						<label>
							<input type="checkbox" name="$attr_show_list_name" $attr_show_list_val >
							Раскрыть список
						</label>
					</div>

					<label class="input-text">
						<span>Заголовок фильтра</span>
						<input type="text" class="widefat" name="$attr_title_name" value="$attr_title_val" placeholder="$attr_label" />
					</label>
				</div>
				FILTER_ATTR;
			}
		}

		$widget_title_label = <<<WIDGET_TITLE
		<label class="input-text">
			<span>Заголовок виджета</span>
			<input type="text" class="widefat" name="$widget_title_label_name" value="$widget_title_label_val" placeholder="Заголовок виджета" />
		</label>
		WIDGET_TITLE;

		$filter_price = <<<FILTER_PRICE
		<div class="snd-wc-filter-row">
			<div class="snd-wc-filter-labels-list">
				<label>
					<input type="checkbox" name="$price_checkbox_name" $price_checkbox_val >
					Фильтровать по цене
				</label>
				<label>
					<input type="checkbox" name="$price_show_list_name" $price_show_list_val >
					Раскрыть список
				</label>
			</div>

			<label class="input-text">
				<span>Заголовок фильтра</span>
				<input type="text" class="widefat" name="$price_title_name" value="$price_title_val" placeholder="Фильтровать по цене" >
			</label>
		</div>
		FILTER_PRICE;

		echo <<<FORM
		<div class="filter_widget">
			<div class="archive_page_filter archive_page_filter--wc-snd-filter">
				<input name="$inpud_id_name" type="hidden" value="$inpud_id_val" />
				$widget_title_label

				<div class="archive_page_filter-filters">
					<h4>Фильтры</h4>
					$filter_price

					$filter_attrs
				</div>
			</div>
		</div>
		FORM;
	}

	// сохранение настроек виджета
	public function update($new_instance, $old_instance)
	{
		$instance = array();

		// $instance[ 'snd-wc-filter-id' ]
		$instance['snd-wc-filter-id'] = !empty($new_instance['snd-wc-filter-id']) ? strip_tags($new_instance['snd-wc-filter-id']) : '';

		// $instance[ 'snd-wc-filter-widget-title' ]
		$instance['title'] = !empty($new_instance['title']) ? strip_tags($new_instance['title']) : '';

		// $instance[ 'snd-wc-filter-price-checkbox' ]
		$instance['snd-wc-filter-price-checkbox'] = !empty($new_instance['snd-wc-filter-price-checkbox']) ? strip_tags($new_instance['snd-wc-filter-price-checkbox']) : '';

		// $instance[ 'snd-wc-filter-price-show-list' ]
		$instance['snd-wc-filter-price-show-list'] = !empty($new_instance['snd-wc-filter-price-show-list']) ? strip_tags($new_instance['snd-wc-filter-price-show-list']) : '';

		// $instance['snd-wc-filter-price-title']
		$instance['snd-wc-filter-price-title'] = !empty($new_instance['snd-wc-filter-price-title']) ? strip_tags($new_instance['snd-wc-filter-price-title']) : '';

		$attributes = wc_get_attribute_taxonomies();
		foreach ($attributes as $attribute) {
			$attr_name = esc_attr($attribute->attribute_name);

			// $instance[ 'snd-wc-filter-' . $attr_name . '-checkbox' ]
			$instance['snd-wc-filter-' . $attr_name . '-checkbox'] = !empty($new_instance['snd-wc-filter-' . $attr_name . '-checkbox']) ? strip_tags($new_instance['snd-wc-filter-' . $attr_name . '-checkbox']) : '';

			// $instance[ 'snd-wc-filter-' . $attr_name . '-show-list' ]
			$instance['snd-wc-filter-' . $attr_name . '-show-list'] = !empty($new_instance['snd-wc-filter-' . $attr_name . '-show-list']) ? strip_tags($new_instance['snd-wc-filter-' . $attr_name . '-show-list']) : '';

			// $instance[ 'snd-wc-filter-' . $attr_name . '-title' ]
			$instance['snd-wc-filter-' . $attr_name . '-title'] = !empty($new_instance['snd-wc-filter-' . $attr_name . '-title']) ? strip_tags($new_instance['snd-wc-filter-' . $attr_name . '-title']) : '';
		}

		return $instance;
	}

	protected function get_filtered_price()
	{
		$tax_query = [
			[
				'taxonomy' => 'product_visibility',
				'field' => 'name',
				'terms' => 'exclude-from-catalog',
				'operator' => 'NOT IN',
			]
		];

		if (is_tax('product_cat')) {
			$product_category = get_queried_object();

			$tax_query['relation'] = 'AND';
			$tax_query[] =
				[
					'taxonomy' => 'product_cat',
					'field' => 'slug',
					'terms' => $product_category->slug,
				];
		}

		$product_ids = get_posts([
			'post_type' => 'product',
			'posts_per_page' => -1,
			'post_status' => 'publish',
			'fields' => 'ids',
			'tax_query' => $tax_query
		]);

		if (!$product_ids) return;

		$min = PHP_FLOAT_MAX;
		$max = 0;

		foreach ($product_ids as $product_id) {
			$product = wc_get_product($product_id);

			if ($product->is_type('simple')) {
				$product_price = $product->get_price();

				$min = $product_price < $min ? $product_price : $min;
				$max = $product_price > $max ? $product_price : $max;
			} elseif ($product->is_type('variable')) {
				$prices = $product->get_variation_prices();

				$min = current($prices['price']) < $min ? current($prices['price']) : $min;
				$max = end($prices['price']) > $max ? end($prices['price']) : $max;
			}
		}

		return [
			'min_price' => $min,
			'max_price' => $max
		];
	}

	protected function get_attr_count($attr_slug, $term_id)
	{
		$tax_query = [
			[
				'taxonomy' => 'pa_' . $attr_slug,
				'field' => 'term_id',
				'terms' => $term_id,
			]
		];

		if (is_tax('product_cat')) {
			$product_category = get_queried_object();
			$current_category_id = $product_category->term_id;

			$tax_query[] = [
				'taxonomy' => 'product_cat',
				'field' => 'term_id',
				'terms' => $current_category_id,
			];
		}

		return count(get_posts([
			'post_type' => 'product',
			'numberposts' => -1,
			'tax_query' => $tax_query
		]));
	}

	protected function get_current_attrs($attributes = [], $instance = '')
	{
		if (!$attributes) return;

		$returnAttr = [];

		foreach ($attributes as $iAttr => $attribute) {
			$attr_name  = esc_attr($attribute->attribute_name);
			$attr_check = !empty($instance["snd-wc-filter-$attr_name-checkbox"]) ? $instance["snd-wc-filter-$attr_name-checkbox"] : '';
			$attr_show_list = !empty($instance["snd-wc-filter-$attr_name-show-list"]) ? $instance["snd-wc-filter-$attr_name-show-list"] : '';

			if ( ! $attr_check ) return $returnAttr;

			$attr_title = !empty($instance["snd-wc-filter-$attr_name-title"]) ? $instance["snd-wc-filter-$attr_name-title"] : $attribute->attribute_label;

			$terms = get_terms([
				'taxonomy' => "pa_$attr_name",
				'hide_empty' => true,
			]);

			$attribute_type = $attribute->attribute_type ?: '';

			if (isset($_GET[$attr_check])) {
				$GET_attr_cheked = $_GET[$attr_check];
			}

			if (!$terms) return $returnAttr;

			foreach ($terms as $iTerm => $term) {
				$count = $this->get_attr_count($attr_name, $term->term_id) ?: false;
				if ($count) {
					$checked = isset($GET_attr_cheked) && $GET_attr_cheked === $term->slug ? 'checked' : false;
					$term_swatch = get_term_meta($term->term_id, 'product_pa_' . $attr_name, true);

					$returnAttr[$iAttr]['attr_title'] = $attr_title;
					$returnAttr[$iAttr]['attribute_type'] = $attribute_type;
					$returnAttr[$iAttr]['attr_check'] = $attr_check;
					$returnAttr[$iAttr]['attr_show_list'] = $attr_show_list;

					$returnAttr[$iAttr]['terms'][$iTerm]['term_swatch'] = $term_swatch;
					$returnAttr[$iAttr]['terms'][$iTerm]['count'] = $count;
					$returnAttr[$iAttr]['terms'][$iTerm]['checked'] = $checked;
					$returnAttr[$iAttr]['terms'][$iTerm]['name'] = $term->name;
					$returnAttr[$iAttr]['terms'][$iTerm]['slug'] = $term->slug;
					$returnAttr[$iAttr]['terms'][$iTerm]['term_id'] = $term->term_id;
				}
			}
		}

		return $returnAttr;
	}

	protected function get_filter_price($price_title = '', $price_check = true, $price_show_list = true)
	{
		if (!$price_check) return;

		$prices    = $this->get_filtered_price();
		$min_price = !empty($prices['min_price']) ? intval($prices['min_price']) : 0;
		$max_price = !empty($prices['max_price']) ? intval($prices['max_price']) : 0;

		if (!($min_price && $max_price)) return;

		if (!empty($_GET['min_price'])) {
			$GET_min_price = $_GET["min_price"];
		}

		if (!empty($_GET['max_price'])) {
			$GET_max_price = $_GET["max_price"];
		}

		$min_value = !empty($GET_min_price) ? $GET_min_price : $min_price;
		$max_value = !empty($GET_max_price) ? $GET_max_price : $max_price;
		$step = 100;

		$slider_attrs = [
			'id' => 'sliderPrice',
			'class' => 'filter__slider-price',
			'data-min' => $min_price,
			'data-max' => $max_price,
			'data-min-value' => $min_value,
			'data-max-value' => $max_value,
			'data-step' => $step,
		];

		$slider_attrs_string = implode(' ', array_map(function ($key, $value) {
			return sprintf('%s="%s"', $key, $value);
		}, array_keys($slider_attrs), $slider_attrs));

		$summary_classes = 'summary';
		$details_classes = 'categ-1-categ__price-range sub-menu';
		if ( $price_show_list ) {
			$summary_classes .= ' summary-open';
			$details_classes .= ' details-open';
		}

		return <<<RETURN
		<div class="categ-1-categ__price details">
			<div class="$summary_classes">
				$price_title
			</div>

			<div class="$details_classes">
				<div $slider_attrs_string></div>

				<div class="categ-1-categ__price-inputs">
					<label class="filter__label">
						<input name="min_price" type="number" value="$min_value" step="$step" class="filter__input">
					</label>
					<label class="filter__label">
						<input name="max_price" type="number" value="$max_value" step="$step" class="filter__input">
					</label>
				</div>
			</div>
		</div>
		RETURN;
	}

	protected function get_filter_category_attrs($current_category_attrs)
	{
		if (!$current_category_attrs) return;

		$filter_category_attrs = '';

		foreach ($current_category_attrs as $attribute) {
			$attr_title = $attribute['attr_title'];
			$attribute_type = $attribute['attribute_type'];
			$attr_check_name = $attribute['attr_check'];
			$attr_show_list = $attribute['attr_show_list'];
			$terms = $attribute['terms'];
			$labels = '';

			$summary_classes = '';
			$details_classes = '';
			if ($attr_show_list) {
				$summary_classes .= ' summary-open';
				$details_classes .= ' details-open';
			}

			if (!$terms) continue;

			foreach ($terms as $term) {
				$checked = $term['checked'];
				$term_swatch = $term['term_swatch'];
				$term_name = $term['name'];
				$term_slug = $term['slug'];
				$term_id = $term['term_id'];

				switch ($attribute_type) {
					case 'image':
						$title = sprintf('<span style="background-image: url(%s);" title="%s"></span>', wp_get_attachment_image_url($term_swatch, [40, 40]), $term_name);
						break;

					case 'color':
						$title = sprintf('<span style="background: %s;" title="%s"></span>', $term_swatch, $term_name);
						break;

					case 'label':
						$title = sprintf('<span>%s</span>', $term_name);
						break;

					default:
						$title = sprintf('<span>%s</span>', $term_name);
						break;
				}

				switch ($attribute_type) {
					case 'color':
					case 'image':
						$label_class = 'sd-card-page__color';
						break;

					case 'label':
						$label_class = 'sd-card-page__option';
						break;

					default:
						$label_class = 'cart-1-cart__checkbox sub-menu' . $details_classes;
						break;
				}

				$labels .= <<<LABEL
					<label class="$label_class">
						<input type="checkbox" data-id="$term_id" name="$attr_check_name" value="$term_slug" $checked>
						$title
					</label>
				LABEL;
			}

			switch ($attribute_type) {
				case 'color':
				case 'image':
					$return_class = 'categ-1-categ__colors details';
					$labels_before = "<div class=\"sd-card-page__options sub-menu $details_classes\">";
					$labels_after = '</div>';
					break;
				case 'label':
					$return_class = 'categ-1-categ__grid-check details';
					$labels_before = '<div class="sd-card-page__options sub-menu">';
					$labels_after = '</div>';
					break;
				default:
					$return_class = 'menu-item details sd-catalog__collection';
					$labels_before = '';
					$labels_after = '';
					break;
			}

			$filter_category_attrs .= <<<RETURN
				<div class="$return_class">
					<div class="summary $summary_classes">
						$attr_title
					</div>
					$labels_before
					$labels
					$labels_after
				</div>
			RETURN;
		}

		return $filter_category_attrs;
	}

	protected function get_filter_buttons()
	{
		$reset_attr = '';
		if (esc_url(strtok($_SERVER['REQUEST_URI'], '?')) !== esc_url($_SERVER['REQUEST_URI'])) {
			$url = esc_url(strtok($_SERVER['REQUEST_URI'], '?'));
			$reset_attr = "onclick=\"location.href='$url';\" ";
		}

		return <<<RETURN
			<div class="categ-1-categ__buttons">
				<button type="reset" $reset_attr class="sd-catalog__cancel">Сбросить</button>
				<button type="submit" class="sd-catalog__done">Применить</button>
			</div>
		RETURN;
	}
}

// регистрация виджета
add_action('widgets_init', 'snd_wc_filter_widget_load');
function snd_wc_filter_widget_load()
{
	register_widget('SND_WC_Filter_Widget');
}

// подключение стилей виджета в админке
add_action('admin_enqueue_scripts', 'snd_wc_filter_widget_enqueue_back');
function snd_wc_filter_widget_enqueue_back()
{
	wp_enqueue_style('custom_filter_core-admin_main', get_template_directory_uri() . '/includes/widgets/wc-filter/admin.css');
}
