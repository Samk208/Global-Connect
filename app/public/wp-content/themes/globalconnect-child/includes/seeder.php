<?php

/**
 * Seeder: Populates the site with demo content if empty.
 */

if (!defined('ABSPATH')) {
    exit;
}

function globalconnect_seed_demo_content()
{
    // Check if we already have vehicles
    $args = array(
        'post_type' => 'vehicle',
        'post_status' => 'any',
        'posts_per_page' => 1,
    );
    $query = new WP_Query($args);

    // 1. Existing Demo Vehicles (USA)
    if (!$query->have_posts()) {
        // Demo Vehicles Data
        $vehicles = array(
            array(
                'title' => '2019 Toyota Camry SE',
                'desc' => 'Excellent condition, low mileage. Perfect for Conakry taxi service.',
                'meta' => array(
                    'vehicle_price' => '14,500',
                    'vehicle_mileage' => '45,000',
                    'vehicle_vin' => '4T1B11HK8KU123456',
                    'vehicle_year' => '2019',
                    'vehicle_demo_image' => 'https://images.unsplash.com/photo-1621007947382-bb3c3994e3fb?auto=format&fit=crop&q=80&w=800'
                ),
                'tax' => array(
                    'vehicle_make' => 'Toyota',
                    'vehicle_model' => 'Camry',
                    'vehicle_body_type' => 'Sedan',
                    'vehicle_status' => 'Available',
                    'vehicle_source' => 'USA'
                )
            ),
            array(
                'title' => '2020 Honda CR-V EX',
                'desc' => 'Spacious SUV, great for family. Ready to ship to Monrovia.',
                'meta' => array(
                    'vehicle_price' => '18,200',
                    'vehicle_mileage' => '32,000',
                    'vehicle_vin' => '5J6RW1H56LA654321',
                    'vehicle_year' => '2020',
                    'vehicle_demo_image' => 'https://images.unsplash.com/photo-1591166043424-bb97fbfca2d3?auto=format&fit=crop&q=80&w=800'
                ),
                'tax' => array(
                    'vehicle_make' => 'Honda',
                    'vehicle_model' => 'CR-V',
                    'vehicle_body_type' => 'SUV',
                    'vehicle_status' => 'Available',
                    'vehicle_source' => 'USA'
                )
            ),
            array(
                'title' => '2018 Ford Explorer XLT',
                'desc' => 'Rugged 7-seater. Ideal for Ivory Coast roads.',
                'meta' => array(
                    'vehicle_price' => '21,000',
                    'vehicle_mileage' => '58,000',
                    'vehicle_vin' => '1FM5K8D81JG987654',
                    'vehicle_year' => '2018'
                ),
                'tax' => array(
                    'vehicle_make' => 'Ford',
                    'vehicle_model' => 'Explorer',
                    'vehicle_body_type' => 'SUV',
                    'vehicle_status' => 'Pending',
                    'vehicle_source' => 'USA'
                )
            ),
            array(
                'title' => '2021 Toyota Corolla LE',
                'desc' => 'Fuel efficient and reliable. Best seller for Nigeria.',
                'meta' => array(
                    'vehicle_price' => '16,800',
                    'vehicle_mileage' => '12,500',
                    'vehicle_vin' => '2T1BURHE0MC246810',
                    'vehicle_year' => '2021'
                ),
                'tax' => array(
                    'vehicle_make' => 'Toyota',
                    'vehicle_model' => 'Corolla',
                    'vehicle_body_type' => 'Sedan',
                    'vehicle_status' => 'Available',
                    'vehicle_source' => 'USA'
                )
            ),
        );

        foreach ($vehicles as $car) {
            $post_id = wp_insert_post(array(
                'post_title' => $car['title'],
                'post_content' => $car['desc'],
                'post_status' => 'publish',
                'post_type' => 'vehicle',
            ));

            if ($post_id) {
                // Set Meta
                foreach ($car['meta'] as $key => $value) {
                    update_post_meta($post_id, $key, $value);
                }
                // Set Terms
                foreach ($car['tax'] as $tax => $term) {
                    wp_set_object_terms($post_id, $term, $tax);
                }
            }
        }
    }

    // 2. Add Europe Inventory (Check if exists first)
    $euro_check = new WP_Query(array('post_type' => 'vehicle', 'tax_query' => array(array('taxonomy' => 'vehicle_source', 'field' => 'slug', 'terms' => 'europe'))));
    if (!$euro_check->have_posts()) {
        $euro_vehicles = array(
            array(
                'title' => '2018 Mercedes-Benz Sprinter 2500',
                'desc' => 'High roof cargo van. Diesel engine. Perfect for logistics.',
                'meta' => array('vehicle_price' => '28,500', 'vehicle_mileage' => '85,000', 'vehicle_year' => '2018', 'vehicle_demo_image' => 'https://images.unsplash.com/photo-1559416523-140ddc3d238c?auto=format&fit=crop&q=80&w=800'),
                'tax' => array('vehicle_make' => 'Mercedes-Benz', 'vehicle_model' => 'Sprinter', 'vehicle_body_type' => 'Van', 'vehicle_status' => 'Available', 'vehicle_source' => 'Europe')
            ),
            array(
                'title' => '2019 DAF XF 480 Tractor Head',
                'desc' => 'Euro 6 standard. Clean cabin. Ready for export from Hamburg.',
                'meta' => array('vehicle_price' => '32,000', 'vehicle_mileage' => '450,000', 'vehicle_year' => '2019', 'vehicle_demo_image' => 'https://images.unsplash.com/photo-1601584115197-04ecc0da31d7?auto=format&fit=crop&q=80&w=800'),
                'tax' => array('vehicle_make' => 'DAF', 'vehicle_model' => 'XF', 'vehicle_body_type' => 'Truck', 'vehicle_status' => 'Available', 'vehicle_source' => 'Europe')
            )
        );
        foreach ($euro_vehicles as $car) {
            $pid = wp_insert_post(array('post_title' => $car['title'], 'post_content' => $car['desc'], 'post_status' => 'publish', 'post_type' => 'vehicle'));
            if ($pid) {
                foreach ($car['meta'] as $k => $v)
                    update_post_meta($pid, $k, $v);
                foreach ($car['tax'] as $t => $v)
                    wp_set_object_terms($pid, $v, $t);
            }
        }
    }

    // 3. Add China Inventory (Vehicles)
    $china_check = new WP_Query(array('post_type' => 'vehicle', 'tax_query' => array(array('taxonomy' => 'vehicle_source', 'field' => 'slug', 'terms' => 'china'))));
    if (!$china_check->have_posts()) {
        $china_vehicles = array(
            array(
                'title' => 'New Sinotruk Howo 371 Dump Truck',
                'desc' => 'Brand new 6x4 dump truck. 10 wheeler. Direct from factory.',
                'meta' => array('vehicle_price' => '42,000', 'vehicle_mileage' => '0', 'vehicle_year' => '2024', 'vehicle_demo_image' => 'https://images.unsplash.com/photo-1519003722824-194d4455a60c?auto=format&fit=crop&q=80&w=800'),
                'tax' => array('vehicle_make' => 'Sinotruk', 'vehicle_model' => 'Howo', 'vehicle_body_type' => 'Truck', 'vehicle_status' => 'Available', 'vehicle_source' => 'China')
            )
        );
        foreach ($china_vehicles as $car) {
            $pid = wp_insert_post(array('post_title' => $car['title'], 'post_content' => $car['desc'], 'post_status' => 'publish', 'post_type' => 'vehicle'));
            if ($pid) {
                foreach ($car['meta'] as $k => $v)
                    update_post_meta($pid, $k, $v);
                foreach ($car['tax'] as $t => $v)
                    wp_set_object_terms($pid, $v, $t);
            }
        }
    }

    // Also seed a demo Shipment
    $ship_id = wp_insert_post(array(
        'post_title' => 'GC-1001-US', // Tracking Number
        'post_status' => 'publish',
        'post_type' => 'shipment',
    ));
    if ($ship_id) {
        update_post_meta($ship_id, 'shipment_status', 'In Transit');
        update_post_meta($ship_id, 'current_location', 'Atlantic Ocean (Near Canary Islands)');
        update_post_meta($ship_id, 'estimated_arrival', '2026-02-15');
    }

    // Seed Parts & Machinery
    $parts_check = new WP_Query(array('post_type' => 'part', 'posts_per_page' => 1));
    if (!$parts_check->have_posts()) {
        $parts = array(
            array(
                'title' => 'Caterpillar 320D Excavator',
                'desc' => 'Reliable heavy machinery for construction. 2015 model, good tracks.',
                'cat' => 'Machinery',
                'source' => 'China',
                'price' => '45000',
                'condition' => 'Used',
                'image' => 'https://images.unsplash.com/photo-1581094794329-c8112a89af12?auto=format&fit=crop&q=80&w=800'
            ),
            array(
                'title' => 'Container of Used Tires (Mix Sizes)',
                'desc' => 'Bulk container of Grade A/B used tires. 13-18 inch mix. Approx 1500 pcs.',
                'cat' => 'Tires',
                'source' => 'China',
                'price' => '3500',
                'condition' => 'Used',
                'image' => 'https://images.unsplash.com/photo-1545093149-618ce3bcf49d?auto=format&fit=crop&q=80&w=800'
            ),
            array(
                'title' => 'Komatsu D65 Dozer',
                'desc' => 'Powerful dozer ready for export. Blade included.',
                'cat' => 'Machinery',
                'source' => 'China',
                'price' => '38000',
                'condition' => 'Used'
            ),
            array(
                'title' => 'Mercedes OM642 Engine',
                'desc' => 'V6 Diesel engine for Sprinter/E-Class. Tested and palletized.',
                'cat' => 'Parts',
                'source' => 'Europe',
                'price' => '3200',
                'condition' => 'Used'
            ),
            array(
                'title' => 'New Truck Tires 295/80R22.5',
                'desc' => 'Set of 10 New Chinese Brand truck tires. Heavy duty.',
                'cat' => 'Tires',
                'source' => 'China',
                'price' => '2200',
                'condition' => 'New'
            ),
        );

        foreach ($parts as $part) {
            $pid = wp_insert_post(array(
                'post_title' => $part['title'],
                'post_content' => $part['desc'],
                'post_status' => 'publish',
                'post_type' => 'part',
            ));
            if ($pid) {
                update_post_meta($pid, 'part_price', $part['price']);
                update_post_meta($pid, 'part_condition', $part['condition']);
                if (isset($part['image'])) {
                    update_post_meta($pid, 'part_demo_image', $part['image']);
                }
                wp_set_object_terms($pid, $part['cat'], 'part_category');
                wp_set_object_terms($pid, $part['source'], 'vehicle_source');
            }
        }
    }

    // 4. Migration: Assign 'USA' to any existing vehicles missing a source
    $missing_source_query = new WP_Query(array(
        'post_type' => 'vehicle',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'vehicle_source',
                'operator' => 'NOT EXISTS'
            )
        )
    ));

    if ($missing_source_query->have_posts()) {
        while ($missing_source_query->have_posts()) {
            $missing_source_query->the_post();
            wp_set_object_terms(get_the_ID(), 'USA', 'vehicle_source');
        }
        wp_reset_postdata();
    }
    // 5. Create Core Pages and Assign Templates
    $pages = array(
        'home' => array('title' => 'Home', 'template' => 'page-landing.php'),
        'shop' => array('title' => 'Inventory', 'template' => 'page-shop.php'),
        'track' => array('title' => 'Track Shipment', 'template' => 'page-track.php'),
        'about' => array('title' => 'About Us', 'template' => 'page-about.php'),
        'contact' => array('title' => 'Contact Us', 'template' => 'page-contact.php'),
        'china-sourcing' => array('title' => 'China Direct', 'template' => 'page-china-sourcing.php'),
        'dashboard' => array('title' => 'My Dashboard', 'template' => 'page-dashboard.php'),
        'login' => array('title' => 'Login / Register', 'template' => 'page-login.php'),
        'how-it-works' => array('title' => 'How It Works', 'template' => 'page-how-it-works.php'),
    );

    foreach ($pages as $slug => $page_data) {
        $existing_page = get_page_by_path($slug);
        if (!$existing_page) {
            $page_id = wp_insert_post(array(
                'post_title' => $page_data['title'],
                'post_name' => $slug,
                'post_status' => 'publish',
                'post_type' => 'page',
                'post_content' => '', // Content is handled by template
            ));

            if ($page_id && !is_wp_error($page_id)) {
                update_post_meta($page_id, '_wp_page_template', $page_data['template']);

                // Set Homepage
                if ($slug === 'home') {
                    update_option('show_on_front', 'page');
                    update_option('page_on_front', $page_id);
                }
            }
        } else {
            // Ensure template is assigned even if page exists
            $current_template = get_post_meta($existing_page->ID, '_wp_page_template', true);
            if ($current_template !== $page_data['template']) {
                update_post_meta($existing_page->ID, '_wp_page_template', $page_data['template']);
            }

            // Ensure Homepage setting
            if ($slug === 'home' && get_option('page_on_front') != $existing_page->ID) {
                update_option('show_on_front', 'page');
                update_option('page_on_front', $existing_page->ID);
            }
        }
    }
}
add_action('init', 'globalconnect_seed_demo_content');
