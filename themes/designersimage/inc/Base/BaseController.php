<?php
/**
 *  @package diTheme
 *  ##################################################
 *  |   THEME BASE CONTROLLER                        |
 *  ##################################################
*/

namespace Theme\Base;

class BaseController
{
    public $theme_path;
    public $theme_url;

    public $managers = array();

    public function __construct()
    {
        $this->theme_path = get_template_directory( dirname( __FILE__, 2 ) );
        $this->theme_url = get_template_directory_uri( dirname( __FILE__, 2 ) );
        
        $this->managers = [
            'post_formats' => 'Post Formats',
            'custom_header' => 'Custom Header',
            'custom_background' => 'Custom Background',
            'widget_manager' => 'Widget Manager'
        ];
    }

    public function activated( string $key )
	{
		$theme = wp_get_theme();

		return $theme->name == 'Designer\'s Image';
	}
}