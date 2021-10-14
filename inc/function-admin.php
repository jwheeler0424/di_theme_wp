<?php

/* 
    @package designersimage
    ==============================
        ADMIN PAGE
    ==============================
*/

function di_add_admin_page() {

    // Generate DI Admin Page
    add_menu_page( "DI Theme Options", "Designer's Image", 'manage_options', 'designers_image', 'di_theme_create_page', get_template_directory_uri() . '/img/di_icon.png', 3 );

    // Generate DI Admin Sub Pages
    add_submenu_page( 'designers_image', 'DI Theme Options', 'Settings', 'manage_options', 'designers_image', 'di_theme_create_page' );
    add_submenu_page( 'designers_image', 'DI CSS Options', 'Custom CSS', 'manage_options', 'designers_image_css', 'di_theme_css_page' );

    // Activate custom settings
    add_action( 'admin_init', 'di_custom_settings' );

}

add_action( 'admin_menu', 'di_add_admin_page' );

function di_custom_settings() {
    register_setting( 'di-settings-group', 'profile_image' );
    register_setting( 'di-settings-group', 'first_name' );
    register_setting( 'di-settings-group', 'last_name' );
    register_setting( 'di-settings-group', 'user_description' );
    register_setting( 'di-settings-group', 'twitter_handler', 'di_sanitize_twitter_handler' );
    register_setting( 'di-settings-group', 'facebook_handler' );
    register_setting( 'di-settings-group', 'gplus_handler' );

    add_settings_section( 'di-sidebar-options', 'Sidebar Options', 'di_sidebar_options', 'designers_image' );

    add_settings_field( 'sidebar-profile-image', 'Profile Image', 'di_sidebar_profile', 'designers_image', 'di-sidebar-options' );
    add_settings_field( 'sidebar-name', 'Full Name', 'di_sidebar_name', 'designers_image', 'di-sidebar-options' );
    add_settings_field( 'sidebar-description', 'Description', 'di_sidebar_description', 'designers_image', 'di-sidebar-options' );
    add_settings_field( 'sidebar-twitter', 'Twitter handler', 'di_sidebar_twitter', 'designers_image', 'di-sidebar-options' );
    add_settings_field( 'sidebar-facebook', 'Facebook handler', 'di_sidebar_facebook', 'designers_image', 'di-sidebar-options' );
    add_settings_field( 'sidebar-gplus', 'Google+ handler', 'di_sidebar_gplus', 'designers_image', 'di-sidebar-options' );
}

function di_sidebar_options() {
    echo 'Customize your Sidebar Information';
}

function di_sidebar_profile() {
    $profileImg = esc_attr( get_option( 'profile_image' ) );
    echo '<input type="button" class="button button-secondary" value="Choose Profile Image" id="upload-button" /><input type="hidden" id="profile-image" name="profile_image" value="'.$profileImg.'" />';
}

function di_sidebar_name() {
    $firstName = esc_attr( get_option( 'first_name' ) );
    $lastName = esc_attr( get_option( 'last_name' ) );
    echo '<input type="text" name="first_name" value="'.$firstName.'" placeholder="First Name" /> <input type="text" name="last_name" value="'.$lastName.'" placeholder="Last Name" />';
}

function di_sidebar_description() {
    $description = esc_attr( get_option( 'user_description' ) );
    echo '<input type="text" name="user_description" value="'.$description.'" placeholder="Description" /><p class="description">Write a company description.</p>';
}

function di_sidebar_twitter() {
    $twitter = esc_attr( get_option( 'twitter_handler' ) );
    echo '<input type="text" name="twitter_handler" value="'.$twitter.'" placeholder="Twitter handler" /><p class="description">Input your Twitter username without the @ character.</p>';
}
function di_sidebar_facebook() {
    $facebook = esc_attr( get_option( 'facebook_handler' ) );
    echo '<input type="text" name="facebook_handler" value="'.$facebook.'" placeholder="Facebook handler" />';
}
function di_sidebar_gplus() {
    $gplus = esc_attr( get_option( 'gplus_handler' ) );
    echo '<input type="text" name="gplus_handler" value="'.$gplus.'" placeholder="Google+ handler" />';
}


// Sanitization Settings
function di_sanitize_twitter_handler( $input ) {
    $output = sanitize_text_field( $input );
    $output = str_replace( '@', '', $output );
    return $output;
}


function di_theme_create_page() {
    
    // generation of our admin page
    require_once( get_template_directory() . '/inc/templates/di-admin.php' );

}

function di_theme_css_page() {
    // generation of our admin page
}









/*

2 - Dashbord
3 - Designer's Image
4 - Separator
5 - Posts
10 - Media
15 - Links
20 - Pages
25 - Comments
59 - Separator
60 - Appearnce
65 - Plugins
70 - Users
75 - Tools
80 - Settings
99 - Separator

*/