<?php
/**
 * @package diPlugin
 *  ##################################################
 *  |   PLUGIN API KEYS CONTROLLER                   |
 *  ##################################################
*/

namespace Plugin\Base;

use Plugin\Api\SettingsApi;
use Plugin\Base\BaseController;
use Plugin\Api\Callbacks\APIKeysCallbacks;
use Plugin\Api\Callbacks\AdminCallbacks;

class APIKeysController extends BaseController
{
    public $settings;
    public $callbacks;
    public $key_callbacks;
    public $subpages = array();
    public $api_keys = array();

    public function register()
    {
        if ( !$this->activated( 'keys_manager' ) ) return;

        $this->settings = new SettingsApi();
        $this->callbacks = new AdminCallbacks();
        $this->key_callbacks = new APIKeysCallbacks();

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
                'parent_slug' => 'di_plugin',
                'page_title' => 'API Keys',
                'menu_title' => 'API Keys Manager', 
                'capability' => 'manage_options', 
                'menu_slug' => 'di_api', 
                'callback' => array( $this->callbacks, 'adminAPI')
            ]
        ];
    }

    public function setSettings()
    {
        $args = [
            [
                'option_group' => 'di_plugin_api_settings',
                'option_name' => 'di_plugin_api',
                'callback' => array( $this->key_callbacks, 'apiSanitize' )
            ]
        ];

        $this->settings->setSettings( $args );
    }

    public function setSections()
    {
        $args = [
            [
                'id' => 'di_api_index',
                'title' => 'API Keys Manager',
                'callback' => array( $this->key_callbacks, 'apiSectionManager' ),
                'page' => 'di_api'
            ]
        ];

        $this->settings->setSections( $args );
    }

    public function setFields()
    {
        $args = array(
            array(
                'id' => 'key_type',
                'title' => 'API Key Type',
                'callback' => array( $this->key_callbacks, 'textField' ),
                'page' => 'di_api',
                'section' => 'di_api_index',
                'args' => array(
                    'option_name' => 'di_plugin_api',
                    'label_for' => 'key_type',
                    'placeholder' => 'eg. reCAPTCHA',
                    'array' => 'key_type'
                )
            ),
            array(
                'id' => 'site_key',
                'title' => 'Site Key',
                'callback' => array( $this->key_callbacks, 'textField' ),
                'page' => 'di_api',
                'section' => 'di_api_index',
                'args' => array(
                    'option_name' => 'di_plugin_api',
                    'label_for' => 'site_key',
                    'array' => 'key_type'
                )
            ),
            array(
                'id' => 'secret_key',
                'title' => 'Secret Key',
                'callback' => array( $this->key_callbacks, 'textField' ),
                'page' => 'di_api',
                'section' => 'di_api_index',
                'args' => array(
                    'option_name' => 'di_plugin_api',
                    'label_for' => 'secret_key',
                    'array' => 'key_type'
                )
            )
        );

        $this->settings->setFields( $args );
    }
        
}

