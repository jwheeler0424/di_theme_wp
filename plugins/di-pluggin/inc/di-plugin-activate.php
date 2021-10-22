<?php
/*
    @package diPlugin
*/

class DesignersImagePluginActivate
{
    public static function activate() {
        flush_rewrite_rules();
    }
}