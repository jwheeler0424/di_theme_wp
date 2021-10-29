<?php
/**
 * @package diPlugin
*/

namespace PluginInc\Base;

use \PluginInc\Base\BaseController;
use \PluginInc\Api\Widgets\MediaWidget;

class WidgetController extends BaseController
{
    public function register()
    {

        if ( !$this->activated( 'widget_manager' ) ) return;

        $media_widget = new MediaWidget();
        $media_widget->register();

    }

    
}