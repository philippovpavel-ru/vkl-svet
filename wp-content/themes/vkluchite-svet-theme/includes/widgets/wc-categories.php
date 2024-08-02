<?php
if (!defined('ABSPATH')) {
  exit;
}

class SND_WC_Categories_Widget extends WP_Widget {
  /*
  * создание виджета
  */
  function __construct() {
    parent::__construct(
      'snd_wc_categories_widget', 
      'SND Категории магазина', // заголовок виджета
      array( 'description' => 'Позволяет вывести все категории магазина' ) // описание
    );
  }

  /*
  * фронтэнд виджета
  */
  public function widget( $args, $instance ) {
    $title = apply_filters( 'widget_title', $instance['title'] ); // к заголовку применяем фильтр (необязательно)
    $show_catalog = $instance['show_catalog'];
    $show_list = $instance['show_list'];

    $links = [];
    $links_string = '';
    $summary_classes = 'summary';
    $item_classes = 'sub-menu';
    $current_url = '';

    // определяем текущий полный url
    if ( is_tax( 'product_cat' ) ) {
      $query_object = get_queried_object();
      $current_url = esc_url( get_term_link( $query_object ) );
    } 

    if ( is_shop() ) {
      $shop_page_id = wc_get_page_id('shop');
      $current_url = esc_url( get_permalink($shop_page_id) );
    }

    // если нужно показывать каталог
    if ($show_catalog) {
      $shop_page_id = wc_get_page_id('shop');
      $shop_page_url = get_permalink($shop_page_id);

      $links[] = [
        'url' => esc_url($shop_page_url),
        'title' => 'Все',
        'current_url' => $current_url === $shop_page_url ? true : false,
      ];
    }

    // добавляем список категорий
    $terms = get_terms('product_cat', [
      'hide_empty' => true,
    ]);

    if ($terms) {
      foreach ($terms as $term) {
        $links[] = [
          'url' => esc_url(get_term_link($term)),
          'title' => $term->name,
          'current_url' => $current_url === esc_url(get_term_link($term)) ? true : false,
        ];
      }
    }

    // если нужно раскрыть список
    if ($show_list) {
      $summary_classes .= ' summary-open';
      $item_classes .= ' details-open';
    }

    // формируем строку
    echo $args['before_widget'];

    if ( ! empty( $title ) ) {
      $links_string .= "{$args['before_title']}
        <div class='{$summary_classes}'>{$title}</div>
      {$args['after_title']}";
    }

    if ( $links ) {
      foreach ( $links as $link ) {
        $current_class = $link['current_url'] ? 'current' : '';

        $links_string .= "<a href='{$link['url']}' class='{$item_classes} {$current_class}'>
          {$link['title']}
        </a>";
      }
    }

    echo "<div class='menu-item details'>$links_string</div>";

    echo $args['after_widget'];
  }

  /*
  * бэкэнд виджета
  */
  public function form( $instance ) {
    $title = !empty($instance['title']) ? $instance[ 'title' ] : '' ;
    $show_catalog = !empty($instance['show_catalog']) ? 'checked' : '';
    $show_list = !empty($instance['show_list']) ? 'checked' : '';
    ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>">
        Заголовок
      </label>
      <input
        class="widefat"
        id="<?php echo $this->get_field_id( 'title' ); ?>"
        name="<?php echo $this->get_field_name( 'title' ); ?>"
        type="text"
        value="<?php echo esc_attr( $title ); ?>"
      />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'show_catalog' ); ?>">
        <input
          id="<?php echo $this->get_field_id( 'show_catalog' ); ?>"
          name="<?php echo $this->get_field_name( 'show_catalog' ); ?>"
          type="checkbox"
          <?php echo esc_attr( $show_catalog ); ?>
        />
        Показывать каталог
      </label>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'show_list' ); ?>">
        <input
          id="<?php echo $this->get_field_id( 'show_list' ); ?>"
          name="<?php echo $this->get_field_name( 'show_list' ); ?>"
          type="checkbox"
          <?php echo esc_attr( $show_list ); ?>
        />
        Раскрыть список
      </label>
    </p>
    <?php 
  }

  /*
  * сохранение настроек виджета
  */
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = !empty($new_instance['title']) ? strip_tags( $new_instance['title'] ) : '';
    $instance['show_catalog'] = !empty($new_instance['show_catalog']) ? true : false;
    $instance['show_list'] = !empty($new_instance['show_list']) ? true : false;

    return $instance;
  }
}

/*
* регистрация виджета
*/
add_action( 'widgets_init', 'snd_wc_categories_widget_load' );
function snd_wc_categories_widget_load() {
  register_widget('SND_WC_Categories_Widget' );
}