<?php
/**
 *  @package diTheme
 *  ##################################################
 *  |   THEME ENQUEUE SCRIPTS & STYLES CONTROLLER    |
 *  ##################################################
*/

namespace Theme\Base;

use Theme\Base\BaseController;

class Enqueue extends BaseController
{
    public function register() {

        add_action( 'admin_enqueue_scripts', array( $this, 'enqueueAdmin' ) );

        add_action( 'wp_enqueue_scripts', array( $this, 'enqueueFront' ) );

    }

    public function enqueueAdmin()
    {
        
        wp_enqueue_style( 'di-theme-admin', $this->theme_url . '/assets/di-theme-admin.min.css' );
        wp_enqueue_script( 'di-admin-script', $this->theme_url . '/assets/di-theme-admin.min.js', array(), '1.0.0', true );

    }

    public function enqueueFront()
    {
        $slug = basename(get_permalink());

        wp_enqueue_style( 'di-theme', $this->theme_url . '/assets/di-theme.min.css', array(), '1.0.0', 'all' );
    
        wp_enqueue_script( 'di-theme', $this->theme_url . '/assets/di-theme.min.js', array(), '1.0.0', true );

        switch ( $slug )
        {
            case 'testimonials':
                wp_enqueue_style( 'di-theme-forms', $this->theme_url . '/assets/di-theme-forms.min.css', array(), '1.0.0', 'all' );
                wp_enqueue_script( 'di-theme-forms', $this->theme_url . '/assets/di-theme-forms.min.js', array(), '1.0.0', true );
                break;
            
            case 'contact':
                wp_enqueue_style( 'di-theme-contactPage', $this->theme_url . '/assets/di-theme-contact.min.css', array(), '1.0.0', 'all' );
                wp_enqueue_script( 'di-theme-forms', $this->theme_url . '/assets/di-theme-forms.min.js', array(), '1.0.0', true );
                break;

            case basename(get_site_url()):
                wp_enqueue_style( 'di-theme-homePage', $this->theme_url . '/assets/di-theme-home.min.css', array(), '1.0.0', 'all' );
                break;
            
        }
       
    }

}