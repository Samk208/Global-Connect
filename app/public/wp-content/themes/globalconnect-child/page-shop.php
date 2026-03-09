<?php

/**
 * Template Name: Unified Shop
 * Description: A single page to browse both Vehicles and Parts.
 */

get_header();

// Get filter params
$category = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : 'all';
$search = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';
$orderby = isset($_GET['orderby']) ? sanitize_text_field($_GET['orderby']) : 'date_desc';

// Determine post type and taxonomy based on category
$args = array(
    'posts_per_page' => 12,
    'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
    'post_status' => 'publish',
    's' => $search
);

switch ($category) {
    case 'vehicles':
        $args['post_type'] = 'vehicle';
        break;
    case 'tires':
        $args['post_type'] = 'part';
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'part_category',
                'field' => 'slug',
                'terms' => 'tires'
            )
        );
        break;
    case 'machines-parts':
        $args['post_type'] = 'part';
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'part_category',
                'field' => 'slug',
                'terms' => array('machinery', 'parts'),
                'operator' => 'IN'
            )
        );
        break;
    default: // 'all'
        $args['post_type'] = array('vehicle', 'part');
        break;
}

// Sorting
switch ($orderby) {
    case 'price_asc':
        $args['meta_key'] = 'vehicle_price'; // Note: parts also use part_price. Handling mixed meta is tricky.
        $args['orderby'] = 'meta_value_num';
        $args['order'] = 'ASC';
        break;
    case 'price_desc':
        $args['meta_key'] = 'vehicle_price';
        $args['orderby'] = 'meta_value_num';
        $args['order'] = 'DESC';
        break;
    case 'popularity':
        $args['meta_key'] = 'gc_inquiry_count';
        $args['orderby'] = 'meta_value_num';
        $args['order'] = 'DESC';
        break;
    default:
        $args['orderby'] = 'date';
        $args['order'] = 'DESC';
        break;
}

$query = new WP_Query($args);
?>

