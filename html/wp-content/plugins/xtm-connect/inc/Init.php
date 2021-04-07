<?php

/**
 * This file initialize all methods
 * 
 * @package XTMConnect
 */

namespace Inc;

final class Init
{
    
    public static function get_services()
    {
        return[
            Base\TranslationsDB::class,
            Pages\Translation::class,
            Base\SettingsLinks::class,
            Base\ColumnStatus::class,
            Base\Enqueue::class,
            Base\BulkAction::class
        ];
    }

    public static function register_services()
    {
        foreach ( self::get_services() as $class) {
            $service = self::instantiate($class);
            if(method_exists($service, 'register')){
                $service->register();
            }

        }
    }

    private static function instantiate($class )
    {
        $service = new $class();
        return $service;
    }
}