<?php
/**
 *  @package diTheme
 *  ##################################################
 *  |   THEME SERVICES PAGE LINKS                    |
 *  ##################################################
*/

$args = array(
    'name' => 'services',
    'post_type' => 'page',
    'post_status' => 'publish',
    'numberposts' => 1,
);

$services_page = get_posts($args);

$subpages = get_pages( array(
    'title_li'    => '',
    'child_of'    => $services_page[0]->ID,
    'sort_column' => 'menu_order'
) );

echo '<nav class="services-links">';

foreach ( $subpages as $page ) {
    echo '<a href="'. esc_url( get_permalink( $page->ID ) ) .'" title="'. $page->post_title .'">';
            get_template_part( 'img/svg/icon', $page->post_name.'.svg' );
    echo '<span>'. $page->post_title .'</span> </a>';
}

echo '</nav>';