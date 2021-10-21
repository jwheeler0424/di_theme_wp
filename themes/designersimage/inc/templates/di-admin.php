<h1>Designer's Image Sidebar Options</h1>
<?php settings_errors() ?>
<?php
    $picture = esc_attr( get_option( 'profile_image' ) );
    $firstName = esc_attr( get_option( 'first_name' ) );
    $lastName = esc_attr( get_option( 'last_name' ) );
    $fullname = $firstName . ' ' . $lastName;
    $description = esc_attr( get_option( 'user_description' ) );
?>

<div class="di-sidebar-preview">
    <div class="di-sidebar">
        <div class="image-container">
            <div id="profile-image-preview" class="profile-image" style="background-image: url(<?php print $picture ?>)"></div>
        </div>
        <h1 class="di-username"><?php print $fullname; ?></h1>
        <h2 class="di-description"><?php print $description; ?></h2>
        <div class="icons-wrapper"><?php ?></div>
    </div>
</div>

<form method="post" action="options.php" class="di-general-form">
    <?php settings_fields( 'di-settings-group' ); ?>
    <?php do_settings_sections( 'designers_image' ); ?>
    <?php submit_button( 'Save Changes', 'primary', 'btnSubmit' ); ?>
</form>