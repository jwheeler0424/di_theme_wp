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

        // Portfolio Carousel Shortcode
        add_shortcode( 'portfolio-carousel', array( $this, 'portfolio_carousel' ) );

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

    public function login_Form($attr, $content = null)
    {
        // Parse shortcode attributes
        $default_attr = [ 'show_title' => false ];
        $attr = shortcode_atts( $default_attr, $attr );
        $show_title = $attr['show_title'];

        if ( is_user_logged_in() ) {
            return __( 'You are already signed in.', 'di-plugin' );
        }

        // Pass the redirect paramenter to the WordPress login functionality:
        // by default, don't specify a redirect, but if a valid redirect URL
        // has been passed as a request parameter, use it.
        $attr['redirect'] = '';
        if ( isset( $_REQUEST['redirect_to'] ) ) {
            $attr['redirect'] = wp_validate_redirect( $_REQUEST['redirect_to'], $attr['redirect'] );
        }

        // Error Messages
        $errors = array();
        if ( isset( $_REQUEST['login'] ) ) {
            $error_codes = explode( ',', $_REQUEST['login'] );

            foreach ( $error_codes as $code ) {
                $errors[] = $this->get_error_message( $code );
            }
        }
        $attr['errors'] = $errors;

        ob_start();
        do_action( 'personalize_login_before_login-form' );
        require_once( "$this->plugin_path/templates/shortcode/login-form.php" );
        do_action( 'personalize_login_after_login-form' );

        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }

    public function portfolio_carousel($attr, $content = null)
    {
        ob_start();
        require_once( "$this->plugin_path/templates/shortcode/portfolio-carousel.php" );
        return ob_get_clean();
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