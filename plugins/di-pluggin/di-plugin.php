<?php
/*
    @package diPlugin
*/

/*
    Plugin Name: Designer's Image Plugin
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

defined( 'ABSPATH' ) or die( 'You\'re not allowed to access this file. Run, you fools.' );

if ( !class_exists( 'DesignersImagePlugin' ) ) {
    class DesignersImagePlugin
    {
        public $plugin;

        function __contruct() {
            $this->plugin = plugin_basename( __FILE__ );
        }

        function register() {
            add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );

            add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );

            add_filter( "plugin_action_links_$this->plugin", array( $this, 'settings_link' ) );
        }

        public function settings_link( $links ) {
            // add custom settings link
            $settings_link = '<a href="admin.php?page=di_plugin">Settings</a>';
            array_push( $links, $settings_link );
            return $links;
        }

        public function add_admin_pages() {
            add_menu_page( 'DI Plugin', 'Designer\'s Image', 'manage_options', 'di_plugin', array( $this, 'admin_index' ), '', null );
        }

        public function admin_index() {
            // require template
            require_once plugin_dir_path( __FILE__ ) . 'templates/admin.php';
        }

        protected function create_post_type() {
            add_action( 'init', array( $this, 'custom_post_type' ) );
        }

        function custom_post_type() {
            register_post_type( 'book', ['public' => true, 'label' => 'Books'] );
        }

        function enqueue() {
            // enqueue all our scripts
            wp_enqueue_style( 'mypluginstyle', plugins_url( '/assets/mystyle.css', __FILE__ ) );
            wp_enqueue_script( 'mypluginscript', plugins_url( '/assets/mysscript.js', __FILE__ ) );
        }

        function activate() {
            require_once plugin_dir_path( __FILE__ ) . 'inc/di-plugin-activate.php';
            DesignersImagePluginActivate::activate();
        }

    }
    $diPlugin = new DesignersImagePlugin();
    $diPlugin->register();
}

// activation
register_activation_hook( __FILE__, array( $diPlugin, 'activate' ) );

// deactivation
require_once plugin_dir_path( __FILE__ ) . 'inc/di-plugin-deactivate.php';
register_deactivation_hook( __FILE__, array( 'DesignersImagePluginDeactivate', 'deactivate' ) );
