<?php
/**
 * @package diPlugin
 *  ##################################################
 *  |   PLUGIN PORTFOLIO MANAGER CALLBACKS           |
 *  ##################################################
*/


namespace Plugin\Api\Callbacks;

use Plugin\Base\BaseController;

class PortfolioCallbacks extends BaseController
{
    public function shortcodePage()
    {
        return require_once( "$this->plugin_path/templates/portfolio.php" );
    }
}