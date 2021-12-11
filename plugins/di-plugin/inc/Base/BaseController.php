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
            'keys_manager' => 'Activate API Keys Manager',
            'contact_manager' => 'Activate Contacts Manager',
            'testimonial_manager' => 'Activate Testimonial Manager',
            'event_manager' => 'Activate Events Manager',
            'portfolio_manager' => 'Activate Portfolio Manager',
            'services_manager' => 'Activate Services Manager',
            'templates_manager' => 'Activate Custom Templates',
            'auth_manager' => 'Activate Ajax Login/Signup',
            // 'membership_manager' => 'Activate Membership Manager',
            // 'chat_manager' => 'Activate Chat Manager'
        ];
    }

    public function activated( string $key )
	{
		$option = get_option( 'di_plugin' );

		return isset( $option[ $key ] ) ? $option[ $key ] : false;
	}

    /**
     * Finds and returns a matching error message for the given error code.
     *
     * @param string    $error_code     The error code to look up.
     * 
     * @return string                   An error message.
     */
    protected function get_error_message( $error_code )
    {
        switch ( $error_code ) {
            case 'captcha':
                return __( 'The Google reCAPTCHA check failed. Are you a robot?', 'di-plugin' );
    
            case 'closed':
                return __( 'Registering new users is currently not allowed.', 'di-plugin' );
    
            case 'email':
                return __( 'The email address you entered is not valid.', 'di-plugin' );
            
            case 'email_exists':
                return __( 'An account already exists with this email address.', 'di-plugin' );
                
            case 'empty_username':
                return __( 'You need to enter your username to continue.', 'di-plugin' );
            
            case 'empty_password':
                return __( 'You need to enter a password to continue.', 'di-plugin' );
            
            case 'expiredkey':
            case 'invalidkey':
                return __( 'The password reset link you used is not valid anymore.', 'di-plugin' );
            
            case 'invalid_email':
            case 'invalidcombo':
                return __( 'There are no users registered with this email address.', 'di-plugin' );

            case 'invalid_username':
                return __( 'We don\'t have any users with that username.', 'di-plugin' );
            
            case 'incorrect_password':
                $err = __( 'The password you entered was invalid. <a href="%s">Did you forget your password?</a>', 'di-plugin' );
                return sprintf( $err, wp_lostpassword_url() );

            case 'password_reset_empty':
                return __( 'You need to enter a password to continue.', 'di-plugin' );
            
            case 'password_reset_mismatch':
                return __( 'The tow passwords you entered don\'t match.', 'di-plugin' );

            case 'username':
                return __( 'The username you entered is not valid.', 'di-plugin' );

            case 'username_exists':
                return __( 'An account already exists with this username.', 'di-plugin' );
            
            default:
                break;
        }

        return __( 'An unknown error occurred. Please try again later.', 'di-plugin' );
    }

    /**
     * Renders the contents of the given user authorization template to a string and returns it.
     *
     * @param string    $template_name  The name of the template to render (without .php)
     * @param array     $attributes     The PHP variables for the template
     * 
     * @return string                   The contents of the template.
     */
    protected function get_template_html( $template_name, $attr = null )
    {
        if ( !$attr ) {
            $attr = array();
        }
        
        ob_start();

        do_action( 'di_login_before_' . $template_name );

        require_once ( "$this->plugin_path/templates/shortcode/" . $template_name . '.php' );

        do_action( 'di_login_after_' . $template_name );

        $html = ob_get_contents();
        ob_end_clean();

        return $html;

    }
    
}