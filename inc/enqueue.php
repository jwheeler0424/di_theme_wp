<?php

/* 
    @package designersimage
    ==============================
        ADMIN ENQUEUE FUNCTIONS
    ==============================
*/
function di_load_admin_scripts( $hook ) {

    if( 'toplevel_page_designers_image' != $hook ) { return; }

    wp_register_style( 'di_admin', get_template_directory_uri() . '/css/di.admin.css', array(), '1.0.0', 'all' );
    wp_enqueue_style( 'di_admin' );

    wp_enqueue_media();

    wp_register_script( 'di-admin-script', get_template_directory_uri() . '/js/di.admin.js', array(), '1.0.0', true );
    wp_enqueue_script( 'di-admin-script' );

}

add_action( 'admin_enqueue_scripts', 'di_load_admin_scripts' );