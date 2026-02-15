<?php
/**
 * Usage: Registers the 'Vehicle' Custom Post Type.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function globalconnect_register_vehicle_cpt() {

	$labels = array(
		'name'                  => _x( 'Vehicles', 'Post Type General Name', 'globalconnect-child' ),
		'singular_name'         => _x( 'Vehicle', 'Post Type Singular Name', 'globalconnect-child' ),
		'menu_name'             => __( 'Vehicles', 'globalconnect-child' ),
		'name_admin_bar'        => __( 'Vehicle', 'globalconnect-child' ),
		'archives'              => __( 'Vehicle Archives', 'globalconnect-child' ),
		'attributes'            => __( 'Vehicle Attributes', 'globalconnect-child' ),
		'parent_item_colon'     => __( 'Parent Vehicle:', 'globalconnect-child' ),
		'all_items'             => __( 'All Vehicles', 'globalconnect-child' ),
		'add_new_item'          => __( 'Add New Vehicle', 'globalconnect-child' ),
		'add_new'               => __( 'Add New', 'globalconnect-child' ),
		'new_item'              => __( 'New Vehicle', 'globalconnect-child' ),
		'edit_item'             => __( 'Edit Vehicle', 'globalconnect-child' ),
		'update_item'           => __( 'Update Vehicle', 'globalconnect-child' ),
		'view_item'             => __( 'View Vehicle', 'globalconnect-child' ),
		'view_items'            => __( 'View Vehicles', 'globalconnect-child' ),
		'search_items'          => __( 'Search Vehicle', 'globalconnect-child' ),
		'not_found'             => __( 'Not found', 'globalconnect-child' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'globalconnect-child' ),
		'featured_image'        => __( 'Featured Image', 'globalconnect-child' ),
		'set_featured_image'    => __( 'Set featured image', 'globalconnect-child' ),
		'remove_featured_image' => __( 'Remove featured image', 'globalconnect-child' ),
		'use_featured_image'    => __( 'Use as featured image', 'globalconnect-child' ),
		'insert_into_item'      => __( 'Insert into vehicle', 'globalconnect-child' ),
		'uploaded_to_this_item' => __( 'Uploaded to this vehicle', 'globalconnect-child' ),
		'items_list'            => __( 'Vehicles list', 'globalconnect-child' ),
		'items_list_navigation' => __( 'Vehicles list navigation', 'globalconnect-child' ),
		'filter_items_list'     => __( 'Filter vehicles list', 'globalconnect-child' ),
	);
	$args = array(
		'label'                 => __( 'Vehicle', 'globalconnect-child' ),
		'description'           => __( 'Used cars for export', 'globalconnect-child' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'excerpt' ),
		'taxonomies'            => array( 'category', 'post_tag' ), // We will register custom taxonomies later
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-car',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'show_in_rest'          => true, // Enable Gutenberg/Block editor if needed, or Divi Builder support
	);
	register_post_type( 'vehicle', $args );

}
add_action( 'init', 'globalconnect_register_vehicle_cpt', 0 );
