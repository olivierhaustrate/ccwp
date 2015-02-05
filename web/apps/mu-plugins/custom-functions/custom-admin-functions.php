<?php
/*
Plugin Name: custom-dashboard-functions
Plugin URI:
Description: custom dashboard functions
Version: 0.1
Author: olivier haustrate
Author Email: olivier.haustrate@hotmail.com
License:

  Copyright 2015 olivier haustrate (olivier.haustrate@hotmail.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

// =======================
// Reset Wordpress default
// =======================

// Remove unnecessary meta-data from your WordPress site
// ======================================================
function remove_header_extra(){
  //Are you editing your WordPress blog using your browser? Then you are not using a blog client
  remove_action('wp_head', 'rsd_link');
  // Windows Live Writer is (it's another blog editing client
  remove_action('wp_head', 'wlwmanifest_link');
  //This announces that you are running WordPress and what version you are using. 
  remove_action('wp_head', 'wp_generator');
  //URL shortening is sometimes useful, but this automatic ugly url in your header is useless.
  remove_action('wp_head', 'wp_shortlink_wp_head');
  // Display the links to the general feeds: Post and Comment Feed
  remove_action('wp_head', 'feed_links', 2);
  //// Display the links to the extra feeds such as category feeds
  remove_action('wp_head', 'feed_links_extra', 3);
  //Deprecated
  remove_action('wp_head', 'index_rel_link');
  // start link
  remove_action('wp_head', 'start_post_rel_link', 10, 0);
  // prev link
  remove_action('wp_head', 'parent_post_rel_link', 10, 0);
  // Display relational links for the posts adjacent to the current post.
  remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
}
add_action('init', 'remove_header_extra');

// Disable Wordpress core update notifications
// ===========================================

function remove_core_updates() {
    if(! current_user_can('update_core')){return;}
    add_action('init', create_function('$a',"remove_action( 'init', 'wp_version_check' );"),2);
    add_filter('pre_option_update_core','__return_null');
    add_filter('pre_site_transient_update_core','__return_null');
    }
add_action('after_setup_theme','remove_core_updates');

// Disable plugin update notifications
// ===================================
remove_action('load-update-core.php','wp_update_plugins');
add_filter('pre_site_transient_update_plugins','__return_null');

// Remove default dashboard widgets
// ================================
function remove_dashboard_meta() {
        remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
        remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
        remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
		    remove_action('welcome_panel', 'wp_welcome_panel');
}
add_action( 'admin_init', 'remove_dashboard_meta' );


// ====================================
// Start project specific customization
// ====================================

// Set default timezone
// ====================
date_default_timezone_set('Europe/Berlin');

?>