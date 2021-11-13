<?php
/**
 * @package diPlugin
*/


namespace Plugin\Api\Callbacks;

use Plugin\Base\BaseController;

class TestimonialCallbacks extends BaseController
{
    public function shortcodePage()
    {
        return require_once( "$this->plugin_path/templates/testimonial.php" );
    }
}