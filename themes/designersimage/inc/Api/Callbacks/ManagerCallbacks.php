<?php
/**
 * @package diTheme
*/


namespace ThemeInc\Api\Callbacks;

use \ThemeInc\Base\BaseController;

class ManagerCallbacks extends BaseController
{
    public function checkboxSanitize( $input )
    {
        $output = array();
        
        foreach ( $this->managers as $key => $value ) {
            $output[$key] =  isset($input[$key]) ? true : false;
        }

        return $output;
    } 

    public function adminSectionManager()
    {
        echo 'Manage the Sections and Features of this Theme by activating the checkboxes from the following list.';
    }

    
    public function checkboxField( $args )
    {
        $name = $args['label_for'];
        $classes = $args['class'];
        $option_name = $args['option_name'];

        $checked = false;
        

        // if ( isset($_POST["edit_taxonomy"]) ) {
        //     $checkbox = get_option( $option_name );
        //     $checked = isset( $checkbox[$_POST["edit_taxonomy"]][$name] ) ?: false;
        // }
        
        echo '<div class="'. $classes .'"><input type="checkbox" id="'. $name .'" name="'. $option_name .'['. $name .']" vale="1" class="'. $classes .'"'. ( $checked ? 'checked' : '') .'><label for="'. $name .'"><div></div></label></div>';
    }

    public function checkboxPostFormatsField( $args )
    {
        $output = '';
        $name = $args['label_for'];
        $classes = $args['class'];
        $option_name = $args['option_name'];

        $checked = false;
        

        $checkbox = get_option( $option_name );
        
        $formats = array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' );

        foreach ($formats as $format) {

            if ( isset($_POST["edit_taxonomy"]) ) {
                $checked = isset( $checkbox[$_POST["edit_taxonomy"]][$name][$format] ) ?: false;
            }

            $output .= '<div class="'. $classes .' mb-10"><input type="checkbox" id="'. $format .'" name="'. $option_name .'['. $name .']['. $format .']" vale="1" class="'. $classes .'"'. ( $checked ? 'checked' : '') .'><label for="'. $format .'"><div></div></label> <strong>'. $format .'</strong></div>';
        }

        echo $output;
    }
}