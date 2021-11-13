<?php
/**
 * @package diPlugin
*/

namespace Plugin\Base;

class Deactivate
{
    public static function deactivate() {
        flush_rewrite_rules();
    }
}