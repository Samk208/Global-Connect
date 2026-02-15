<?php

/**
 * RankMath SEO Pro Integration for GlobalConnect
 * 
 * Enhances custom post types (vehicle, part) with:
 * - Schema markup (Product schema)
 * - Open Graph image fallback
 * - Custom SEO titles & descriptions
 * - Sitemap priorities
 * - Breadcrumb customization
 * - Content analysis tweaks
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * ============================================================
 * 1. Schema Markup: Product Schema for Vehicles & Parts
 * ============================================================
 * RankMath Pro will auto-generate schema, but we provide structured
 * data hints so it generates accurate Product schema.
 */
add_filter('rank_math/json_ld', 'gc_custom_schema_markup', 99, 2);
function gc_custom_schema_markup($data, $jsonld)
{
    if (is_singular('vehicle')) {
        $post_id = get_the_ID();
        $price = get_post_meta($post_id, 'vehicle_price', true);
        $year = get_post_meta($post_id, 'vehicle_year', true);
        $mileage = get_post_meta($post_id, 'vehicle_mileage', true);
        $makes = get_the_terms($post_id, 'vehicle_make');
        $models = get_the_terms($post_id, 'vehicle_model');
        $sources = get_the_terms($post_id, 'vehicle_source');

        $vehicle_schema = array(
            '@type' => 'Product',
            '@id' => get_permalink($post_id) . '#product',
            'name' => get_the_title($post_id),
            'description' => get_the_excerpt($post_id) ?: wp_trim_words(get_the_content(), 50),
            'url' => get_permalink($post_id),
            'brand' => array(
                '@type' => 'Brand',
                'name' => ($makes && !is_wp_error($makes)) ? $makes[0]->name : 'GlobalConnect'
            ),
            'category' => 'Vehicles',
            'additionalProperty' => array()
        );

        // Add image
        if (has_post_thumbnail($post_id)) {
            $vehicle_schema['image'] = get_the_post_thumbnail_url($post_id, 'large');
        } else {
            $demo_img = get_post_meta($post_id, 'vehicle_demo_image', true);
            if ($demo_img) {
                $vehicle_schema['image'] = $demo_img;
            }
        }

        // Add offers/pricing
        if ($price) {
            $vehicle_schema['offers'] = array(
                '@type' => 'Offer',
                'price' => $price,
                'priceCurrency' => 'USD',
                'availability' => 'https://schema.org/InStock',
                'seller' => array(
                    '@type' => 'Organization',
                    'name' => 'GlobalConnect',
                    'url' => home_url()
                )
            );
        }

        // Vehicle-specific properties
        if ($year) {
            $vehicle_schema['additionalProperty'][] = array(
                '@type' => 'PropertyValue',
                'name' => 'Year',
                'value' => $year
            );
        }
        if ($mileage) {
            $vehicle_schema['additionalProperty'][] = array(
                '@type' => 'PropertyValue',
                'name' => 'Mileage',
                'value' => $mileage . ' miles'
            );
        }
        if ($models && !is_wp_error($models)) {
            $vehicle_schema['additionalProperty'][] = array(
                '@type' => 'PropertyValue',
                'name' => 'Model',
                'value' => $models[0]->name
            );
        }
        if ($sources && !is_wp_error($sources)) {
            $vehicle_schema['additionalProperty'][] = array(
                '@type' => 'PropertyValue',
                'name' => 'Source Country',
                'value' => $sources[0]->name
            );
        }

        $data['ProductSchema'] = $vehicle_schema;
    }

    if (is_singular('part')) {
        $post_id = get_the_ID();
        $price = get_post_meta($post_id, 'part_price', true);
        $condition = get_post_meta($post_id, 'part_condition', true);
        $categories = get_the_terms($post_id, 'part_category');

        $part_schema = array(
            '@type' => 'Product',
            '@id' => get_permalink($post_id) . '#product',
            'name' => get_the_title($post_id),
            'description' => get_the_excerpt($post_id) ?: wp_trim_words(get_the_content(), 50),
            'url' => get_permalink($post_id),
            'brand' => array(
                '@type' => 'Brand',
                'name' => 'GlobalConnect'
            ),
            'category' => ($categories && !is_wp_error($categories)) ? $categories[0]->name : 'Parts & Tires'
        );

        if (has_post_thumbnail($post_id)) {
            $part_schema['image'] = get_the_post_thumbnail_url($post_id, 'large');
        } else {
            $demo_img = get_post_meta($post_id, 'part_demo_image', true);
            if ($demo_img) {
                $part_schema['image'] = $demo_img;
            }
        }

        if ($price) {
            $part_schema['offers'] = array(
                '@type' => 'Offer',
                'price' => $price,
                'priceCurrency' => 'USD',
                'availability' => 'https://schema.org/InStock',
                'itemCondition' => ($condition === 'New') ? 'https://schema.org/NewCondition' : 'https://schema.org/UsedCondition',
                'seller' => array(
                    '@type' => 'Organization',
                    'name' => 'GlobalConnect',
                    'url' => home_url()
                )
            );
        }

        if ($condition) {
            $part_schema['additionalProperty'][] = array(
                '@type' => 'PropertyValue',
                'name' => 'Condition',
                'value' => $condition
            );
        }

        $data['ProductSchema'] = $part_schema;
    }

    // Organization schema for homepage
    if (is_front_page()) {
        $data['Organization'] = array(
            '@type' => 'Organization',
            '@id' => home_url() . '#organization',
            'name' => 'GlobalConnect',
            'url' => home_url(),
            'description' => 'Vehicle and machinery export from USA and China to West Africa',
            'address' => array(
                '@type' => 'PostalAddress',
                'streetAddress' => '5909 Elmwood Avenue',
                'addressLocality' => 'Philadelphia',
                'addressRegion' => 'PA',
                'postalCode' => '19143',
                'addressCountry' => 'US'
            ),
            'sameAs' => array(
                'https://www.facebook.com/profile.php?id=100071518400878'
            )
        );
    }

    return $data;
}


