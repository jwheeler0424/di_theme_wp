<?php
/**
 * @package diPlugin
*/
namespace Inc\Pages;

use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;
use \Inc\Api\Callbacks\ManagerCallbacks;

class Admin extends BaseController
{
    public $callbacks;
    public $callbacks_mgr;
    public $pages;
    public $subpages;
    public $settings;

    public function register()
    {
        $this->settings = new SettingsApi();

        $this->callbacks = new AdminCallbacks();

        $this->callbacks_mgr = new ManagerCallbacks();

        $this->setPages();
        $this->setSubpages();

        $this->setSettings();
        $this->setSections();
        $this->setFields();

        $this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->addSubPages( $this->subpages )->register();
    }

    public function setPages()
    {
        $this->pages = [
            [
                'page_title' => 'DI Plugin', 
                'menu_title' => 'di Settings', 
                'capability' => 'manage_options', 
                'menu_slug' => 'di_plugin', 
                'callback' => array( $this->callbacks, 'pluginDashboard'),
                'icon_url' => '', 
                'position' => 3
            ]
        ];
    }

    public function setSubpages()
    {
        $this->subpages = [
            [
                'parent_slug' => 'di_plugin',
                'page_title' => 'Custom Post Types',
                'menu_title' => 'Custom Post Types', 
                'capability' => 'manage_options', 
                'menu_slug' => 'di_cpt', 
                'callback' => array( $this->callbacks, 'pluginCPT')
            ],
            [
                'parent_slug' => 'di_plugin',
                'page_title' => 'Custom Taxonomies',
                'menu_title' => 'Taxonomies', 
                'capability' => 'manage_options', 
                'menu_slug' => 'di_taxonomies', 
                'callback' => array( $this->callbacks, 'pluginTaxonomy')
            ],
            [
                'parent_slug' => 'di_plugin',
                'page_title' => 'Custom Widgets',
                'menu_title' => 'Widets', 
                'capability' => 'manage_options', 
                'menu_slug' => 'di_widgets', 
                'callback' => array( $this->callbacks, 'pluginWidget')
            ]
        ];
    }

    public function setSettings()
    {
        $args = array();

        foreach ( $this->managers as $key => $value ) {
            $args[] = [
                'option_group' => 'di_plugin_settings',
                'option_name' => $key,
                'callback' => array( $this->callbacks_mgr, 'checkboxSanitize' )
            ];
        }

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
                    'label_for' => $key,
                    'class' => 'ui-toggle'
                )
            ];
        }

        $this->settings->setFields( $args );
    }

}