<?php
/**
 * @package diPlugin
*/

namespace PluginInc\Base;

use \PluginInc\Base\BaseController;

class AuthController extends BaseController
{
    public $callbacks;
    public $subpages = array();

    public function register()
    {
        if ( !$this->activated( 'login_manager' ) ) return;

        add_action( 'wp_head', array( $this, 'add_auth_template' ) );

    }

    public function add_auth_template()
    {
        $file = $this->plugin_path . 'templates/auth.php';

        if ( file_exists( $file ) ) {
            load_template( $file, true );
        }
    }
}