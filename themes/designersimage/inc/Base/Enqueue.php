<?php
/**
 *  @package diTheme
 *  ##################################################
 *  |   THEME ENQUEUE SCRIPTS & STYLES CONTROLLER    |
 *  ##################################################
*/

namespace ThemeInc\Base;

use \ThemeInc\Base\BaseController;

class Enqueue extends BaseController
{
    public function register() {

        add_action( 'admin_enqueue_scripts', array( $this, 'enqueueAdmin' ) );

        add_action( 'wp_enqueue_scripts', array( $this, 'enqueueFront' ) );

    }

    public function enqueueAdmin( $hook )
    {
        
        switch ( $hook ) {

            case 'toplevel_page_designers_image':
                wp_enqueue_style( 'di-theme-admin', $this->theme_url . '/assets/di-theme-admin.min.css', array(), '1.0.0', 'all' );
            
                wp_enqueue_media();
            
                wp_enqueue_script( 'di-admin-script', $this->theme_url . '/assets/di-theme-admin.min.js', array(), '1.0.0', true );
                break;
    
            case 'edit.php':
                
                break;
    
            case 'post.php':
                
                break;
    
        }

    }

    public function enqueueFront()
    {
        wp_enqueue_style( 'bootstrap', $this->theme_url . '/assets/bootstrap.min.css', array(), '5.1.3', 'all' );
        wp_enqueue_style( 'di-theme', $this->theme_url . '/assets/di-theme.min.css', array(), '1.0.0', 'all' );
        wp_enqueue_style( 'di-theme-forms', $this->theme_url . '/assets/di-theme-forms.min.css', array(), '1.0.0', 'all' );
        wp_enqueue_style( 'material-icons', 'https://fonts.googleapis.com/icon?family=Material+Icons', array(), '1.6.28', 'all' );
    
        wp_deregister_script( 'jquery' );
        wp_enqueue_script( 'jquery', $this->theme_url . '/assets/jquery.min.js', array(), '3.6.0', true );
        wp_enqueue_script( 'bootstrap', $this->theme_url . '/assets/bootstrap.min.js', array('jquery'), '5.1.3', true );
        wp_enqueue_script( 'di-theme-forms', $this->theme_url . '/assets/di-theme-forms.min.js', array(), '1.0.0', true );
    }

}