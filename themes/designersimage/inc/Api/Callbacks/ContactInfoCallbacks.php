<?php
/**
 *  @package diTheme
 *  ##################################################
 *  |   THEME CONTACT INFORMATION CALLBACKS          |
 *  ##################################################
*/

namespace ThemeInc\Api\Callbacks;

class ContactInfoCallbacks
{
    public function ciSectionManager()
    {
        echo 'Manage your Contact Information and Social Media links.';
    }

    public function ciSanitize( $input )
    {
        $output = get_option( 'di_theme_ci' );

        if ( isset($_POST["remove"]) ) {
            unset($output[$_POST["remove"]]);

            return $output;
        }

        if ( count($output) == 0 ) {
            $output[$input['contact_info']] = $input;

            return $output;
        }
        
        foreach ($output as $key => $value) {
            if ( $input['contact_info'] === $key ) {
                $output[$key] = $input;
            } else {
                $output[$input['contact_info']] = $input;
            }
        }
        
        return $output;
    }

    public function textField( $args )
    {
        $name = $args['label_for'];

        $option_name = $args['option_name'];

        $value = '';
        
        // if ( isset($_POST["edit_post"]) ) {
        //     $input = get_option( $option_name );
        //     $value = $input[ $_POST["edit_post" ]][ $name ];
        // }

        echo '<input type="text" class="regular-text" id="'. $name .'" name="'. $option_name .'['. $name .']" value="'. $value .'" placeholder="'. $args['placeholder'] .'" required />';
    }

}