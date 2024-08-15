<?php
  function snd_breadcrumbs()
  {
    if ( is_page_template('page-templates/with-container-without-headline-breadcrumbs.php') ) return;
    if ( is_page_template('page-templates/without-breadcrumbs.php') ) return;

    // получаем номер текущей страницы
    $page_num = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $separator = '<p>/</p>';

    ob_start();
    // если главная страница сайта
    if ( is_front_page() ) {
      if ( $page_num > 1 ) {
        echo '<a href="' . site_url() . '">Главная</a>' . $separator . $page_num . '-я страница';
      } else {
        echo '<p>Главная страница</p>';
      }
    } else { // не главная
      echo '<a href="' . site_url() . '">Главная</a>' . $separator;
      if ( is_home() ) {
        $homepage_ID = get_option('page_for_posts');
        echo '<p>'. get_the_title($homepage_ID) .'</p>';
      }
      elseif( class_exists('WooCommerce') && is_shop() ) {
        $shopPageID = intval(wc_get_page_id('shop'));

        echo '<p>'. esc_html(get_the_title($shopPageID)) .'</p>';
      }
      elseif( class_exists('WooCommerce') && is_product_taxonomy() ) {
        $shopPageID = intval(wc_get_page_id('shop'));
        $shopPageTitle = esc_html( get_the_title($shopPageID) );
        $shopPageUrl = esc_url( get_permalink($shopPageID) );
        $taxonomyTitle = esc_html( get_queried_object()->name );

        echo "<a href='{$shopPageUrl}'>{$shopPageTitle}</a>";
        echo $separator;
        echo '<p>'. $taxonomyTitle .'</p>';
      }
      elseif ( class_exists('WooCommerce') && is_product() ) {
        $shopPageID = intval(wc_get_page_id('shop'));
        $shopPageTitle = esc_html(get_the_title($shopPageID));
        $shopPageUrl = esc_url(get_permalink($shopPageID));
        $productTitle = esc_html(get_the_title());

        echo "<a href='{$shopPageUrl}'>{$shopPageTitle}</a>";
        echo $separator;
        echo '<p>'. $productTitle .'</p>';
      }
      elseif ( class_exists('WooCommerce') && is_checkout() ) {
        $cartPageID = intval(wc_get_page_id('cart'));
        $cartPageTitle = esc_html(get_the_title($cartPageID));
        $cartPageUrl = esc_url(get_permalink($cartPageID));
        $checkoutPageTitle = esc_html(get_the_title());

        echo "<a href='{$cartPageUrl}'>{$cartPageTitle}</a>";
        echo $separator;
        echo '<p>'. $checkoutPageTitle .'</p>';
      }
      elseif (is_single()) { // записи
        the_category(', ');
        echo $separator;
        the_title('<p>', '</p>');
      }
      elseif (is_page()) { // страницы WordPress 
        the_title('<p>', '</p>');
      }
      elseif (is_category()) { // архивы
        echo '<p>';
        single_cat_title();
        echo '</p>';
      }
      elseif (is_tag()) {
        echo '<p>';
        single_tag_title();
        echo '</p>';
      }
      elseif (is_day()) { // архивы (по дням)
        echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $separator;
        echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a>' . $separator;
        echo '<p>' . get_the_time('d') . '</p>';
      }
      elseif (is_month()) { // архивы (по месяцам)
        echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $separator;
        echo '<p>' . get_the_time('F') . '</p>';
      }
      elseif (is_year()) { // архивы (по годам)
        echo '<p>' . get_the_time('Y') . '</p>';
      }
      elseif (is_author()) { // архивы по авторам
        global $author;
        $userdata = get_userdata($author);
        echo '<p>Опубликовал(а) ' . $userdata->display_name . '</p>';
      }
      elseif (is_404()) { // если страницы не существует
        echo '<p>Ошибка 404</p>';
      }
      elseif ( is_search() ) { // поиск
        echo '<p>Поиск "'. get_search_query() .'"</p>';
      }

      if ($page_num > 1) { // номер текущей страницы
        echo ' (' . $page_num . '-я страница)';
      }
    }

    $links = ob_get_contents();
    ob_end_clean();

    echo '<div class="sd-bread-crumbs"><div class="container">' . $links . '</div></div>';
  }