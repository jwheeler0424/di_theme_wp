<?php
/**
 *  @package diPlugin
 *  ##################################################
 *  |   PLUGIN PASSWORD RESET FORM                   |
 *  ##################################################
*/
?>

<?php if ( $attr['show_title'] ): ?>
    <h2><?php _e( 'Pick a New Password?', 'di-plugin' ); ?></h2>
<?php endif; ?>

<form id="di-reset-password-form" action="#" method="post" data-url="<?php echo admin_url('admin-ajax.php'); ?>" autocomplete="off">
    <fieldset data-error="pass1">
        <label for="pass1"><?php _e( 'New Password', 'di-plugin' ); ?></label>
        <input type="password" class="field-input" id="pass1" name="pass1" value="" autocomplete="off" required />
        <?php get_template_part( 'img/svg/icon', 'bad.svg' ); ?>
        <?php get_template_part( 'img/svg/icon', 'weak.svg' ); ?>
        <?php get_template_part( 'img/svg/icon', 'warning.svg' ); ?>
        <?php get_template_part( 'img/svg/icon', 'strong.svg' ); ?>
        <button type="button" class="visible">
            <?php get_template_part( 'img/svg/icon', 'visible.svg' ); ?>
            <?php get_template_part( 'img/svg/icon', 'non_visible.svg' ); ?>
        </button>
        <small class="field-msg"><?php _e( 'A New Password is Required', 'di-plugin' ); ?></small>
    </fieldset>

    <fieldset data-error="pass2">
        <label for="pass2"><?php _e( 'Confirm Password', 'di-plugin' ); ?></label>
        <input type="password" class="field-input" id="pass2" name="pass2" value="" autocomplete="off" required />
        <?php get_template_part( 'img/svg/icon', 'bad.svg' ); ?>
        <?php get_template_part( 'img/svg/icon', 'weak.svg' ); ?>
        <?php get_template_part( 'img/svg/icon', 'warning.svg' ); ?>
        <?php get_template_part( 'img/svg/icon', 'strong.svg' ); ?>
        <small class="field-msg"><?php _e( 'Your Password Must Match', 'di-plugin' ); ?></small>
    </fieldset>

    <div id="password-strength"></div>

    <fieldset class="hint">
        <?php echo wp_get_password_hint(); ?>
    </fieldset>

    <fieldset>
        <button type="submit" name="submit" id="resetpass-button" class="btn btn-submit"><?php _e( 'Reset Password', 'di-plugin' ); ?></button>
        <small class="field-msg js-form-submission"><?php _e( 'Submission in process, please wait...', 'di-plugin' ); ?></small>
    </fieldset>

    <input type="hidden" id="user_login" name="rp_login" value="<?php echo esc_attr( $attr['login'] ) ?>" autocomplete="off" />
    <input type="hidden" name="rp_key" value="<?php echo esc_attr( $attr['key'] ) ?>" />
    <input type="hidden" name="action" value="reset_password" />
    <?php wp_nonce_field( 'ajax-reset-password-nonce', 'di_reset_password' ) ?>
</form>