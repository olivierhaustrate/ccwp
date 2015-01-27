<?php
/*
Plugin Name: club-custom-functions
Plugin URI:
Description: load club custom functions
Version: 0.1
Author: olivier haustrate
Author Email: olivier.haustrate@hotmail.com
License:

  Copyright 2014 olivier haustrate (olivier.haustrate@hotmail.com)

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

// ==================
// Naming conventions
// ==================
// prefix: 	functions: rbc-
// 			custom post type: cpt-
// 			custom taxonomy: ct-
//			custom meta box: cmb-
// text domain: ritterbutzke
// ===========================

// ================
// Table of content
// ================
// 1. Custom taxonomies
// 2. Custom post types
// 3. Custom meta boxes
// 4. Custom user roles
// 5. Custom Dashboard
// 5.1 Custom branding
// 5.2 Admin-menu
// 5.3 Custom post types
// 6. Calendar
// =====================


// ===============================================================
// 1. Register custom taxonomies for custom posts news and friends
// ===============================================================
// Note:
// We register our custom taxonomies before ou custom posts
// in order for our rewrite rules to work correctly

// 1.1 CT: News-categories
// =======================

if ( ! function_exists( 'rbc_ct_news_categories' ) ) {

// Register Custom Taxonomy
function rbc_ct_news_categories() {

	$labels = array(
		'name'                       => _x( 'Categories', 'Taxonomy General Name', 'ritterbutzke' ),
		'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', 'ritterbutzke' ),
		'menu_name'                  => __( 'Categories', 'Ritterbutzke' ),
		'all_items'                  => __( 'All Categories', 'Ritterbutzke' ),
		'parent_item'                => __( 'Parent Category', 'Ritterbutzke' ),
		'parent_item_colon'          => __( 'Parent Category:', 'Ritterbutzke' ),
		'new_item_name'              => __( 'New Category Name', 'Ritterbutzke' ),
		'add_new_item'               => __( 'Add New Category', 'Ritterbutzke' ),
		'edit_item'                  => __( 'Edit Category', 'Ritterbutzke' ),
		'update_item'                => __( 'Update Category', 'Ritterbutzke' ),
		'separate_items_with_commas' => __( 'Separate categories with commas', 'Ritterbutzke' ),
		'search_items'               => __( 'Search Categories', 'Ritterbutzke' ),
		'add_or_remove_items'        => __( 'Add or remove categories', 'Ritterbutzke' ),
		'choose_from_most_used'      => __( 'Choose from the most used categories', 'Ritterbutzke' ),
		'not_found'                  => __( 'Not Found', 'Ritterbutzke' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true, // test
		'show_tagcloud'              => false,
		'rewrite'                       => array( 'slug' => 'news/category', 'with_front' => false ),
		'query_var'                     => true,
		'capabilities' => array (
            'manage_terms' => 'manage_network',
            'edit_terms' => 'manage_network',
            'delete_terms' => 'manage_network',
            'assign_terms' => 'edit_posts'
            )
	);
	register_taxonomy( 'rbc-news-categories', 'rbc-news', $args );

}

// Hook into the 'init' action
add_action( 'init', 'rbc_ct_news_categories', 0 );

}

// 1.2 CT: Friends-categories
// ==========================

if ( ! function_exists( 'rbc_ct_friends_categories' ) ) {

// Register Custom Taxonomy
function rbc_ct_friends_categories() {

	$labels = array(
		'name'                       => _x( 'Categories', 'Taxonomy General Name', 'ritterbutzke' ),
		'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', 'ritterbutzke' ),
		'menu_name'                  => __( 'Categories', 'ritterbutzke' ),
		'all_items'                  => __( 'All Categories', 'ritterbutzke' ),
		'parent_item'                => __( 'Parent Category', 'ritterbutzke' ),
		'parent_item_colon'          => __( 'Parent Category:', 'ritterbutzke' ),
		'new_item_name'              => __( 'New Category Name', 'ritterbutzke' ),
		'add_new_item'               => __( 'Add New Category', 'ritterbutzke' ),
		'edit_item'                  => __( 'Edit Category', 'ritterbutzke' ),
		'update_item'                => __( 'Update Category', 'ritterbutzke' ),
		'separate_items_with_commas' => __( 'Separate categories with commas', 'ritterbutzke' ),
		'search_items'               => __( 'Search Categories', 'ritterbutzke' ),
		'add_or_remove_items'        => __( 'Add or remove categories', 'ritterbutzke' ),
		'choose_from_most_used'      => __( 'Choose from the most used categories', 'ritterbutzke' ),
		'not_found'                  => __( 'Not Found', 'ritterbutzke' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
		'rewrite'                       => array( 'slug' => 'friends/category', 'with_front' => false ),
		'query_var'                     => true,
		'capabilities' => array (
            'manage_terms' => 'manage_network',
            'edit_terms' => 'manage_network',
            'delete_terms' => 'manage_network',
            'assign_terms' => 'edit_posts'
            )
	);
	register_taxonomy( 'rbc-friends-categories', 'rbc-friends', $args );

}

// Hook into the 'init' action
add_action( 'init', 'rbc_ct_friends_categories', 0 );

}


// ====================================================
// 2. Register custom post types: events, news, friends
// ====================================================

// 2.1 CPT: Events
// ===============

if ( ! function_exists('rbc_cpt_events') ) {

// Register Custom Post Type
function rbc_cpt_events() {

	$labels = array(
		'name'                => _x( 'Events', 'Post Type General Name', 'ritterbutzke' ),
		'singular_name'       => _x( 'Event', 'Post Type Singular Name', 'ritterbutzke' ),
		'menu_name'           => __( 'Events', 'ritterbutzke' ),
		'parent_item_colon'   => __( 'Parent Event:', 'ritterbutzke' ),
		'all_items'           => __( 'All Events', 'ritterbutzke' ),
		'view_item'           => __( 'View Event', 'ritterbutzke' ),
		'add_new_item'        => __( 'Add New Event', 'ritterbutzke' ),
		'add_new'             => __( 'Add New', 'ritterbutzke' ),
		'edit_item'           => __( 'Edit Event', 'ritterbutzke' ),
		'update_item'         => __( 'Update Event', 'ritterbutzke' ),
		'search_items'        => __( 'Search Event', 'ritterbutzke' ),
		'not_found'           => __( 'Not found', 'ritterbutzke' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'ritterbutzke' ),
	);

	$args = array(
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail', ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-book',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => array( 'slug' => 'events', 'with_front' => false ),
	);
	register_post_type( 'rbc-events', $args );

}

// Hook into the 'init' action
add_action( 'init', 'rbc_cpt_events', 0 );

}

// 2.2 CPT: News
// =============

if ( ! function_exists('rbc_cpt_news') ) {

// Register Custom Post Type
function rbc_cpt_news() {

	$labels = array(
		'name'                => _x( 'News', 'Post Type General Name', 'ritterbutzke' ),
		'singular_name'       => _x( 'News', 'Post Type Singular Name', 'ritterbutzke' ),
		'menu_name'           => __( 'News', 'ritterbutzke' ),
		'parent_item_colon'   => __( 'Parent News:', 'ritterbutzke' ),
		'all_items'           => __( 'All News', 'ritterbutzke' ),
		'view_item'           => __( 'View News', 'ritterbutzke' ),
		'add_new_item'        => __( 'Add New News', 'ritterbutzke' ),
		'add_new'             => __( 'Add New', 'ritterbutzke' ),
		'edit_item'           => __( 'Edit News', 'ritterbutzke' ),
		'update_item'         => __( 'Update News', 'ritterbutzke' ),
		'search_items'        => __( 'Search News', 'ritterbutzke' ),
		'not_found'           => __( 'Not found', 'ritterbutzke' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'ritterbutzke' ),
	);

	$args = array(
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail', ),
		'taxonomies'          => array( 'rbc-news-categories' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-welcome-write-blog',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => array( 'slug' => 'news', 'with_front' => false ),
	);
	register_post_type( 'rbc-news', $args );

}

// Hook into the 'init' action
add_action( 'init', 'rbc_cpt_news', 0 );

}

// 2.3 CPT: Friends
// ================

if ( ! function_exists('rbc_cpt_friends') ) {

// Register Custom Post Type
function rbc_cpt_friends() {

	$labels = array(
		'name'                => _x( 'Friends', 'Post Type General Name', 'ritterbutzke' ),
		'singular_name'       => _x( 'Friend', 'Post Type Singular Name', 'ritterbutzke' ),
		'menu_name'           => __( 'Friends', 'ritterbutzke' ),
		'parent_item_colon'   => __( 'Parent Friend:', 'ritterbutzke' ),
		'all_items'           => __( 'All Friends', 'ritterbutzke' ),
		'view_item'           => __( 'View Friend', 'ritterbutzke' ),
		'add_new_item'        => __( 'Add New Friend', 'ritterbutzke' ),
		'add_new'             => __( 'Add New', 'ritterbutzke' ),
		'edit_item'           => __( 'Edit Friend', 'ritterbutzke' ),
		'update_item'         => __( 'Update Friend', 'ritterbutzke' ),
		'search_items'        => __( 'Search Friend', 'ritterbutzke' ),
		'not_found'           => __( 'Not found', 'ritterbutzke' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'ritterbutzke' ),
	);

	$args = array(
		'labels'              => $labels,
		'supports'            => array( 'title', ),
		'taxonomies'          => array( 'rbc-friends-categories' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-groups',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => array( 'slug' => 'friends', 'with_front' => false ),
	);
	register_post_type( 'rbc-friends', $args );

}

// Hook into the 'init' action
add_action( 'init', 'rbc_cpt_friends', 0 );

}

// =======================================================
// 3. Register custom meta boxes for page and custom posts
// =======================================================

// 3.1 Page
// ========

// Remove WP editor
function rbc_custom_page() {
	remove_post_type_support( 'page', 'editor' );
	remove_post_type_support( 'page', 'page-attributes' );
	remove_post_type_support( 'page', 'custom-fields' );
	remove_post_type_support( 'page', 'author' );
	remove_post_type_support( 'page', 'comments' );
	remove_post_type_support( 'page', 'trackbacks' );
	remove_post_type_support( 'page', 'revisions' );
}
add_action( 'init', 'rbc_custom_page' );

// Add Page subtitle
function rbc_cmb_page_subtitle( array $meta_boxes_1 ) {
	$fields = array(
		array( 'id' => 'page-subtitle',  'type' => 'text', ),
);

	$meta_boxes_1[] = array(
		'title' => 'Subtitle',
		'pages' => 'page',
		'fields' => $fields
	);
return $meta_boxes_1;

}
add_filter( 'cmb_meta_boxes', 'rbc_cmb_page_subtitle' );

// About page (page_id 1)
// ======================

// German description
function rbc_cmb_about_de_description( array $meta_boxes_2 ) {

	$fields = array(
		array( 'id' => 'about-de-description',  'type' => 'wysiwyg', 'options' => array( 'textarea_rows' => '20' )),
	);

	$meta_boxes_2[] = array(
		'title' => 'German description',
		'pages' => 'page',
		'show_on' => array( 'id' => array( 1 ) ),
		'fields' => $fields
	);

	return $meta_boxes_2;
}

add_filter( 'cmb_meta_boxes', 'rbc_cmb_about_de_description' );

// English description
function rbc_cmb_about_en_description( array $meta_boxes_3 ) {

	$fields = array(
		array( 'id' => 'about-en-description',  'type' => 'wysiwyg', 'options' => array( 'textarea_rows' => '20' )),
);

	$meta_boxes_3[] = array(
		'title' => 'English description',
		'pages' => 'page',
		'show_on' => array( 'id' => array( 1 ) ),
		'fields' => $fields
	);
return $meta_boxes_3;

}
add_filter( 'cmb_meta_boxes', 'rbc_cmb_about_en_description' );

// Add page link
function rbc_cmb_about_links( array $meta_boxes_4 ) {

$fields = array(
            array( 'id' => 'about-links-name', 'name' => 'Name', 'type' => 'text' ),
			array( 'id' => 'about-links-url', 'name' => 'Url', 'type' => 'url'),
			);

$group_fields = $fields;
	foreach ( $group_fields as &$field ) {
		$field['id'] = str_replace( 'field', 'gfield', $field['id'] );
	}

	$meta_boxes_4[] = array(
		'title' => 'Links',
		'pages' => 'page',
		'show_on' => array( 'id' => array( 1 ) ),
		'context'    => 'side',
		'priority'   => 'low',
		'fields' => array(
			array(
				'id' => 'gp_about_links',
				'type' => 'group',
				'repeatable' => true,
				'fields' => $group_fields,
			)
		)
	);

	return $meta_boxes_4;

}
add_filter( 'cmb_meta_boxes', 'rbc_cmb_about_links' );

// Contact page (page_id 2)
// ========================

// Add details contact box
function rbc_cmb_contact_details( array $meta_boxes_41 ) {

$groups_and_cols = array(
		array( 'id' => 'contact-general', 'name' => 'General', 'type' => 'group', 'cols' => 4, 'fields' => array(
			array( 'id' => 'contact-details', 'name' => 'General contact info', 'type' => 'textarea','rows' => 15 )
			) ),
		array( 'id' => 'contact-specific', 'name' => 'Specific contact info', 'type' => 'group', 'cols' => 4, 'fields' => array(
			array( 'id' => 'contact-fund', 'name' => 'Fundsachen (email)', 'type' => 'text', ),
			array( 'id' => 'contact-booking', 'name' => 'Booking (email)', 'type' => 'text', ),
			array( 'id' => 'contact-location', 'name' => 'Location (email)', 'type' => 'text', ),
			array( 'id' => 'contact-extra-links', 'name' => 'Other contact', 'repeatable' => true, 'type' => 'group', 'fields' => array(
				array( 'id' => 'contact-name',  'type' => 'text', 'name' => 'Contact name'),
				array( 'id' => 'contact-url',  'type' => 'text', 'name' => 'Contact email' )
				) ),
			) ),
		array( 'id' => 'contact-pressekit', 'name' => 'Pressekit', 'type' => 'group', 'cols' => 4, 'fields' => array(
			array( 'id' => 'contact-pressekit-text',  'name' => 'General info', 'type' => 'textarea','rows' => 8),
			array( 'id' => 'contact-pressekit-email',  'name' => 'Contact press (email)', 'type' => 'text'),
			array( 'id' => 'contact-pressekit-downloads',  'name' => 'Downloads', 'type' => 'file', 'name' => 'Download kit' ),
			) ),
	);

	$meta_boxes_41[] = array(
		'title' => 'Contact info',
		'pages' => 'page',
        'show_on' => array( 'id' => array( 2 ) ),
		'fields' => $groups_and_cols
	);

return $meta_boxes_41;

}
add_filter( 'cmb_meta_boxes', 'rbc_cmb_contact_details' );


// German impressum
function rbc_cmb_contact_de_impressum( array $meta_boxes_42 ) {

	$fields = array(
		array( 'id' => 'de-impressum',  'type' => 'wysiwyg', 'options' => array( 'textarea_rows' => '20' )),
);

	$meta_boxes_42[] = array(
		'title' => 'German impressum',
		'pages' => 'page',
		'show_on' => array( 'id' => array( 2 ) ),
		'fields' => $fields
	);
return $meta_boxes_42;

}
add_filter( 'cmb_meta_boxes', 'rbc_cmb_contact_de_impressum' );

// English impressum
function rbc_cmb_contact_en_impressum( array $meta_boxes_43 ) {

	$fields = array(
		array( 'id' => 'en-impressum',  'type' => 'wysiwyg', 'options' => array( 'textarea_rows' => '20' )),
);

	$meta_boxes_43[] = array(
		'title' => 'English impressum',
		'pages' => 'page',
		'show_on' => array( 'id' => array( 2 ) ),
		'fields' => $fields
	);
return $meta_boxes_43;

}
add_filter( 'cmb_meta_boxes', 'rbc_cmb_contact_en_impressum' );



// Background Text
// ======================

function add_secret_message_option_menu() {
	add_options_page('Secret Message', 'Secret Message', 'edit_posts', 'functions','add_secret_message_option_field');

}
add_action('admin_menu', 'add_secret_message_option_menu');

function add_secret_message_option_field() {
	?>
	<div class="wrap secret-message">
		<h2>Secret Message</h2>
		<form method="post" action="options.php">
			<?php wp_nonce_field('update-options') ?>
				<input class="secret-message-msg" type="text" name="secret-message" value="<?php echo get_option('secret-message'); ?>" />
				<input class="secret-message-act" type="checkbox" name="secret-message-active" <?php echo ( get_option('secret-message-active') ? 'checked' : '' ); ?> />
			<p><input class="secret-message-sub" type="submit" name="Submit" value="Speichern" /></p>
			<input type="hidden" name="action" value="update" />
			<input type="hidden" name="page_options" value="secret-message, secret-message-active" />
		</form>
	</div>
	<?php
}



// 3.2 CPT Events
// ==============

// Event subtitle
function rbc_cmb_events_subtitle( array $meta_boxes_5 ) {

	$fields = array(
		array( 'id' => 'events-subtitle',  'type' => 'text', ),
);

	$meta_boxes_5[] = array(
		'title' => 'Subtitle',
		'pages' => 'rbc-events',
		'context'    => 'normal',
		'priority'   => 'high',
		'fields' => $fields
	);
return $meta_boxes_5;

}
add_filter( 'cmb_meta_boxes', 'rbc_cmb_events_subtitle' );

// Event dates & time
function rbc_cmb_date_time( array $meta_boxes_6 ) {

$fields = array(
            array( 'id' => 'events-date', 'name' => 'Date', 'type' => 'date', 'cols' => 6 ),
			array( 'id' => 'events-time', 'name' => 'Time', 'type' => 'time', 'cols' => 6 ),
			);

$group_fields = $fields;
	foreach ( $group_fields as &$field ) {
		$field['id'] = str_replace( 'field', 'gfield', $field['id'] );
	}

	$meta_boxes_6[] = array(
		'title' => 'Date and time',
		'pages' => 'rbc-events',
		'context'    => 'side',
		'priority'   => 'low',
		'fields' => array(
			array(
				'id' => 'gp_events_date_time',
				'type' => 'group',
				'repeatable' => true,
				'fields' => $group_fields,
			)
		)
	);

	return $meta_boxes_6;

}
add_filter( 'cmb_meta_boxes', 'rbc_cmb_date_time' );

// Event end date & time
function rbc_cmb_end_date_time( array $meta_boxes_6_bis ) {

$fields = array(
            array( 'id' => 'events-end-date-time', 'type' => 'datetime_unix')
			);

	$meta_boxes_6_bis[] = array(
		'title' => 'End Date and time',
		'pages' => 'rbc-events',
		'context'    => 'side',
		'priority'   => 'low',
		'fields' => $fields
		);

	return $meta_boxes_6_bis;

}
add_filter( 'cmb_meta_boxes', 'rbc_cmb_end_date_time' );

// German event description
function rbc_cmb_events_de_description( array $meta_boxes_7 ) {

	$fields = array(
		array( 'id' => 'events-de-description',  'type' => 'wysiwyg', 'options' => array( 'textarea_rows' => '15' )),
);

	$meta_boxes_7[] = array(
		'title' => 'German description',
		'pages' => 'rbc-events',
		'fields' => $fields
	);
return $meta_boxes_7;

}
add_filter( 'cmb_meta_boxes', 'rbc_cmb_events_de_description' );

// English event description
function rbc_cmb_events_en_description( array $meta_boxes_8 ) {

	$fields = array(
		array( 'id' => 'events-en-description',  'type' => 'wysiwyg', 'options' => array( 'textarea_rows' => '15' )),
);

	$meta_boxes_8[] = array(
		'title' => 'English description',
		'pages' => 'rbc-events',
		'fields' => $fields
	);
return $meta_boxes_8;

}
add_filter( 'cmb_meta_boxes', 'rbc_cmb_events_en_description' );

// Line up
function rbc_cmb_events_line_up( array $meta_boxes_9 ) {

$fields = array(
            array( 'id' => 'events-line-up-category', 'name' => 'Category', 'type' => 'text', 'cols' => 3 ),
			array( 'id' => 'events-line-up-content', 'name' => 'Content', 'type' => 'wysiwyg', 'options' => array( 'textarea_rows' => '15' ),'cols' => 9 ),
			);

$group_fields = $fields;
	foreach ( $group_fields as &$field ) {
		$field['id'] = str_replace( 'field', 'gfield', $field['id'] );
	}

	$meta_boxes_9[] = array(
		'title' => 'Line up',
		'pages' => 'rbc-events',
		'fields' => array(
			array(
				'id' => 'gp_events_line_up',
				'type' => 'group',
				'repeatable' => true,
				'sortable' => true,
				'fields' => $group_fields,
			)
		)
	);

	return $meta_boxes_9;

}
add_filter( 'cmb_meta_boxes', 'rbc_cmb_events_line_up' );

// Tickets
function rbc_cmb_events_tickets( array $meta_boxes_10 ) {

	$fields = array(
		array( 'id' => 'events-tickets-providers', 'type' => 'group', 'cols' => 4, 'fields' => array(
				array( 'id' => 'events-tickets-tixforgigs',  'type' => 'url', 'name' => 'Tixforgigs url' ),
				array( 'id' => 'events-tickets-resident-advisor',  'type' => 'url', 'name' => 'Resident Advisor url' ),
				array( 'id' => 'events-tickets-extra', 'name' => 'Additional tickets provider', 'repeatable' => true, 'repeatable_max' => 1, 'type' => 'group', 'fields' => array(
					array( 'id' => 'events-tickets-extra-name',  'type' => 'text', 'name' => 'Name'),
					array( 'id' => 'events-tickets-extra-url',  'type' => 'url', 'name' => 'Url' ),
				) ),
		) ),
		array( 'id' => 'events-tickets-infos',  'name' => 'Infos', 'type' => 'wysiwyg', 'options' => array( 'textarea_rows' => '20' ), 'cols' => 8 ),
);

	$meta_boxes_10[] = array(
		'title' => 'Tickets',
		'pages' => 'rbc-events',
		'fields' => $fields
	);

	return $meta_boxes_10;
}
add_filter( 'cmb_meta_boxes', 'rbc_cmb_events_tickets' );

// Sticky event
function rbc_cmb_events_sticky( array $meta_boxes_11 ) {

	$fields = array(
		array( 'id' => 'events-sticky',  'name' => 'Highlight event', 'type' => 'checkbox' ),
		);

	$meta_boxes_11[] = array(
		'title' => 'Highlight Event',
		'pages' => 'rbc-events',
		'context'    => 'side',
		'priority'   => 'low',
		'fields' => $fields
	);

	return $meta_boxes_11;
}
add_filter( 'cmb_meta_boxes', 'rbc_cmb_events_sticky' );

// Event links
function rbc_cmb_events_links( array $meta_boxes_12 ) {

	$fields = array(
		array( 'id' => 'events-facebook', 'name' => 'Facebook', 'type' => 'url', ),
		array( 'id' => 'events-resident-advisor', 'name' => 'Resident Advisor', 'type' => 'url', ),
		array( 'id' => 'events-extra-links', 'name' => 'Additional links', 'repeatable' => true, 'repeatable_max' => 1, 'type' => 'group', 'fields' => array(
			array( 'id' => 'events-link-name',  'type' => 'text', 'name' => 'Link name'),
			array( 'id' => 'events-link-url',  'type' => 'url', 'name' => 'Link url' ),
		) ),
);

	$meta_boxes_12[] = array(
		'title' => 'Links',
		'pages' => 'rbc-events',
		'context'    => 'side',
		'priority'   => 'low',
		'fields' => $fields
	);
return $meta_boxes_12;

}
add_filter( 'cmb_meta_boxes', 'rbc_cmb_events_links' );

// Event banner image (newsletter)
function rbc_cmb_events_banner_image( array $meta_boxes_12_bis ) {

	$fields = array(
		array( 'id' => 'events-banner-image', 'type' => 'image', ),
		);

	$meta_boxes_12_bis[] = array(
		'title' => 'Banner image (Newsletter)',
		'pages' => 'rbc-events',
		'context'    => 'side',
		'priority'   => 'low',
		'fields' => $fields
	);
return $meta_boxes_12_bis;

}
add_filter( 'cmb_meta_boxes', 'rbc_cmb_events_banner_image' );


// 3.3 CPT Friends
// ===============

// Friends links
function rbc_cmb_friends_link( array $meta_boxes_13 ) {

	$fields = array(
		array( 'id' => 'friends-links',  'type' => 'url', ),
);

	$meta_boxes_13[] = array(
		'title' => 'Friend link',
		'pages' => 'rbc-friends',
		'fields' => $fields
	);
return $meta_boxes_13;

}
add_filter( 'cmb_meta_boxes', 'rbc_cmb_friends_link' );

// 3.4 CPT News
// ============

// News subtitle
function rbc_cmb_news_subtitle( array $meta_boxes_14 ) {

	$fields = array(
		array( 'id' => 'news-subtitle',  'type' => 'text', ),
);

	$meta_boxes_14[] = array(
		'title' => 'Subtitle',
		'pages' => 'rbc-news',
		'context'    => 'normal',
		'priority'   => 'high',
		'fields' => $fields
	);
return $meta_boxes_14;

}
add_filter( 'cmb_meta_boxes', 'rbc_cmb_news_subtitle' );


// German News description
function rbc_cmb_news_de_description( array $meta_boxes_15 ) {

	$fields = array(
		array( 'id' => 'news-de-description',  'type' => 'wysiwyg', 'options' => array( 'textarea_rows' => '15' )),
);

	$meta_boxes_15[] = array(
		'title' => 'German description',
		'pages' => 'rbc-news',
		'fields' => $fields
	);
return $meta_boxes_15;

}
add_filter( 'cmb_meta_boxes', 'rbc_cmb_news_de_description' );

// English News description
function rbc_cmb_news_en_description( array $meta_boxes_16 ) {

	$fields = array(
		array( 'id' => 'news-en-description',  'type' => 'wysiwyg', 'options' => array( 'textarea_rows' => '15' )),
);

	$meta_boxes_16[] = array(
		'title' => 'English description',
		'pages' => 'rbc-news',
		'fields' => $fields
	);
return $meta_boxes_16;

}
add_filter( 'cmb_meta_boxes', 'rbc_cmb_news_en_description' );

// Pop up news
function rbc_cmb_news_pop_up( array $meta_boxes_16_bis ) {

	$fields = array(
		array( 'id' => 'news-pop-up', 'type' => 'checkbox' ),
		);

	$meta_boxes_16_bis[] = array(
		'title' => 'Add to front page pop up',
		'pages' => 'rbc-news',
		'context'    => 'side',
		'priority'   => 'low',
		'fields' => $fields
	);

	return $meta_boxes_16_bis;
}
add_filter( 'cmb_meta_boxes', 'rbc_cmb_news_pop_up' );

// Newsletter news (add to newsletter)
function rbc_cmb_news_newsletter( array $meta_boxes_17_bis ) {

	$fields = array(
		array( 'id' => 'news-newsletter', 'type' => 'checkbox' ),
		);

	$meta_boxes_17_bis[] = array(
		'title' => 'Add to newsletter',
		'pages' => 'rbc-news',
		'context'    => 'side',
		'priority'   => 'low',
		'fields' => $fields
	);

	return $meta_boxes_17_bis;
}
add_filter( 'cmb_meta_boxes', 'rbc_cmb_news_newsletter' );

// Social media links
function rbc_cmb_news_social( array $meta_boxes_17 ) {

	$fields = array(
		array( 'id' => 'news-facebook', 'name' => 'Facebook', 'type' => 'url', ),
		array( 'id' => 'news-resident-advisor', 'name' => 'Resident Advisor', 'type' => 'url', ),
		array( 'id' => 'news-youtube', 'name' => 'Youtube oder Soundcloud url', 'type' => 'url', ),
);

	$meta_boxes_17[] = array(
		'title' => 'Social media links',
		'pages' => 'rbc-news',
		'context'    => 'side',
		'priority'   => 'low',
		'fields' => $fields
	);
return $meta_boxes_17;

}
add_filter( 'cmb_meta_boxes', 'rbc_cmb_news_social' );

// News links
function rbc_cmb_news_links( array $meta_boxes_17_ter ) {

	$fields = array(
				array( 'id' => 'news-links', 'repeatable' => true, 'type' => 'group', 'fields' => array(
				array( 'id' => 'news-link-name',  'type' => 'text', 'name' => 'Link name'),
				array( 'id' => 'news-link-url',  'type' => 'url', 'name' => 'Link url' ),
				) ),
			);

	$meta_boxes_17_ter[] = array(
		'title' => 'Additional Links',
		'pages' => 'rbc-news',
		'context'    => 'side',
		'priority'   => 'low',
		'fields' => $fields
	);
return $meta_boxes_17_ter;

}
add_filter( 'cmb_meta_boxes', 'rbc_cmb_news_links' );


// 3.5 Broadcasts (wp posts)
// =========================

// Broadcast media links
function rbc_cmb_broadcast_media( array $meta_boxes_18 ) {

	$fields = array(
		array( 'id' => 'broadcast-media-link', 'type' => 'text'),
);

	$meta_boxes_18[] = array(
		'title' => 'Media links',
		'pages' => 'post',
		'context'    => 'side',
		'priority'   => 'low',
		'fields' => $fields
	);
return $meta_boxes_18;

}
add_filter( 'cmb_meta_boxes', 'rbc_cmb_broadcast_media' );

// Grab first link and save as hidden post_meta
add_action( 'save_post', 'my_save_post', 10, 2 );
function my_save_post( $post_id, $post ) {
    if ( wp_is_post_revision( $post_id ) )
        return;

    $matches = array();
    preg_match_all( '/#media-code#(.*)/', $post->post_content, $matches );

    $first_link = false;
    if ( ! empty( $matches[1][0] ) )
        $first_link = $matches[1][0];

    update_post_meta( $post_id, 'broadcast-media-link', $first_link );
}

// Delete link form broadcast content when displayed
add_filter( 'the_content', 'the_content_filter', 20 );

function the_content_filter( $content ) {
    $content = preg_replace('/#media-code#(.*)/i', '', $content);
    return $content;
}

// Sticky broadcasts (add to newsletter)
function rbc_cmb_broadcast_sticky( array $meta_boxes_18_bis ) {

	$fields = array(
		array( 'id' => 'broadcast_sticky', 'type' => 'checkbox' ),
		);

	$meta_boxes_18_bis[] = array(
		'title' => 'Add to newsletter',
		'pages' => 'post',
		'context'    => 'side',
		'priority'   => 'low',
		'fields' => $fields
	);

	return $meta_boxes_18_bis;
}
add_filter( 'cmb_meta_boxes', 'rbc_cmb_broadcast_sticky' );

// Broadcast - Multi image uploader
function rbc_cmb_broadcast_multi_image( array $meta_boxes_20 ) {

	$fields = array(
		array( 'id' => 'broadcast-multi-image', 'type' => 'image', 'repeatable' => true, 'sortable' => true ),
		);

	$meta_boxes_20[] = array(
		'title' => 'Multi image uploader',
		'pages' => 'post',
		'context'    => 'normal',
		'priority'   => 'high',
		'fields' => $fields
	);
return $meta_boxes_20;

}
//add_filter( 'cmb_meta_boxes', 'rbc_cmb_broadcast_multi_image' );

// ====================
// 4. Custom user roles
// ====================



remove_role( 'club_admin' );
remove_role( 'club_editor' );
remove_role( 'rb_admin' );


// ===================
// 5. Custom Dashboard
// ===================

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
        remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');//since 3.8
		remove_action('welcome_panel','wp_welcome_panel');
}
add_action( 'admin_init', 'remove_dashboard_meta' );



// Add new dashboard widgets
// =========================
function add_rbc_custom_dashboard_widget() {
	wp_add_dashboard_widget( 'rbc_welcome', __( 'Currently logged in Ritter Butzke Club' ), 'rbc_welcome' );
	wp_add_dashboard_widget( 'rbc_last_posts', __( 'Recently published' ), 'rbc_last_posts' );
	wp_add_dashboard_widget( 'rbc_last_draft_broadcast', __( 'Last incoming broadcast (status: draft)' ), 'rbc_last_draft_broadcast' );
    wp_add_dashboard_widget( 'rbc_current_pop_up', __( 'Pop up news' ), 'rbc_current_pop_up' );
}

// Welcome
function rbc_welcome() { ?>
	<img src="<?php echo network_home_url();?>content/themes/ritterbutzke/images/logo-rbc.png" height="200" width="200" style="margin-left:10%;">
	<?php }

//  Last published
function rbc_last_posts() {
	$args = array(
		'numberposts' => '5',
		'orderby' => 'post_date',
		'order' => 'DESC',
		'post_status' => 'publish',
		'post_type' => array('post', 'rbc-news', 'rbc-events', 'rbc-friends')
		);

	$recent_posts = wp_get_recent_posts( $args );
		echo '<ul>';
		foreach( $recent_posts as $recent ){
		echo '<li>'.date('d.m.Y', strtotime($recent["post_date"])). '&nbsp; - &nbsp;' .'<a href="'.get_admin_url().'/post.php?post='.$recent['ID'].'&action=edit">' . $recent["post_title"].'</a>'. '&nbsp; by &nbsp;' .get_the_author_meta('display_name', $recent["post_author"]).'</li> ';
		}
		echo '</ul>';
	}
//  Last broadcast draft
function rbc_last_draft_broadcast() {
	$args = array(
			'post_type' => array('post'),
			'post_status' => array( 'draft'),
			'posts_per_page' => 10,
			'order' => 'DESC',
			'orderby' => 'date'
			);

	$the_query = new WP_Query( $args );
		if ( $the_query->have_posts() ) :
			echo '<ul>';
			while ( $the_query->have_posts() ) : $the_query->the_post();
			$category = get_the_category();
			echo '<li>'.get_the_date('d.m.Y').', &nbsp;'. $category[0]->cat_name . ':&nbsp;' . '<a href="'.get_admin_url().'/post.php?post='.get_the_ID().'&action=edit">'.get_the_title().'</a></li>';
			endwhile;
			echo '</ul>';
		endif;

	wp_reset_postdata();
}

// Current pop up news
function rbc_current_pop_up() {
	$custom_terms = get_terms('rbc-news-categories');

	foreach($custom_terms as $custom_term) {
		wp_reset_query();
		$args = array(
		'post_type' => 'rbc-news',
		'tax_query' => array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'rbc-news-categories',
					'field' => 'slug',
					'terms' => $custom_term->slug,
				),
			),
		'meta_query' => array(
				'relation' => 'AND',
				array(
							'key' => 'news-pop-up',
							'value' => 1,
							'compare' => '=',
							'type' => 'CHAR'
							)
						),
		 );

     $loop = new WP_Query($args);
     if($loop->have_posts()) {
	 while($loop->have_posts()) : $loop->the_post();
        echo '<h3>'.$custom_term->name.'</h3>';
		echo '<ul>';


        echo '<li>'.'<span>'.get_the_date('d.m.Y').'</span>'. '&nbsp; - &nbsp;' . '<a href="'.get_admin_url().'/post.php?post='.get_the_ID().'&action=edit">'.get_the_title().'</a>'.'</li>';

		echo '</ul>';
		endwhile;
		} else {
		echo 'Currently there is no news checked to be displayed as pop up on the homepage.';
		}
	}
}

add_action('wp_dashboard_setup', 'add_rbc_custom_dashboard_widget' );

// Dashboard widget - Custom css
function rbc_custom_dashboard_css() {
	echo '<style>
    #dashboard-widgets .postbox .inside {
    margin-bottom: 0;
    min-height: 200px;
	}
	</style>';
}
add_action('admin_head', 'rbc_custom_dashboard_css');



// 5.1 Custom branding
// ===================

// 5.2 Admin-menu
// ====================

// Re-order menu items
function custom_menu_order($menu_ord) {
    if (!$menu_ord) return true;

    return array(
        'index.php', // Dashboard
        'separator1', // First separator
        'upload.php', // Media
        'link-manager.php', // Links
        'edit.php?post_type=page', // Pages
				'edit.php?post_type=rbc-events', // Custom Post Type Events
        'edit.php?post_type=rbc-news', // Custom Post Type News
        'edit.php?post_type=rbc-friends', // Custom Post Type Friends
				'edit.php', // Posts
        'edit-comments.php', // Comments
        'separator2', // Second separator
        'themes.php', // Appearance
        'plugins.php', // Plugins
        'users.php', // Users
        'tools.php', // Tools
        'options-general.php', // Settings
        'separator-last', // Last separator
        );
}
add_filter('custom_menu_order', 'custom_menu_order'); // Activate custom_menu_order
add_filter('menu_order', 'custom_menu_order');


// Add direct link to edit page in Admin menu
function register_my_custom_menu_page(){
  add_menu_page( 'about', 'About us', 'manage_options', '/post.php?post=1&action=edit', '' , 'dashicons-groups' , 21 );
	add_menu_page( 'contact', 'Contact', 'manage_options', '/post.php?post=2&action=edit', '' , 'dashicons-email-alt' , 22 );
	add_menu_page( 'newsletter', 'Newsletter', 'manage_options', '/post.php?post=3&action=edit', '' , 'dashicons-format-aside' , 23 );
	add_menu_page( 'background-text', 'Secret Message', 'manage_options', '/options-general.php?page=functions', '' , 'dashicons-slides' , 20 );
}
add_action( 'admin_menu', 'register_my_custom_menu_page' );


// 5.3 Custom column on cpt admin page
// ===================================

// 5.3.1 CPT Events

// Add column header
function rbc_events_columns_head($columns) {
		unset($columns);
			$columns = array(
				'cb' => '<input type="checkbox"/>',
				'events-date' => __("events date"),
				'title' => __('Title'),
				'events-highlight' => __("Highlighted"),
				'events-thumbnail' => __("Flyer"),
			);

		return $columns;
}
add_filter('manage_rbc-events_posts_columns', 'rbc_events_columns_head', 10);

// Add column content
function rbc_events_columns_content($column_name, $post_id) {
	$events_hightlight = get_post_meta(get_the_id(), 'events-sticky', true);

	if ($column_name == 'events-date') {

	// Repeatable group field
	$field_data = get_post_meta( get_the_id(), 'gp_events_date_time', false );

	// Find first and last day of event.
	$dates = count($field_data);
	if ( $dates > 1 ) {
	$temp_day = array();

	foreach ( $field_data as $single_field ) {
	$temp_day[] = strtotime($single_field['events-date']);
	}

	// Sort from lowest to highest
	sort($temp_day, SORT_NUMERIC);

	$start_day = $temp_day[0];
	$end_day = end($temp_day);
	} else {
	// Single Day Event
	$start_day = strtotime($field_data[0][ 'events-date' ]);
	$start_time = strtotime($field_data[0][ 'events-time' ]);
	}

	if ( $dates > 1 ): echo date('d. M', $start_day) . " — " . date('d. M Y', $end_day); else: echo date('d. M Y', $start_day); endif;

	}

    if ($column_name == 'events-highlight') {
		if($events_hightlight==1)
		{echo '&#10004;';}
		else
		{echo '';}
	}

	if ($column_name == 'events-thumbnail') {
		echo the_post_thumbnail( array(75,75) );
    }

}
add_action('manage_rbc-events_posts_custom_column', 'rbc_events_columns_content', 10, 2);

/////////////////////////////////////////////////
// Events orderby dates
// Make column sortable
function my_sortable_rbc_events_column() {
    //$columns['events-date'] = 'events-date';
    unset($columns['title']);

    return $columns;
}
add_filter( 'manage_edit-rbc-events_sortable_columns', 'my_sortable_rbc_events_column' );

// Orderby Events's dates
add_action( 'pre_get_posts', 'rbc_cpt_events_order' );

function rbc_cpt_events_order( $query ) {
		global $is_admin;
    // check if we're in admin, if not exit
    if ( ! $is_admin ) {
        return;
    }

    $post_type = $query->get('post_type');

    if ( $post_type == 'rbc-events' ) {

         if ( $query->get( 'meta_key' ) == '' ) {
            $query->set( 'meta_key', '_events-date' );
        }
		if ( $query->get( 'orderby' ) == '' ) {
            $query->set( 'orderby', 'meta_value_num' );
        }
        if( $query->get( 'order' ) == '' ){
            $query->set( 'order', 'DESC' );
        }
    }
}
////////////////////////////////////////////////

// Resize columns in post listing screen
// CSS should go to css file
function rbc_events_column_resize() { ?>
    <style type="text/css">
		.post-type-rbc-events .fixed .column-title {
            width: 25%;
        }
		.post-type-rbc-events .fixed .column-events-date {
            width: 15%;
        }
		.post-type-rbc-events .fixed .column-events-highlight {
            width: 15%;
        }


    </style>
<?php }

add_action( 'admin_enqueue_scripts', 'rbc_events_column_resize' );

// 5.3.2 CPT Friends

// Add column header
function rbc_friends_columns_head($columns) {
		unset($columns['date']);
		return $columns;
}
add_filter('manage_rbc-friends_posts_columns', 'rbc_friends_columns_head', 10);


// All Friends displaid alphabetical ascending
add_action( 'pre_get_posts', 'rbc_friends_order' );

function rbc_friends_order( $query ) {
    global $is_admin;
    // check if we're in admin, if not exit
    if ( ! $is_admin ) {
        return;
    }

    $post_type = $query->get('post_type');

    if ( $post_type == 'rbc-friends' ) {

        if ( $query->get( 'orderby' ) == '' ) {
            $query->set( 'orderby', 'title' );
        }
        if( $query->get( 'order' ) == '' ){
            $query->set( 'order', 'ASC' );
        }
    }
}

// Add custom taxonomy filter
function rbc_friends_taxonomy_filters() {
	global $typenow;

	// an array of all the taxonomyies you want to display. Use the taxonomy name or slug
	$taxonomies = array('rbc-friends-categories');

	// must set this to the post type you want the filter(s) displayed on
	if( $typenow == 'rbc-friends' ){

		foreach ($taxonomies as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug);
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);
			if(count($terms) > 0) {
				echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
				echo "<option value=''>Show All $tax_name</option>";
				foreach ($terms as $term) {
					echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>';
				}
				echo "</select>";
			}
		}
	}
}
add_action( 'restrict_manage_posts', 'rbc_friends_taxonomy_filters' );

// Resize columns in post listing screen
// CSS should go to css file
function rbc_friends_column_resize() { ?>
    <style type="text/css">
	.post-type-rbc-friends .fixed .column-title {
		width: 25%;
    }
    </style>
<?php }

add_action( 'admin_enqueue_scripts', 'rbc_friends_column_resize' );


// 5.3.3 CPT News

// Add column header
function rbc_news_columns_head($columns) {
$columns = array(
				'cb' => '<input type="checkbox"/>',
				'title' => __('Title'),
				'rbc-news-categories' => __('Category'),
				'news-pop-up' => __("In Pop up"),
				'news-newsletter' => __("In Newsletter"),
				'date' => __("Posted on"),
			);
		return $columns;
}
add_filter('manage_rbc-news_posts_columns', 'rbc_news_columns_head', 10);

// Add column content
function rbc_news_columns_content($column_name, $post_id) {
	$news_pop_up = get_post_meta(get_the_id(), 'news-pop-up', true);
	$news_newsletter = get_post_meta(get_the_id(), 'news-newsletter', true);
if ($column_name == 'news-pop-up') {
		if($news_pop_up==1)
		{echo '&#10004;';}
		else
		{echo '';}
	}

if ($column_name == 'news-newsletter') {
		if($news_newsletter==1)
		{echo '&#10004;';}
		else
		{echo '';}
	}

if ($column_name == 'rbc-news-categories') {
	$taxonomy = $column_name;
        $post_type = get_post_type($post_id);
        $terms = get_the_terms($post_id, $taxonomy);

        if (!empty($terms) ) {
            foreach ( $terms as $term )
            $post_terms[] ="<a href='edit.php?post_type={$post_type}&{$taxonomy}={$term->slug}'> " .esc_html(sanitize_term_field('name', $term->name, $term->term_id, $taxonomy, 'edit')) . "</a>";
            echo join('', $post_terms );
        }
         else echo '<i>No Category Set. </i>';
}

}
add_action('manage_rbc-news_posts_custom_column', 'rbc_news_columns_content', 10, 2);

// Add custom taxonomy filter
function rbc_news_taxonomy_filters() {
	global $typenow;

	// an array of all the taxonomyies you want to display. Use the taxonomy name or slug
	$taxonomies = array('rbc-news-categories');

	// must set this to the post type you want the filter(s) displayed on
	if( $typenow == 'rbc-news' ){

		foreach ($taxonomies as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug);
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);
			if(count($terms) > 0) {
				echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
				echo "<option value=''>Show All $tax_name</option>";
				foreach ($terms as $term) {
					echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>';
				}
				echo "</select>";
			}
		}
	}
}
add_action( 'restrict_manage_posts', 'rbc_news_taxonomy_filters' );

// Resize columns in post listing screen
// CSS should go to css file
function rbc_news_column_resize() { ?>
    <style type="text/css">
	.post-type-rbc-news .fixed .column-title {
		width: 25%;
    }
	.post-type-rbc-news .fixed .column-rbc-news-categories {
		width: 10%;
    }
	.post-type-rbc-news .fixed .column-news-pop-up {
		width: 10%;
    }
	.post-type-rbc-news .fixed .column-news-newsletter {

    }
    </style>
<?php }

add_action( 'admin_enqueue_scripts', 'rbc_news_column_resize' );


// 5.3.4 WP Posts - Broadcasts

// Add column header
function rbc_broadcasts_columns_head($columns) {
		unset($columns);
			$columns = array(
				'cb' => '<input type="checkbox"/>',
				'title' => __('Title'),
				'categories' => __('Category'),
				'broadcast-newsletter' => __('Added to Newsletter'),
				'date' => __('Posted on'),

			);

		return $columns;
}
add_filter('manage_post_posts_columns', 'rbc_broadcasts_columns_head', 10);

// Add column content
function rbc_broadcasts_columns_content($column_name, $post_id) {
	$broadcast_newsletter = get_post_meta(get_the_id(), 'broadcast_sticky', true);
if ($column_name == 'broadcast-newsletter') {
		if($broadcast_newsletter==1)
		{echo '&#10004;';}
		else
		{echo '';}
	}
}
add_action('manage_posts_custom_column', 'rbc_broadcasts_columns_content', 10, 2);

// Resize columns in post listing screen
// CSS should go to css file
function rbc_broadcasts_column_resize() { ?>
    <style type="text/css">
		.post-type-post .fixed .column-cb {
            width: 2%;
        }
		.post-type-post .fixed .column-title {
            width: 20%;
        }
		.post-type-post .fixed .column-categories {
            width: 15%;
        }
		.post-type-post .fixed .column-date {
            width: 25%;
        }

    </style>
<?php }

add_action( 'admin_enqueue_scripts', 'rbc_broadcasts_column_resize' );


// 5.4 Filters on cpt admin page
// =============================

// Remove date filter
// based on custom post type

// gets the current post type in the WordPress Admin
// http://themergency.com/wordpress-tip-get-post-type-in-admin/
function get_current_post_type() {
global $post, $typenow, $current_screen;

    if ( $post && $post->post_type ) // see note below snippet
        return $post->post_type;

    elseif( $typenow )
        return $typenow;

    elseif( $current_screen && $current_screen->post_type )
        return $current_screen->post_type;

    elseif( isset( $_REQUEST['post_type'] ) )
        return sanitize_key( $_REQUEST['post_type'] );

    return null;
}

// hide date dropdown for [customposttype] only using above function

if (get_current_post_type() == 'rbc-events') {
add_filter('months_dropdown_results', '__return_empty_array');
}
if (get_current_post_type() == 'rbc-friends') {
add_filter('months_dropdown_results', '__return_empty_array');
}


// 5.3.2. Events
// Adds a hidden Meta Field '_events-date' to rbc-events cpt by which the events are ordered because sorting by the repeatable date field won’t work

// DEBUGGING
//add_action('admin_footer-post.php', 'rbc_cpt_events_date_meta_debug');
function rbc_cpt_events_date_meta_debug() {
	global $post;

	//Only run this on custom post rbc-events
	if( $post->post_type != 'rbc-events' ) return false;

	$dates = get_post_meta($post->ID, '_events-date');
	?>
	<div style="position: fixed; right: 2em; top: 2em; width: 20em; z-index:2000; color: #0000ff; background: rgba(255,255,255,.5); padding: 0.6em;">
		<h3>Debugging</h3>
			<p>_events-date = <?php echo $dates[0]; ?> </p>
	</div>
	<?php
}

add_action('save_post', 'rbc_cpt_events_date_meta', 10);

function rbc_cpt_events_date_meta($post) {
	global $post;

	//Only run this on cpt rbc-events
	if( $post->post_type != 'rbc-events' ) return false;

	global $_POST;
	if( !empty($_POST['gp_events_date_time']) ) {
		$dates = array_values_recursive($_POST['gp_events_date_time']);

	// If event has multiple dates compare date values and check for the most recent one. This is just to check against user fuck ups with the date insertion
		if(count($dates) > 2 ) {
			$tmp_dates = array();
			for($i = 0; $i < count($dates) -1 ; $i++) {
				$tmp_dates[$i] = strtotime($dates[$i][0][0] . " " . $dates[$i][1][0]);
			}

			usort($tmp_dates, function($a, $b) {
				$v1 = strtotime($a[0]);
				$v2 = strtotime($b[0]);
				return $v1 - $v2;
			});

			$date = $tmp_dates[0];

		} else {
			$date = strtotime($dates[0][0][0] . " " . $dates[0][1][0]);
		}
	// Add or update the hidden meta field _events-date with the most recent date value of the event
		add_post_meta( $post->ID, '_events-date', $date, true ) || update_post_meta( $post->ID, '_events-date', $date );


	// Add End Date as hidden meta field
		$end_date = $_POST['events-end-date-time'];
		if( !empty($end_date) ) {
			$end_date= strtotime($end_date['date'] . " " . $end_date['time']);
		} else {
			$end_date = $date + 86400;
		}
		add_post_meta( $post->ID, '_events-end-date', $end_date, true ) || update_post_meta( $post->ID, '_events-end-date', $end_date );
	}
}

//This is to sort the not indexed $_POST['gp_events_date_time'] array
function array_values_recursive(array $array) {
    $array = array_values($array);
    for ($i = 0, $x = count($array); $i < $x; ++$i) {
        if (is_array($array[$i])) {
            $array[$i] = array_values_recursive($array[$i]);
        }
    }
    return $array;
}

// 6. Calendar
// =============================

// TODO: Add a redirect to 404 pageaktivetoptop

// Add rewrite tag for calendar view
function add_calendar_rewrite_tag() {
 	add_rewrite_tag('%cal_year%','([^&]+)');
 	add_rewrite_tag('%cal_month%','([^&]+)');
}
add_action('init', 'add_calendar_rewrite_tag');

// Add rewrite for rule calendar
function add_calendar_rewrite_rule() {
	add_rewrite_rule('^events/([^/]*)/([^/]*)/?','index.php?post_type=rbc-events&cal_year=$matches[1]&cal_month=$matches[2]','top');
}
add_action('init', 'add_calendar_rewrite_rule');

?>