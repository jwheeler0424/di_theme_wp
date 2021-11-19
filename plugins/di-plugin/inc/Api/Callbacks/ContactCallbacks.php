<?php
/**
 * @package diPlugin
 *  ##################################################
 *  |   CONTACT CALLBACK FUNCTIONS                   |
 *  ##################################################
*/


namespace Plugin\Api\Callbacks;

use Plugin\Base\BaseController;

class ContactCallbacks extends BaseController
{
    public function shortcodePage()
    {
        return require_once( "$this->plugin_path/templates/contact.php" );
    }
}