/**
 * ============================================================
 * 2. Open Graph Image Fallback for Custom Post Types
 * ============================================================
 */
add_filter('rank_math/opengraph/facebook/image', 'gc_og_image_fallback');
add_filter('rank_math/opengraph/twitter/image', 'gc_og_image_fallback');
function gc_og_image_fallback($image)
{
    if (!empty($image)) {
        return $image;
    }

    $post_id = get_the_ID();

    if (get_post_type($post_id) === 'vehicle') {
        if (has_post_thumbnail($post_id)) {
            return get_the_post_thumbnail_url($post_id, 'large');
        }
        $demo = get_post_meta($post_id, 'vehicle_demo_image', true);
        if ($demo) return $demo;
    }

    if (get_post_type($post_id) === 'part') {
        if (has_post_thumbnail($post_id)) {
            return get_the_post_thumbnail_url($post_id, 'large');
        }
        $demo = get_post_meta($post_id, 'part_demo_image', true);
        if ($demo) return $demo;
    }

    return $image;
}


/**
 * ============================================================
 * 3. Custom SEO Titles & Descriptions for CPTs
 * ============================================================
 */
add_filter('rank_math/frontend/title', 'gc_custom_seo_titles');
function gc_custom_seo_titles($title)
{
    if (is_singular('vehicle')) {
        $post_id = get_the_ID();
        $year = get_post_meta($post_id, 'vehicle_year', true);
        $makes = get_the_terms($post_id, 'vehicle_make');
        $make_name = ($makes && !is_wp_error($makes)) ? $makes[0]->name : '';

        if ($year && $make_name) {
            $custom_title = $year . ' ' . $make_name . ' ' . get_the_title() . ' For Export | GlobalConnect';
            // Only use custom title if RankMath hasn't set one
            if (strpos($title, 'GlobalConnect') === false && strpos($title, get_the_title()) !== false) {
                return $custom_title;
            }
        }
    }

    if (is_singular('part')) {
        $post_id = get_the_ID();
        $condition = get_post_meta($post_id, 'part_condition', true);
        $categories = get_the_terms($post_id, 'part_category');
        $cat_name = ($categories && !is_wp_error($categories)) ? $categories[0]->name : 'Part';

        if ($condition) {
            $custom_title = get_the_title() . ' - ' . $condition . ' ' . $cat_name . ' | GlobalConnect';
            if (strpos($title, 'GlobalConnect') === false && strpos($title, get_the_title()) !== false) {
                return $custom_title;
            }
        }
    }

    if (is_post_type_archive('vehicle')) {
        return 'Used Vehicles for Export to Africa | GlobalConnect Inventory';
    }

    if (is_post_type_archive('part')) {
        return 'Auto Parts & Tires for Export | GlobalConnect Parts';
    }

    return $title;
}

