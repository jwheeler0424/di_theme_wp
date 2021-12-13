<?php
/**
 *  @package diPlugin
 *  ##################################################
 *  |   PLUGIN REGISTRATION FORM                     |
 *  ##################################################
*/
?>

<?php if ( $attr['show_title'] ): ?>
    <h2><?php _e( 'Register', 'di-plugin' ); ?></h2>
<?php endif; ?>

<form id="di-register-form" action="#" method="post" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
    <fieldset data-error="username">
        <label for="username"><?php _e( 'Username', 'di-plugin' ); ?></label>
        <input type="text" class="field-input" placeholder="NewUser_55" id="username" name="username" required>
        <small class="field-msg"><?php _e( 'A Username is Required', 'di-plugin' ); ?></small>
    </fieldset>

    <fieldset data-error="email">
        <label for="email"><?php _e( 'Email Address', 'di-plugin' ); ?></label>
        <input type="email" class="field-input" placeholder="yourname@website.com" id="email" name="email" required>
        <small class="field-msg"><?php _e( 'Your Email is Required', 'di-plugin' ); ?></small>
    </fieldset>

    <fieldset data-error="first">
        <label for="first"><?php _e( 'First Name', 'di-plugin' ); ?></label>
        <input type="text" class="field-input" placeholder="John" id="first" name="first" required>
        <small class="field-msg"><?php _e( 'Your First Name is Required', 'di-plugin' ); ?></small>
    </fieldset>

    <fieldset data-error="last">
        <label for="last"><?php _e( 'Last Name', 'di-plugin' ); ?></label>
        <input type="text" class="field-input" placeholder="Doe" id="last" name="last" required>
        <small class="field-msg"><?php _e( 'Your Last Name is Required', 'di-plugin' ); ?></small>
    </fieldset>

    <fieldset class="hint">
        <?php _e( 'Note: Your password will be generated automatically and sent to your email address.', 'di-plugin' ); ?>
    </fieldset>

    <fieldset class="recaptcha">
        <?php if ( $attr['reCAPTCHA'] ): ?>
            <div class="g-recaptcha" data-sitekey="<?php echo $attr['reCAPTCHA']; ?>"></div>
        <?php endif; ?>
    </fieldset>

    <fieldset>
        <button type="submit" name="submit" id="signup-button" class="btn btn-submit"><?php _e( 'Register', 'di-plugin' ); ?></button>
        <small class="field-msg js-form-submission"><?php _e( 'Submission in process, please wait...', 'di-plugin' ); ?></small>
    </fieldset>

    <input type="hidden" name="action" value="register">
    <?php wp_nonce_field( 'ajax-register-nonce', 'di_register' ) ?>
</form>

<div class="auth-links">
    <a class="link link-auth" href="<?php echo wp_login_url() ?>">
        <?php _e( 'Log In', 'di-plugin' ); ?>
    </a>
    &nbsp;&nbsp;|&nbsp;&nbsp;
    <a class="link link-auth" href="<?php echo wp_lostpassword_url(); ?>">
        <?php _e( 'Lost your password?', 'di-plugin' ); ?>
    </a>
</div>