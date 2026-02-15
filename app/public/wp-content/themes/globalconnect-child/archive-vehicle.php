<?php

/**
 * Template Name: Vehicle Inventory Archive
 * Description: Custom archive template for the 'vehicle' post type.
 */

get_header();
?>

<div id="gc-inventory-archive">

    <!-- Archive Header -->
    <section class="gc-page-header">
        <div class="gc-container">
            <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
            <h1>Current Inventory</h1>
            <p>Browse our selection of quality export-ready vehicles.</p>
        </div>
    </section>

    <div class="gc-container gc-archive-layout">

        <!-- Sidebar Filter (Mockup for now) -->
        <aside class="gc-sidebar">
            <div class="gc-filter-widget">
                <h3>Filter Vehicles</h3>
                <form role="search" method="get" class="gc-filter-form" action="<?php echo home_url('/'); ?>">
                    <input type="hidden" name="post_type" value="vehicle" />

                    <div class="gc-form-group">
                        <label>Search</label>
                        <input type="text" name="s" placeholder="e.g. Toyota Camry"
                            value="<?php echo get_search_query(); ?>">
                    </div>

                    <div class="gc-form-group">
                        <label>Make</label>
                        <select name="vehicle_make" onchange="this.form.submit()">
                            <option value="">All Makes</option>
                            <?php
                            $makes = get_terms(array('taxonomy' => 'vehicle_make', 'hide_empty' => false));
                            $current_make = isset($_GET['vehicle_make']) ? $_GET['vehicle_make'] : '';
                            foreach ($makes as $make) {
                                echo '<option value="' . esc_attr($make->slug) . '" ' . selected($current_make, $make->slug, false) . '>' . esc_html($make->name) . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="gc-form-group">
                        <label>Model</label>
                        <select name="vehicle_model" onchange="this.form.submit()">
                            <option value="">All Models</option>
                            <?php
                            $models = get_terms(array('taxonomy' => 'vehicle_model', 'hide_empty' => false));
                            $current_model = isset($_GET['vehicle_model']) ? $_GET['vehicle_model'] : '';
                            foreach ($models as $model) {
                                echo '<option value="' . esc_attr($model->slug) . '" ' . selected($current_model, $model->slug, false) . '>' . esc_html($model->name) . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="gc-form-group">
                        <label>Status</label>
                        <select name="vehicle_status" onchange="this.form.submit()">
                            <option value="">All Status</option>
                            <?php
                            $statuses = get_terms(array('taxonomy' => 'vehicle_status', 'hide_empty' => false));
                            $current_status = isset($_GET['vehicle_status']) ? $_GET['vehicle_status'] : '';
                            foreach ($statuses as $status) {
                                echo '<option value="' . esc_attr($status->slug) . '" ' . selected($current_status, $status->slug, false) . '>' . esc_html($status->name) . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="gc-form-group">
                        <label>Year</label>
                        <select name="vehicle_year" onchange="this.form.submit()">
                            <option value="">All Years</option>
                            <?php
                            $current_year = isset($_GET['vehicle_year']) ? $_GET['vehicle_year'] : '';
                            for ($y = date('Y'); $y >= 2010; $y--) {
                                echo '<option value="' . $y . '" ' . selected($current_year, $y, false) . '>' . $y . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <button type="submit" class="gc-btn gc-btn-primary gc-btn-block">Filter Results</button>
                    <a href="/inventory" class="gc-reset-link">Reset Filters</a>
                </form>
            </div>

            <div class="gc-sidebar-contact">
                <h4>Need Help?</h4>
                <p>Can't find what you're looking for? We can source it for you.</p>
                <a href="/contact" class="gc-text-link">Contact Us &rarr;</a>
            </div>
        </aside>

        <!-- Vehicle Grid -->
        <main class="gc-archive-main">
            <div class="gc-archive-toolbar">
                <div class="gc-result-count">
                    <?php
                    global $wp_query;
                    echo 'Showing ' . $wp_query->found_posts . ' vehicles';
                    ?>
                </div>
                <div class="gc-sorting-dropdown">
                    <form method="get">
                        <?php
                        // Preserve existing GET parameters
                        foreach ($_GET as $key => $val) {
                            if ($key !== 'orderby') {
                                echo '<input type="hidden" name="' . esc_attr($key) . '" value="' . esc_attr($val) . '">';
                            }
                        }
                        ?>
                        <select name="orderby" onchange="this.form.submit()">
                            <option value="">Sort By: Default</option>
                            <option value="price_asc" <?php selected(isset($_GET['orderby']) ? $_GET['orderby'] : '', 'price_asc'); ?>>Price: Low to High</option>
                            <option value="price_desc" <?php selected(isset($_GET['orderby']) ? $_GET['orderby'] : '', 'price_desc'); ?>>Price: High to Low</option>
                            <option value="year_desc" <?php selected(isset($_GET['orderby']) ? $_GET['orderby'] : '', 'year_desc'); ?>>Year: Newest First</option>
                            <option value="date_desc" <?php selected(isset($_GET['orderby']) ? $_GET['orderby'] : '', 'date_desc'); ?>>Latest Listed</option>
                            <option value="popularity" <?php selected(isset($_GET['orderby']) ? $_GET['orderby'] : '', 'popularity'); ?>>Most Popular</option>
                        </select>
                    </form>
                </div>
            </div>

            <?php if (have_posts()): ?>
                <div class="gc-inventory-grid gc-grid-2-col">
                    <?php
                    while (have_posts()):
                        the_post();
                        $price = get_post_meta(get_the_ID(), 'vehicle_price', true);
                        $mileage = get_post_meta(get_the_ID(), 'vehicle_mileage', true);
                        $status = wp_get_post_terms(get_the_ID(), 'vehicle_status', array('fields' => 'names'));
                        $status_label = !empty($status) ? $status[0] : 'Available';
                    ?>
                        <article class="gc-vehicle-card gc-card-horizontal">
                            <div class="gc-vehicle-image">
                                <?php
                                $demo_image = get_post_meta(get_the_ID(), 'vehicle_demo_image', true);
                                if (has_post_thumbnail()):
                                    the_post_thumbnail('medium_large');
                                elseif ($demo_image):
                                    echo '<img src="' . esc_url($demo_image) . '" alt="' . esc_attr(get_the_title()) . '">';
                                else: ?>
                                    <div class="gc-no-image">No Image</div>
                                <?php endif; ?>
                                <span
                                    class="gc-price-badge"><?php echo $price ? '$' . esc_html($price) : 'Contact Us'; ?></span>
                                <?php $whatsapp = get_option('gc_whatsapp_number', '12672900254'); ?>
                                <a href="https://wa.me/<?php echo esc_attr($whatsapp); ?>?text=I'm interested in <?php echo urlencode(get_the_title()); ?>" class="gc-quick-inquiry" title="Quick Inquiry">
                                    <span class="dashicons dashicons-whatsapp"></span>
                                </a>
                            </div>
                            <div class="gc-vehicle-details">
                                <div class="gc-details-header">
                                    <span
                                        class="gc-status-pill <?php echo sanitize_title($status_label); ?>"><?php echo esc_html($status_label); ?></span>
                                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                </div>

                                <div class="gc-vehicle-specs">
                                    <div class="spec-item"><span class="dashicons dashicons-dashboard"></span>
                                        <?php echo $mileage ? esc_html($mileage) . ' mi' : 'N/A'; ?></div>
                                    <div class="spec-item"><span class="dashicons dashicons-calendar"></span>
                                        <?php echo esc_html(get_post_meta(get_the_ID(), 'vehicle_year', true)); ?></div>
                                    <div class="spec-item"><span class="dashicons dashicons-car"></span> Export Ready</div>
                                </div>

                                <div class="gc-vehicle-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>

                                <a href="<?php the_permalink(); ?>" class="gc-btn-sm">View Full Details</a>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <div class="gc-pagination">
                    <?php
                    the_posts_pagination(array(
                        'mid_size' => 2,
                        'prev_text' => __('&larr; Previous', 'globalconnect-child'),
                        'next_text' => __('Next &rarr;', 'globalconnect-child'),
                    ));
                    ?>
                </div>

            <?php else: ?>
                <div class="gc-empty-archive">
                    <h3>No vehicles found.</h3>
                    <p>Try adjusting your search filters.</p>
                </div>
            <?php endif; ?>
        </main>

    </div>
</div>

<?php get_footer(); ?>