add_filter('rank_math/frontend/description', 'gc_custom_seo_descriptions');
function gc_custom_seo_descriptions($description)
{
    if (!empty($description)) {
        return $description;
    }

    if (is_singular('vehicle')) {
        $post_id = get_the_ID();
        $year = get_post_meta($post_id, 'vehicle_year', true);
        $price = get_post_meta($post_id, 'vehicle_price', true);
        $makes = get_the_terms($post_id, 'vehicle_make');
        $make_name = ($makes && !is_wp_error($makes)) ? $makes[0]->name : '';

        $desc = 'Export-ready ' . ($year ? $year . ' ' : '') . $make_name . ' ' . get_the_title();
        if ($price) {
            $desc .= ' starting at $' . $price;
        }
        $desc .= '. Direct shipping to West Africa from Philadelphia. Request a quote today.';
        return wp_trim_words($desc, 30);
    }

    if (is_singular('part')) {
        $post_id = get_the_ID();
        $condition = get_post_meta($post_id, 'part_condition', true);
        $price = get_post_meta($post_id, 'part_price', true);

        $desc = ($condition ? $condition . ' ' : '') . get_the_title();
        if ($price) {
            $desc .= ' - $' . $price;
        }
        $desc .= '. Quality auto parts and tires shipped worldwide by GlobalConnect.';
        return wp_trim_words($desc, 30);
    }

    return $description;
}


/**
 * ============================================================
 * 4. Sitemap Priority Hints for RankMath
 * ============================================================
 */
add_filter('rank_math/sitemap/entry', 'gc_sitemap_priorities', 10, 3);
function gc_sitemap_priorities($url, $type, $object)
{
    if (isset($object->post_type)) {
        if ($object->post_type === 'vehicle') {
            $url['priority'] = 0.8;
            $url['changefreq'] = 'weekly';
        }
        if ($object->post_type === 'part') {
            $url['priority'] = 0.7;
            $url['changefreq'] = 'weekly';
        }
    }
    return $url;
}


/**
 * ============================================================
 * 5. Breadcrumb Customization for RankMath
 * ============================================================
 */
add_filter('rank_math/frontend/breadcrumb/items', 'gc_custom_breadcrumbs');
function gc_custom_breadcrumbs($crumbs)
{
    if (is_singular('vehicle')) {
        // Ensure "Vehicles" archive link is in breadcrumb
        $has_archive = false;
        foreach ($crumbs as $crumb) {
            if (isset($crumb[1]) && strpos($crumb[1], 'vehicle') !== false) {
                $has_archive = true;
                break;
            }
        }
        if (!$has_archive && count($crumbs) > 1) {
            array_splice($crumbs, 1, 0, array(
                array('Vehicles', get_post_type_archive_link('vehicle'))
            ));
        }
    }

    if (is_singular('part')) {
        $has_archive = false;
        foreach ($crumbs as $crumb) {
            if (isset($crumb[1]) && strpos($crumb[1], 'part') !== false) {
                $has_archive = true;
                break;
            }
        }
        if (!$has_archive && count($crumbs) > 1) {
            array_splice($crumbs, 1, 0, array(
                array('Parts & Tires', get_post_type_archive_link('part'))
            ));
        }
    }

    return $crumbs;
}


/**
 * ============================================================
 * 6. Add Custom Post Types to RankMath Sitemap
 * ============================================================
 */
add_filter('rank_math/sitemap/post_types', 'gc_add_cpt_to_sitemap');
function gc_add_cpt_to_sitemap($post_types)
{
    $post_types['vehicle'] = 'vehicle';
    $post_types['part'] = 'part';
    return $post_types;
}

add_filter('rank_math/sitemap/taxonomies', 'gc_add_tax_to_sitemap');
function gc_add_tax_to_sitemap($taxonomies)
{
    $taxonomies['vehicle_make'] = 'vehicle_make';
    $taxonomies['vehicle_model'] = 'vehicle_model';
    $taxonomies['vehicle_body_type'] = 'vehicle_body_type';
    $taxonomies['part_category'] = 'part_category';
    return $taxonomies;
}


/**
 * ============================================================
 * 7. Canonical URL Cleanup for Filtered Pages
 * ============================================================
 */
add_filter('rank_math/frontend/canonical', 'gc_clean_canonical');
function gc_clean_canonical($canonical)
{
    // Remove filter params from canonical to avoid duplicate content
    if (is_post_type_archive('vehicle') || is_post_type_archive('part')) {
        $canonical = strtok($canonical, '?');
    }
    return $canonical;
}


/**
 * ============================================================
 * 8. Add noindex to Login/Register pages
 * ============================================================
 */
add_filter('rank_math/frontend/robots', 'gc_noindex_auth_pages');
function gc_noindex_auth_pages($robots)
{
    if (is_page_template('page-login.php') || is_page_template('page-dashboard.php')) {
        $robots['index'] = 'noindex';
        $robots['follow'] = 'nofollow';
    }
    return $robots;
}
