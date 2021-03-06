<?php

/**
 * Trigger this file on Plugin uninstall
 * 
 * @package XTMConnect
 */

 if(!defined('WP_UNINSTALL_PLUGIN'))
 {
    die;
 }

 global $wpdb;

 $wpdb->query("DELETE FROM wp_posts WHERE post_type = 'post' OR post_type='page'");
 $wpdb->query("DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)");
 $wpdb->query("DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)");