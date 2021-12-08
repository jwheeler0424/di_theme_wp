<?php
/**
 * @package diPlugin
 *  ##################################################
 *  |   PLUGIN BASE CONTROLLER                       |
 *  ##################################################
*/

namespace Plugin\Base;

class BaseController
{
    public $plugin_path;
    public $plugin_url;
    public $plugin;

    public $theme_url;

    public $managers = array();

    public function __construct()
    {
        $this->plugin_path = plugin_dir_path( dirname( __FILE__, 2 ) );
        $this->plugin_url = plugin_dir_url( dirname( __FILE__, 2 ) );
        $this->plugin = plugin_basename( dirname( __FILE__, 3 ) ) . '/di-plugin.php';

        $this->theme_url = get_template_directory_uri( dirname( __FILE__, 2 ) );

        $this->managers = [
            'cpt_manager' => 'Activate CPT Manager',
            'taxonomy_manager' => 'Activate Taxonomy Manager',
            // 'widget_manager' => 'Activate Widget Manager',
            // 'gallery_manager' => 'Activate Gallery Manager',
            'contact_manager' => 'Activate Contacts Manager',
            'testimonial_manager' => 'Activate Testimonial Manager',
            'event_manager' => 'Activate Events Manager',
            'portfolio_manager' => 'Activate Portfolio Manager',
            'services_manager' => 'Activate Services Manager',
            'templates_manager' => 'Activate Custom Templates',
            'login_manager' => 'Activate Ajax Login/Signup',
            // 'membership_manager' => 'Activate Membership Manager',
            // 'chat_manager' => 'Activate Chat Manager'
        ];
    }

    public function activated( string $key )
	{
		$option = get_option( 'di_plugin' );

		return isset( $option[ $key ] ) ? $option[ $key ] : false;
	}

    // Finds and returns a matching error message for the given error code.
    public function get_error_message( $error_code )
    {
        switch ( $error_code ) {
            case 'empty_username':
                return __( 'You need to enter your username to login.', 'di-plugin' );
            
            case 'empty_password':
                return __( 'You need to enter a password to login.', 'di-plugin' );
            
            case 'invalid_username':
                return __( 'We don\'t have any users with that username.', 'di-plugin' );
            
            case 'incorrect_password':
                $err = __( 'The password you entered was invalid. <a href="%s">Did you forget your password?</a>', 'di-plugin' );
                return sprintf( $err, wp_lostpassword_url() );

            default:
                break;
        }

        return __( 'An unknown error occurred. Please try again later.', 'di-plugin' );
    }

    
}