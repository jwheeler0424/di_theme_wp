<?php
/**
 * @package diPlugin
*/

namespace Inc\Base;

use \Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;

class CustomTaxonomyController extends BaseController
{
    public $callbacks;
    public $subpages;
    public function register()
    {
        if ( !$this->activated( 'taxonomy_manager' ) ) return;

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
                'page_title' => 'Custom Taxonomies',
                'menu_title' => 'Taxonomy Manager', 
                'capability' => 'manage_options', 
                'menu_slug' => 'di_taxonomy', 
                'callback' => array( $this->callbacks, 'adminTaxonomy')
            ]
        ];
    }

    public function activate()
    {
        return;
    }
}