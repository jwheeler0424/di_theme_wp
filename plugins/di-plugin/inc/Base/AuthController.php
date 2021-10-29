<?php
/**
 * @package diPlugin
*/

namespace PluginInc\Base;

use \PluginInc\Api\SettingsApi;
use \PluginInc\Base\BaseController;
use \PluginInc\Api\Callbacks\AdminCallbacks;

class AuthController extends BaseController
{
    public $callbacks;
    public $subpages = array();

    public function register()
    {
        if ( !$this->activated( 'login_manager' ) ) return;

        $this->settings = new SettingsApi();
        $this->callbacks = new AdminCallbacks();

        $this->setSubpages();

        $this->settings->addSubPages( $this->subpages )->register();

        add_action( 'init', array( $this, 'activate' ) );
    }

    public function setSubpages()
    {
        $this->subpages = [
            [
                'parent_slug' => 'di_plugin',
                'page_title' => 'Login Manager',
                'menu_title' => 'Login Manager', 
                'capability' => 'manage_options', 
                'menu_slug' => 'di_auth', 
                'callback' => array( $this->callbacks, 'adminAuth')
            ]
        ];
    }

    public function activate()
    {
        return;
    }
}