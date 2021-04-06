<?php

/**
 * Include this file to use static method deactivate
 * 
 * @package XTMConnect
 */

namespace Inc\Base;

class Deactivate
{
    public static function deactivate()
    {
        flush_rewrite_rules();
    }
}