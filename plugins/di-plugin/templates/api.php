<?php
/**
 *  @package diPlugin
 *  ##################################################
 *  |   PLUGIN API KEYS INFORMATION PAGE             |
 *  ##################################################
*/
?>

<div class="wrap">
    <h1>API Keys Manager</h1>
    <?php settings_errors() ?>
    
    <ul class="nav nav-tabs">
        <li class="<?php echo !isset($_POST["edit_post"]) ? 'active' : '' ?>"><a href="#tab-1" id="tab-1">API Keys</a></li>
        <li class="<?php echo isset($_POST["edit_post"]) ? 'active' : '' ?>">
            <a href="#tab-2" id="tab-2">
            <?php echo isset($_POST["edit_post"]) ? 'Edit' : 'Add' ?> API Key
            </a>
        </li>
        <!-- <li><a href="#tab-3" id="tab-3">Export</a></li> -->
    </ul>

    <div class="tab-content">
        <div id="tab-1" class="tab-pane <?php echo !isset($_POST["edit_post"]) ? 'active' : '' ?>">
            <h3>Manage your API Keys</h3>
            <?php
                $options = get_option( 'di_plugin_api' ) ?: array();

                echo '<table class="cpt-table"><tr><th>API Type</th><th>Site Key</th><th>Secret Key</th><th class="text-center">Actions</th></tr>';

				foreach ($options as $option) {
                    
                    echo "<tr><td>{$option['key_type']}</td><td>{$option['site_key']}</td><td>{$option['secret_key']}</td><td class=\"text-center\">";
                    
                    echo '<form method="post" action="" class="inline-block">';

                    echo '<input type="hidden" name="edit_post" value="'. $option['key_type'] .'">';
                    submit_button( 'Edit', 'primary small', 'submit', false );

                    echo '</form> ';

                    echo '<form method="post" action="options.php" class="inline-block">';

                    settings_fields( 'di_plugin_api_settings' );
                    submit_button( 'Delete', 'delete small', 'submit', false, array(
                        'onclick' => 'return confirm("Are you sure you want to delete this API Key? The data associated with it will not be deleted.");'
                    ) );
                    echo '<input type="hidden" name="remove" value="'. $option['key_type'] .'">';
                    echo '</form></td></tr>';
				}

				echo '</table>';
            ?>
        </div>

        <div id="tab-2" class="tab-pane <?php echo isset($_POST["edit_post"]) ? 'active' : '' ?>">
            <form method="post" action="options.php">
                <?php 
                    settings_fields( 'di_plugin_api_settings' );
                    do_settings_sections( 'di_api' );
                    submit_button();
                ?>
            </form>
        </div>
        <!-- <div id="tab-3" class="tab-pane">
            <h3>About</h3>
        </div> -->
    </div>
</div>