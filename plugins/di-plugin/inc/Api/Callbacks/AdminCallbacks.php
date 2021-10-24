<?php
/**
 * @package diPlugin
*/


namespace Inc\Api\Callbacks;

use \Inc\Base\BaseController;

class AdminCallbacks extends BaseController
{
    public function pluginDashboard()
    {
        return require_once( "$this->plugin_path/templates/admin.php" );
    }

    public function pluginCPT()
    {
        return require_once( "$this->plugin_path/templates/cpt.php" );
    }

    public function pluginTaxonomy()
    {
        return require_once( "$this->plugin_path/templates/taxonomies.php" );
    }

    public function pluginWidget()
    {
        return require_once( "$this->plugin_path/templates/widgets.php" );
    }

    public function diOptionsGroup( $input )
    {
        return $input;
    } 

    public function diAdminSection()
    {
        echo 'look here.';
    }

    public function diTextExample() 
    {
        $value = esc_attr( get_option( 'text_example' ) );
        echo '<input type="text" class="regular-text" name="text_example" value="'. $value .'" placeholder="Write something here!" >';
    }

    public function diFirstName() 
    {
        $value = esc_attr( get_option( 'first_name' ) );
        echo '<input type="text" class="regular-text" name="first_name" value="'. $value .'" placeholder="First name" >';
    }
}