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

    <p class="auth-info"></p>

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
        <fieldset>
            <input type="checkbox" name="remember" id="remember" value="1"> Remember Me
        </fieldset>
        <fieldset>
            <button type="submit" class="btn btn-submit" name="submit"><?php _e( 'Sign In', 'di-plugin') ?></button>
            <small class="field-msg js-form-submission"><?php _e( 'Submission in process, please wait...', 'di-plugin') ?></small>
        </fieldset>

        <input type="hidden" name="action" value="login">
        <?php wp_nonce_field( 'ajax-login-nonce', 'di_auth' ) ?>
    </form>

    <a class="link" href="<?php echo wp_lostpassword_url(); ?>">
        <?php _e( 'Lost your password?', 'di-plugin' ); ?>
    </a>
     | 
    <a class="link" href="<?php echo wp_registration_url() ?>">
        <?php _e( 'Register', 'di-plugin' ); ?>
    </a>

</div>