<?php
/*
    @package diPlugin
*/

namespace Inc\Base;

class SettingsLinks
{
    public function register() {
        add_filter( 'plugin_action_links_' . PLUGIN , array( $this, 'settings_links' ) );
    }

    public function settings_links( $links ) {
        // add custom settings link
        $newLinks = $links;
        $url = get_admin_url() . "admin.php?page=di_plugin";
        $settings_link = '<a href="' . $url . '">' . __('Settings', 'textdomain') . '</a>';
        $newLinks[] = $settings_link;
        return $newLinks;
    }

}