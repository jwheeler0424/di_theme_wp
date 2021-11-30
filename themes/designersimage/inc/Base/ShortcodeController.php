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
        // About Company Icon Links Shortcode
        add_shortcode( 'company-links', array( $this, 'company_links' ) );

        // Contact Message Form Shortcode
        add_shortcode( 'contact-form', array( $this, 'contact_form' ) );

        // Contact Links Main Shortcode
        add_shortcode( 'contact-links', array( $this, 'contact_links' ) );

        // Portfolio Carousel Shortcode
        add_shortcode( 'portfolio-carousel', array( $this, 'portfolio_carousel' ) );

        // Services Icon Links Shortcode
        add_shortcode( 'services-links', array( $this, 'services_links' ) );

        // Testimonial Slider Shortcode
        add_shortcode( 'testimonial-slider', array( $this, 'testimonial_slider' ) );

        // Testimonial Form Shortcode
        add_shortcode( 'testimonial-form', array( $this, 'testimonial_form' ) );
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