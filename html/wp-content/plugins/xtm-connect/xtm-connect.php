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

function create_xtm_post_type() {

    $labels = array(
        'name' => _x( 'XTM Connect', 'Post Type General Name', 'XTM Connect' ),
        'singular_name' => _x( 'XTM Connect', 'Post Type Singular Name', 'XTM Connect' ),
        'menu_name' => _x( 'XTM Connect', 'Admin Menu text', 'XTM Connect' ),
        'name_admin_bar' => _x( 'XTM Connect', 'Add New on Toolbar', 'XTM Connect' ),
        'archives' => __( 'XTM Connect Archives', 'XTM Connect' ),
        'attributes' => __( 'XTM Connect Attributes', 'XTM Connect' ),
        'parent_item_colon' => __( 'XTM Connect', 'XTM Connect' ),
        'all_items' => __( 'Translation', 'XTM Connect' ),
        'add_new_item' => __( 'Add new post', 'XTM Connect' ),
        'add_new' => __( 'New post', 'XTM Connect' ),
        'new_item' => __( 'New post', 'XTM Connect' ),
        'edit_item' => __( 'Edit post', 'XTM Connect' ),
        'update_item' => __( 'Update post', 'XTM Connect' ),
        'view_item' => __( 'View item', 'XTM Connect' ),
        'view_items' => __( 'Translate list', 'XTM Connect' ),
        'search_items' => __( 'Search items', 'XTM Connect' ),
        'not_found' => __( 'No posts to show.', 'XTM Connect' ),
        'not_found_in_trash' => __( 'Nothing found in trash.', 'XTM Connect' ),
        'featured_image' => __( 'Featured image', 'XTM Connect' ),
        'set_featured_image' => __( 'Set featured image', 'XTM Connect' ),
        'remove_featured_image' => __( 'Remove featured image', 'XTM Connect' ),
        'use_featured_image' => __( 'Use featured image', 'XTM Connect' ),
        'insert_into_item' => __( 'Insert into item', 'XTM Connect' ),
        'uploaded_to_this_item' => __( 'Upload to item', 'XTM Connect' ),
        'items_list' => __( 'Items list', 'XTM Connect' ),
        'items_list_navigation' => __( 'Posts navigation', 'XTM Connect' ),
        'filter_items_list' => __( 'Filter posts', 'XTM Connect' ),
    );
    $args = array(
        'label' => __( 'XTM Connect', 'XTM Connect' ),
        'description' => __( 'XTM Connect', 'XTM Connect' ),
        'labels' => $labels,
        'menu_icon' => 'dashicons-admin-tools',
        'supports' => array('title', 'author'),
        'taxonomies' => array(),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 80,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'exclude_from_search' => false,
        'show_in_rest' => true,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );
    register_post_type( 'xtm_post', $args );

}
add_action( 'init', 'create_xtm_post_type', 0 );

function translations_db_create(){
    global $wpdb;
    $dbName = $wpdb->prefix . "translations";

    $result = $wpdb->get_results("SELECT * FROM $dbName");
    if(!empty($result)){
       return $this; 
    }else{

        
        $query = "CREATE TABLE wp_translations(
            ID bigint(20) UNSIGNED AUTO_INCREMENT,
            post_author bigint(20) UNSIGNED,
            post_date datetime ON UPDATE CURRENT_TIMESTAMP,
            post_title varchar(100) DEFAULT '',
            post_content varchar(1000) DEFAULT '',
            post_status varchar(30) DEFAULT '',
            PRIMARY KEY (ID))";

        require_once(ABSPATH . "wp-admin/includes/upgrade.php");
        dbDelta( $query );
    }
}
// add_action( 'init', 'translations_db_create');

add_filter('manage_edit-xtm_post_columns', 'add_custom_column');
function add_custom_column($columns) {
    $columns['status'] = 'Status';
    return $columns;
}

add_action('manage_posts_custom_column',  'show_custom_columns');
function show_custom_columns($name) {
    global $post;
    switch ($name) {
        case 'status':
            echo $post->post_status;
    }
}

function translate_post_status(){
    register_post_status('sended_to_translate', array(
        'label'                     => _x( 'Sended to translate', 'xtm_post' ),
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'Sended to translate <span class="count">(%s)</span>', 'Sended to translate <span class="count">(%s)</span>' ),
    ) );
}
add_action( 'init', 'translate_post_status' );

add_filter('bulk_actions-edit-xtm_post', function( $bulk_actions){

    $bulk_actions['translate'] = "Translate";

    return $bulk_actions;
});

add_filter('handle_bulk_actions-edit-xtm_post', 'handle_bulk_post_translate', 10, 3);

function handle_bulk_post_translate($redirect_to, $doaction, $post_ids){
    if ($doaction != 'translate'){
        return $redirect_to;
    }

    global $wpdb;
    $dbName = $wpdb->prefix . "translations";
    require_once(ABSPATH . "wp-admin/includes/upgrade.php");
    foreach ($post_ids as $post_id) {
        $post = get_post($post_id);
        $post->post_status = 'sended_to_translate';
        wp_update_post($post);
        dbDelta("INSERT INTO $dbName VALUES(
                $post->ID,
                '$post->post_author',
                '$post->post_date',
                '$post->title',
                '$post->content',
                '$post->post_status'
                )");
    }

    $redirect_to = add_query_arg('translated_posts', count($post_ids), $redirect_to);

    return $redirect_to;
}
