<?php
/**
 *  @package diTheme
 *  ##################################################
 *  |   THEME ADMIN PAGE                             |
 *  ##################################################
*/
?><div class="wrap">
    <h1>di Theme Options</h1>
    <?php settings_errors() ?>
    <?php

        // $picture = esc_attr( get_option( 'profile_image' ) );

    ?>

    <form method="post" action="options.php" class="di-general-form">
        <?php settings_fields( 'di_theme_settings' ) ?>
        <?php do_settings_sections( 'di_theme' ) ?>
        <?php submit_button() ?>
    </form>
</div>