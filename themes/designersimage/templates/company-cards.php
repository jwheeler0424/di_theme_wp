<?php
/**
 *  @package diTheme
 *  ##################################################
 *  |   THEME COMPANY PAGE CARDS                     |
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

echo '<nav class="company-cards">';

foreach ( $subpages as $page ) {
    echo '<div class="card">';
        echo '<div class="icon">';
            get_template_part( 'img/svg/icon', $page->post_name.'.svg' );
        echo '</div>';
        echo '<h3>'. $page->post_title .'</h3>';
        echo '<p>'. $page->post_excerpt .'</p>';
        echo '<a href="'. esc_url( get_permalink( $page->ID ) ) .'" title="Learn More">Learn More</a>';
    echo '</div>';
}

echo '</nav>';

wp_reset_postdata();