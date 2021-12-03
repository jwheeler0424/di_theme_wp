<?php
/**
 *  @package diPlugin
 *  ##################################################
 *  |   PLUGIN GUTENBURG BLOCK CONTROLLER            |
 *  ##################################################
*/

namespace Plugin\Base;

use Plugin\Base\BaseController;

class GutenburgController extends BaseController
{
    public function register()
    {
        // Set the default colors for Gutenburg Blocks
        add_action( 'init', array( $this, 'gutenburg_default_colors' ) );

        // Register the Gutenburg Blocks
        add_action( 'init', array( $this, 'gutenburg_blocks' ) );

    }

    public function gutenburg_blocks()
    {
        wp_register_script( 'custom-faq-js', $this->plugin_url . 'assets/di-gutenburg-blocks.min.js', array( 'wp-i18n', 'wp-blocks', 'wp-block-editor' ) );
        register_block_type( 'designersimage/definition-list', array(
            'editor_script' => 'custom-faq-js'
        ) );
    }

    public function gutenburg_default_colors()
    {
        add_theme_support(
            'editor-color-palette',
            [
                [
                    'name' => 'di Primary',
                    'slug' => 'primary',
                    'color' => '#6579b2'
                ],
                [
                    'name' => 'di Secondary',
                    'slug' => 'secondary',
                    'color' => '#8397cb'
                ],
                [
                    'name' => 'di Tertiary',
                    'slug' => 'tertiary',
                    'color' => '#7a88af'
                ],
                [
                    'name' => 'di Light',
                    'slug' => 'light',
                    'color' => '#a7b6de'
                ],
                [
                    'name' => 'di Dark',
                    'slug' => 'dark',
                    'color' => '#575b78'
                ],
                [
                    'name' => 'di Mix',
                    'slug' => 'mix',
                    'color' => '#657dbe'
                ],
                [
                    'name' => 'di Placeholder',
                    'slug' => 'placeholder',
                    'color' => '#a0a0a0'
                ],
                [
                    'name' => 'di Grey',
                    'slug' => 'grey',
                    'color' => '#999999'
                ],
                [
                    'name' => 'di Grey - Dark',
                    'slug' => 'grey-dark',
                    'color' => '#666666'
                ],
                [
                    'name' => 'di Grey - Light',
                    'slug' => 'grey-light',
                    'color' => '#e6e7e8'
                ],
                [
                    'name' => 'di Grey - Medium',
                    'slug' => 'grey-medium',
                    'color' => '#c5c7c9'
                ],
                [
                    'name' => 'di Red',
                    'slug' => 'red',
                    'color' => '#ac3c3d'
                ],
                [
                    'name' => 'di Blue',
                    'slug' => 'blue',
                    'color' => '#3f589f'
                ],
                [
                    'name' => 'di Green',
                    'slug' => 'green',
                    'color' => '#66ab3c'
                ],
                [
                    'name' => 'di Yellow',
                    'slug' => 'yellow',
                    'color' => '#f7bb17'
                ],
                [
                    'name' => 'di White',
                    'slug' => 'white',
                    'color' => '#f5f5f6'
                ]
            ]
        );
    }

}