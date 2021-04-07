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

define( 'PLUGIN', plugin_basename( __FILE__ ) );

function activate_xtmconnect_plugin()
{
	Inc\Base\Activate::activate();
}

register_activation_hook( __FILE__, 'activate_xtmconnect_plugin' );

function deactivate_xtmconnect_plugin()
{
	\Inc\Base\Deactivate::deactivate();
}

register_deactivation_hook( __FILE__, 'deactivate_xtmconnect_plugin' );

if(class_exists('Inc\\Init'))
{
	Inc\Init::register_services();
}