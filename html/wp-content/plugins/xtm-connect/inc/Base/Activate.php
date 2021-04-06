<?php

/**
 * Include this file to use static method activate
 * 
 * @package XTMConnect
 */

namespace Inc\Base;

class Activate
{
    public static function activate()
    {
        flush_rewrite_rules();
    }
}