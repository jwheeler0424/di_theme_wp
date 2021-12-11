<?php
/**
 * @package diPlugin
 *  ##################################################
 *  |   PLUGIN ACTIVATION FUNCTION                      |
 *  ##################################################
*/

namespace Plugin\Base;

class Activate
{
    public static function activate() {
        flush_rewrite_rules();

        $default = array();

        if ( !get_option( 'di_plugin' ) ) {
            update_option( 'di_plugin', $default );
        }

        if ( !get_option( 'di_plugin_cpt' ) ) {
            update_option( 'di_plugin_cpt', $default );
        }

        if ( !get_option( 'di_plugin_tax' ) ) {
            update_option( 'di_plugin_tax', $default );
        }

        if ( !get_option( 'di_plugin_api' ) ) {
            update_option( 'di_plugin_api', $default );
        }

        if ( !get_option( 'di_plugin_user_roles' ) ) {
            update_option( 'di_plugin_user_roles', false );
        }
    }
}