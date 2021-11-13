<?php
/**
 * @package diPlugin
*/

namespace Plugin\Base;

use Plugin\Base\BaseController;
use Plugin\Api\Widgets\MediaWidget;

class WidgetController extends BaseController
{
    public function register()
    {

        if ( !$this->activated( 'widget_manager' ) ) return;

        $media_widget = new MediaWidget();
        $media_widget->register();

    }

    
}