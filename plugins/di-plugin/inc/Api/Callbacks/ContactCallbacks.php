<?php
/**
 * @package diPlugin
*/


namespace PluginInc\Api\Callbacks;

use \PluginInc\Base\BaseController;

class ContactCallbacks extends BaseController
{
    public function shortcodePage()
    {
        return require_once( "$this->plugin_path/templates/contact.php" );
    }
}