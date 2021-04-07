<?php

/**
 * Include this file to use translations table in database
 * 
 * @package XTMConnect
 */

namespace Inc\Base;

class TranslationsDB
{

  public function register()
  {
      add_action('init',array( $this,'translations_db_create'));
  }

  function translations_db_create(){
    global $wpdb;
    $tableName = $wpdb->prefix . "translations";

    $query = $wpdb->prepare('SHOW TABLES LIKE %s', $wpdb->esc_like($tableName));

    if($wpdb->get_var($query) == $tableName){
        return; 
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
}