<?php
/*
    @package diPlugin
*/

class DesignersImagePluginDeactivate
{
    public static function deactivate() {
        flush_rewrite_rules();
    }
}