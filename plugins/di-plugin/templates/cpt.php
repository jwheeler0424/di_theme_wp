<div class="wrap">
    <h1>Custom Post Type Manager</h1>
    <?php settings_errors(); ?>

    
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab-1" id="tab-1">Custom Post Types</a></li>
        <li><a href="#tab-2" id="tab-2">Add Custom Post Type</a></li>
        <li><a href="#tab-3" id="tab-3">Export</a></li>
    </ul>

    <div class="tab-content">
        <div id="tab-1" class="tab-pane active">
            <h3>Manage your Custom Post Types</h3>
            <?php
                $options = get_option( 'di_plugin_cpt' ) ?: array();

                echo '<table class="cpt-table"><tr><th>ID</th><th>Singular Name</th><th>Plural Name</th><th class="text-center">Public</th><th class="text-center">Archive</th><th class="text-center">Actions</th></tr>';

				foreach ($options as $option) {
                    $public = isset($option['public']) ? "TRUE" : "FALSE";
                    $archive = isset($option['has_archive']) ? "TRUE" : "FALSE";
					echo "<tr><td>{$option['post_type']}</td><td>{$option['singular_name']}</td><td>{$option['plural_name']}</td><td class=\"text-center\">{$public}</td><td class=\"text-center\">{$archive}</td><td class=\"text-center\"><a href=\"#\">EDIT</a> - <a href=\"#\">DELETE</a></td></tr>";
				}

				echo '</table>';
            ?>
        </div>

        <div id="tab-2" class="tab-pane">
            <h3>Create a new Custom Post Type</h3>
            <form method="post" action="options.php">
                <?php 
                    settings_fields( 'di_plugin_cpt_settings' );
                    do_settings_sections( 'di_cpt' );
                    submit_button();
                ?>
            </form>
        </div>
        <div id="tab-3" class="tab-pane">
            <h3>About</h3>
        </div>
    </div>
</div>