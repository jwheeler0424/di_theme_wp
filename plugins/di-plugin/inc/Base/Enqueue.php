<?php
/**
 * @package diPlugin
*/

namespace Inc\Base;

use \Inc\Base\BaseController;

class Enqueue extends BaseController
{
    public function register() {
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
    }

    function enqueue() {
        // enqueue all our scripts
        wp_enqueue_style( 'mypluginstyle', $this->plugin_url . 'assets/di-style.min.css' );
        wp_enqueue_script( 'mypluginscript', $this->plugin_url . 'assets/di-script.min.js' );
    }

}