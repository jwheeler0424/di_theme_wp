<?php
/**
 *  @package diPlugin
 *  ##################################################
 *  |   PLUGIN PASSWORD LOST FORM                    |
 *  ##################################################
*/
?>

<div id="register-form" class="widecolumn">
    <?php if ( $attr['show_title'] ): ?>
        <h2><?php _e( 'Forgot Your Password?', 'di-plugin' ); ?></h2>
    <?php endif; ?>

    <p class="auth-info"></p>

    <p>
        <?php
            _e(
                "Enter your email address and we'll send you a link you can use to pick a new password.",
                'di-plugin'
            );
        ?>
    </p>

    <form id="di-lost-password-form" action="#" method="post" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
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

    <a class="link" href="<?php echo wp_login_url() ?>">
        <?php _e( 'Log In', 'di-plugin' ); ?>
    </a>
     | 
    <a class="link" href="<?php echo wp_registration_url() ?>">
        <?php _e( 'Register', 'di-plugin' ); ?>
    </a>
</div>