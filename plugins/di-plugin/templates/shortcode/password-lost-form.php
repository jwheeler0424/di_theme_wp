<?php
/**
 *  @package diPlugin
 *  ##################################################
 *  |   PLUGIN PASSWORD LOST FORM                    |
 *  ##################################################
*/
?>

<?php if ( $attr['show_title'] ): ?>
    <h2><?php _e( 'Forgot Your Password?', 'di-plugin' ); ?></h2>
<?php endif; ?>

<form id="di-lost-password-form" action="#" method="post" data-url="<?php echo admin_url('admin-ajax.php'); ?>">

    <?php 
        // Show errors if there are any
        if( $attr['errors'] && count( $attr['errors'] ) > 0 ): 
    ?>
        <?php foreach ( $attr['errors'] as $error ): ?>
            <p class="auth-info error">
                <?php echo $error; ?>
            </p>
        <?php endforeach; ?>
    <?php endif; ?>

    <p class="auth-info">
        <?php
            _e(
                "Enter your email address and we'll send you a link you can use to pick a new password.",
                'di-plugin'
            );
        ?>
    </p>

    <fieldset data-error="email">
        <label for="email"><?php _e( 'Email Address', 'di-plugin' ); ?></label>
        <input type="email" class="field-input" placeholder="yourname@website.com" id="email" name="email" required>
        <small class="field-msg"><?php _e( 'Your Email is Required', 'di-plugin' ); ?></small>
    </fieldset>

    <fieldset>
        <button type="submit" name="submit" id="lost-password-button" class="btn btn-submit"><?php _e( 'Reset Password', 'di-plugin' ); ?></button>
        <small class="field-msg js-form-submission"><?php _e( 'Submission in process, please wait...', 'di-plugin' ); ?></small>
    </fieldset>

    <input type="hidden" name="action" value="lost_password">
    <?php wp_nonce_field( 'ajax-lost-password-nonce', 'di_lost_password' ) ?>
</form>

<div class="auth-links">
    <a class="link link-auth" href="<?php echo wp_login_url() ?>">
        <?php _e( 'Log In', 'di-plugin' ); ?>
    </a>
    &nbsp;&nbsp;|&nbsp;&nbsp;
    <a class="link link-auth" href="<?php echo wp_registration_url() ?>">
        <?php _e( 'Register', 'di-plugin' ); ?>
    </a>
</div>