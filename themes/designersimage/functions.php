<?php
/**
 *  @package diTheme
*/

// If this file is called directly, abort!
defined( 'ABSPATH' ) or die( 'You\'re not allowed to access this file. Run, you fools.' );

// Require_once the Composer Autoload
if ( file_exists( dirname( __DIR__, 2 ) . '/vendor/autoload.php' ) ) {
    require_once dirname( __DIR__, 2 ) . '/vendor/autoload.php';
}

/**
 * Initialize all the core classes of the theme 
 */
if ( class_exists( 'ThemeInc\\Base\\Activate' ) ) {
    ThemeInc\Base\Activate::activate();
}

/**
 * Initialize all the core classes of the theme
 */
if ( class_exists( 'ThemeInc\\Init' ) ) {
    ThemeInc\Init::register_services();
}


require get_template_directory() . '/inc/Base/CustomFunctions.php';
require get_template_directory() . '/inc/Base/WalkerNavPrimary.php';