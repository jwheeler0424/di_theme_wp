<?php
/**
 * @package diPlugin
 *  ##################################################
 *  |   PLUGIN CUSTOM TEMPLATE CONTROLLER            |
 *  ##################################################
*/

namespace Plugin\Base;

use Plugin\Base\BaseController;

class TemplateController extends BaseController
{
    public $templates;

    public function register()
    {
        if ( !$this->activated( 'templates_manager' ) ) return;

        $this->templates = array(
            'page-templates/auth-tpl.php' => 'User Authorization Page',
            'page-templates/company-tpl.php' => 'Company Page',
            'page-templates/events-tpl.php' => 'Events Page',
            'page-templates/portfolio-tpl.php' => 'Portfolio Page',
            'page-templates/services-tpl.php' => 'Services Page'
        );

        add_filter( 'theme_page_templates', array( $this, 'custom_template' ) );
        add_filter( 'template_include', array( $this, 'load_template' ) );

        add_filter( 'manage_pages_columns', array( $this, 'page_column_views' ) );
        add_action( 'manage_pages_custom_column', array( $this, 'page_custom_column_views'), 5, 2 );

    }

    public function custom_template( $templates )
    {
        $templates = array_merge( $templates, $this->templates );
        return $templates;
    }

    public function load_template( $template )
    {
        global $post;

        if ( !$post ) {
            return $template;
        }
        
        // If front page, load a custom template
        // if ( is_front_page() ) {
        //     $file = $this->plugin_path . 'page-templates/front-page.php';

        //     if ( file_exists( $file ) ) {
        //         return $file;
        //     }
        // }

        $template_name = get_post_meta( $post->ID, '_wp_page_template', true );

        if ( !isset($this->templates[$template_name]) ) {
            return $template;
        }

        $file = $this->plugin_path . $template_name;

        if ( file_exists($file) ) {
            return $file;
        }

        return $template;

    }

    public function page_column_views( $defaults )
    {
        $defaults['page-layout'] = __('Template');
        return $defaults;
    }

    public function page_custom_column_views( $column_name, $id )
    {
        if ( $column_name === 'page-layout' ) {
            $set_template = get_post_meta( get_the_ID(), '_wp_page_template', true );
            if ( $set_template == 'default' ) {
                echo 'Default';
            }
            $templates = get_page_templates();
            ksort( $templates );
            foreach ( array_keys( $templates ) as $template ) :
                if ( $set_template == $templates[$template] ) echo $template;
            endforeach;
        }
    }
    
}