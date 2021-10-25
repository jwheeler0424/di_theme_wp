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
        $args = [
            [
                'option_group' => 'di_plugin_settings',
                'option_name' => 'cpt_manager',
                'callback' => array( $this->callbacks_mgr, 'checkboxSanitize' )
            ],
            [
                'option_group' => 'di_plugin_settings',
                'option_name' => 'taxonomy_manager',
                'callback' => array( $this->callbacks_mgr, 'checkboxSanitize' )
            ],
            [
                'option_group' => 'di_plugin_settings',
                'option_name' => 'widget_manager',
                'callback' => array( $this->callbacks_mgr, 'checkboxSanitize' )
            ],
            [
                'option_group' => 'di_plugin_settings',
                'option_name' => 'gallery_manager',
                'callback' => array( $this->callbacks_mgr, 'checkboxSanitize' )
            ],
            [
                'option_group' => 'di_plugin_settings',
                'option_name' => 'testimonial_manager',
                'callback' => array( $this->callbacks_mgr, 'checkboxSanitize' )
            ],
            [
                'option_group' => 'di_plugin_settings',
                'option_name' => 'templates_manager',
                'callback' => array( $this->callbacks_mgr, 'checkboxSanitize' )
            ],
            [
                'option_group' => 'di_plugin_settings',
                'option_name' => 'login_manager',
                'callback' => array( $this->callbacks_mgr, 'checkboxSanitize' )
            ],
            [
                'option_group' => 'di_plugin_settings',
                'option_name' => 'membership_manager',
                'callback' => array( $this->callbacks_mgr, 'checkboxSanitize' )
            ],
            [
                'option_group' => 'di_plugin_settings',
                'option_name' => 'chat_manager',
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
        $args = [
            [
                'id' => 'cpt_manager',
                'title' => 'Activate CPT Manager',
                'callback' => array( $this->callbacks_mgr, 'checkboxField' ),
                'page' => 'di_plugin',
                'section' => 'di_admin_index',
                'args' => array(
                    'label_for' => 'cpt_manager',
                    'class' => 'ui-toggle'
                )

            ],
            [
                'id' => 'taxonomy_manager',
                'title' => 'Activate Taxonomy Manager',
                'callback' => array( $this->callbacks_mgr, 'checkboxField' ),
                'page' => 'di_plugin',
                'section' => 'di_admin_index',
                'args' => array(
                    'label_for' => 'taxonomy_manager',
                    'class' => 'ui-toggle'
                )

            ],
            [
                'id' => 'widget_manager',
                'title' => 'Activate Widget Manager',
                'callback' => array( $this->callbacks_mgr, 'checkboxField' ),
                'page' => 'di_plugin',
                'section' => 'di_admin_index',
                'args' => array(
                    'label_for' => 'widget_manager',
                    'class' => 'ui-toggle'
                )

            ],
            [
                'id' => 'gallery_manager',
                'title' => 'Activate Gallery Manager',
                'callback' => array( $this->callbacks_mgr, 'checkboxField' ),
                'page' => 'di_plugin',
                'section' => 'di_admin_index',
                'args' => array(
                    'label_for' => 'gallery_manager',
                    'class' => 'ui-toggle'
                )

            ],
            [
                'id' => 'testimonial_manager',
                'title' => 'Activate Testimonial Manager',
                'callback' => array( $this->callbacks_mgr, 'checkboxField' ),
                'page' => 'di_plugin',
                'section' => 'di_admin_index',
                'args' => array(
                    'label_for' => 'testimonial_manager',
                    'class' => 'ui-toggle'
                )

            ],
            [
                'id' => 'templates_manager',
                'title' => 'Activate Templates Manager',
                'callback' => array( $this->callbacks_mgr, 'checkboxField' ),
                'page' => 'di_plugin',
                'section' => 'di_admin_index',
                'args' => array(
                    'label_for' => 'templates_manager',
                    'class' => 'ui-toggle'
                )

            ],
            [
                'id' => 'login_manager',
                'title' => 'Activate Ajax Login/Signup',
                'callback' => array( $this->callbacks_mgr, 'checkboxField' ),
                'page' => 'di_plugin',
                'section' => 'di_admin_index',
                'args' => array(
                    'label_for' => 'login_manager',
                    'class' => 'ui-toggle'
                )

            ],
            [
                'id' => 'membership_manager',
                'title' => 'Activate Membership Manager',
                'callback' => array( $this->callbacks_mgr, 'checkboxField' ),
                'page' => 'di_plugin',
                'section' => 'di_admin_index',
                'args' => array(
                    'label_for' => 'membership_manager',
                    'class' => 'ui-toggle'
                )

            ],
            [
                'id' => 'chat_manager',
                'title' => 'Activate Chat Manager',
                'callback' => array( $this->callbacks_mgr, 'checkboxField' ),
                'page' => 'di_plugin',
                'section' => 'di_admin_index',
                'args' => array(
                    'label_for' => 'chat_manager',
                    'class' => 'ui-toggle'
                )

            ]
        ];

        $this->settings->setFields( $args );
    }

}