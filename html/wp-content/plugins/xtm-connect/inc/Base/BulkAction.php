<?php

/**
 * Include this file to add translate custom bulk action
 * 
 * @package XTMConnect
 */

namespace Inc\Base;

class BulkAction
{
  public function register(){
    add_filter('bulk_actions-edit-xtm_post', array($this, 'add_bulk_action'));
    add_filter('handle_bulk_actions-edit-xtm_post', array($this, 'handle_bulk_post_translate'), 10, 3);
    add_action('admin_notices', array($this, 'add_admin_notice'));
  }
  function add_bulk_action($bulk_actions){

    $bulk_actions['translate'] = "Translate";

    return $bulk_actions;
  }


  function handle_bulk_post_translate($redirect_to, $doaction, $post_ids){
    if ($doaction != 'translate'){
        return $redirect_to;
    }

    global $wpdb;
    $tableName = $wpdb->prefix . "translations";
    require_once(ABSPATH . "wp-admin/includes/upgrade.php");
    foreach ($post_ids as $post_id) {
        $post = get_post($post_id);
        if($post->post_status == 'sended_to_translate'){
          return $redirect_to;
        }
        $post->post_status = 'sended_to_translate';
        wp_update_post($post);
        dbDelta("INSERT INTO $tableName VALUES(
                $post->ID,
                '$post->post_author',
                '$post->post_date',
                '$post->post_title',
                '$post->post_content',
                '$post->post_status'
                )");
  }

  $redirect_to = add_query_arg('translated_posts', count($post_ids), $redirect_to);

  return $redirect_to;
  }

  function add_admin_notice(){
    if(!empty($_REQUEST['translated_posts'])){
      $postsCount = intval($_REQUEST['translated_posts']);
      printf('<div id="message" class="updated fade">Sended %d post(s) to translate!</div>', $postsCount);
    }
  }
}