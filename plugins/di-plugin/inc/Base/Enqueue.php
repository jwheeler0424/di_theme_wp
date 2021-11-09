<?php
/**
 * @package diPlugin
*/

namespace PluginInc\Base;

use \PluginInc\Base\BaseController;

class Enqueue extends BaseController
{
    public function register() {
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
    }

    function enqueue() {
        // enqueue all our scripts
        wp_enqueue_style( 'di-plugin', $this->plugin_url . 'assets/di-plugin.min.css' );
        wp_enqueue_script( 'di-plugin', $this->plugin_url . 'assets/di-plugin.min.js' );
    }

}