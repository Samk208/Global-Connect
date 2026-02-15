<?php
/**
 * Usage: Registers Custom Taxonomies for the 'Vehicle' Custom Post Type.
 */

if (!defined('ABSPATH')) {
    exit;
}

function globalconnect_register_vehicle_taxonomies()
{

    // Make Taxonomy
    $labels_make = array(
        'name' => _x('Makes', 'taxonomy general name', 'globalconnect-child'),
        'singular_name' => _x('Make', 'taxonomy singular name', 'globalconnect-child'),
        'search_items' => __('Search Makes', 'globalconnect-child'),
        'all_items' => __('All Makes', 'globalconnect-child'),
        'parent_item' => __('Parent Make', 'globalconnect-child'),
        'parent_item_colon' => __('Parent Make:', 'globalconnect-child'),
        'edit_item' => __('Edit Make', 'globalconnect-child'),
        'update_item' => __('Update Make', 'globalconnect-child'),
        'add_new_item' => __('Add New Make', 'globalconnect-child'),
        'new_item_name' => __('New Make Name', 'globalconnect-child'),
        'menu_name' => __('Make', 'globalconnect-child'),
    );
    register_taxonomy('vehicle_make', array('vehicle'), array(
        'hierarchical' => true,
        'labels' => $labels_make,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'make'),
    ));

    // Model Taxonomy
    $labels_model = array(
        'name' => _x('Models', 'taxonomy general name', 'globalconnect-child'),
        'singular_name' => _x('Model', 'taxonomy singular name', 'globalconnect-child'),
        'search_items' => __('Search Models', 'globalconnect-child'),
        'all_items' => __('All Models', 'globalconnect-child'),
        'parent_item' => __('Parent Model', 'globalconnect-child'),
        'parent_item_colon' => __('Parent Model:', 'globalconnect-child'),
        'edit_item' => __('Edit Model', 'globalconnect-child'),
        'update_item' => __('Update Model', 'globalconnect-child'),
        'add_new_item' => __('Add New Model', 'globalconnect-child'),
        'new_item_name' => __('New Model Name', 'globalconnect-child'),
        'menu_name' => __('Model', 'globalconnect-child'),
    );
    register_taxonomy('vehicle_model', array('vehicle'), array(
        'hierarchical' => true,
        'labels' => $labels_model,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'model'),
    ));

    // Body Type Taxonomy
    $labels_body = array(
        'name' => _x('Body Types', 'taxonomy general name', 'globalconnect-child'),
        'singular_name' => _x('Body Type', 'taxonomy singular name', 'globalconnect-child'),
        'menu_name' => __('Body Type', 'globalconnect-child'),
    );
    register_taxonomy('vehicle_body_type', array('vehicle'), array(
        'hierarchical' => true,
        'labels' => $labels_body,
        'show_ui' => true,
        'show_admin_column' => true,
        'rewrite' => array('slug' => 'body-type'),
    ));

    // Status Taxonomy (e.g. Available, Sold, Pending)
    $labels_status = array(
        'name' => _x('Status', 'taxonomy general name', 'globalconnect-child'),
        'singular_name' => _x('Status', 'taxonomy singular name', 'globalconnect-child'),
        'menu_name' => __('Status', 'globalconnect-child'),
    );
    register_taxonomy('vehicle_status', array('vehicle'), array(
        'hierarchical' => true,
        'labels' => $labels_status,
        'show_ui' => true,
        'show_admin_column' => true,
        'rewrite' => array('slug' => 'status'),
    ));

    // Source Country Taxonomy
    $labels_source = array(
        'name' => _x('Source Countries', 'taxonomy general name', 'globalconnect-child'),
        'singular_name' => _x('Source Country', 'taxonomy singular name', 'globalconnect-child'),
        'menu_name' => __('Source Country', 'globalconnect-child'),
    );
    register_taxonomy('vehicle_source', array('vehicle', 'part'), array(
        'hierarchical' => true,
        'labels' => $labels_source,
        'show_ui' => true,
        'show_admin_column' => true,
        'rewrite' => array('slug' => 'source'),
    ));

}
add_action('init', 'globalconnect_register_vehicle_taxonomies', 0);
