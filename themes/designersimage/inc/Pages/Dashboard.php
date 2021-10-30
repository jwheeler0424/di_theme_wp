<?php
/**
 * @package diTheme
*/
namespace ThemeInc\Pages;

use \ThemeInc\Api\SettingsApi;
use \ThemeInc\Base\BaseController;
use \ThemeInc\Api\Callbacks\AdminCallbacks;
use \ThemeInc\Api\Callbacks\ManagerCallbacks;

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
                'page_title' => 'DI Theme', 
                'menu_title' => 'di Theme', 
                'capability' => 'manage_options', 
                'menu_slug' => 'di_theme', 
                'callback' => array( $this->callbacks, 'adminDashboard'),
                'icon_url' => 'dashicons-cover-image', 
                'position' => 2
            ]
        ];
    }

    public function setSettings()
    {
        $args = [
            [
                'option_group' => 'di_theme_settings',
                'option_name' => 'di_theme_option',
                'callback' => array( $this->callbacks_mgr, 'checkboxSanitize' )
            ]
        ];

        $this->settings->setSettings( $args );
    }

    public function setSections()
    {
        $args = [
            [
                'id' => 'di_admin-theme_index',
                'title' => 'Options Manager',
                'callback' => array( $this->callbacks_mgr, 'adminSectionManager' ),
                'page' => 'di_theme'
            ]
        ];

        $this->settings->setSections( $args );
    }

    public function setFields()
    {
        $args = array(
            [
                'id' => 'post_formats',
                'title' => 'Post Formats',
                'callback' => array( $this->callbacks_mgr, 'checkboxPostFormatsField' ),
                'page' => 'di_theme',
                'section' => 'di_admin-theme_index',
                'args' => array(
                    'option_name' => 'di_theme_option',
                    'label_for' => 'post_formats',
                    'class' => 'ui-toggle',
                    'array' => 'options'
                )
            ],
            [
                'id' => 'custom_header',
                'title' => 'Custom Header',
                'callback' => array( $this->callbacks_mgr, 'checkboxField' ),
                'page' => 'di_theme',
                'section' => 'di_admin-theme_index',
                'args' => array(
                    'option_name' => 'di_theme_option',
                    'label_for' => 'custom_header',
                    'class' => 'ui-toggle',
                    'array' => 'options'
                )
            ],
            [
                'id' => 'custom_background',
                'title' => 'Custom Background',
                'callback' => array( $this->callbacks_mgr, 'checkboxField' ),
                'page' => 'di_theme',
                'section' => 'di_admin-theme_index',
                'args' => array(
                    'option_name' => 'di_theme_option',
                    'label_for' => 'custom_background',
                    'class' => 'ui-toggle',
                    'array' => 'options'
                )
            ],
            [
                'id' => 'widget_manager',
                'title' => 'Widget Manager',
                'callback' => array( $this->callbacks_mgr, 'checkboxField' ),
                'page' => 'di_theme',
                'section' => 'di_admin-theme_index',
                'args' => array(
                    'option_name' => 'di_theme_option',
                    'label_for' => 'widget_manager',
                    'class' => 'ui-toggle',
                    'array' => 'options'
                )
            ]
        );


        $this->settings->setFields( $args );
    }

}