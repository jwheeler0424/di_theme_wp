<?php
/**
 *  @package diTheme
 *  ##################################################
 *  |   THEME SHORTCODE CONTROLLER                   |
 *  ##################################################
*/

namespace Theme\Base;

use Theme\Base\BaseController;

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

        // Portfolio Carousel Shortcode
        add_shortcode( 'portfolio-carousel', array( $this, 'portfolio_carousel' ) );

        // Services Icon Links Shortcode
        add_shortcode( 'services-links', array( $this, 'services_links' ) );

        // Services Icon Links - Footer Shortcode
        add_shortcode( 'services-links-footer', array( $this, 'services_links_footer' ) );

        // Testimonial Slider Shortcode
        add_shortcode( 'testimonial-slider', array( $this, 'testimonial_slider' ) );

        // Testimonial Form Shortcode
        add_shortcode( 'testimonial-form', array( $this, 'testimonial_form' ) );
    }

    public function background_icon()
    {
        ob_start();
        require_once( "$this->theme_path/templates/background-icon.php" );
        return ob_get_clean();
    }

    public function company_cards()
    {
        ob_start();
        require_once( "$this->theme_path/templates/company-cards.php" );
        return ob_get_clean();
    }

    public function company_links()
    {
        ob_start();
        require_once( "$this->theme_path/templates/company-links.php" );
        return ob_get_clean();
    }

    public function contact_form()
    {
        ob_start();
        require_once( "$this->theme_path/templates/contact-form.php" );
        return ob_get_clean();
    }

    public function contact_links()
    {
        ob_start();
        require_once( "$this->theme_path/templates/contact-links.php" );
        return ob_get_clean();
    }

    public function event_list_footer()
    {
        ob_start();
        require_once( "$this->theme_path/templates/event-list-footer.php" );
        return ob_get_clean();
    }

    public function home_hero($attr, $content)
    {
        ob_start();
        require_once( "$this->theme_path/templates/home-hero.php" );
        return ob_get_clean();
    }

    public function home_about($attr, $content)
    {
        ob_start();
        require_once( "$this->theme_path/templates/home-about.php" );
        return ob_get_clean();
    }

    public function home_portfolio($attr, $content)
    {
        ob_start();
        require_once( "$this->theme_path/templates/home-portfolio.php" );
        return ob_get_clean();
    }

    public function home_services($attr, $content)
    {
        ob_start();
        require_once( "$this->theme_path/templates/home-services.php" );
        return ob_get_clean();
    }

    public function home_testimonials($attr, $content)
    {
        ob_start();
        require_once( "$this->theme_path/templates/home-testimonials.php" );
        return ob_get_clean();
    }

    public function portfolio_carousel()
    {
        ob_start();
        require_once( "$this->theme_path/templates/portfolio-carousel.php" );
        return ob_get_clean();
    }

    public function services_links()
    {
        ob_start();
        require_once( "$this->theme_path/templates/services-links.php" );
        return ob_get_clean();
    }

    public function services_links_footer()
    {
        ob_start();
        require_once( "$this->theme_path/templates/services-links-footer.php" );
        return ob_get_clean();
    }

    public function testimonial_form()
    {
        ob_start();
        require_once( "$this->theme_path/templates/testimonial-form.php" );
        return ob_get_clean();
    }

    public function testimonial_slider()
    {
        ob_start();
        require_once( "$this->theme_path/templates/testimonial-slider.php" );
        return ob_get_clean();
    }

}