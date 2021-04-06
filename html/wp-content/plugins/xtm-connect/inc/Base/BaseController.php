<?php
/**
 * 
 * @package XTMConnect
 */

 namespace Inc\Base;

 class BaseController
 {
     public $pluginPath;
     public $pluginUrl;
     public $pluginName;

     public function __construct()
     {
         $this->pluginPath = plugin_dir_path(dirname(__FILE__, 2));
         $this->pluginUrl= plugin_dir_url(dirname(__FILE__, 2));
     }
 }