<?php
/**
 *  @package diTheme
 *  ##################################################
 *  |   THEME SUPPORT OPTIONS CONTROLLER             |
 *  ##################################################
*/

namespace ThemeInc\Base;

class ThemeSupport
{
    public $options;
    public $post_formats;
    public $post_thumbnail;
    public $header;
    public $background;
    public $widget;
    public $widget_block_editor;
    public $output = array();

    public function __construct()
    {
        $this->options = get_option( 'di_theme_option' );
        
        $this->post_formats = isset($this->options['post_formats']) ? $this->options['post_formats'] : array();
        $this->post_thumbnail =  isset($this->options['post_thumbnail']) ?: 0;
        $this->header =  isset($this->options['custom_header']) ?: 0;
        $this->background =  isset($this->options['custom_background']) ?: 0;
        $this->widget =  isset($this->options['widget_manager']) ?: 0;
        $this->widget_block_editor =  isset($this->options['widget_block_editor']) ?: 0;
    }
    
    public function register() {
        
        $this->setThemeSupports();
        add_action( 'after_setup_theme', array( $this, 'register_nav_menu' ));

    }

    public function setThemeSupports()
    {
        $formats = array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' );
        if ( is_array($this->post_formats) && count($this->post_formats) > 0 ) {
            foreach ( $formats as $format ) {
                $this->output[] = (isset($this->post_formats[$format]) && $this->post_formats[$format] == 1) ? $format : '';
            }
            if ( !empty( $this->post_formats ) ) {
                add_theme_support( 'post-formats', $this->output );
            }
        }

        if ( @$this->header == 1) {
            add_theme_support( 'custom-header');
        }

        if ( @$this->background == 1) {
            add_theme_support( 'custom-background');
        }

        if ( @$this->post_thumbnail == 1) {
            add_theme_support( 'post-thumbnails');
        }

        if ( @$this->widget == 1) {
            add_theme_support( 'widgets');
        }

        if ( @$this->widget_block_editor == 1) {
            add_theme_support( 'widgets-block-editor');
        }

        add_theme_support( 'html5', array( 'search-form' ) );
        
    }

    public function register_nav_menu() {
        register_nav_menu( 'primary', 'Header Navigation Menu' );
        register_nav_menu( 'footer', 'Footer Navigation Menu' );
    }

}