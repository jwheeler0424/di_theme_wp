<?php
/**
 * @package diPlugin
*/
namespace Inc\Pages;

use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;

class Admin extends BaseController
{
    public $callbacks;
    public $pages;
    public $subpages;
    public $settings;

    public function register()
    {
        $this->settings = new SettingsApi();

        $this->callbacks = new AdminCallbacks();

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
        $args = [
            [
                'option_group' => 'di_options_group',
                'option_name' => 'text_example',
                'callback' => array( $this->callbacks, 'diOptionsGroup' )
            ],
            [
                'option_group' => 'di_options_group',
                'option_name' => 'first_name'
            ]

        ];

        $this->settings->setSettings( $args );
    }

    public function setSections()
    {
        $args = [
            [
                'id' => 'di_admin_index',
                'title' => 'Settings',
                'callback' => array( $this->callbacks, 'diAdminSection' ),
                'page' => 'di_plugin'
            ]
        ];

        $this->settings->setSections( $args );
    }

    public function setFields()
    {
        $args = [
            [
                'id' => 'text_example',
                'title' => 'Text Example',
                'callback' => array( $this->callbacks, 'diTextExample' ),
                'page' => 'di_plugin',
                'section' => 'di_admin_index',
                'args' => array(
                    'label_for' => 'text_example',
                    'class' => 'example-class'
                )

                ],
                [
                    'id' => 'first_name',
                    'title' => 'First Name',
                    'callback' => array( $this->callbacks, 'diFirstName' ),
                    'page' => 'di_plugin',
                    'section' => 'di_admin_index',
                    'args' => array(
                        'label_for' => 'first_name',
                        'class' => 'example-class'
                    )
    
                ]
        ];

        $this->settings->setFields( $args );
    }

}