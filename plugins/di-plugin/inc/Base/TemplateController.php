<?php
/**
 * @package diPlugin
*/

namespace PluginInc\Base;

use \PluginInc\Api\SettingsApi;
use \PluginInc\Base\BaseController;
use \PluginInc\Api\Callbacks\AdminCallbacks;

class TemplateController extends BaseController
{
    public $callbacks;
    public $subpages;
    public function register()
    {
        if ( !$this->activated( 'templates_manager' ) ) return;

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
                'page_title' => 'Templates Manager',
                'menu_title' => 'Templates Manager', 
                'capability' => 'manage_options', 
                'menu_slug' => 'di_templates', 
                'callback' => array( $this->callbacks, 'adminTemplates')
            ]
        ];
    }

    public function activate()
    {
        return;
    }
}