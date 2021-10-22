<?php

/* 
    @package designersimage
    ========================================
    |   ADMIN PAGE                         |
    ========================================
*/

function di_add_admin_page() {

    // Generate DI Admin Page
    add_menu_page( "DI Theme Options", "Designer's Image", 'manage_options', 'designers_image', 'di_theme_create_page', get_template_directory_uri() . '/img/di_icon.png', 3 );

    // Generate DI Admin Sub Pages
    add_submenu_page( 'designers_image', 'DI Sidebar Options', 'Sidebar', 'manage_options', 'designers_image', 'di_theme_create_page' );
    add_submenu_page( 'designers_image', 'DI Theme Options', 'Theme Options', 'manage_options', 'designers_image_theme', 'di_theme_support_page' );
    add_submenu_page( 'designers_image', 'DI Contact Form', 'Contact Form', 'manage_options', 'designers_image_theme_contact', 'di_contact_form_page' );
    add_submenu_page( 'designers_image', 'DI CSS Options', 'Custom CSS', 'manage_options', 'designers_image_css', 'di_theme_css_page' );

    // Activate custom settings
    add_action( 'admin_init', 'di_custom_settings' );

}

add_action( 'admin_menu', 'di_add_admin_page' );

function di_custom_settings() {
    // Sidebar Options
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

    // Theme Support Options
    register_setting( 'di-theme-support' , 'post_formats' );
    register_setting( 'di-theme-support' , 'custom_header' );
    register_setting( 'di-theme-support' , 'custom_background' );

    add_settings_section( 'di-theme-options', 'Theme Options', 'di_theme_options', 'designers_image_theme' );

    add_settings_field( 'post-formats', 'Post Formats', 'di_post_formats', 'designers_image_theme', 'di-theme-options' );
    add_settings_field( 'custom-header', 'Custom Header', 'di_custom_header', 'designers_image_theme', 'di-theme-options' );
    add_settings_field( 'custom-background', 'Custom Background', 'di_custom_background', 'designers_image_theme', 'di-theme-options' );

    // Contact Form Options
    register_setting ( 'di-contact-options', 'activate_contact' );

    add_settings_section( 'di-contact-section', 'Contact Form', 'di_contact_section', 'designers_image_theme_contact' );

    add_settings_field( 'activate-form', 'Activate Contact Form', 'di_activate_contact', 'designers_image_theme_contact', 'di-contact-section' );

    // Custom CSS Options
    register_setting ( 'di-custom-css-options', 'di_css', 'di_sanitize_custom_css' );

    add_settings_section( 'di-custom-css-section', 'Custom CSS', 'di_custom_css_section_callback', 'di_theme_css_page' );

    add_settings_field( 'custom-css', 'Insert Custom CSS', 'di_custom_css_callback', 'di_theme_css_page', 'di-custom-css-section' );

}


function di_theme_options() {
    echo 'Activate and Deactivate specific Theme Support Options';
}

function di_contact_section() {
    echo 'Activate and Deactivate the Built-in Contact Form';
}

function di_activate_contact() {
    $options = get_option( 'activate_contact' );
    $checked = ( @$options == 1 ? 'checked' : '');
    echo '<label><input type="checkbox" id="activate_contact" name="activate_contact" value="1" '.$checked.' /></label><br />';
}

function di_custom_css_section_callback() {
    echo 'Customize Designer\'s Image Theme with your own CSS.';
}

function di_custom_css_callback() {
    $css = get_option( 'di_css' );
    $css = ( empty($css) ) ? "/* Designer's Image Custom CSS */" : $css;
    echo '<div id="customCss">'.$css.'</div><textarea id="di_css" name="di_css" style="display: none; visibility: hidden">'.$css.'</textarea>';
}

function di_post_formats() {
    $options = get_option( 'post_formats' );
    $formats = array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' );
    $output = '';

    foreach ( $formats as $format ) {
        $checked = ( @$options[$format] == 1 ? 'checked' : '');
        $output .= '<label><input type="checkbox" id="'.$format.'" name="post_formats['.$format.']" value="1" '.$checked.' />'.$format.'</label><br />';
    }

    echo $output;
}

function di_custom_header() {
    $options = get_option( 'custom_header' );
    $checked = ( @$options == 1 ? 'checked' : '');
    echo '<label><input type="checkbox" id="custom_header" name="custom_header" value="1" '.$checked.' /> Activate Custom Header</label><br />';
}

function di_custom_background() {
    $options = get_option( 'custom_background' );
    $checked = ( @$options == 1 ? 'checked' : '');
    echo '<label><input type="checkbox" id="custom_background" name="custom_background" value="1" '.$checked.' /> Activate Custom Background</label>';
}

// Sidebar Options Functions
function di_sidebar_options() {
    echo 'Customize your Sidebar Information';
}

function di_sidebar_profile() {
    $profileImg = esc_attr( get_option( 'profile_image' ) );
    if ( empty($profileImg) ) {
        echo '<input type="button" class="button button-secondary" value="Choose Profile Image" id="upload-button" /><input type="hidden" id="profile-image" name="profile_image" value="" />';
    } else {
        echo '<input type="button" class="button button-secondary" value="Choose Profile Image" id="upload-button" /><input type="hidden" id="profile-image" name="profile_image" value="'.$profileImg.'" /> <input type="button" class="button button-secondary" value="Remove" id="remove-image" />';
    }
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

function di_sanitize_custom_css( $input ) {
    $output = esc_textarea( $input );
    return $output;
}

// Template submenu functions
function di_theme_support_page() {
    require_once( get_template_directory() . '/inc/templates/di-theme-support.php' );
}

function di_theme_create_page() {   
    // generation of our admin page
    require_once( get_template_directory() . '/inc/templates/di-admin.php' );
}

function di_contact_form_page() {
    require_once( get_template_directory() . '/inc/templates/di-contact-form.php' );
}

function di_theme_css_page() {
    // generation of our admin custom css page
    require_once( get_template_directory() . '/inc/templates/di-custom-css.php' );
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