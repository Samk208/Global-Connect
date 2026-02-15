<?php
/**
 * Usage: Registers the 'Shipment' Custom Post Type.
 */

if (!defined('ABSPATH')) {
    exit;
}

function globalconnect_register_shipment_cpt()
{

    $labels = array(
        'name' => _x('Shipments', 'Post Type General Name', 'globalconnect-child'),
        'singular_name' => _x('Shipment', 'Post Type Singular Name', 'globalconnect-child'),
        'menu_name' => __('Shipments', 'globalconnect-child'),
        'name_admin_bar' => __('Shipment', 'globalconnect-child'),
        'archives' => __('Shipment Archives', 'globalconnect-child'),
        'attributes' => __('Shipment Attributes', 'globalconnect-child'),
        'parent_item_colon' => __('Parent Shipment:', 'globalconnect-child'),
        'all_items' => __('All Shipments', 'globalconnect-child'),
        'add_new_item' => __('Add New Shipment', 'globalconnect-child'),
        'add_new' => __('Add New', 'globalconnect-child'),
        'new_item' => __('New Shipment', 'globalconnect-child'),
        'edit_item' => __('Edit Shipment', 'globalconnect-child'),
        'update_item' => __('Update Shipment', 'globalconnect-child'),
        'view_item' => __('View Shipment', 'globalconnect-child'),
        'view_items' => __('View Shipments', 'globalconnect-child'),
        'search_items' => __('Search Shipment', 'globalconnect-child'),
        'not_found' => __('Not found', 'globalconnect-child'),
        'not_found_in_trash' => __('Not found in Trash', 'globalconnect-child'),
        'featured_image' => __('Featured Image', 'globalconnect-child'),
        'set_featured_image' => __('Set featured image', 'globalconnect-child'),
        'remove_featured_image' => __('Remove featured image', 'globalconnect-child'),
        'use_featured_image' => __('Use as featured image', 'globalconnect-child'),
        'insert_into_item' => __('Insert into shipment', 'globalconnect-child'),
        'uploaded_to_this_item' => __('Uploaded to this shipment', 'globalconnect-child'),
        'items_list' => __('Shipments list', 'globalconnect-child'),
        'items_list_navigation' => __('Shipments list navigation', 'globalconnect-child'),
        'filter_items_list' => __('Filter shipments list', 'globalconnect-child'),
    );
    $args = array(
        'label' => __('Shipment', 'globalconnect-child'),
        'description' => __('Customer shipments for tracking', 'globalconnect-child'),
        'labels' => $labels,
        'supports' => array('title', 'custom-fields', 'revisions'), // Title will be the Tracking Number
        'hierarchical' => false,
        'public' => false, // Not public on frontend directly, accessed via tracking form
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 6,
        'menu_icon' => 'dashicons-location-alt',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => false,
        'can_export' => true,
        'has_archive' => false,
        'exclude_from_search' => true,
        'publicly_queryable' => false,
        'capability_type' => 'page',
    );
    register_post_type('shipment', $args);

}
add_action('init', 'globalconnect_register_shipment_cpt', 0);

/**
 * Add Meta Boxes for Shipment Data
 */
function globalconnect_shipment_add_meta_boxes()
{
    add_meta_box(
        'gc_shipment_details',
        'Shipment details',
        'globalconnect_shipment_meta_box_callback',
        'shipment',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'globalconnect_shipment_add_meta_boxes');

/**
 * Meta Box Callback
 */
function globalconnect_shipment_meta_box_callback($post)
{
    wp_nonce_field('globalconnect_save_shipment_data', 'globalconnect_shipment_meta_nonce');

    $status = get_post_meta($post->ID, 'shipment_status', true);
    $location = get_post_meta($post->ID, 'current_location', true);
    $eta = get_post_meta($post->ID, 'estimated_arrival', true);
    $container = get_post_meta($post->ID, 'container_number', true);

    ?>
    <style>
        .gc-meta-row {
            margin-bottom: 15px;
        }

        .gc-meta-row label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .gc-meta-row input,
        .gc-meta-row select {
            width: 100%;
            max-width: 400px;
        }
    </style>

    <div class="gc-meta-row">
        <label for="shipment_status">Current Status</label>
        <select name="shipment_status" id="shipment_status">
            <option value="Received" <?php selected($status, 'Received'); ?>>Received</option>
            <option value="Processing" <?php selected($status, 'Processing'); ?>>Processing</option>
            <option value="Sailing" <?php selected($status, 'Sailing'); ?>>Sailing (In Transit)</option>
            <option value="Customs" <?php selected($status, 'Customs'); ?>>In Customs</option>
            <option value="Arrived" <?php selected($status, 'Arrived'); ?>>Arrived at Destination</option>
            <option value="Delivered" <?php selected($status, 'Delivered'); ?>>Delivered</option>
        </select>
    </div>

    <div class="gc-meta-row">
        <label for="current_location">Current Location</label>
        <input type="text" name="current_location" id="current_location" value="<?php echo esc_attr($location); ?>"
            placeholder="e.g. Newark Port, NJ or Atlantic Ocean">
    </div>

    <div class="gc-meta-row">
        <label for="estimated_arrival">Estimated Arrival (ETA)</label>
        <input type="date" name="estimated_arrival" id="estimated_arrival" value="<?php echo esc_attr($eta); ?>">
    </div>

    <div class="gc-meta-row">
        <label for="container_number">Container Number</label>
        <input type="text" name="container_number" id="container_number" value="<?php echo esc_attr($container); ?>"
            placeholder="e.g. ABCD1234567">
    </div>
    <?php
}

/**
 * Save Meta Box Data
 */
function globalconnect_save_shipment_data($post_id)
{
    if (!isset($_POST['globalconnect_shipment_meta_nonce']))
        return;
    if (!wp_verify_nonce($_POST['globalconnect_shipment_meta_nonce'], 'globalconnect_save_shipment_data'))
        return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;
    if (!current_user_can('edit_post', $post_id))
        return;

    if (isset($_POST['shipment_status']))
        update_post_meta($post_id, 'shipment_status', sanitize_text_field($_POST['shipment_status']));
    if (isset($_POST['current_location']))
        update_post_meta($post_id, 'current_location', sanitize_text_field($_POST['current_location']));
    if (isset($_POST['estimated_arrival']))
        update_post_meta($post_id, 'estimated_arrival', sanitize_text_field($_POST['estimated_arrival']));
    if (isset($_POST['container_number']))
        update_post_meta($post_id, 'container_number', sanitize_text_field($_POST['container_number']));
}
add_action('save_post', 'globalconnect_save_shipment_data');
