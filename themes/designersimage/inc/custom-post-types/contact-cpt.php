<?php

/*  
    @package designersimage
    ========================================
    |   CONTACT MESSAGE CUSTOM POST TYPE   |
    ========================================
*/

$contact = get_option( 'activate_contact' );
if ( @$contact == 1) {

    add_action( 'init', 'di_contact_custom_post_type' );

    add_filter( 'manage_di-contact_posts_columns', 'di_set_contact_columns' );
    add_filter( 'manage_edit-di-contact_sortable_columns', 'di_set_sortable_columns' );
    add_filter( 'post_row_actions', 'remove_row_actions', 10, 2 );
    add_action( 'manage_di-contact_posts_custom_column', 'di_contact_custom_column', 10, 2 );

    add_action( 'add_meta_boxes', 'di_contact_add_meta_box' );
    add_action( 'save_post', 'di_save_contact_email_data' );
    add_action( 'save_post', 'di_save_contact_phone_data' );

}

/* CONTACT CPT */
function di_contact_custom_post_type() {
    $labels = array(
        'name'                  => 'Contact Messages',
        'singular_name'         => 'Contact Message',
        'menu_name'             => 'Contact Messages',
        'name_admin_bar'        => 'Contact Message',
    );
    $args = array(
        'labels'                => $labels,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'capability_type'       => 'post',
        'hierarchical'          => false,
        'menu_position'         => 26,
        'menu_icon'             => 'dashicons-email-alt',
        'rewrite'               => array('slug' => 'contacts', 'with_front' => false ),
        'supports'              => array( 'title', 'editor' )
    );

    register_post_type( 'di-contact', $args );
}


function di_set_contact_columns( $columns ) {
    $newColumns = array();
    $newColumns['title'] = 'Full Name';
    $newColumns['message'] = 'Message';
    $newColumns['email'] = 'Email Address';
    $newColumns['phone'] = 'Phone Number';
    $newColumns['datetime'] = 'Date';
    //$newColumns['date'] = 'Date';
    $newColumns['trash'] = '';
    return $newColumns;
}

function di_set_sortable_columns ( $columns ) {
    $newColumns['title'] = 'Full Name';
    $newColumns['datetime'] = 'Date';
    return $newColumns;
}

function remove_row_actions( $actions, $post ) {
    $post_type_object = get_post_type_object( $post->post_type );
    $can_edit_post    = current_user_can( 'edit_post', $post->ID );
    $actions          = array();
    
    global $current_screen;
    if( $current_screen->post_type != 'di-contact' ) return $actions;

    return $actions;
}

function di_contact_custom_column( $column, $post_id ) {

    switch( $column ) {

        case 'message':
            // message column
            echo get_the_excerpt();
            break;

        case 'email':
            // email column
            $email = get_post_meta( $post_id, '_contact_email_value_key', true );
            echo '<a href="mailto:'.$email.'">'.$email.'</a>';
            break;

        case 'phone':
            // phone number column
            $phone = get_post_meta ( $post_id, '_contact_phone_value_key', true );
            echo $phone;
            break;
        
        case 'datetime':
            echo get_the_date( 'n/j/y @ g:i a', $post_id );
            break;
        
        case 'trash':
            // delete button column
            $trash = sprintf(
                '<div class="row-actions"><span class="trash"><a href="%s" class="submitdelete" aria-label="%s" title="Delete">%s</a></span></div>',
                get_delete_post_link( $post_id ),
                /* translators: %s: Post title. */
                esc_attr( sprintf( __( 'Move &#8220;%s&#8221; to the Trash' ), $title ) ),
                _x( '<span class="dashicons dashicons-trash"></span>', 'verb' )
            );
            echo $trash;
            break;

    }

}

/* CONTACT META BOXES */
function di_contact_add_meta_box() {

    add_meta_box( 'contact_email', 'Email Address', 'di_contact_email_callback', 'di-contact', 'side' );
    add_meta_box( 'contact_phone', 'Phone Number', 'di_contact_phone_callback', 'di-contact', 'side' );

}

function di_contact_email_callback( $post ) {

    wp_nonce_field( 'di_save_contact_email_data', 'di_contact_email_meta_box_nonce' );

    $value = get_post_meta( $post->ID, '_contact_email_value_key', true );

    echo '<label for="di_contact_email_field">Contact Email Address: </label>';
    echo '<input type="email" id="di_contact_email_field" name="di_contact_email_field" value="'.esc_attr( $value ).'" size="25" />';

}

function di_contact_phone_callback( $post ) {

    wp_nonce_field( 'di_save_contact_phone_data', 'di_contact_phone_meta_box_nonce' );

    $value = get_post_meta( $post->ID, '_contact_phone_value_key', true );

    echo '<label for="di_contact_phone_field">Contact Phone Number: </label>';
    echo '<input type="phone" id="di_contact_phone_field" name="di_contact_phone_field" value="'.esc_attr( $value ).'" size="25" />';

}

function di_save_contact_email_data( $post_id ) {

    // Check if the email meta box nonce is set, return if not.
    if ( ! isset( $_POST['di_contact_email_meta_box_nonce'] ) ) {
        return;
    }

    // Verify that nonce exists, return if not.
    if ( ! wp_verify_nonce( $_POST['di_contact_email_meta_box_nonce'], 'di_save_contact_email_data' ) ) {
        return;
    }

    // Check if WordPress is performing autosave, return if so.
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
        return;
    }

    // Check if user can edit post, return if not.
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // Check if the text field is set, return if not.
    if ( ! isset( $_POST['di_contact_email_field'] ) ) {
        return;
    }

    $data = sanitize_text_field( $_POST['di_contact_email_field'] );

    update_post_meta( $post_id, '_contact_email_value_key', $data );

}

function di_save_contact_phone_data( $post_id ) {

    // Check if the phone meta box nonce is set, return if not.
    if ( ! isset( $_POST['di_contact_phone_meta_box_nonce'] ) ) {
        return;
    }

    // Verify that nonce exists, return if not.
    if ( ! wp_verify_nonce( $_POST['di_contact_phone_meta_box_nonce'], 'di_save_contact_phone_data' ) ) {
        return;
    }

    // Check if WordPress is performing autosave, return if so.
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
        return;
    }

    // Check if user can edit post, return if not.
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // Check if the text field is set, return if not.
    if ( ! isset( $_POST['di_contact_phone_field'] ) ) {
        return;
    }

    $data = sanitize_text_field( preg_replace( "/[^0-9]/", "", $_POST['di_contact_phone_field'] ) );

    update_post_meta( $post_id, '_contact_phone_value_key', $data );

}
