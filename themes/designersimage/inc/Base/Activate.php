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
    }
}