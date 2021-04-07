<?php

/**
 * Include this file to prepare translation page
 * 
 * @package XTMConnect
 */

namespace Inc\Pages;

use Inc\Base\PrepareCPT;

class Translation extends PrepareCPT
{
    protected $args;

    public function __construct(){
        parent::__construct();
        $this->args = parent::prepare_cpt();
    }
    public function register()
    { 
        add_action( 'init', array( $this,'create_xtm_post_type'), 0 );
    }

    function create_xtm_post_type() {
        register_post_type( 'xtm_post', $this->args );
    }
}