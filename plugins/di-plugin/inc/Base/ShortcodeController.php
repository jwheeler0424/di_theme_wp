<?php
/**
 *  @package diPlugin
 *  ##################################################
 *  |   PLUGIN SHORTCODE CONTROLLER                   |
 *  ##################################################
*/

namespace Plugin\Base;

use Plugin\Base\BaseController;

class ShortcodeController extends BaseController
{
    public function register()
    {
        // Background Icon Shortcode
        add_shortcode( 'background-icon', array( $this, 'background_icon' ) );

        // About Company Icon Cards Shortcode
        add_shortcode( 'company-cards', array( $this, 'company_cards' ) );

        // About Company Icon Links Shortcode
        add_shortcode( 'company-links', array( $this, 'company_links' ) );

        // Contact Message Form Shortcode
        add_shortcode( 'contact-form', array( $this, 'contact_form' ) );

        // Contact Links Main Shortcode
        add_shortcode( 'contact-links', array( $this, 'contact_links' ) );

        // Event List - Footer Shortcode
        add_shortcode( 'event-list-footer', array( $this, 'event_list_footer' ) );

        // Home Hero Section Shortcode
        add_shortcode( 'home-hero', array( $this, 'home_hero' ) );

        // Home Hero Section Shortcode
        add_shortcode( 'home-about', array( $this, 'home_about' ) );

        // Home Hero Section Shortcode
        add_shortcode( 'home-portfolio', array( $this, 'home_portfolio' ) );

        // Home Hero Section Shortcode
        add_shortcode( 'home-services', array( $this, 'home_services' ) );

        // Home Hero Section Shortcode
        add_shortcode( 'home-testimonials', array( $this, 'home_testimonials' ) );

        // Login Form shortcode
        add_shortcode( 'login-form', array( $this, 'login_form' ) );

        // Password Lost Form shortcode
        add_shortcode( 'password-lost-form', array( $this, 'password_lost_form' ) );

        // Password Reset Form shortcode
        add_shortcode( 'password-reset-form', array( $this, 'password_reset_form' ) );

        // Portfolio Carousel Shortcode
        add_shortcode( 'portfolio-carousel', array( $this, 'portfolio_carousel' ) );

        // Register Form shortcode
        add_shortcode( 'register-form', array( $this, 'register_form' ) );
        
        // Services Icon Cards Shortcode
        add_shortcode( 'service-cards', array( $this, 'service_cards' ) );

        // Services Icon Links Shortcode
        add_shortcode( 'service-links', array( $this, 'service_links' ) );

        // Services Icon Links - Footer Shortcode
        add_shortcode( 'service-links-footer', array( $this, 'service_links_footer' ) );

        // Testimonial Slider Shortcode
        add_shortcode( 'testimonial-slider', array( $this, 'testimonial_slider' ) );

        // Testimonial Form Shortcode
        add_shortcode( 'testimonial-form', array( $this, 'testimonial_form' ) );
    }

    public function background_icon($attr, $content = null)
    {
        ob_start();
        require_once( "$this->plugin_path/templates/shortcode/background-icon.php" );
        return ob_get_clean();
    }

    public function company_cards($attr, $content = null)
    {
        ob_start();
        require_once( "$this->plugin_path/templates/shortcode/company-cards.php" );
        return ob_get_clean();
    }

    public function company_links($attr, $content = null)
    {
        ob_start();
        require_once( "$this->plugin_path/templates/shortcode/company-links.php" );
        return ob_get_clean();
    }

    public function contact_form($attr, $content = null)
    {
        ob_start();
        require_once( "$this->plugin_path/templates/shortcode/contact-form.php" );
        return ob_get_clean();
    }

    public function contact_links($attr, $content = null)
    {
        ob_start();
        require_once( "$this->plugin_path/templates/shortcode/contact-links.php" );
        return ob_get_clean();
    }

    public function event_list_footer($attr, $content = null)
    {
        ob_start();
        require_once( "$this->plugin_path/templates/shortcode/event-list-footer.php" );
        return ob_get_clean();
    }

    public function home_hero($attr, $content = null)
    {
        ob_start();
        require_once( "$this->plugin_path/templates/shortcode/home-hero.php" );
        return ob_get_clean();
    }

