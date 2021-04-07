<?php

/**
 * Include this file to prepare custom post type labels and arguments
 * 
 * @package XTMConnect
 */

namespace Inc\Base;

class PrepareCPT
{
  protected $labels;
  protected $arguments;

  public function __construct(){
    
    $this->labels = array(
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

    $this->arguments = array(
      'label' => __( 'XTM Connect', 'XTM Connect' ),
      'description' => __( 'XTM Connect', 'XTM Connect' ),
      'labels' => $this->labels,
      'menu_icon' => 'dashicons-admin-tools',
      'supports' => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields'),
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
    
  }

  public function prepare_cpt() {
    return $this->arguments;
  }

}