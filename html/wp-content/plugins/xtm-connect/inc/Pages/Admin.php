<?php

/**
 * Include this file to use admin methods
 * 
 * @package XTMConnect
 */

namespace Inc\Pages;

use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;
use \Inc\Api\Callbacks\AdminCallbacks;

class Admin extends BaseController
{

    public $settings;

    public $callbacks;

    public $pages = array();

    public $subpages = array();

    public function register()
    {
        $this->settings = new SettingsApi;

        $this->callbacks = new AdminCallbacks;

        $this->set_pages();

        $this->set_subpages();

        $this->set_settings();
        $this->set_sections();
        $this->set_fields();

        $this->settings->add_pages( $this->pages)->with_sub_page('Translation')->add_subpages($this->subpages)->register();

    }

    public function set_pages()
    {
        $this->pages = [
            [
                'page_title' => 'XTM Connect Plugin', 
                'menu_title' => 'XTM Connect', 
                'capability' => 'manage_options', 
                'menu_slug' => 'xtm_connect', 
                'callback' => array($this->callbacks, 'admin_dashboard'), 
                'icon_url' => 'dashicons-arrow-right-alt2', 
                'position' => 110
            ]
        ];
    }

    public function set_subpages()
    {
        $this->subpages = [
            [
                'parent_slug' => 'xtm_connect',
                'page_title' => 'Translation', 
                'menu_title' => 'Translation', 
                'capability' => 'manage_options', 
                'menu_slug' => 'translation', 
                'callback' => array($this->callbacks, 'translation')
            ]
        ];
    }

    public function set_settings()
    {
        $args = [
            [
                'option_group' => 'xtm_options_group',
                'option_name' => 'text_example',
                'callback' => array($this->callbacks, 'xtm_options_group')
            ]
        ];

        $this->settings->set_settings($args);
    }

    public function set_sections()
    {
        $args = [
            [
                'id' => 'xtm_admin_index',
                'title' => 'Settings',
                'callback' => '',
                'page' => 'xtm_connect'
            ]
        ];

        $this->settings->set_sections($args);
    }

    public function set_fields()
    {
        $args = [
            [
                'id' => 'text_example',
                'title' => 'Text example',
                'callback' => array($this->callbacks, 'xtm_text_example'),
                'page' => 'xtm_connect',
                'section' => 'xtm_admin_index',
                'args' => array(
                    'label_for' => 'text_example',
                    'class' => 'example-class'
                )
            ]
        ];

        $this->settings->set_fields($args);
    }
}