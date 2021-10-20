<?php

/* 
    @package designersimage
    ========================================
        FRONT-END ENQUEUE FUNCTIONS        |
    ========================================
*/

/* Header Image Alt Text Display */
function alt_text_display() {
    
    $data =  get_object_vars(get_theme_mod('header_image_data'));
    if ( $data ) {
        $image_id = is_array($data) && isset($data['attachment_id']) ? $data['attachment_id'] : false;

        if ($image_id) {

            $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true);
            return $image_alt;

        }
    }
}
add_action( 'wp_enqueue_scripts', 'alt_text_display' );