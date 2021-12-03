<?php
/**
 *  @package diPlugin
 *  ##################################################
 *  |   PLUGIN ADMIN DASHBOARD CONTROLLER            |
 *  ##################################################
*/

namespace Plugin\Pages;

use Plugin\Api\SettingsApi;
use Plugin\Base\BaseController;
use Plugin\Api\Callbacks\AdminCallbacks;
use Plugin\Api\Callbacks\ManagerCallbacks;

class Dashboard extends BaseController
{
    public $callbacks;

    public $callbacks_mgr;

    public $pages;
    
    public $settings;

    public function register()
    {
        $this->settings = new SettingsApi();

        $this->callbacks = new AdminCallbacks();

        $this->callbacks_mgr = new ManagerCallbacks();

        $this->setPages();

        $this->setSettings();
        $this->setSections();
        $this->setFields();

        $this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->register();
    }

    public function setPages()
    {
        $this->pages = [
            [
                'page_title' => 'DI Plugin', 
                'menu_title' => 'di Settings', 
                'capability' => 'manage_options', 
                'menu_slug' => 'di_plugin', 
                'callback' => array( $this->callbacks, 'adminDashboard'),
                'icon_url' => '', 
                'position' => 3
            ]
        ];
    }

    public function setSettings()
    {
        $args = [
            [
                'option_group' => 'di_plugin_settings',
                'option_name' => 'di_plugin',
                'callback' => array( $this->callbacks_mgr, 'checkboxSanitize' )
            ]
        ];

        $this->settings->setSettings( $args );
    }

    public function setSections()
    {
        $args = [
            [
                'id' => 'di_admin_index',
                'title' => 'Settings Manager',
                'callback' => array( $this->callbacks_mgr, 'adminSectionManager' ),
                'page' => 'di_plugin'
            ]
        ];

        $this->settings->setSections( $args );
    }

    public function setFields()
    {
        $args = array();

        foreach ( $this->managers as $key => $value ) {
            $args[] = [
                'id' => $key,
                'title' => $value,
                'callback' => array( $this->callbacks_mgr, 'checkboxField' ),
                'page' => 'di_plugin',
                'section' => 'di_admin_index',
                'args' => array(
                    'option_name' => 'di_plugin',
                    'label_for' => $key,
                    'class' => 'ui-toggle'
                )
            ];
        }

        $this->settings->setFields( $args );
    }

}