<?php
/**
 *  @package diPlugin
 *  ##################################################
 *  |   PLUGIN TAXONOMIES MANAGER PAGE               |
 *  ##################################################
*/
?>


<div class="wrap">
    <h1>Taxonomies Manager</h1>
    <?php settings_errors(); ?>

    
    <ul class="nav nav-tabs">
        <li class="<?php echo !isset($_POST["edit_taxonomy"]) ? 'active' : '' ?>"><a href="#tab-1" id="tab-1">Taxonomies</a></li>
        <li class="<?php echo isset($_POST["edit_taxonomy"]) ? 'active' : '' ?>">
            <a href="#tab-2" id="tab-2">
            <?php echo isset($_POST["edit_taxonomy"]) ? 'Edit' : 'Add' ?> Taxonomy
            </a>
        </li>
    </ul>

    <div class="tab-content">
        <div id="tab-1" class="tab-pane <?php echo !isset($_POST["edit_taxonomy"]) ? 'active' : '' ?>">
            <h3>Manage your Custom Taxonomies</h3>
            <?php
                $options = get_option( 'di_plugin_tax' ) ?: array();

                echo '<table class="tax-table"><tr><th>ID</th><th>Singular Name</th><th class="text-center">Heirarchical</th><th class="text-center">Actions</th></tr>';

				foreach ($options as $option) {
                    $hierarchical = isset($option['hierarchical']) ? "TRUE" : "FALSE";
                
				 	echo "<tr><td>{$option['taxonomy']}</td><td>{$option['singular_name']}</td><td class=\"text-center\">{$hierarchical}</td><td class=\"text-center\">";
                    
                    echo '<form method="post" action="" class="inline-block">';

                    echo '<input type="hidden" name="edit_taxonomy" value="'. $option['taxonomy'] .'">';
                    submit_button( 'Edit', 'primary small', 'submit', false );

                    echo '</form> ';

                    echo '<form method="post" action="options.php" class="inline-block">';

                    settings_fields( 'di_plugin_tax_settings' );
                    submit_button( 'Delete', 'delete small', 'submit', false, array(
                        'onclick' => 'return confirm("Are you sure you want to delete this Custom Taxonomy? The data associated with it will not be deleted.");' 
                    ) );
                    echo '<input type="hidden" name="remove" value="'. $option['taxonomy'] .'">';
                    echo '</form></td></tr>';
				}

				echo '</table>';
            ?>
        </div>

        <div id="tab-2" class="tab-pane <?php echo isset($_POST["edit_taxonomy"]) ? 'active' : '' ?>">
            <form method="post" action="options.php">
                <?php 
                    settings_fields( 'di_plugin_tax_settings' );
                    do_settings_sections( 'di_taxonomy' );
                    submit_button();
                ?>
            </form>
        </div>
    </div>
</div>