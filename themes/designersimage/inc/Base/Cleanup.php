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

        add_filter( 'script_loader_src', array( $this, 'di_remove_wp_version_strings' ));
        add_filter( 'style_loader_src', array( $this, 'di_remove_wp_version_strings' ));
        add_filter( 'the_generator', array( $this, 'di_remove_meta_version' ));

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

}