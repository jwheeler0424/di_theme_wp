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
        $path = get_page_uri();

        wp_enqueue_style( 'di-theme', $this->theme_url . '/assets/di-theme.min.css', array(), '1.0.0', 'all' );
    
        wp_enqueue_script( 'di-theme', $this->theme_url . '/assets/di-theme.min.js', array(), '1.0.0', true );

        switch ( strtok($path, '/') )
        {
            case 'company':
                wp_enqueue_style( 'di-theme-company', $this->theme_url . '/assets/di-theme-company.min.css', array(), '1.0.0', 'all' );
                break;
            
            case 'portfolio':
                wp_enqueue_style( 'di-theme-company', $this->theme_url . '/assets/di-theme-portfolio.min.css', array(), '1.0.0', 'all' );
                break;

            case 'services':
                wp_enqueue_style( 'di-theme-services', $this->theme_url . '/assets/di-theme-services.min.css', array(), '1.0.0', 'all' );
                break;

            case 'testimonial':
            case 'contact':
                wp_enqueue_style( 'di-theme-forms', $this->theme_url . '/assets/di-theme-forms.min.css', array(), '1.0.0', 'all' );
                wp_enqueue_script( 'di-theme-forms', $this->theme_url . '/assets/di-theme-forms.min.js', array(), '1.0.0', true );
                break;

            case 'home':
                wp_enqueue_style( 'di-theme-home', $this->theme_url . '/assets/di-theme-home.min.css', array(), '1.0.0', 'all' );
                break;
            
            default:
                wp_enqueue_style( 'di-theme-404', $this->theme_url . '/assets/di-theme-404.min.css', array(), '1.0.0', 'all' );
                break;
            
        }
       
    }

}