<div class="gc-shop-page gc-shop-enhanced">
    <!-- Hero Section with Category Tabs -->
    <section class="gc-shop-hero"
        style="background: #0F172A; padding: 60px 0; color: white; position: relative; overflow: hidden;">
        <!-- Background Tech Grid -->
        <div
            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: linear-gradient(rgba(255, 255, 255, 0.05) 1px, transparent 1px), linear-gradient(90deg, rgba(255, 255, 255, 0.05) 1px, transparent 1px); background-size: 40px 40px; opacity: 0.3; pointer-events: none;">
        </div>

        <div class="gc-container" style="position: relative; z-index: 2;">
            <?php if (function_exists('rank_math_the_breadcrumbs'))
                rank_math_the_breadcrumbs(); ?>

            <div class="gc-shop-hero-content" style="text-align: center; max-width: 900px; margin: 0 auto;">
                <span class="gc-header-data"
                    style="color: var(--gc-gold); text-shadow: 0 2px 10px rgba(0,0,0,0.3);">GLOBAL + INVENTORY +
                    DATABASE</span>
                <h1 class="gc-hero-title"
                    style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 3.5rem; text-transform: uppercase; color: #ffffff; text-shadow: 0 4px 30px rgba(0,0,0,0.5);">
                    Export<span class="gc-tech-divider"
                        style="color: var(--gc-blue-accent); opacity: 0.8;">\</span>Ready<span class="gc-tech-divider"
                        style="color: var(--gc-blue-accent); opacity: 0.8;">\</span>Stock
                </h1>
                <p class="gc-hero-subtitle"
                    style="font-family: var(--gc-font-mono); font-size: 0.9rem; color: #e2e8f0; letter-spacing: 1px; margin-top: 15px; text-shadow: 0 2px 4px rgba(0,0,0,0.3);">
                    DIRECT SHIPPING TO WEST AFRICA /// 100% VIN VERIFIED /// 3-5 DAY PROCESSING
                </p>

                <!-- Category Tab Navigation (Glassmorphism) -->
                <div class="gc-category-tabs"
                    style="display: inline-flex; gap: 10px; margin-top: 40px; background: rgba(255,255,255,0.1); padding: 8px; border-radius: 50px; backdrop-filter: blur(10px);">
                    <button class="gc-tab-btn <?php echo $category === 'all' ? 'active' : ''; ?>" data-category="all"
                        style="background: <?php echo $category === 'all' ? 'var(--gc-gold)' : 'transparent'; ?>; color: <?php echo $category === 'all' ? '#000' : '#fff'; ?>; border: none; padding: 10px 24px; border-radius: 40px; font-weight: 600; cursor: pointer; transition: 0.3s;">
                        All Items
                    </button>
                    <button class="gc-tab-btn <?php echo $category === 'vehicles' ? 'active' : ''; ?>"
                        data-category="vehicles"
                        style="background: <?php echo $category === 'vehicles' ? 'var(--gc-gold)' : 'transparent'; ?>; color: <?php echo $category === 'vehicles' ? '#000' : '#fff'; ?>; border: none; padding: 10px 24px; border-radius: 40px; font-weight: 600; cursor: pointer; transition: 0.3s;">
                        Vehicles
                    </button>
                    <button class="gc-tab-btn <?php echo $category === 'machines-parts' ? 'active' : ''; ?>"
                        data-category="machines-parts"
                        style="background: <?php echo $category === 'machines-parts' ? 'var(--gc-gold)' : 'transparent'; ?>; color: <?php echo $category === 'machines-parts' ? '#000' : '#fff'; ?>; border: none; padding: 10px 24px; border-radius: 40px; font-weight: 600; cursor: pointer; transition: 0.3s;">
                        Machinery
                    </button>
                    <button class="gc-tab-btn <?php echo $category === 'tires' ? 'active' : ''; ?>"
                        data-category="tires"
                        style="background: <?php echo $category === 'tires' ? 'var(--gc-gold)' : 'transparent'; ?>; color: <?php echo $category === 'tires' ? '#000' : '#fff'; ?>; border: none; padding: 10px 24px; border-radius: 40px; font-weight: 600; cursor: pointer; transition: 0.3s;">
                        Tires
                    </button>
                </div>

                <!-- Enhanced Search Bar -->
                <form method="get" class="gc-hero-search"
                    style="max-width: 600px; margin: 30px auto 0; position: relative;">
                    <input type="hidden" name="category" id="gc-selected-category"
                        value="<?php echo esc_attr($category); ?>">
                    <div class="gc-search-wrapper"
                        style="display: flex; background: white; border-radius: 8px; overflow: hidden; padding: 4px;">
                        <input type="text" name="s" value="<?php echo esc_attr($search); ?>"
                            placeholder="Search VIN, Make, Model..."
                            style="flex: 1; border: none; padding: 12px 20px; outline: none; font-family: var(--gc-font-mono); font-size: 0.9rem;" />
                        <button type="submit" class="gc-search-btn"
                            style="background: var(--gc-blue-primary); color: white; border: none; padding: 0 30px; border-radius: 6px; font-weight: 700; cursor: pointer;">SEARCH</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Filters & Results Section -->
    <div class="gc-container gc-shop-content" style="padding: 40px 20px;">
        <div class="gc-shop-toolbar"
            style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 1px solid #e2e8f0; padding-bottom: 20px;">
            <div class="gc-result-info" style="font-family: var(--gc-font-mono); font-size: 0.9rem; color: #64748b;">
                <strong>DATABASE:</strong> <?php echo $query->found_posts + 3; ?> Items Available
                <?php if ($search): ?>
                    <span class="gc-search-term">| QUERY: "<?php echo esc_html($search); ?>"</span>
                    <a href="<?php echo get_permalink(); ?>" class="gc-clear-search"
                        style="color: var(--gc-red-china); margin-left: 10px; text-decoration: none;">[CLEAR]</a>
                <?php endif; ?>
            </div>
            <div class="gc-sorting-dropdown" style="font-family: var(--gc-font-mono); font-size: 0.9rem;">
                <label style="color:#94a3b8; margin-right: 10px;">SORT_BY:</label>
                <form method="get" style="display:inline-block;">
                    <input type="hidden" name="category" value="<?php echo esc_attr($category); ?>">
                    <select name="orderby" onchange="this.form.submit()"
                        style="border: 1px solid #cbd5e1; padding: 5px 10px; border-radius: 4px;">
                        <option value="date_desc" <?php selected($orderby, 'date_desc'); ?>>NEWEST_ARRIVAL</option>
                        <option value="price_asc" <?php selected($orderby, 'price_asc'); ?>>PRICE_ASC</option>
                        <option value="price_desc" <?php selected($orderby, 'price_desc'); ?>>PRICE_DESC</option>
                    </select>
                </form>
            </div>
        </div>

        <main class="gc-shop-results">

            <div class="gc-inventory-grid"
                style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 30px;">

                <?php 
                // MOCK CONTENT: ALWAYS SHOW 3 PREMIUM TECH CARDS FIRST (As requested for appearance)
                $all_mock_items = [
                    [
                        'id' => 'CN-9921',
                        'title' => 'Sinotruk Howo 371HP Dump Truck',
                        'type' => 'vehicles',
                        'price' => '28,500', 
                        'badge' => 'CHINA DIRECT',
                        'data' => ['POWER' => '371 HP', 'AXLE' => '6x4', 'FUEL' => 'Diesel'],
                        'image' => content_url('/uploads/2026/03/sinotruk-howo-8x4-slider.jpg'),
                        'status' => 'FACTORY NEW'
                    ],
                     [
                        'id' => 'USA-4002',
                        'title' => '2020 Toyota Camry SE',
                        'type' => 'vehicles',
                        'price' => '14,200', 
                        'badge' => 'USA STOCK',
                        'data' => ['MILEAGE' => '45k mi', 'TITLE' => 'Clean', 'LOC' => 'Newark, NJ'],
                        'image' => content_url('/uploads/2026/03/suvs-sedans.jpg'),
                        'status' => 'READY TO SHIP'
                    ],
                    [
                        'id' => 'EU-1102',
                        'title' => 'Mercedes Actros 2645',
                        'type' => 'vehicles',
                        'price' => '32,000', 
                        'badge' => 'EUROPE STOCK',
                        'data' => ['YEAR' => '2019', 'AXLE' => '6x2', 'LOC' => 'Antwerp'],
                        'image' => content_url('/uploads/2026/03/heavy-trucks-fleet.jpg'),
                        'status' => 'IN TRANSIT'
                    ],
                    [
                        'id' => 'CAT-2201',
                        'title' => 'Caterpillar 320D Excavator',
                        'type' => 'machines-parts',
                        'price' => '41,000', 
                        'badge' => 'HEAVY MACH',
                        'data' => ['HOURS' => '4200h', 'BUCKET' => '1.0m3', 'LOC' => 'Shanghai'],
                        'image' => content_url('/uploads/2026/03/construction-equipment.jpg'),
                        'status' => 'INSPECTION PASSED'
                    ],
                    [
                       'id' => 'PART-5590',
                       'title' => 'Komatsu PC200 Hydraulic Pump',
                       'type' => 'machines-parts',
                       'price' => '1,850', 
                       'badge' => 'SPARE PART',
                       'data' => ['COND' => 'Rebuilt', 'WARRANTY' => '6 Mo', 'ORIGIN' => 'Japan'],
                       'image' => content_url('/uploads/2026/03/parts-components.jpg'),
                       'status' => 'IN STOCK'
                   ],
                   [
                       'id' => 'TIRE-X100',
                       'title' => 'Michelin X Multi 315/80 R22.5',
                       'type' => 'tires',
                       'price' => '380', 
                       'badge' => 'PREMIUM TIRE',
                       'data' => ['SIZE' => '315/80', 'RATING' => '156/150L', 'PLY' => '18'],
                       'image' => content_url('/uploads/2026/03/tires-warehouse.jpg'),
                       'status' => 'BULK AVAILABLE'
                   ]
                ];

                // Filter Logic
                $active_mock_items = [];
                foreach($all_mock_items as $item) {
                    if ($category === 'all' || $item['type'] === $category) {
                        $active_mock_items[] = $item;
                    }
                }
                
                // Show only up to 3 relevant mock items
                $active_mock_items = array_slice($active_mock_items, 0, 3);

                foreach($active_mock_items as $item): ?>
                    <article class="gc-card-tech">
                        <div class="gc-card-tech-header">
                            <span>ID: <?php echo $item['id']; ?></span>
                            <span><?php echo $item['status']; ?></span>
                        </div>
                        <div class="gc-card-tech-image">
                            <div class="gc-tech-badge"><?php echo $item['badge']; ?></div>
                            <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>">
                        </div>
                        <div class="gc-card-tech-body">
                            <h3><?php echo $item['title']; ?></h3>
                            <div class="gc-tech-grid">
                                <?php foreach($item['data'] as $k => $v): ?>
                                    <div class="gc-tech-data-point"><span><?php echo $k; ?></span><?php echo $v; ?></div>
                                <?php endforeach; ?>
                                <div class="gc-tech-data-point"><span>PRICE</span><span style="color:var(--gc-gold); font-weight:bold;">$<?php echo $item['price']; ?></span></div>
                            </div>
                            <a href="#" class="gc-btn-tech">View Data Sheet</a>
                        </div>
                    </article>
                <?php endforeach; ?>

                <?php if ($query->have_posts()): ?>
                    <?php while ($query->have_posts()):
                        $query->the_post();
                        $type = get_post_type();
                        $price = ($type == 'vehicle') ? get_post_meta(get_the_ID(), 'vehicle_price', true) : get_post_meta(get_the_ID(), 'part_price', true);
                        $demo_image = ($type == 'vehicle') ? get_post_meta(get_the_ID(), 'vehicle_demo_image', true) : get_post_meta(get_the_ID(), 'part_demo_image', true);

                        // Data Points Logic
                        $year = get_post_meta(get_the_ID(), 'vehicle_year', true);
                        $mileage = get_post_meta(get_the_ID(), 'vehicle_mileage', true);
                        $condition = get_post_meta(get_the_ID(), 'part_condition', true);

                        $data_points = [];
                        if ($year)
                            $data_points['YEAR'] = $year;
                        if ($mileage)
                            $data_points['MILEAGE'] = $mileage;
                        if ($condition)
                            $data_points['COND'] = $condition;
                        $data_points['TYPE'] = ($type == 'vehicle') ? 'Vehicle' : 'Part';
                        ?>
                        <article class="gc-card-tech">
                            <div class="gc-card-tech-header">
                                <span>ID: GC-<?php the_ID(); ?></span>
                                <span>AVAILABLE</span>
                            </div>
                            <div class="gc-card-tech-image">
                                <?php if (has_post_thumbnail()): the_post_thumbnail('medium_large');
                                elseif ($demo_image):
                                    echo '<img src="' . esc_url($demo_image) . '">';
                                else: ?>
                                    <div
                                        style="width:100%; height:100%; background:#f1f5f9; display:flex; align-items:center; justify-content:center; flex-direction:column; color:#94a3b8;">
                                        <span class="dashicons dashicons-format-image"
                                            style="font-size:40px; width:40px; height:40px;"></span>
                                        <span
                                            style="font-family:var(--gc-font-mono); font-size:12px; margin-top:10px;">NO_IMAGE_DATA</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="gc-card-tech-body">
                                <h3><a href="<?php the_permalink(); ?>"
                                        style="text-decoration:none; color:inherit;"><?php the_title(); ?></a></h3>
                                <div class="gc-tech-grid">
                                    <?php foreach ($data_points as $k => $v): ?>
                                        <div class="gc-tech-data-point"><span><?php echo $k; ?></span><?php echo esc_html($v); ?>
                                        </div>
                                    <?php endforeach; ?>
                                    <div class="gc-tech-data-point"><span>PRICE</span><span
                                            style="color:var(--gc-gold); font-weight:bold;"><?php echo $price ? '$' . esc_html($price) : 'Quote'; ?></span>
                                    </div>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="gc-btn-tech">View Details</a>
                            </div>
                        </article>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                <?php endif; ?>
            </div>

            <div class="gc-pagination" style="margin-top: 50px; text-align: center; font-family: var(--gc-font-mono);">
                <?php
                echo paginate_links(array(
                    'total' => $query->max_num_pages,
                    'current' => max(1, get_query_var('paged')),
                    'prev_text' => '&larr; PREV',
                    'next_text' => 'NEXT &rarr;'
                ));
                ?>
            </div>

        </main>
    </div>
</div>

<script>
    jQuery(document).ready(function ($) {
        // Simple Interaction for Tabs
        $('.gc-tab-btn').on('click', function () {
            const category = $(this).data('category');
            const currentUrl = new URL(window.location.href);
            if (category && category !== 'all') {
                currentUrl.searchParams.set('category', category);
            } else {
                currentUrl.searchParams.delete('category');
            }
            currentUrl.searchParams.delete('paged');
            window.location.href = currentUrl.toString();
        });
    });
</script>

<?php get_footer(); ?>