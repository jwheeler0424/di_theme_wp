<?php
/**
 * @package diPlugin
*/

namespace PluginInc\Base;

use \PluginInc\Api\SettingsApi;
use \PluginInc\Base\BaseController;
use \PluginInc\Api\Callbacks\AdminCallbacks;

class GalleryController extends BaseController
{
    public $callbacks;
    public $subpages;
    public function register()
    {
        if ( !$this->activated( 'gallery_manager' ) ) return;

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
                'page_title' => 'Gallery Manager',
                'menu_title' => 'Gallery Manager', 
                'capability' => 'manage_options', 
                'menu_slug' => 'di_gallery', 
                'callback' => array( $this->callbacks, 'adminGallery')
            ]
        ];
    }

    public function activate()
    {
        return;
    }
}