<?php
/**
 * @package diTheme
*/


namespace ThemeInc\Api\Callbacks;

use \ThemeInc\Base\BaseController;

class AdminCallbacks extends BaseController
{
    public function adminDashboard()
	{
        return require_once( "$this->theme_path/templates/admin.php" );
	}
}