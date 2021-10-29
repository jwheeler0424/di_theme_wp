<?php
/**
 * @package diPlugin
*/


namespace Inc\Api\Callbacks;

use \Inc\Base\BaseController;

class ContactCallbacks extends BaseController
{
    public function shortcodePage()
    {
        return require_once( "$this->plugin_path/templates/contact.php" );
    }
}