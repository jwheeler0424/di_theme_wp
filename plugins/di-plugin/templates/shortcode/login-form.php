<?php
/**
 *  @package diPlugin
 *  ##################################################
 *  |   PLUGIN LOGIN FORM                            |
 *  ##################################################
*/
?>

<?php if ( $attr['show_title'] ): ?>
    <h2><?php _e( 'Sign In', 'di-plugin' ); ?></h2>
<?php endif; ?>

<?php 
    // Show errors if there are any
    if( $attr['errors'] && count( $attr['errors'] ) > 0 ): 
?>
    <?php foreach ( $attr['errors'] as $error ): ?>
        <p class="auth-error">
            <?php echo $error; ?>
        </p>
    <?php endforeach; ?>
<?php endif; ?>

<?php 
    // Show success message if the user just registered
    if( $attr['registered'] ):
?>
    <p class="auth-info">
        <?php
            _e( "You have successfully registered! We have emailed your password to the email address you provided.", 'di-plugin' );
        ?>
    </p>
<?php endif; ?>

<?php 
    // Show success message if the user has requested a password reset
    if( $attr['lost_password_sent'] ):
?>
    <p class="auth-info">
        <?php
            _e( 'Check your email for a link to reset your password.', 'di-plugin' );
        ?>
    </p>
<?php endif; ?>

<?php 
    // Show success message if the user has updated the password
    if( $attr['password_updated'] ):
?>
    <p class="auth-info">
        <?php
            _e( 'Your password has been changed. You can sign in now.', 'di-plugin' );
        ?>
    </p>
<?php endif; ?>

<?php 
    if ( $_GET['logged_out'] ):
    // Show logged out message if user just logged out
?>
    <p class="auth-info">
        <?php _e( 'You have been successfully signed out.', 'di-plugin' ) ?>
    </p>
<?php endif; ?>

<p class="auth-info">
    <?php _e( 'Use the form below to sign in to your user account. ', 'di-plugin' ) ?>
</p>

<form id="di-login-form" action="#" method="post" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
    <fieldset data-error="username">
        <label for="user_login"><?php _e( 'Username', 'di-plugin') ?></label>
        <input type="text" class="field-input" id="user_login" name="username" required>
        <small class="field-msg">You Must Provide a Username</small>
    </fieldset>
    <fieldset data-error="password">
        <label for="user_pass"><?php _e( 'Password', 'di-plugin') ?></label>
        <input type="password" class="field-input" id="user_pass" name="password" required>
        <small class="field-msg">You Must Provide a Password</small>
    </fieldset>
    <fieldset class="custom-checkbox">
        <input type="checkbox" name="remember" id="remember" value="1">
        <label for="remember">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30">
                <g>
                    <rect x="1.5" y="1.5" width="27" height="27" rx="2.5" fill="none" />
                </g>
                <path d="M6.5,10.8,0,4.3,2.1,2.2,6.5,6.5,13,0l2.1,2.1Z" transform="translate(7 10)" />
            </svg>
            <?php _e( 'Remember Me', 'di-plugin') ?>
        </label>
    </fieldset>
    <fieldset>
        <button type="submit" class="btn btn-submit" name="submit"><?php _e( 'Sign In', 'di-plugin') ?></button>
        <small class="field-msg js-form-submission"><?php _e( 'Submission in process, please wait...', 'di-plugin') ?></small>
    </fieldset>

    <input type="hidden" name="action" value="login">
    <?php wp_nonce_field( 'ajax-login-nonce', 'di_auth' ) ?>
</form>
<div class="auth-links">
    <a class="link link-auth" href="<?php echo wp_lostpassword_url(); ?>">
        <?php _e( 'Lost your password?', 'di-plugin' ); ?>
    </a>
    &nbsp;&nbsp;|&nbsp;&nbsp;
    <a class="link link-auth" href="<?php echo wp_registration_url() ?>">
        <?php _e( 'Register', 'di-plugin' ); ?>
    </a>
</div>