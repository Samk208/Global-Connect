<?php
/**
 * Register 'Part' Custom Post Type
 * Handles: Tires (New/Used), Heavy Machinery Parts, Auto Parts.
 */

if (!defined('ABSPATH')) {
    exit;
}

function globalconnect_register_part_cpt()
{
    $labels = array(
        'name' => _x('Parts & Machinery', 'Post Type General Name', 'globalconnect-child'),
        'singular_name' => _x('Part', 'Post Type Singular Name', 'globalconnect-child'),
        'menu_name' => __('Parts Inventory', 'globalconnect-child'),
        'all_items' => __('All Parts', 'globalconnect-child'),
        'add_new_item' => __('Add New Part', 'globalconnect-child'),
        'new_item' => __('New Part', 'globalconnect-child'),
        'edit_item' => __('Edit Part', 'globalconnect-child'),
    );
    $args = array(
        'label' => __('Part', 'globalconnect-child'),
        'description' => __('Inventory for Tires and Parts', 'globalconnect-child'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-admin-tools',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );
    register_post_type('part', $args);

    // Register Taxonomy: Part Category
    register_taxonomy('part_category', 'part', array(
        'hierarchical' => true,
        'labels' => array(
            'name' => _x('Part Categories', 'taxonomy general name'),
            'singular_name' => _x('Category', 'taxonomy singular name'),
            'search_items' => __('Search Categories'),
            'all_items' => __('All Categories'),
            'parent_item' => __('Parent Category'),
            'parent_item_colon' => __('Parent Category:'),
            'edit_item' => __('Edit Category'),
            'update_item' => __('Update Category'),
            'add_new_item' => __('Add New Category'),
            'new_item_name' => __('New Category Name'),
            'menu_name' => __('Categories'),
        ),
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'part-category'),
    ));
}
add_action('init', 'globalconnect_register_part_cpt', 0);

/**
 * Add Meta Boxes for Parts
 */
function globalconnect_part_add_meta_boxes()
{
    add_meta_box('gc_part_details', 'Part Details', 'globalconnect_part_meta_callback', 'part', 'normal', 'high');
}
add_action('add_meta_boxes', 'globalconnect_part_add_meta_boxes');

function globalconnect_part_meta_callback($post)
{
    wp_nonce_field('gc_save_part_data', 'gc_part_meta_nonce');
    $condition = get_post_meta($post->ID, 'part_condition', true);
    $price = get_post_meta($post->ID, 'part_price', true);
    ?>
    <p>
        <label for="part_condition"><strong>Condition:</strong></label>
        <select name="part_condition" id="part_condition">
            <option value="New" <?php selected($condition, 'New'); ?>>New</option>
            <option value="Used" <?php selected($condition, 'Used'); ?>>Used</option>
            <option value="Refurbished" <?php selected($condition, 'Refurbished'); ?>>Refurbished</option>
        </select>
    </p>
    <p>
        <label for="part_price"><strong>Price ($):</strong></label>
        <input type="number" name="part_price" value="<?php echo esc_attr($price); ?>">
    </p>
    <?php
}

function globalconnect_save_part_data($post_id)
{
    if (!isset($_POST['gc_part_meta_nonce']) || !wp_verify_nonce($_POST['gc_part_meta_nonce'], 'gc_save_part_data'))
        return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;
    if (!current_user_can('edit_post', $post_id))
        return;

    if (isset($_POST['part_condition']))
        update_post_meta($post_id, 'part_condition', sanitize_text_field($_POST['part_condition']));
    if (isset($_POST['part_price']))
        update_post_meta($post_id, 'part_price', sanitize_text_field($_POST['part_price']));
}
add_action('save_post', 'globalconnect_save_part_data');
