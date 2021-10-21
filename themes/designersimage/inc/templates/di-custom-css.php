<h1>Designer's Image Custom CSS</h1>
<?php settings_errors() ?>
<?php

    // $picture = esc_attr( get_option( 'profile_image' ) );

?>

<form id="save-custom-css-form" method="post" action="options.php" class="di-general-form">
    <?php settings_fields( 'di-custom-css-options' ) ?>
    <?php do_settings_sections( 'di_theme_css_page' ) ?>
    <?php submit_button() ?>
</form>