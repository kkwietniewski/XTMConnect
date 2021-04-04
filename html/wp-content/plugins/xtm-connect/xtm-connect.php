<?php
/**
 * @package XTMConnect
 */
/*
Plugin Name: XTM Connect
Plugin URI: https://github.com/kkwietniewski/XTMConnect/blob/main/html/wp-content/plugins/xtm-connect/xtm-connect.php
Description: This is the recruitment task plugin.
Version: 1.0.0
Author: Kacper Kwietniewski
Author URI: https://github.com/kkwietniewski/
License: GPLv3 or later
Text-Domain: xtm-connect
*/

/*
    XTMConnect the recruitment task plugin.
    Copyright (C) 2021 Kacper Kwietniewski

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <https://www.gnu.org/licenses/>.
*/

defined('ABSPATH') or die('Hey, you can\'t access this page!');

if ( file_exists(dirname( __FILE__ ) .'/vendor/autoload.php')){
	require_once dirname( __FILE__ ) .'/vendor/autoload.php';
}

use Inc\Activate;
use Inc\Deactivate;

if ( !class_exists('XTMConnect') ){

	class XTMConnect
	{
        public $pluginName;

        public function __construct()
        {
            $this->pluginName = plugin_basename(__FILE__);
        }

		function register(){
			add_action('admin_enqueue_scripts',array( $this,'enqueue'));

            add_action('admin_menu', array($this, 'add_admin_pages'));

            add_filter("plugin_action_links_$this->pluginName", array($this, 'settings_link'));
		}

        public function settings_link( $links ) {
			$settings_link = '<a href="admin.php?page=xtm_connect">Settings</a>';
			array_push( $links, $settings_link );
			return $links;
		}

		public function add_admin_pages() {
			add_menu_page( 'XTM Connect Plugin', 'XTM Connect', 'manage_options', 'xtm_connect', array( $this, 'admin_index' ), 'dashicons-arrow-right-alt2', 110 );
		}

		public function admin_index() {
			require_once plugin_dir_path( __FILE__ ) . 'templates/admin.php';
		}

		protected function create_post_type(){
			add_action('init',array($this,'custom_post_type' ));
		}

		function custom_post_type(){
			register_post_type('book',['public' => true,'label'=>'Books']);
		}

		function enqueue(){
			wp_enqueue_style('xtmpluginstyle',plugins_url( '/assets/xtm-style.css', __FILE__ ));
			wp_enqueue_script('xtmpluginscripts',plugins_url( '/assets/xtm-scripts.js', __FILE__ ));
		}

		function activate(){
			Activate::activate();
		}
        function deactivate(){
            Deactivate::deactivate();
        }
	}

	$xtmConnect = new XTMConnect();
	$xtmConnect->register();

	register_activation_hook(__FILE__,array($xtmConnect,'activate'));
	register_deactivation_hook(__FILE__,array($xtmConnect, 'deactivate' ));

}