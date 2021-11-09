<?php
/**
 *  @package diTheme
 *  ##################################################
 *  |   THEME CONTACT INFORMATION PAGE               |
 *  ##################################################
*/
?><div class="wrap">
    <h1>di Theme Contact Information</h1>
    <?php settings_errors() ?>
    <?php

        // $picture = esc_attr( get_option( 'profile_image' ) );
        
    ?>

    <form method="post" action="options.php" class="di-general-form" id="admin-contact-info">
        <?php settings_fields( 'di_theme_ci_settings' ) ?>
        <?php do_settings_sections( 'di_ci' ) ?>
        <?php submit_button() ?>
    </form>
</div>