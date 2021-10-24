<?php
/**
 * @package diPlugin
*/
namespace Inc\Pages;

use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;

class Admin extends BaseController
{
    public $pages;
    public $settings;

    public function __construct()
    {
        $this->settings = new SettingsApi();

        $this->pages = [
            [
                'page_title' => 'DI Plugin', 
                'menu_title' => 'di Settings', 
                'capability' => 'manage_options', 
                'menu_slug' => 'di_plugin', 
                'callback' => function() { echo '<h1>designers image plugin</h1>'; },
                'icon_url' => '', 
                'position' => 3
            ],
            [
                'page_title' => 'Test Plugin', 
                'menu_title' => 'Test', 
                'capability' => 'manage_options', 
                'menu_slug' => 'test_plugin', 
                'callback' => function() { echo '<h1>External</h1>'; },
                'icon_url' => 'dashicons-external', 
                'position' => 3
            ]
        ];
    }

    public function register()
    {
        $this->settings->addPages( $this->pages )->register();
    }

    // public function add_admin_pages()
    // {
    //     add_menu_page( 'DI Plugin', 'di Settings', 'manage_options', 'di_plugin', array( $this, 'admin_index' ), '', 3 );
    // }

    // public function admin_index()
    // {
    //     // require template
    //     require_once $this->plugin_path . 'templates/admin.php';
    // }
}