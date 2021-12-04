<?php
/**
 *  @package diTheme
 *  ##################################################
 *  |   THEME CLEANUP VERSION STRINGS                |
 *  ##################################################
*/

namespace Theme\Base;

class Cleanup
{
    public function register() {

        add_filter( 'script_loader_src', array( $this, 'di_remove_wp_version_strings' ) );
        add_filter( 'style_loader_src', array( $this, 'di_remove_wp_version_strings' ) );
        add_filter( 'the_generator', array( $this, 'di_remove_meta_version' ) );
        add_filter( 'the_content', array( $this, 'remove_p_tags' ) );
        add_filter( 'wp_title', array( $this, 'wpdocs_filter_wp_title'), 10, 2 );

    }

    function wpdocs_filter_wp_title( $title, $sep ) {
        global $paged, $page;
     
        if ( is_feed() )
            return $title;
     
        // Add the site description for the home/front page.
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) )
            $title = "$title $sep $site_description";
     
        // Add a page number if necessary.
        if ( $paged >= 2 || $page >= 2 )
            $title = "$title $sep " . sprintf( __( 'Page %s', 'designersimage' ), max( $paged, $page ) );
     
        return $title;
    }

    function disable_wp_auto_p( $content ) {
        remove_filter( 'the_content', 'wpautop' );
        remove_filter( 'the_excerpt', 'wpautop' );
        return $content;
    }

    public function di_remove_wp_version_strings( $src ) {

        global $wp_version;
        parse_str( parse_url( $src, PHP_URL_QUERY ), $query );
    
        if ( !empty( $query['ver'] ) && $query['ver'] === $wp_version ) {
            $src = remove_query_arg( 'ver', $src );
        }
    
        return $src;
    
    }

    public function di_remove_meta_version() {
        return '';
    }

    public function remove_p_tags($content){
        remove_filter( 'the_content', 'wpautop' );
        remove_filter( 'the_excerpt', 'wpautop' );
        $array = array (
            '<p>['      => '[', //replace "<p>[" with "["
            ']</p>'     => ']', //replace "]</p>" with "]"
            ']<br />'   => ']' //replace "]<br />" with "]"
        );
        $content = strtr($content, $array); //replaces instances of the keys in the array with their values
        return $content;
    }

}