    public function home_about($attr, $content = null)
    {
        ob_start();
        require_once( "$this->plugin_path/templates/shortcode/home-about.php" );
        return ob_get_clean();
    }

    public function home_portfolio($attr, $content = null)
    {
        ob_start();
        require_once( "$this->plugin_path/templates/shortcode/home-portfolio.php" );
        return ob_get_clean();
    }

    public function home_services($attr, $content = null)
    {
        ob_start();
        require_once( "$this->plugin_path/templates/shortcode/home-services.php" );
        return ob_get_clean();
    }

    public function home_testimonials($attr, $content = null)
    {
        ob_start();
        require_once( "$this->plugin_path/templates/shortcode/home-testimonials.php" );
        return ob_get_clean();
    }

    /**
     * A shortcode for rendering the login form
     *
     * @param array  $attr      Shortcode attributes
     * @param string $content   The text content for the shortcode - NOT USED
     * 
     * @return string           The shortcode output
     */
    public function login_form($attr, $content = null)
    {
        // Pass the redirect paramenter to the WordPress login functionality:
        // by default, don't specify a redirect, but if a valid redirect URL
        // has been passed as a request parameter, use it.
        $redirect = '';
        if ( isset( $_REQUEST['redirect_to'] ) ) {
            $redirect = wp_validate_redirect( $_REQUEST['redirect_to'], $redirect );
        }

        // Check if the user just registered
        $registered = isset( $_REQUEST['registered'] );

        // Check if the user just requested a new password
        $lost_password_sent = isset( $_REQUEST['checkmail'] ) && $_REQUEST['checkmail'] == 'confirm';

        // Check if user just updated password
        $password_updated = isset( $_REQUEST['password'] ) && $_REQUEST['password'] == 'changed';

        // Error Messages
        $errors = array();
        if ( isset( $_REQUEST['login'] ) ) {
            $error_codes = explode( ',', $_REQUEST['login'] );

            foreach ( $error_codes as $code ) {
                $errors[] = $this->get_error_message( $code );
            }
        }

        // Parse shortcode attributes
        $default_attr = array( 
            'errors'                => $errors,
            'lost_password_sent'    => $lost_password_sent,
            'password_updated'      => $password_updated,
            'redirect'              => $redirect,
            'registered'            => $registered,
            'show_title'            => false
        );
        $attr = shortcode_atts( $default_attr, $attr );

        if ( is_user_logged_in() ) {
            $user = wp_get_current_user();
            if ( user_can( $user, 'manage_options' ) ) {
                wp_redirect( admin_url() );
            } elseif ( $user->roles[0] === 'member') {
                wp_redirect( home_url( 'member-account' ) );
            } else {
                wp_redirect( home_url( 'client-account' ) );
            }
            exit;
        }

        // Render the login form using template
        return $this->get_shortcode_template_html( 'login-form', $attr );
    }

    /**
     * A shortcode for rendering the form used to initiate the password reset
     *
     * @param array  $attr      Shortcode attributes
     * @param string $content   The text content for the shortcode - NOT USED
     * 
     * @return string           The shortcode output
     */
    public function password_lost_form($attr, $content = null)
    {
        // Error Messages
        $errors = array();
        if ( isset( $_REQUEST['errors'] ) ) {
            $error_codes = explode( ',', $_REQUEST['errors'] );

            foreach ( $error_codes as $code ) {
                $errors[] = $this->get_error_message( $code );
            }
        }

        // Parse shortcode attributes
        $default_attr = array( 
            'errors'                => $errors,
            'show_title'            => false
        );
        $attr = shortcode_atts( $default_attr, $attr );

        if ( is_user_logged_in() ) {
            $user = wp_get_current_user();
            if ( user_can( $user, 'manage_options' ) ) {
                wp_redirect( admin_url() );
            } elseif ( $user->roles[0] === 'member') {
                wp_redirect( home_url( 'member-account' ) );
            } else {
                wp_redirect( home_url( 'client-account' ) );
            }
            exit;
        }

        // Render the login form using template
        return $this->get_shortcode_template_html( 'password-lost-form', $attr );
    }

