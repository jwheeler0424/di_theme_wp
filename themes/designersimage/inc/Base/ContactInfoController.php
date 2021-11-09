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
                'callback' => array( $this->ci_callbacks, 'phoneField' ),
                'page' => 'di_ci',
                'section' => 'di_ci_index',
                'args' => array(
                    'option_name' => 'di_theme_ci',
                    'label_for' => 'contact_phone',
                    'placeholder' => 'eg. (555) 555-5555',
                    'required' => true,
                    'array' => 'contact_info'
                )
            ),
            array(
                'id' => 'contact_email',
                'title' => 'Email Address',
                'callback' => array( $this->ci_callbacks, 'emailField' ),
                'page' => 'di_ci',
                'section' => 'di_ci_index',
                'args' => array(
                    'option_name' => 'di_theme_ci',
                    'label_for' => 'contact_email',
                    'placeholder' => 'user@website.com',
                    'required' => true,
                    'array' => 'contact_info'
                )
            ),
            array(
                'id' => 'contact_website',
                'title' => 'Website',
                'callback' => array( $this->ci_callbacks, 'urlField' ),
                'page' => 'di_ci',
                'section' => 'di_ci_index',
                'args' => array(
                    'option_name' => 'di_theme_ci',
                    'label_for' => 'contact_website',
                    'placeholder' => 'https://website.com',
                    'required' => true,
                    'array' => 'contact_info'
                )
            ),
            array(
                'id' => 'contact_location',
                'title' => 'Location',
                'callback' => array( $this->ci_callbacks, 'textField' ),
                'page' => 'di_ci',
                'section' => 'di_ci_index',
                'args' => array(
                    'option_name' => 'di_theme_ci',
                    'label_for' => 'contact_location',
                    'placeholder' => 'City, State',
                    'required' => true,
                    'array' => 'contact_info'
                )
            ),
            array(
                'id' => 'contact_facebook',
                'title' => 'Facebook',
                'callback' => array( $this->ci_callbacks, 'urlField' ),
                'page' => 'di_ci',
                'section' => 'di_ci_index',
                'args' => array(
                    'option_name' => 'di_theme_ci',
                    'label_for' => 'contact_facebook',
                    'placeholder' => 'https://facebook.com',
                    'required' => false,
                    'array' => 'contact_info'
                )
            ),
            array(
                'id' => 'contact_instagram',
                'title' => 'Instagram',
                'callback' => array( $this->ci_callbacks, 'urlField' ),
                'page' => 'di_ci',
                'section' => 'di_ci_index',
                'args' => array(
                    'option_name' => 'di_theme_ci',
                    'label_for' => 'contact_instagram',
                    'placeholder' => 'https://instagram.com',
                    'required' => false,
                    'array' => 'contact_info'
                )
            ),
            array(
                'id' => 'contact_twitter',
                'title' => 'Twitter',
                'callback' => array( $this->ci_callbacks, 'urlField' ),
                'page' => 'di_ci',
                'section' => 'di_ci_index',
                'args' => array(
                    'option_name' => 'di_theme_ci',
                    'label_for' => 'contact_twitter',
                    'placeholder' => 'https://twitter.com',
                    'required' => false,
                    'array' => 'contact_info'
                )
            ),
            array(
                'id' => 'contact_youtube',
                'title' => 'YouTube',
                'callback' => array( $this->ci_callbacks, 'urlField' ),
                'page' => 'di_ci',
                'section' => 'di_ci_index',
                'args' => array(
                    'option_name' => 'di_theme_ci',
                    'label_for' => 'contact_youtube',
                    'placeholder' => 'https://youtube.com',
                    'required' => false,
                    'array' => 'contact_info'
                )
            ),
            array(
                'id' => 'contact_github',
                'title' => 'GitHub',
                'callback' => array( $this->ci_callbacks, 'urlField' ),
                'page' => 'di_ci',
                'section' => 'di_ci_index',
                'args' => array(
                    'option_name' => 'di_theme_ci',
                    'label_for' => 'contact_github',
                    'placeholder' => 'https://github.com',
                    'required' => false,
                    'array' => 'contact_info'
                )
            ),
            array(
                'id' => 'contact_linkedin',
                'title' => 'LinkedIn',
                'callback' => array( $this->ci_callbacks, 'urlField' ),
                'page' => 'di_ci',
                'section' => 'di_ci_index',
                'args' => array(
                    'option_name' => 'di_theme_ci',
                    'label_for' => 'contact_linkedin',
                    'placeholder' => 'https://linkedin.com',
                    'required' => false,
                    'array' => 'contact_info'
                )
            )
        );

        $this->settings->setFields( $args );
    }

}