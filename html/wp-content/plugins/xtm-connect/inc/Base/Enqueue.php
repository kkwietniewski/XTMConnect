<?php

/**
 * Include this file to use enqueue scripts
 * 
 * @package XTMConnect
 */

namespace Inc\Base;

class Enqueue extends BaseController
{

    public function register()
    {
        add_action('admin_enqueue_scripts',array( $this,'enqueue'));
    }

    function enqueue()
    {
        wp_enqueue_style('xtmpluginstyle',$this->pluginUrl . 'assets/xtm-style.css', __FILE__ );
        wp_enqueue_script('xtmpluginscripts',$this->pluginUrl .  'assets/xtm-scripts.js', __FILE__ );
    }
}