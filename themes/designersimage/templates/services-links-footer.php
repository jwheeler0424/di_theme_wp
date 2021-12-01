<?php
/**
 *  @package diTheme
 *  ##################################################
 *  |   THEME SERVICES PAGE LINKS - FOOTER           |
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

echo '<nav class="links">';

foreach ( $subpages as $page ) {
    echo '<div class="'. $page->post_name .'">';
    echo '<div class="icon">';
    get_template_part( 'img/svg/icon', $page->post_name.'.svg' );
    echo '</div>';
    echo '<a href="'. esc_url( get_permalink( $page->ID ) ) .'" title="'. $page->post_title .'">'.$page->post_title .'</a>';
    echo '</div>';
    if ( $page->post_name !== 'tech') {
        echo '<div class="separator"></div>';
    }
}

echo '</nav>';

wp_reset_postdata();