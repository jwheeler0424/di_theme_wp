<?php
/**
 *  ##################################################
 *  |   DESIGNER'S IMAGE THEME FUNCTIONS             |
 *  ##################################################
 * 
 *  @package diTheme
 *  @since diTheme 1.0
*/


// If this file is called directly, abort!
defined( 'ABSPATH' ) or die( 'You\'re not allowed to access this file. Run, you fools.' );

// Require_once the Composer Autoload
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

/**
 * Activate the core of the theme 
 */
if ( class_exists( 'Theme\\Base\\Activate' ) ) {
    Theme\Base\Activate::activate();
}

/**
 * Initialize all the core classes of the theme
 */
if ( class_exists( 'Theme\\Init' ) ) {
    Theme\Init::register_services();
}
