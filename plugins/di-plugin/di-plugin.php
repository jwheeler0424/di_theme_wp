<?php
/*
    @package diPlugin
*/

/*
    Plugin Name: Designer's Image
    Plugin URI: http://designersimage.io
    Description: A completely custom plugin to handle all activities for Designer's Image
    Version: 1.0.0
    Author: Jonathan D. Wheeler
    Author URI: http://designersimage.io
    License: GPLv3
    Text Domain: di-plugin
*/

/*
    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <https://www.gnu.org/licenses/>.
*/

// If this file is called directly, abort!
defined( 'ABSPATH' ) or die( 'You\'re not allowed to access this file. Run, you fools.' );

// Require_once the Composer Autoload
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

// Define CONSTANTS
define( 'PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'PLUGIN', plugin_basename( __FILE__ ) );

use Inc\Base\Activate;
use Inc\Base\Deactivate;


/**
 * The code that runs dring plugin activation
 */
function activate_di_plugin() {
    Activate::activate();
}

/**
 * The code that runs dring plugin deactivation
 */
function deactivate_di_plugin() {
    Deactivate::deactivate();
}

register_activation_hook( __FILE__, 'activate_di_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_di_plugin' );

/**
 * Initialize all the core classes of the plugin 
 */
if ( class_exists( 'Inc\\Init' ) ) {
    Inc\Init::register_services();
}