    /**
     * A shortcode for endering the form used to reset a user's password
     *
     * @param array     $attr       Shortcode attributes
     * @param string    $content    The text content for shortcode - NOT USED
     * 
     * @return string   The shortcode output
     */
    public function password_reset_form($attr, $content = null)
    {
        // Error Messages
        $errors = array();
        if ( isset( $_REQUEST['error'] ) ) {
            $error_codes = explode( ',', $_REQUEST['error'] );

            foreach ( $error_codes as $code ) {
                $errors[] = $this->get_error_message( $code );
            }
        }

        // Login & Key URL parameters
        $login = '';
        $key = '';
        if ( isset( $_REQUEST['login'] ) && isset( $_REQUEST['key'] ) ) {
            $login = $_REQUEST['login'];
            $key = $_REQUEST['key'];
        }

        // Parse shortcode attributes
        $default_attr = array( 
            'errors'        => $errors,
            'key'           => $key,
            'login'         => $login,
            'show_title'    => false
        );
        $attr = shortcode_atts( $default_attr, $attr );

        if ( is_user_logged_in() ) {
            $user = wp_get_current_user();
            if ( user_can( $user, 'manage_options' ) ) {
                wp_redirect( admin_url() );
            } elseif ( $user->roles[0] === 'member') {
                wp_redirect( home_url( 'member-account' ) );
            } else {
                wp_redirect( home_url( 'client-account' ) );
            }
            exit;
        }

        if ( !isset($_REQUEST['login']) || !isset($_REQUEST['key']) ) {
            wp_redirect( home_url( 'member-login?login=invalidkey' ) );
            exit;
        }

        return $this->get_shortcode_template_html( 'password-reset-form', $attr );
    }

    public function portfolio_carousel($attr, $content = null)
    {
        ob_start();
        require_once( "$this->plugin_path/templates/shortcode/portfolio-carousel.php" );
        return ob_get_clean();
    }

    /**
     * A shortcode for rendering the registration form
     *
     * @param array  $attr      Shortcode attributes
     * @param string $content   The text content for the shortcode - NOT USED
     * 
     * @return string           The shortcode output
     */
    public function register_form($attr, $content = null)
    {
        // Retrieve reCAPTCHA Key
        $keys = get_option( 'di_plugin_api' ) ?: array();

        // Retrieve possible errors from request parameters
        $errors = array();
        if ( isset( $_REQUEST['register-errors'] ) ) {
            $error_codes = explode( ',', $_REQUEST['register-errors'] );

            foreach ( $error_codes as $error_code ) {
                $errors[] = $this->get_error_message( $error_code );
            }
        }

        // Parse shortcode attributes
        $default_attr = array( 
            'errors'        => $errors,
            'reCAPTCHA'     => ($keys['reCAPTCHA']) ? $keys['reCAPTCHA']['site_key'] : '',
            'show_title'    => false
        );
        $attr = shortcode_atts( $default_attr, $attr );

        if ( is_user_logged_in() ) {
            $user = wp_get_current_user();
            if ( user_can( $user, 'manage_options' ) ) {
                wp_redirect( admin_url() );
            } elseif ( $user->roles[0] === 'member') {
                wp_redirect( home_url( 'member-account' ) );
            } else {
                wp_redirect( home_url( 'client-account' ) );
            }
            exit;
        } elseif ( !get_option( 'users_can_register' ) ) {
            wp_redirect( home_url( 'member-login' ) );
        }

        // Render the register form using template
        return $this->get_shortcode_template_html( 'register-form', $attr );

    }

    public function service_cards($attr, $content = null)
    {
        ob_start();
        require_once( "$this->plugin_path/templates/shortcode/service-cards.php" );
        return ob_get_clean();
    }

    public function service_links($attr, $content = null)
    {
        ob_start();
        require_once( "$this->plugin_path/templates/shortcode/service-links.php" );
        return ob_get_clean();
    }

    public function service_links_footer($attr, $content = null)
    {
        ob_start();
        require_once( "$this->plugin_path/templates/shortcode/service-links-footer.php" );
        return ob_get_clean();
    }

    public function testimonial_form($attr, $content = null)
    {
        ob_start();
        require_once( "$this->plugin_path/templates/shortcode/testimonial-form.php" );
        return ob_get_clean();
    }

    public function testimonial_slider($attr, $content = null)
    {
        ob_start();
        require_once( "$this->plugin_path/templates/shortcode/testimonial-slider.php" );
        return ob_get_clean();
    }

}