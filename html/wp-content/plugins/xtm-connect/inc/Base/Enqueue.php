<?php

/**
 * Include this file to use enqueue scripts
 * 
 * @package XTMConnect
 */

namespace Inc\Base;

class Enqueue
{

    public function register()
    {
        add_action('admin_enqueue_scripts',array( $this,'enqueue'));
    }

    function enqueue()
    {
        wp_enqueue_style('xtmpluginstyle',plugin_dir_url( dirname( __FILE__, 2 ) ) . 'assets/xtm-style.css', __FILE__ );
        wp_enqueue_script('xtmpluginscripts',plugin_dir_url( dirname( __FILE__, 2 ) ) .  'assets/xtm-scripts.js', __FILE__ );
    }
}