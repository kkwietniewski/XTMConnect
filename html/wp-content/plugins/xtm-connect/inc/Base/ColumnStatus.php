<?php

/**
 * Include this file to add custom status to xtm_post type
 * 
 * @package XTMConnect
 */

namespace Inc\Base;

class ColumnStatus
{
  
  public function register()
  {
    add_filter('manage_edit-xtm_post_columns', array( $this,'add_custom_column'));
    add_action('manage_posts_custom_column',  array( $this,'show_custom_columns'));
    add_action( 'init', array( $this,'add_translate_post_status'));
  }

  function add_custom_column($columns) {
      $columns['status'] = 'Status';
      return $columns;
  }

  function show_custom_columns($name) {
      global $post;
      switch ($name) {
          case 'status':
              echo $post->post_status;
      }
  }

  function add_translate_post_status(){
    register_post_status('sended_to_translate', array(
        'label'                     => _x( 'Sended to translate', 'xtm_post' ),
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'Sended to translate <span class="count">(%s)</span>', 'Sended to translate <span class="count">(%s)</span>' ),
    ) );
  }
}