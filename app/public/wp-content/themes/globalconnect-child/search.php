<?php

/**
 * The template for displaying search results pages.
 * Enhanced with Deep Tech design and filtering.
 */

get_header();

// Get WhatsApp from settings
$whatsapp = get_option('gc_whatsapp_number', '12672900254');

// Get filter parameter
$filter_type = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : 'all';
$search_query = get_search_query();
?>

<div id="gc-search-results">

    <!-- Hero Section -->
    <section class="gc-hero gc-hero-sm" style="background: linear-gradient(135deg, #0F172A 0%, #1E3A5F 100%);">
        <div class="gc-container">
            <div class="gc-hero-content" style="text-align: center;">
                <span class="gc-pill-label">Search Results</span>
                <h1 style="font-family: 'Outfit', sans-serif; font-weight: 800; text-transform: uppercase; color: white; font-size: 2.5rem;">
                    SEARCH<span class="gc-tech-divider">\</span>INVENTORY
                </h1>
                <p style="color: #E2E8F0; max-width: 500px; margin: 10px auto 0;">
                    Results for: <strong style="color: var(--gc-gold);">"<?php echo esc_html($search_query); ?>"</strong>
                </p>

                <!-- Search Again Form -->
                <form method="get" action="<?php echo home_url('/'); ?>" style="max-width: 500px; margin: 25px auto 0;">
                    <div style="display: flex; background: white; border-radius: 8px; overflow: hidden; padding: 4px;">
                        <input type="text" name="s" value="<?php echo esc_attr($search_query); ?>"
                            placeholder="Search vehicles, parts, tires..."
                            style="flex: 1; border: none; padding: 12px 20px; outline: none; font-family: var(--gc-font-mono); font-size: 0.9rem;" />
                        <button type="submit" style="background: var(--gc-blue-primary); color: white; border: none; padding: 0 25px; border-radius: 6px; font-weight: 700; cursor: pointer;">SEARCH</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="gc-wave-bottom">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#f8f9fa" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,112C672,96,768,96,864,112C960,128,1056,160,1152,160C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
        </div>
    </section>

    <div class="gc-container" style="padding: 40px 20px;">

        <!-- Filter Tabs -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; flex-wrap: wrap; gap: 15px;">
            <div style="display: flex; gap: 10px;">
                <a href="?s=<?php echo urlencode($search_query); ?>&type=all"
                    style="padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.9rem;
                          <?php echo ($filter_type == 'all') ? 'background: var(--gc-blue-primary); color: white;' : 'background: #E2E8F0; color: #334155;'; ?>">
                    All Results
                </a>
                <a href="?s=<?php echo urlencode($search_query); ?>&type=vehicle"
                    style="padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.9rem;
                          <?php echo ($filter_type == 'vehicle') ? 'background: var(--gc-blue-primary); color: white;' : 'background: #E2E8F0; color: #334155;'; ?>">
                    Vehicles
                </a>
                <a href="?s=<?php echo urlencode($search_query); ?>&type=part"
                    style="padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.9rem;
                          <?php echo ($filter_type == 'part') ? 'background: var(--gc-blue-primary); color: white;' : 'background: #E2E8F0; color: #334155;'; ?>">
                    Parts & Tires
                </a>
            </div>
            <div style="font-family: var(--gc-font-mono); font-size: 0.85rem; color: #64748b;">
                <?php
                global $wp_query;
                echo 'DATABASE: ' . $wp_query->found_posts . ' results found';
                ?>
            </div>
        </div>

        <?php
        // Filter results by type if specified
        if ($filter_type != 'all' && have_posts()) {
            // We need to re-query with post_type filter
            $filtered_args = array(
                's' => $search_query,
                'post_type' => $filter_type,
                'posts_per_page' => 12,
                'paged' => get_query_var('paged') ? get_query_var('paged') : 1
            );
            $filtered_query = new WP_Query($filtered_args);
        } else {
            $filtered_query = $wp_query;
        }
        ?>

        <?php if ($filtered_query->have_posts()): ?>
            <div class="gc-inventory-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 25px;">
                <?php
                while ($filtered_query->have_posts()):
                    $filtered_query->the_post();
                    $type = get_post_type();
                    $price = ($type == 'vehicle') ? get_post_meta(get_the_ID(), 'vehicle_price', true) : get_post_meta(get_the_ID(), 'part_price', true);
                    $demo_image = ($type == 'vehicle') ? get_post_meta(get_the_ID(), 'vehicle_demo_image', true) : get_post_meta(get_the_ID(), 'part_demo_image', true);
                    $year = get_post_meta(get_the_ID(), 'vehicle_year', true);
                    $condition = get_post_meta(get_the_ID(), 'part_condition', true);
                ?>
                    <article class="gc-card-tech">
                        <div class="gc-card-tech-header">
                            <span>ID: GC-<?php the_ID(); ?></span>
                            <span style="color: <?php echo ($type == 'vehicle') ? 'var(--gc-blue-accent)' : 'var(--gc-gold)'; ?>;">
                                <?php echo ($type == 'vehicle') ? 'VEHICLE' : 'PART'; ?>
                            </span>
                        </div>
                        <div class="gc-card-tech-image">
                            <?php if (has_post_thumbnail()): the_post_thumbnail('medium_large');
                            elseif ($demo_image): ?>
                                <img src="<?php echo esc_url($demo_image); ?>" alt="<?php the_title_attribute(); ?>">
                            <?php else: ?>
                                <div style="width:100%; height:100%; background:#F1F5F9; display:flex; align-items:center; justify-content:center; flex-direction:column; color:#64748b;">
                                    <span class="dashicons dashicons-format-image" style="font-size:40px; width:40px; height:40px;"></span>
                                    <span style="font-family:var(--gc-font-mono); font-size:12px; margin-top:10px;">NO_IMAGE</span>
                                </div>
                            <?php endif; ?>
                            <a href="https://wa.me/<?php echo esc_attr($whatsapp); ?>?text=Hi, I found this on your site: <?php echo urlencode(get_the_title()); ?>"
                                class="gc-quick-inquiry" title="Quick WhatsApp Inquiry"
                                style="position: absolute; top: 10px; right: 10px; background: #25D366; color: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <span class="dashicons dashicons-whatsapp"></span>
                            </a>
                        </div>
                        <div class="gc-card-tech-body">
                            <h3><a href="<?php the_permalink(); ?>" style="text-decoration:none; color:inherit;"><?php the_title(); ?></a></h3>
                            <div class="gc-tech-grid">
                                <?php if ($year): ?><div class="gc-tech-data-point"><span>YEAR</span><?php echo esc_html($year); ?></div><?php endif; ?>
                                <?php if ($condition): ?><div class="gc-tech-data-point"><span>COND</span><?php echo esc_html($condition); ?></div><?php endif; ?>
                                <div class="gc-tech-data-point"><span>TYPE</span><?php echo ($type == 'vehicle') ? 'Vehicle' : 'Part'; ?></div>
                                <div class="gc-tech-data-point"><span>PRICE</span><span style="color:var(--gc-gold); font-weight:bold;"><?php echo $price ? '$' . esc_html($price) : 'Quote'; ?></span></div>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="gc-btn-tech">View Details</a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <div class="gc-pagination" style="margin-top: 40px; text-align: center; font-family: var(--gc-font-mono);">
                <?php
                if ($filter_type != 'all') {
                    echo paginate_links(array(
                        'total' => $filtered_query->max_num_pages,
                        'current' => max(1, get_query_var('paged')),
                        'prev_text' => '&larr; PREV',
                        'next_text' => 'NEXT &rarr;'
                    ));
                    wp_reset_postdata();
                } else {
                    the_posts_pagination(array(
                        'prev_text' => '&larr; PREV',
                        'next_text' => 'NEXT &rarr;'
                    ));
                }
                ?>
            </div>

        <?php else: ?>
            <!-- Empty State -->
            <div style="text-align: center; padding: 80px 20px; background: white; border-radius: 16px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                <div style="width: 80px; height: 80px; background: #FEE2E2; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
                    <span class="dashicons dashicons-search" style="font-size: 36px; color: #DC2626;"></span>
                </div>
                <h3 style="font-family: 'Outfit', sans-serif; font-size: 1.5rem; color: #0F172A; margin-bottom: 10px;">No Results Found</h3>
                <p style="color: #64748b; max-width: 400px; margin: 0 auto 25px;">
                    We couldn't find anything matching "<strong><?php echo esc_html($search_query); ?></strong>". Try different keywords or browse our categories.
                </p>
                <div style="display: flex; justify-content: center; gap: 15px; flex-wrap: wrap;">
                    <a href="/shop" class="gc-btn gc-btn-primary">Browse All Inventory</a>
                    <a href="/shop/?category=vehicles" class="gc-btn gc-btn-outline">View Vehicles</a>
                    <a href="/shop/?category=machines-parts" class="gc-btn gc-btn-outline">View Parts</a>
                </div>

                <!-- Suggestions -->
                <div style="margin-top: 40px; padding-top: 30px; border-top: 1px solid #E2E8F0;">
                    <p style="color: #64748b; font-size: 0.9rem; margin-bottom: 15px;">Popular searches:</p>
                    <div style="display: flex; justify-content: center; gap: 10px; flex-wrap: wrap;">
                        <a href="?s=Toyota" style="background: #F1F5F9; padding: 8px 15px; border-radius: 20px; text-decoration: none; color: #334155; font-size: 0.85rem;">Toyota</a>
                        <a href="?s=Honda" style="background: #F1F5F9; padding: 8px 15px; border-radius: 20px; text-decoration: none; color: #334155; font-size: 0.85rem;">Honda</a>
                        <a href="?s=Sinotruk" style="background: #F1F5F9; padding: 8px 15px; border-radius: 20px; text-decoration: none; color: #334155; font-size: 0.85rem;">Sinotruk</a>
                        <a href="?s=Excavator" style="background: #F1F5F9; padding: 8px 15px; border-radius: 20px; text-decoration: none; color: #334155; font-size: 0.85rem;">Excavator</a>
                        <a href="?s=Tires" style="background: #F1F5F9; padding: 8px 15px; border-radius: 20px; text-decoration: none; color: #334155; font-size: 0.85rem;">Tires</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </div>

    <!-- CTA Section -->
    <section style="background: #0F172A; padding: 50px 0; text-align: center;">
        <div class="gc-container">
            <h2 style="font-family: 'Outfit', sans-serif; color: white; font-size: 1.5rem; margin-bottom: 15px;">Can't Find What You're Looking For?</h2>
            <p style="color: #64748b; max-width: 500px; margin: 0 auto 20px;">We source vehicles and parts worldwide. Tell us what you need!</p>
            <a href="https://wa.me/<?php echo esc_attr($whatsapp); ?>?text=Hi, I'm looking for: " class="gc-btn gc-btn-gold">
                <span class="dashicons dashicons-whatsapp"></span> Request Custom Search
            </a>
        </div>
    </section>

</div>

<?php get_footer(); ?>