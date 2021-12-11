<?php
/**
 *  ##################################################
 *  |   DESIGNER'S IMAGE PLUGIN                      |
 *  ##################################################
 * 
 *  @package    diPlugin
 *  @author     Jonathan D. Wheeler <jonathan@designersimage.io>
 *  @copyright  2021 Designer's Image
 *  @license    GPL-3.0
 * 
 *  @wordpress-plugin
 *  Plugin Name: Designer's Image
 *  Plugin URI: http://designersimage.io/diPlugin/
 *  Description: A completely custom plugin to handle all activities for Designer's Image
 *  Version: 1.0.0
 *  Author: Jonathan D. Wheeler
 *  Author URI: http://designersimage.io
 *  Text Domain: di-plugin
 *  License: GPLv3
 *  License URI: https://www.gnu.org/licenses/gpl-3.0.txt
 *  Update URI: http://designersimage.io/diPlugin/
*/

// If this file is called directly, abort!
defined( 'ABSPATH' ) or die( 'You\'re not allowed to access this file. Run, you fools.' );

// Require_once the Composer Autoload
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
    
}

/**
 * The code that runs dring plugin activation
 */
function activate_di_plugin() {
    Plugin\Base\Activate::activate();
}
register_activation_hook( __FILE__, 'activate_di_plugin' );

/**
 * The code that runs dring plugin deactivation
 */
function deactivate_di_plugin() {
    Plugin\Base\Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_di_plugin' );

/**
 * Initialize all the core classes of the plugin 
 */
if ( class_exists( 'Plugin\\Init' ) ) {
    Plugin\Init::register_services();
}