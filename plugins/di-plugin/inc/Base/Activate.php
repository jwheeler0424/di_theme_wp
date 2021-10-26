<?php
/**
 * @package diPlugin
*/

namespace Inc\Base;

class Activate
{
    public static function activate() {
        flush_rewrite_rules();

        if ( get_option( 'di_plugin' ) ) {
            return;
        }

        $default = array();

        update_option( 'di_plugin', $default );
    }
}