<?php

/* 
    @package designersimage
    ==============================
        ADMIN ENQUEUE FUNCTIONS
    ==============================
*/
function di_load_admin_scripts( $hook ) {
    // echo $hook;

    switch ( $hook ) {

        case 'toplevel_page_designers_image':
            wp_register_style( 'di_admin', get_template_directory_uri() . '/css/di.admin.css', array(), '1.0.0', 'all' );
            wp_enqueue_style( 'di_admin' );
        
            wp_enqueue_media();
        
            wp_register_script( 'di-admin-script', get_template_directory_uri() . '/js/di.admin.js', array(), '1.0.0', true );
            wp_enqueue_script( 'di-admin-script' );
            break;
        
        case 'designers-image_page_designers_image_css':
            wp_enqueue_style( 'ace', get_template_directory_uri() . '/css/di.ace.css', array(), '1.0.0', 'all' );

            wp_register_script( 'ace', get_template_directory_uri() . '/js/ace/ace.js', array(), '1.4.13', true );
            wp_enqueue_script( 'ace' );

            wp_register_script( 'di-custom-css-script', get_template_directory_uri() . '/js/di.custom_css.js', array(), '1.0.0', true );
            wp_enqueue_script( 'di-custom-css-script' );
            break;

    }
}

add_action( 'admin_enqueue_scripts', 'di_load_admin_scripts' );