<h1>Designer's Image Theme Support</h1>
<?php settings_errors() ?>
<?php

    // $picture = esc_attr( get_option( 'profile_image' ) );

?>

<form method="post" action="options.php" class="di-general-form">
    <?php settings_fields( 'di-theme-support' ) ?>
    <?php do_settings_sections( 'designers_image_theme' ) ?>
    <?php submit_button() ?>
</form>