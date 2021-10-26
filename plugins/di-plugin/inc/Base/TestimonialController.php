<?php
/**
 * @package diPlugin
*/

namespace Inc\Base;

use \Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;

class TestimonialController extends BaseController
{
    public $callbacks;
    public $subpages;
    public function register()
    {
        if ( !$this->activated( 'testimonial_manager' ) ) return;

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
                'page_title' => 'Testimonial Manager',
                'menu_title' => 'Testimonial Manager', 
                'capability' => 'manage_options', 
                'menu_slug' => 'di_testimonial', 
                'callback' => array( $this->callbacks, 'adminTestimonial')
            ]
        ];
    }

    public function activate()
    {
        return;
    }
}