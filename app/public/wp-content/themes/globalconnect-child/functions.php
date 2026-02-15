<?php

/**
 * GlobalConnect Child Theme functions and definitions
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Enqueue scripts and styles.
 */
function globalconnect_child_enqueue_styles()
{
    // Cache-bust version based on file modification time
    $theme_version = wp_get_theme()->get('Version') ?: '1.0';
    $css_version = filemtime(get_stylesheet_directory() . '/style.css') ?: $theme_version;

    // Enqueue Google Fonts with display=swap for performance
    wp_enqueue_style('gc-google-fonts', 'https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Roboto+Mono:wght@400;500;700&display=swap', array(), null);

    wp_enqueue_style('divi-parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('globalconnect-child-style', get_stylesheet_directory_uri() . '/style.css', array('divi-parent-style'), $css_version);

    // Enqueue Dashicons for Frontend
    wp_enqueue_style('dashicons');

    // Enqueue Chat Widget Script (with cache busting)
    $chat_ver = file_exists(get_stylesheet_directory() . '/assets/js/gc-chat.js') ? filemtime(get_stylesheet_directory() . '/assets/js/gc-chat.js') : $theme_version;
    wp_enqueue_script('gc-chat-widget', get_stylesheet_directory_uri() . '/assets/js/gc-chat.js', array('jquery'), $chat_ver, true);

    // Enqueue Advanced Animations (deferred)
    $anim_ver = file_exists(get_stylesheet_directory() . '/assets/js/gc-animations.js') ? filemtime(get_stylesheet_directory() . '/assets/js/gc-animations.js') : $theme_version;
    wp_enqueue_script('gc-animations', get_stylesheet_directory_uri() . '/assets/js/gc-animations.js', array(), $anim_ver, true);

    // Enqueue Homepage Category Links Script
    if (is_front_page()) {
        $cat_ver = file_exists(get_stylesheet_directory() . '/assets/js/gc-homepage-categories.js') ? filemtime(get_stylesheet_directory() . '/assets/js/gc-homepage-categories.js') : $theme_version;
        wp_enqueue_script('gc-homepage-categories', get_stylesheet_directory_uri() . '/assets/js/gc-homepage-categories.js', array('jquery'), $cat_ver, true);
        wp_localize_script('gc-homepage-categories', 'gc_shop_url', array(
            'shop' => get_permalink(get_page_by_path('shop'))
        ));
    }

    // Localize script for secure AJAX and settings
    wp_localize_script('gc-chat-widget', 'gc_chat_obj', array(
        'root' => esc_url_raw(rest_url()),
        'nonce' => wp_create_nonce('wp_rest'),
        'whatsapp' => get_option('gc_whatsapp_number', '12672900254')
    ));
}
add_action('wp_enqueue_scripts', 'globalconnect_child_enqueue_styles');

/**
 * Preconnect to external domains for performance
 */
add_action('wp_head', 'gc_resource_hints', 1);
function gc_resource_hints()
{
    echo '<link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
    echo '<link rel="dns-prefetch" href="//www.google.com">' . "\n";
}

/**
 * Add lazy loading to iframes (Google Maps etc.)
 */
add_filter('the_content', 'gc_lazy_load_iframes');
function gc_lazy_load_iframes($content)
{
    $content = str_replace('<iframe ', '<iframe loading="lazy" ', $content);
    // Prevent double loading attribute
    $content = str_replace('loading="lazy" loading="lazy"', 'loading="lazy"', $content);
    return $content;
}

/**
 * Limit post revisions to save DB space
 */
if (!defined('WP_POST_REVISIONS')) {
    define('WP_POST_REVISIONS', 5);
}

/**
 * Register Navigation Menus
 */
function globalconnect_register_menus()
{
    register_nav_menus(array(
        'main-menu' => __('Main Menu', 'globalconnect-child'),
        'footer-menu' => __('Footer Menu', 'globalconnect-child'),
        'mobile-menu' => __('Mobile Menu', 'globalconnect-child'),
    ));
}
add_action('init', 'globalconnect_register_menus');

/**
 * Filter Archive Queries (Inventory & Parts)
 */
function globalconnect_filter_archives($query)
{
    if (is_admin() || !$query->is_main_query()) {
        return;
    }

    if (is_post_type_archive('part') || is_tax('part_category')) {
        if (isset($_GET['condition']) && !empty($_GET['condition'])) {
            $meta_query = array(
                array(
                    'key' => 'part_condition',
                    'value' => sanitize_text_field($_GET['condition']),
                    'compare' => '='
                )
            );
            $query->set('meta_query', $meta_query);
        }

        // Handle Sorting for Parts
        if (isset($_GET['orderby']) && !empty($_GET['orderby'])) {
            switch ($_GET['orderby']) {
                case 'price_asc':
                    $query->set('meta_key', 'part_price');
                    $query->set('orderby', 'meta_value_num');
                    $query->set('order', 'ASC');
                    break;
                case 'price_desc':
                    $query->set('meta_key', 'part_price');
                    $query->set('orderby', 'meta_value_num');
                    $query->set('order', 'DESC');
                    break;
                case 'date_desc':
                    $query->set('orderby', 'date');
                    $query->set('order', 'DESC');
                    break;
                case 'popularity':
                    $query->set('meta_key', 'gc_inquiry_count');
                    $query->set('orderby', 'meta_value_num');
                    $query->set('order', 'DESC');
                    break;
            }
        }
    }

    if (is_post_type_archive('vehicle') || is_post_type_archive('part') || is_tax(array('vehicle_make', 'vehicle_model', 'vehicle_body_type', 'vehicle_status', 'vehicle_source', 'part_category'))) {
        $tax_query = array('relation' => 'AND');

        // Filter by Model
        if (isset($_GET['vehicle_model']) && !empty($_GET['vehicle_model'])) {
            $tax_query[] = array(
                'taxonomy' => 'vehicle_model',
                'field' => 'slug',
                'terms' => sanitize_text_field($_GET['vehicle_model']),
            );
        }

        // Filter by Status
        if (isset($_GET['vehicle_status']) && !empty($_GET['vehicle_status'])) {
            $tax_query[] = array(
                'taxonomy' => 'vehicle_status',
                'field' => 'slug',
                'terms' => sanitize_text_field($_GET['vehicle_status']),
            );
        }

        // Filter by Source (Global Sourcing)
        if (isset($_GET['source']) && !empty($_GET['source'])) {
            $tax_query[] = array(
                'taxonomy' => 'vehicle_source',
                'field' => 'slug',
                'terms' => sanitize_text_field($_GET['source']),
            );
        }

        // Filter by Part Category
        if (isset($_GET['part_category']) && !empty($_GET['part_category'])) {
            $tax_query[] = array(
                'taxonomy' => 'part_category',
                'field' => 'slug',
                'terms' => sanitize_text_field($_GET['part_category']),
            );
        }

        if (count($tax_query) > 1) {
            $query->set('tax_query', $tax_query);
        }

        // Filter by Year (Meta)
        if (isset($_GET['vehicle_year']) && !empty($_GET['vehicle_year'])) {
            $meta_query = $query->get('meta_query') ?: array();
            $meta_query[] = array(
                'key' => 'vehicle_year',
                'value' => sanitize_text_field($_GET['vehicle_year']),
                'compare' => '=',
            );
            $query->set('meta_query', $meta_query);
        }

        // Handle Sorting
        if (isset($_GET['orderby']) && !empty($_GET['orderby'])) {
            switch ($_GET['orderby']) {
                case 'price_asc':
                    // Check post type to decide meta key
                    if (is_post_type_archive('part') || (isset($_GET['post_type']) && $_GET['post_type'] === 'part')) {
                        $query->set('meta_key', 'part_price');
                    } else {
                        $query->set('meta_key', 'vehicle_price');
                    }
                    $query->set('orderby', 'meta_value_num');
                    $query->set('order', 'ASC');
                    break;
                case 'price_desc':
                    if (is_post_type_archive('part') || (isset($_GET['post_type']) && $_GET['post_type'] === 'part')) {
                        $query->set('meta_key', 'part_price');
                    } else {
                        $query->set('meta_key', 'vehicle_price');
                    }
                    $query->set('orderby', 'meta_value_num');
                    $query->set('order', 'DESC');
                    break;
                case 'year_desc':
                    $query->set('meta_key', 'vehicle_year');
                    $query->set('orderby', 'meta_value_num');
                    $query->set('order', 'DESC');
                    break;
                case 'date_desc':
                    $query->set('orderby', 'date');
                    $query->set('order', 'DESC');
                    break;
                case 'popularity':
                    $query->set('meta_key', 'gc_inquiry_count');
                    $query->set('orderby', 'meta_value_num');
                    $query->set('order', 'DESC');
                    break;
            }
        }
    }
}
add_action('pre_get_posts', 'globalconnect_filter_archives');

/**
 * AJAX: Handle Multi-Step Inquiry Wizard Submission
 */
function globalconnect_handle_wizard_submission()
{
    check_ajax_referer('gc_wizard_nonce', 'wizard_nonce');

    // 1. Honeypot Security Check (Bot Detection)
    if (!empty($_POST['website_url'])) {
        wp_send_json_error('Invalid submission detected.');
    }

    // 2. Rate Limiting (Max 5 inquiries per IP per hour)
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $transient_key = 'gc_inquiry_limit_' . md5($ip_address);
    $attempt_count = get_transient($transient_key) ?: 0;

    if ($attempt_count >= 5) {
        wp_send_json_error('Too many inquiries. Please try again in 1 hour.');
    }

    // Increment rate limit counter
    set_transient($transient_key, $attempt_count + 1, HOUR_IN_SECONDS);

    // 3. Sanitize and Validate Inputs
    $product_id = intval($_POST['product_id']);
    $full_name = sanitize_text_field($_POST['full_name']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $port = sanitize_text_field($_POST['destination_port']);
    $method = sanitize_text_field($_POST['shipping_method']);
    $whatsapp_updates = isset($_POST['whatsapp_updates']) ? 'Yes' : 'No';

    // Validate required fields
    if (empty($full_name) || empty($email) || empty($phone) || empty($port)) {
        wp_send_json_error('Please fill in all required fields.');
    }

    if (!is_email($email)) {
        wp_send_json_error('Please provide a valid email address.');
    }

    $product_name = get_the_title($product_id);

    // 4. Update Analytics: Increment Inquiry Count
    $current_count = get_post_meta($product_id, 'gc_inquiry_count', true) ?: 0;
    update_post_meta($product_id, 'gc_inquiry_count', $current_count + 1);

    // 5. Build Email Notification
    $to = get_option('admin_email');
    $subject = "New Export Inquiry: " . $product_name;
    $message = "You have a new high-intent export inquiry.\n\n";
    $message .= "Product: " . $product_name . "\n";
    $message .= "Customer: " . $full_name . "\n";
    $message .= "Email: " . $email . "\n";
    $message .= "Phone: " . $phone . "\n";
    $message .= "Destination Port: " . strtoupper($port) . "\n";
    $message .= "Shipping Method: " . strtoupper($method) . "\n";
    $message .= "WhatsApp Updates Enabled: " . $whatsapp_updates . "\n\n";
    $message .= "Please generate a formal pro-forma invoice and contact the customer.";

    $sent = wp_mail($to, $subject, $message);

    if ($sent) {
        wp_send_json_success('Inquiry submitted successfully.');
    } else {
        wp_send_json_error('Failed to send email. Please contact support.');
    }
}
add_action('wp_ajax_gc_submit_inquiry', 'globalconnect_handle_wizard_submission');
add_action('wp_ajax_nopriv_gc_submit_inquiry', 'globalconnect_handle_wizard_submission');

/**
 * AJAX: Toggle Pinned Shipment for Dashboard
 */
function globalconnect_toggle_pin_shipment()
{
    check_ajax_referer('gc_pin_nonce', 'nonce');
    if (!is_user_logged_in())
        wp_send_json_error('Unauthorized');

    $track = sanitize_text_field($_POST['track']);
    $user_id = get_current_user_id();
    $saved = get_user_meta($user_id, 'gc_saved_tracking', true) ?: [];

    if (in_array($track, $saved)) {
        $saved = array_diff($saved, [$track]);
        $status = 'unpinned';
    } else {
        $saved[] = $track;
        $status = 'pinned';
    }

    update_user_meta($user_id, 'gc_saved_tracking', $saved);
    wp_send_json_success(['status' => $status]);
}
add_action('wp_ajax_gc_toggle_pin_shipment', 'globalconnect_toggle_pin_shipment');

/**
 * ADMIN: Analytics Columns for Vehicles & Parts
 */
function gc_add_analytics_columns($columns)
{
    $new_columns = array();
    foreach ($columns as $key => $value) {
        $new_columns[$key] = $value;
        if ($key === 'title') {
            $new_columns['gc_inquiry_count'] = 'Inquiries';
        }
    }
    return $new_columns;
}
add_filter('manage_vehicle_posts_columns', 'gc_add_analytics_columns');
add_filter('manage_part_posts_columns', 'gc_add_analytics_columns');

function gc_fill_analytics_columns($column, $post_id)
{
    if ($column === 'gc_inquiry_count') {
        $count = get_post_meta($post_id, 'gc_inquiry_count', true) ?: 0;
        echo '<strong>' . esc_html($count) . '</strong>';
    }
}
add_action('manage_vehicle_posts_custom_column', 'gc_fill_analytics_columns', 10, 2);
add_action('manage_part_posts_custom_column', 'gc_fill_analytics_columns', 10, 2);

// Make column sortable
function gc_sortable_analytics_columns($columns)
{
    $columns['gc_inquiry_count'] = 'gc_inquiry_count';
    return $columns;
}
add_filter('manage_edit-vehicle_sortable_columns', 'gc_sortable_analytics_columns');
add_filter('manage_edit-part_sortable_columns', 'gc_sortable_analytics_columns');

/**
 * Include Custom Post Types
 */
require_once get_stylesheet_directory() . '/includes/post-types/vehicle-post-type.php';
require_once get_stylesheet_directory() . '/includes/post-types/vehicle-taxonomies.php';
require_once get_stylesheet_directory() . '/includes/post-types/shipment-post-type.php';
require_once get_stylesheet_directory() . '/includes/post-types/part-post-type.php';

/**
 * Include Shortcodes
 */
require_once get_stylesheet_directory() . '/includes/shortcodes/tracker-shortcode.php';
require_once get_stylesheet_directory() . '/includes/shortcodes/calculator-shortcode.php';
require_once get_stylesheet_directory() . '/includes/shortcodes/tire-calculator-shortcode.php';
require_once get_stylesheet_directory() . '/includes/shortcodes/inquiry-wizard-shortcode.php';
require_once get_stylesheet_directory() . '/includes/shortcodes/dashboard-shortcode.php';
require_once get_stylesheet_directory() . '/includes/shortcodes/trending-shortcode.php';

/**
 * Include SEO / RankMath Integration
 */
require_once get_stylesheet_directory() . '/includes/seo-rankmath.php';


/**
 * Seeder (Runs once to populate content)
 */
require_once get_stylesheet_directory() . '/includes/seeder.php';

/**
 * Include AI Chatbot Logic
 */
require_once get_stylesheet_directory() . '/includes/class-gc-ai-chat.php';

/**
 * ============================================================
 * Feature Adoption: Mobile Sticky Bar
 * ============================================================
 */
function globalconnect_mobile_sticky_bar()
{
    if (!wp_is_mobile())
        return;

    $whatsapp = get_option('gc_whatsapp_number', '12672900254');
?>
    <div class="gc-mobile-sticky-bar">
        <a href="https://wa.me/<?php echo esc_attr($whatsapp); ?>" class="gc-btn-bar whatsapp">
            <span class="dashicons dashicons-whatsapp"></span> WhatsApp
        </a>
        <a href="tel:+<?php echo esc_attr($whatsapp); ?>" class="gc-btn-bar call">
            <span class="dashicons dashicons-phone"></span> Call Now
        </a>
    </div>
<?php
}
add_action('wp_footer', 'globalconnect_mobile_sticky_bar');


/**
 * ============================================================
 * Feature: Dynamic Live Operation Ticker
 * ============================================================
 */
function globalconnect_get_ticker_items()
{
    $ticker_items = array();

    // 1. Get recent shipments in transit
    $shipments = get_posts(array(
        'post_type' => 'shipment',
        'posts_per_page' => 3,
        'orderby' => 'date',
        'order' => 'DESC'
    ));

    foreach ($shipments as $shipment) {
        $status = get_post_meta($shipment->ID, 'shipment_status', true);
        $location = get_post_meta($shipment->ID, 'current_location', true);
        if ($status && $location) {
            $ticker_items[] = array(
                'type' => 'shipment',
                'text' => 'TRACKING: ' . $shipment->post_title . ' - ' . $status
            );
        }
    }

    // 2. Get recently added vehicles
    $vehicles = get_posts(array(
        'post_type' => 'vehicle',
        'posts_per_page' => 3,
        'orderby' => 'date',
        'order' => 'DESC'
    ));

    foreach ($vehicles as $vehicle) {
        $price = get_post_meta($vehicle->ID, 'vehicle_price', true);
        $ticker_items[] = array(
            'type' => 'vehicle',
            'text' => 'NEW STOCK: ' . $vehicle->post_title . ($price ? ' - $' . $price : '')
        );
    }

    // 3. Get most inquired items (top performers)
    $top_inquired = get_posts(array(
        'post_type' => array('vehicle', 'part'),
        'posts_per_page' => 2,
        'meta_key' => 'gc_inquiry_count',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'meta_query' => array(
            array(
                'key' => 'gc_inquiry_count',
                'value' => '0',
                'compare' => '>'
            )
        )
    ));

    foreach ($top_inquired as $item) {
        $count = get_post_meta($item->ID, 'gc_inquiry_count', true);
        $ticker_items[] = array(
            'type' => 'trending',
            'text' => 'TRENDING: ' . $item->post_title . ' (' . $count . ' inquiries)'
        );
    }

    // 4. Add some static operational updates for variety
    $static_updates = array(
        array('type' => 'status', 'text' => 'STATUS: All US Ports Operating Normally'),
        array('type' => 'quote', 'text' => 'QUOTE: 40ft Container to Conakry from $2,800'),
        array('type' => 'quote', 'text' => 'QUOTE: RoRo Shipping to Lagos from $1,200'),
        array('type' => 'status', 'text' => 'STATUS: China Factory Orders - 2 Week Lead Time'),
    );

    // Mix in 2 random static updates
    shuffle($static_updates);
    $ticker_items = array_merge($ticker_items, array_slice($static_updates, 0, 2));

    // Shuffle for variety
    shuffle($ticker_items);

    // Return at least 6 items (duplicate if needed for smooth scrolling)
    if (count($ticker_items) < 6) {
        $ticker_items = array_merge($ticker_items, $ticker_items);
    }

    return array_slice($ticker_items, 0, 8);
}


/**
 * ============================================================
 * Feature Adoption: AI Admin Prompts
 * ============================================================
 */
function globalconnect_register_settings_page()
{
    add_menu_page(
        'Global Connect',
        'Global Connect',
        'manage_options',
        'gc-settings',
        'globalconnect_render_settings_page',
        'dashicons-admin-site',
        6
    );
}
add_action('admin_menu', 'globalconnect_register_settings_page');

function globalconnect_register_general_settings()
{
    // Settings group with sanitization callbacks
    register_setting('gc_settings_group', 'gc_ai_api_key', array(
        'sanitize_callback' => 'sanitize_text_field'
    ));
    register_setting('gc_settings_group', 'gc_ai_model', array(
        'sanitize_callback' => 'sanitize_text_field'
    ));
    register_setting('gc_settings_group', 'gc_ai_system_prompt', array(
        'sanitize_callback' => 'sanitize_textarea_field'
    ));
    register_setting('gc_settings_group', 'gc_contact_form_id', array(
        'sanitize_callback' => 'absint'
    ));
    register_setting('gc_settings_group', 'gc_whatsapp_number', array(
        'sanitize_callback' => 'sanitize_text_field'
    ));
}
add_action('admin_init', 'globalconnect_register_general_settings');

function globalconnect_render_settings_page()
{
    // Security Check: Verify user has permission to access settings
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
?>
    <div class="wrap">
        <h1>Global Connect Settings</h1>

        <form method="post" action="options.php"
            style="background:#fff; padding:20px; border:1px solid #ddd; margin-bottom:20px; border-radius: 8px;">
            <?php settings_fields('gc_settings_group'); ?>
            <?php do_settings_sections('gc_settings_group'); ?>

            <h2 style="border-bottom: 2px solid #f0f0f1; padding-bottom: 10px;">General Configuration</h2>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">WhatsApp Number</th>
                    <td><input type="text" name="gc_whatsapp_number"
                            value="<?php echo esc_attr(get_option('gc_whatsapp_number', '12672900254')); ?>"
                            style="width:100%;" placeholder="e.g. 12672900254" />
                        <p class="description">Used for all WhatsApp buttons across the site.</p>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Contact Form ID (WPForms)</th>
                    <td><input type="number" name="gc_contact_form_id"
                            value="<?php echo esc_attr(get_option('gc_contact_form_id', '1')); ?>" style="width:100px;" />
                        <p class="description">The ID of your WPForms contact form.</p>
                    </td>
                </tr>
            </table>

            <h2 style="border-bottom: 2px solid #f0f0f1; padding-bottom: 10px; margin-top: 40px;">AI Chatbot Configuration
            </h2>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">OpenAI API Key</th>
                    <td><input type="password" name="gc_ai_api_key"
                            value="<?php echo esc_attr(get_option('gc_ai_api_key')); ?>" style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Model</th>
                    <td>
                        <?php $current_model = get_option('gc_ai_model', 'gpt-4o-mini'); ?>
                        <select name="gc_ai_model">
                            <option value="gpt-3.5-turbo" <?php selected($current_model, 'gpt-3.5-turbo'); ?>>
                                GPT-3.5 Turbo (Fast/Cheap)</option>
                            <option value="gpt-4o" <?php selected($current_model, 'gpt-4o'); ?>>GPT-4o
                                (Smartest)</option>
                            <option value="gpt-4o-mini" <?php selected($current_model, 'gpt-4o-mini'); ?>>
                                GPT-4o Mini (Best Value)</option>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">System Prompt</th>
                    <td>
                        <textarea name="gc_ai_system_prompt"
                            style="width:100%; height:150px;"><?php echo esc_textarea(get_option('gc_ai_system_prompt', 'You are a helpful assistant for Global Connect Shipping.')); ?></textarea>
                    </td>
                </tr>
            </table>

            <?php submit_button(); ?>
        </form>

        <hr>

        <h2 style="margin-top:40px;">Inquiry Analytics</h2>
        <div style="display:flex; gap:20px;">
            <div style="flex:1; background:#fff; padding:20px; border:1px solid #ddd; border-radius:8px;">
                <h3>Top 5 Inquired Vehicles</h3>
                <table class="widefat striped">
                    <thead>
                        <tr>
                            <th>Vehicle</th>
                            <th>Inquiries</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $top_vehicles = get_posts(array(
                            'post_type' => 'vehicle',
                            'meta_key' => 'gc_inquiry_count',
                            'orderby' => 'meta_value_num',
                            'order' => 'DESC',
                            'posts_per_page' => 5
                        ));
                        if ($top_vehicles):
                            foreach ($top_vehicles as $v):
                                $count = get_post_meta($v->ID, 'gc_inquiry_count', true) ?: 0;
                        ?>
                                <tr>
                                    <td><a
                                            href="<?php echo get_edit_post_link($v->ID); ?>"><?php echo esc_html($v->post_title); ?></a>
                                    </td>
                                    <td><strong><?php echo esc_html($count); ?></strong></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="2">No inquiry data yet.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div style="flex:1; background:#fff; padding:20px; border:1px solid #ddd; border-radius:8px;">
                <h3>Top 5 Inquired Parts</h3>
                <table class="widefat striped">
                    <thead>
                        <tr>
                            <th>Part / Machinery</th>
                            <th>Inquiries</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $top_parts = get_posts(array(
                            'post_type' => 'part',
                            'meta_key' => 'gc_inquiry_count',
                            'orderby' => 'meta_value_num',
                            'order' => 'DESC',
                            'posts_per_page' => 5
                        ));
                        if ($top_parts):
                            foreach ($top_parts as $p):
                                $count = get_post_meta($p->ID, 'gc_inquiry_count', true) ?: 0;
                        ?>
                                <tr>
                                    <td><a
                                            href="<?php echo get_edit_post_link($p->ID); ?>"><?php echo esc_html($p->post_title); ?></a>
                                    </td>
                                    <td><strong><?php echo esc_html($count); ?></strong></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="2">No inquiry data yet.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <hr>

        <h2>Reference Prompts</h2>
        <div style="display:flex; gap:20px;">
            <div style="flex:1;">
                <h3>Sales Assistant</h3>
                <textarea readonly
                    style="width:100%; height:150px; font-family:monospace; background:#f0f0f1; padding:10px;">
                    ### System Prompt: Global Connect Sales Assistant

                    **Role:** You are "Global Connect Assistant", the friendly and professional inquiry agent for Global Connect Shipping.
                    **Goal:** Help users seeking to buy used cars, heavy machinery, and tires (new/used), or ship them to West Africa, Europe, or Asia.

                    **Core Rules:**
                    1. **Scope:** Only answer questions about Inventory (Cars, Parts, Machinery), Shipping Rates, and "How it Works".
                    2. **Pricing Authority:** You CANNOT initiate discounts.
                    3. **Safety:** NEVER ask for credit card numbers in chat.
                    4. **Tone:** Professional, helpful, trustworthy, and clear.

                    **Knowledge Base:**
                    *   **Inventory:** Used Cars, New/Used Tires, Heavy Machinery Parts.
                    *   **Destinations:** West Africa (Conakry, Monrovia, Abidjan), Europe (Hamburg), Asia (Dubai, Tokyo).
                    *   **Services:** RoRo Shipping, Container Shipping, Parts Sourcing.
                                    </textarea>
            </div>
            <div style="flex:1;">
                <h3>Listing Generator</h3>
                <textarea readonly
                    style="width:100%; height:150px; font-family:monospace; background:#f0f0f1; padding:10px;">
                    Act as a professional car sales copywriter for "Global Connect Shipping".

                    **My Input:** Make/Model, Mileage, Condition
                    **Your Output:** Catchy Headline, Summary, Specs Bullet Points, Export Note.
                                    </textarea>
            </div>
        </div>
    </div>
<?php
}


/**
 * ============================================================
 * Feature: Custom User Registration Handler
 * ============================================================
 */
add_action('admin_post_nopriv_gc_custom_registration', 'gc_handle_custom_registration');
add_action('admin_post_gc_custom_registration', 'gc_handle_custom_registration');

function gc_handle_custom_registration()
{
    // Verify nonce
    if (!isset($_POST['gc_reg_nonce']) || !wp_verify_nonce($_POST['gc_reg_nonce'], 'gc_registration_nonce')) {
        wp_redirect(home_url('/login?action=register&register=failed'));
        exit;
    }

    // Sanitize inputs
    $full_name = isset($_POST['full_name']) ? sanitize_text_field($_POST['full_name']) : '';
    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $username = isset($_POST['username']) ? sanitize_user($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Validate required fields
    if (empty($full_name) || empty($email) || empty($username) || empty($password)) {
        wp_redirect(home_url('/login?action=register&register=failed&error=empty'));
        exit;
    }

    // Check if username already exists
    if (username_exists($username)) {
        wp_redirect(home_url('/login?action=register&register=failed&error=username'));
        exit;
    }

    // Check if email already exists
    if (email_exists($email)) {
        wp_redirect(home_url('/login?action=register&register=failed&error=email'));
        exit;
    }

    // Create user
    $user_id = wp_create_user($username, $password, $email);

    if (is_wp_error($user_id)) {
        wp_redirect(home_url('/login?action=register&register=failed'));
        exit;
    }

    // Update user meta
    wp_update_user(array(
        'ID' => $user_id,
        'display_name' => $full_name,
        'first_name' => explode(' ', $full_name)[0],
        'last_name' => implode(' ', array_slice(explode(' ', $full_name), 1))
    ));

    // Set user role to subscriber
    $user = new WP_User($user_id);
    $user->set_role('subscriber');

    // Send welcome email (optional)
    wp_new_user_notification($user_id, null, 'both');

    // Redirect to login with success message
    wp_redirect(home_url('/login?register=success'));
    exit;
}


/**
 * Customize login redirect
 */
add_filter('login_redirect', 'gc_login_redirect', 10, 3);
function gc_login_redirect($redirect_to, $request, $user)
{
    if (isset($user->roles) && is_array($user->roles)) {
        if (in_array('administrator', $user->roles)) {
            return admin_url();
        }
        return home_url('/dashboard');
    }
    return $redirect_to;
}


/**
 * Handle login failures
 */
add_action('wp_login_failed', 'gc_login_failed');
function gc_login_failed($username)
{
    $referrer = wp_get_referer();
    if ($referrer && strpos($referrer, 'wp-login.php') === false) {
        wp_redirect(home_url('/login?login=failed'));
        exit;
    }
}

add_filter('authenticate', 'gc_verify_login_fields', 1, 3);
function gc_verify_login_fields($user, $username, $password)
{
    if (isset($_POST['wp-submit'])) {
        if (empty($username) || empty($password)) {
            $referrer = wp_get_referer();
            if ($referrer && strpos($referrer, 'login') !== false) {
                wp_redirect(home_url('/login?login=empty'));
                exit;
            }
        }
    }
    return $user;
}


/**
 * ============================================================
 * SECURITY HARDENING
 * ============================================================
 */

/**
 * 1. Add Security Headers
 */
add_action('send_headers', 'gc_security_headers');
function gc_security_headers()
{
    if (!is_admin()) {
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header('X-XSS-Protection: 1; mode=block');
        header('Referrer-Policy: strict-origin-when-cross-origin');
        header('Permissions-Policy: camera=(), microphone=(), geolocation=()');
    }
}

/**
 * 2. Disable XML-RPC (common attack vector)
 */
add_filter('xmlrpc_enabled', '__return_false');

/**
 * 3. Remove WordPress version from head
 */
remove_action('wp_head', 'wp_generator');
add_filter('the_generator', '__return_empty_string');

/**
 * 4. Disable REST API for non-authenticated users (except needed endpoints)
 */
add_filter('rest_authentication_errors', function ($result) {
    if (true === $result || is_wp_error($result)) {
        return $result;
    }

    // Allow RankMath, chat, and public endpoints
    $allowed_routes = array('/wp/v2/posts', '/wp/v2/pages', '/rankmath/', '/gc/');
    $current_route = isset($GLOBALS['wp']->query_vars['rest_route']) ? $GLOBALS['wp']->query_vars['rest_route'] : '';

    foreach ($allowed_routes as $route) {
        if (strpos($current_route, $route) !== false) {
            return $result;
        }
    }

    if (!is_user_logged_in()) {
        return new WP_Error('rest_not_logged_in', 'Authentication required.', array('status' => 401));
    }

    return $result;
});

/**
 * 5. Rate limit registration (max 3 per IP per hour)
 */
add_action('admin_post_nopriv_gc_custom_registration', 'gc_registration_rate_check', 5);
function gc_registration_rate_check()
{
    $ip = sanitize_text_field($_SERVER['REMOTE_ADDR']);
    $key = 'gc_reg_limit_' . md5($ip);
    $count = get_transient($key) ?: 0;

    if ($count >= 3) {
        wp_redirect(home_url('/login?action=register&register=failed&error=ratelimit'));
        exit;
    }

    set_transient($key, $count + 1, HOUR_IN_SECONDS);
}

/**
 * 6. Disable file editing from WordPress admin
 */
if (!defined('DISALLOW_FILE_EDIT')) {
    define('DISALLOW_FILE_EDIT', true);
}

/**
 * 7. Hide login errors (don't reveal if username or password was wrong)
 */
add_filter('login_errors', function () {
    return 'Invalid credentials. Please try again.';
});

/**
 * 8. Sanitize file uploads
 */
add_filter('upload_mimes', function ($mimes) {
    unset($mimes['svg']);
    unset($mimes['svgz']);
    return $mimes;
});
