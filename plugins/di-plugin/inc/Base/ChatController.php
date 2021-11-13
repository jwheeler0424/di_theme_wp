<?php
/**
 * @package diPlugin
*/

namespace Plugin\Base;

use Plugin\Api\SettingsApi;
use Plugin\Base\BaseController;
use Plugin\Api\Callbacks\AdminCallbacks;

class ChatController extends BaseController
{
    public $callbacks;
    public $subpages;
    public function register()
    {
        if ( !$this->activated( 'chat_manager' ) ) return;

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
                'page_title' => 'Chat Manager',
                'menu_title' => 'Chat Manager', 
                'capability' => 'manage_options', 
                'menu_slug' => 'di_chat', 
                'callback' => array( $this->callbacks, 'adminChat')
            ]
        ];
    }

    public function activate()
    {
        return;
    }
}