<?php

/**
 * Template Name: Parts Archive
 * Description: Displays list of Parts, Tires, and Machinery.
 */

get_header();

// Get current term title if on a category page
$page_title = 'Our Inventory';
$description = 'Browse our selection of parts and machinery.';

if (is_tax()) {
    $term = get_queried_object();
    $page_title = $term->name;
    $description = $term->description ?: $description;
} elseif (is_post_type_archive('part')) {
    $page_title = 'Parts & Machinery';
}
?>

<div class="gc-archive-header">
    <div class="gc-container">
        <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
        <h1><?php echo esc_html($page_title); ?></h1>
        <p><?php echo esc_html($description); ?></p>
    </div>
</div>

<div class="gc-container gc-archive-container">

    <!-- Sidebar / Filters -->
    <aside class="gc-sidebar">
        <div class="gc-filter-widget">
            <h3>Categories</h3>
            <ul>
                <?php
                $terms = get_terms(array('taxonomy' => 'part_category', 'hide_empty' => false));
                foreach ($terms as $term) {
                    echo '<li><a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . ' (' . $term->count . ')</a></li>';
                }
                ?>
            </ul>
        </div>
        <div class="gc-filter-widget">
            <h3>Condition</h3>
            <?php
            $current_cond = isset($_GET['condition']) ? $_GET['condition'] : '';
            $conditions = array('New', 'Used', 'Refurbished');
            ?>
            <ul>
                <li>
                    <a href="<?php echo esc_url(remove_query_arg('condition')); ?>" class="<?php echo empty($current_cond) ? 'active' : ''; ?>">All Conditions</a>
                </li>
                <?php foreach ($conditions as $cond): ?>
                    <li>
                        <a href="<?php echo esc_url(add_query_arg('condition', $cond)); ?>"
                            class="<?php echo ($current_cond === $cond) ? 'active' : ''; ?>">
                            <?php echo esc_html($cond); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="gc-archive-main">
        <div class="gc-archive-toolbar">
            <div class="gc-result-count">
                <?php
                global $wp_query;
                echo 'Showing ' . $wp_query->found_posts . ' items';
                ?>
            </div>
            <div class="gc-sorting-dropdown">
                <form method="get">
                    <?php
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
                        <option value="date_desc" <?php selected(isset($_GET['orderby']) ? $_GET['orderby'] : '', 'date_desc'); ?>>Latest Listed</option>
                        <option value="popularity" <?php selected(isset($_GET['orderby']) ? $_GET['orderby'] : '', 'popularity'); ?>>Most Popular</option>
                    </select>
                </form>
            </div>
        </div>

        <?php if (have_posts()): ?>
            <div class="gc-inventory-grid">
                <?php while (have_posts()):
                    the_post();
                    $price = get_post_meta(get_the_ID(), 'part_price', true);
                    $condition = get_post_meta(get_the_ID(), 'part_condition', true);
                ?>
                    <article class="gc-vehicle-card gc-part-card">
                        <div class="gc-vehicle-image">
                            <?php
                            $demo_image = get_post_meta(get_the_ID(), 'part_demo_image', true);
                            if (has_post_thumbnail()): ?>
                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium_large'); ?></a>
                            <?php elseif ($demo_image): ?>
                                <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($demo_image); ?>" alt="<?php the_title_attribute(); ?>"></a>
                            <?php else: ?>
                                <div class="gc-no-image">No Image</div>
                            <?php endif; ?>
                            <?php if ($price): ?>
                                <span class="gc-price-badge">$<?php echo esc_html($price); ?></span>
                            <?php endif; ?>
                            <?php $whatsapp = get_option('gc_whatsapp_number', '12672900254'); ?>
                            <a href="https://wa.me/<?php echo esc_attr($whatsapp); ?>?text=I'm interested in <?php echo urlencode(get_the_title()); ?>" class="gc-quick-inquiry" title="Quick Inquiry">
                                <span class="dashicons dashicons-whatsapp"></span>
                            </a>
                        </div>
                        <div class="gc-vehicle-details">
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="gc-vehicle-meta">
                                <?php if ($condition): ?>
                                    <span
                                        class="gc-tag <?php echo strtolower($condition); ?>"><?php echo esc_html($condition); ?></span>
                                <?php endif; ?>
                                <span>Export Ready</span>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="gc-btn-sm">View Details</a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <!-- Pagination -->
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
                <h3>No items found in this category.</h3>
                <p>Try checking back later or contact us for sourcing.</p>
                <a href="/contact" class="gc-btn gc-btn-primary">Contact Us</a>
            </div>
        <?php endif; ?>
    </main>
</div>

<?php get_footer(); ?>