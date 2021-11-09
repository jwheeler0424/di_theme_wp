<?php
/**
 *  @package diTheme
 *  ##################################################
 *  |   THEME ADMIN API CALLBACKS                    |
 *  ##################################################
*/

namespace ThemeInc\Api\Callbacks;

use \ThemeInc\Base\BaseController;

class AdminCallbacks extends BaseController
{
    public function adminDashboard()
	{
        return require_once( "$this->theme_path/templates/admin.php" );
	}

    public function adminContactInfo()
	{
		return require_once( "$this->theme_path/templates/contact-info.php" );
	}
}