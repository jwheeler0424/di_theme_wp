<?php
/*
    @package diPlugin
*/

namespace Inc\Pages;

class Admin
{
    public function register() {
        $plugin_basename = plugin_basename(PLUGIN_PATH . '/di-plugin.php');
        add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );
        add_filter( "plugin_action_links_$plugin_basename" , array( $this, 'settings_links' ) );
    }

    public function add_admin_pages() {
        add_menu_page( 'DI Plugin', 'Designer\'s Image', 'manage_options', 'di_plugin', array( $this, 'admin_index' ), '', null );
    }

    public function settings_links( $links ) {
        // add custom settings link
        $newLinks = $links;
        $url = get_admin_url() . "admin.php?page=di_plugin";
        $settings_link = '<a href="' . $url . '">' . __('Settings', 'textdomain') . '</a>';
        $newLinks[] = $settings_link;
        return $newLinks;
    }

    public function admin_index() {
        // require template
        require_once PLUGIN_PATH . 'templates/admin.php';
    }
}