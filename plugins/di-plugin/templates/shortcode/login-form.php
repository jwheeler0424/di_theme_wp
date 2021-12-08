<?php
/**
 *  @package diPlugin
 *  ##################################################
 *  |   PLUGIN LOGIN FORM                            |
 *  ##################################################
*/
?>

<div class="login-form-container">
    <?php if ( $attr['show_title'] ): ?>
        <h2><?php _e( 'Sign In', 'di-plugin' ); ?></h2>
    <?php endif; ?>

    <!-- Show errors if there are any -->
    <?php if( count( $attr['errors'] ) > 0 ): ?>
        <?php foreach ( $attr['errors'] as $error ): ?>
            <p class="login-error">
                <?php echo $error; ?>
            </p>
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- Show logged out message if user just logged out -->
    <?php if ( $attr['logged_out'] ): ?>
        <p class="login-info">
            <?php _e( 'You have been successfully signed out.', 'di-plugin' ) ?>
        </p>
    <?php endif; ?>

    <?php
        wp_login_form(
            [
                'label_username'    => __( 'Username', 'di-plugin' ),
                'label_log_in'      => __( 'Sign In', 'di-plugin' ),
                'redirect'          => $attr['redirect']
            ]
        );
    ?>

    <a class="forgot-password" href="<?php echo wp_lostpassword_url(); ?>">
        <?php _e( 'Lost your password?', 'di-plugin' ); ?>
    </a>
</div>