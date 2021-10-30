<h1>Designer's Image Contact Form</h1>
<?php settings_errors() ?>
<?php

    // $picture = esc_attr( get_option( 'profile_image' ) );

?>

<form method="post" action="options.php" class="di-general-form">
    <?php settings_fields( 'di-contact-options' ) ?>
    <?php do_settings_sections( 'designers_image_theme_contact' ) ?>
    <?php submit_button() ?>
</form>