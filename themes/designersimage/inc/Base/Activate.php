<?php
/**
 *  @package diTheme
 *  ##################################################
 *  |   THEME ACTIVATION FUNCTION                    |
 *  ##################################################
*/

namespace ThemeInc\Base;

class Activate
{
    public static function activate() {
        $default = array();

        if ( !get_option( 'di_theme_option' ) ) {
            update_option( 'di_theme_option', $default );
        }

        if ( !get_option( 'di_theme_ci' ) ) {
            update_option( 'di_theme_ci', $default );
        }
    }
}