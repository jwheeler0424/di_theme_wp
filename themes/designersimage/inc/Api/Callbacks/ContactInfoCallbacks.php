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

    public function emailField( $args )
    {
        $name = $args['label_for'];
        $required = $args['required'] ? 'required' : '';

        $option_name = $args['option_name'];
        $input = get_option( $option_name );

        $value = $input[ $name ] ?: '';

        echo '<input type="email" class="regular-text" id="'. $name .'" name="'. $option_name .'['. $name .']" value="'. $value .'" placeholder="'. $args['placeholder'] .'" '. $required .' />';
    }

    public function phoneField( $args )
    {
        $name = $args['label_for'];
        $required = $args['required'] ? 'required' : '';

        $option_name = $args['option_name'];
        $input = get_option( $option_name );

        $value = $input[ $name ] ? '(' . substr($input[ $name ], 0, 3) . ') ' . substr($input[ $name ], 3, 3) . '-' . substr($input[ $name ], 6) : '';

        echo '<input type="tel" class="regular-text" id="'. $name .'" name="'. $option_name .'['. $name .']" value="'. $value .'" placeholder="'. $args['placeholder'] .'" '. $required .' />';
    }

    public function textField( $args )
    {
        $name = $args['label_for'];
        $required = $args['required'] ? 'required' : '';

        $option_name = $args['option_name'];
        $input = get_option( $option_name );

        $value = $input[ $name ] ?: '';

        echo '<input type="text" class="regular-text" id="'. $name .'" name="'. $option_name .'['. $name .']" value="'. $value .'" placeholder="'. $args['placeholder'] .'" '. $required .' />';
    }

    public function urlField( $args )
    {
        $name = $args['label_for'];
        $required = $args['required'] ? 'required' : '';

        $option_name = $args['option_name'];
        $input = get_option( $option_name );

        $value = $input[ $name ] ?: '';

        echo '<input type="url" class="regular-text" id="'. $name .'" name="'. $option_name .'['. $name .']" value="'. $value .'" placeholder="'. $args['placeholder'] .'" '. $required .' />';
    }

}