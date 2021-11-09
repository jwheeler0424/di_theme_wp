<?php
/**
 *  @package diTheme
 *  ##################################################
 *  |   THEME CONTACT INFORMATION CONTROLLER         |
 *  ##################################################
*/

namespace ThemeInc\Base;

use \ThemeInc\Api\SettingsApi;
use \ThemeInc\Base\BaseController;
use \ThemeInc\Api\Callbacks\AdminCallbacks;
use \ThemeInc\Api\Callbacks\ContactInfoCallbacks;

class ContactInfoController extends BaseController
{
    public $callbacks;
    public $ci_callbacks;
    public $settings;
    public $subpages = array();

    public function register()
    {
        $this->settings = new SettingsApi();
        $this->callbacks = new AdminCallbacks();
        $this->ci_callbacks = new ContactInfoCallbacks();

        $this->setSubpages();

        $this->setSettings();
        $this->setSections();
        $this->setFields();

        $this->settings->addSubPages( $this->subpages )->register();
    }

    public function setSubpages()
    {
        $this->subpages = [
            [
                'parent_slug' => 'di_theme',
                'page_title' => 'Contact Info',
                'menu_title' => 'Contact Information', 
                'capability' => 'manage_options', 
                'menu_slug' => 'di_ci', 
                'callback' => array( $this->callbacks, 'adminContactInfo')
            ]
        ];
    }

    public function setSettings()
    {
        $args = [
            [
                'option_group' => 'di_theme_ci_settings',
                'option_name' => 'di_theme_ci',
                'callback' => array( $this->ci_callbacks, 'ciSanitize' )
            ]
        ];

        $this->settings->setSettings( $args );
    }

    public function setSections()
    {
        $args = [
            [
                'id' => 'di_ci_index',
                'title' => 'Contact Information Manager',
                'callback' => array( $this->ci_callbacks, 'ciSectionManager' ),
                'page' => 'di_ci'
            ]
        ];

        $this->settings->setSections( $args );
    }

    public function setFields()
    {
        $args = array(
            array(
                'id' => 'contact_phone',
                'title' => 'Phone Number',
                'callback' => array( $this->ci_callbacks, 'textField' ),
                'page' => 'di_ci',
                'section' => 'di_ci_index',
                'args' => array(
                    'option_name' => 'di_theme_ci',
                    'label_for' => 'contact_phone',
                    'placeholder' => 'eg. (555) 555-5555',
                    'array' => 'contact_info'
                )
            )
        );

        $this->settings->setFields( $args );
    }

}