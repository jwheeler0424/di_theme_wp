<?php
/**
 * @package diPlugin
*/

namespace Plugin\Base;

use Plugin\Api\SettingsApi;
use Plugin\Base\BaseController;
use Plugin\Api\Callbacks\AdminCallbacks;

class MembershipController extends BaseController
{
    public $callbacks;
    public $subpages;
    public function register()
    {
        if ( !$this->activated( 'membership_manager' ) ) return;

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
                'page_title' => 'Membership Manager',
                'menu_title' => 'Membership Manager', 
                'capability' => 'manage_options', 
                'menu_slug' => 'di_membership', 
                'callback' => array( $this->callbacks, 'adminMembership')
            ]
        ];
    }

    public function activate()
    {
        return;
    }
}