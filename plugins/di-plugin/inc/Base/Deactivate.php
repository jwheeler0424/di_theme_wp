<?php
/**
 * @package diPlugin
*/

namespace PluginInc\Base;

class Deactivate
{
    public static function deactivate() {
        flush_rewrite_rules();
    }
}