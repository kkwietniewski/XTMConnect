<?php

/**
 * This file create settings links
 * 
 * @package XTMConnect
 */

namespace Inc\Base;

class SettingsLinks
{
    
    public function register()
    {
        add_filter("plugin_action_links_".PLUGIN, array($this, 'settings_link'));
    }

    public function settings_link( $links ) 
    {
        $settings_link = '<a href="edit.php?post_type=xtm_post">Settings</a>';
        array_push( $links, $settings_link );
        return $links;
    }
}