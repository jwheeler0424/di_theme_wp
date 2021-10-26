<?php
/**
 * @package diPlugin
*/

namespace Inc\Base;

use \Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;

class WidgetController extends BaseController
{
    public $callbacks;
    public $subpages;
    public function register()
    {
        if ( !$this->activated( 'widget_manager' ) ) return;

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
                'page_title' => 'Widget Manager',
                'menu_title' => 'Widget Manager', 
                'capability' => 'manage_options', 
                'menu_slug' => 'di_widget', 
                'callback' => array( $this->callbacks, 'adminWidget')
            ]
        ];
    }

    public function activate()
    {
        return;
    }
}