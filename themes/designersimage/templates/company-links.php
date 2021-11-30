<?php
/**
 *  @package diTheme
 *  ##################################################
 *  |   THEME COMPANY PAGE LINKS                     |
 *  ##################################################
*/

$args = array(
    'name' => 'company',
    'post_type' => 'page',
    'post_status' => 'publish',
    'numberposts' => 1,
);

$company_page = get_posts($args);

$subpages = get_pages( array(
    'title_li'    => '',
    'child_of'    => $company_page[0]->ID,
    'sort_column' => 'menu_order'
) );

echo '<nav class="about-links">';

foreach ( $subpages as $page ) {
    echo '<a href="'. esc_url( get_permalink( $page->ID ) ) .'" title="'. $page->post_title .'">';
            get_template_part( 'img/svg/icon', $page->post_name.'.svg' );
    echo '<span>'. $page->post_name .'</span> </a>';
}

echo '</nav>';