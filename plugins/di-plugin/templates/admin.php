<div class="wrap">
    <h1>di Plugin Dashboard</h1>
    <?php settings_errors(); ?>

    <form method="post" action="options.php">
        <?php 
            settings_fields( 'di_options_group' );
            do_settings_sections( 'di_plugin' );
            submit_button();
        ?>
    </form>
</div>

