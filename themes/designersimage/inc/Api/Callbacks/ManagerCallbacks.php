<?php
/**
 * @package diTheme
*/


namespace ThemeInc\Api\Callbacks;

use \ThemeInc\Base\BaseController;

class ManagerCallbacks extends BaseController
{
    public function themeSanitize( $input )
    {
        $output = get_option( 'di_theme_option' );
        
        if ( count($output) == 0 ) {
            $output = $input;

            return $output;
        }
        
        foreach ($output as $key => $value) {
            if ( $input === $key ) {
                $output[$key] = $input;
            } else {
                $output = $input;
            }
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

        $checkbox = get_option( $option_name );
        $checked = isset( $checkbox[$name] ) ?: false;
        
        echo '<div class="'. $classes .'"><input type="checkbox" id="'. $name .'" name="'. $option_name .'['. $name .']" value="1" class="'. $classes .'"'. ( $checked ? 'checked' : '') .'><label for="'. $name .'"><div></div></label></div>';
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

            $checked = isset( $checkbox[$name][$format] ) ?: false;

            $output .= '<div class="'. $classes .' mb-10"><input type="checkbox" id="'. $format .'" name="'. $option_name .'['. $name .']['. $format .']" value="1" class="'. $classes .'"'. ( $checked ? 'checked' : '') .'><label for="'. $format .'"><div></div></label> <strong>'. $format .'</strong></div>';
        }

        echo $output;
    }
}