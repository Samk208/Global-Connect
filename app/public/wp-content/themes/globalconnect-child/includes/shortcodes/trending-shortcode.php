<?php

/**
 * Shortcode: [globalconnect_trending]
 * Displays the top 3-4 most inquired vehicles in a high-impact grid.
 */

if (!defined('ABSPATH')) exit;

function globalconnect_trending_shortcode($atts)
{
    $atts = shortcode_atts(array(
        'count' => 3,
    ), $atts);

    $args = array(
        'post_type' => 'vehicle',
        'meta_key' => 'gc_inquiry_count',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'posts_per_page' => (int)$atts['count'],
    );

    $query = new WP_Query($args);

    if (!$query->have_posts()) {
        return '';
    }

    ob_start();
?>
    <div class="gc-trending-section">
        <div class="gc-trending-grid">
            <?php while ($query->have_posts()) : $query->the_post();
                $price = get_post_meta(get_the_ID(), 'vehicle_price', true);
                $demo_image = get_post_meta(get_the_ID(), 'vehicle_demo_image', true);
                $inquiry_count = get_post_meta(get_the_ID(), 'gc_inquiry_count', true) ?: 0;
            ?>
                <article class="gc-trending-card gc-glass-light">
                    <div class="gc-card-image">
                        <?php if (has_post_thumbnail()) : the_post_thumbnail('medium_large');
                        elseif ($demo_image) : echo '<img src="' . esc_url($demo_image) . '">';
                        else : echo '<div class="gc-no-image">No Image</div>';
                        endif; ?>

                        <div class="gc-trending-badge">
                            <span class="dashicons dashicons-marker"></span>
                            Trending
                        </div>

                        <div class="gc-card-overlay">
                            <span class="inquiry-stat"><?php echo esc_html($inquiry_count); ?> Recent Inquiries</span>
                        </div>
                    </div>

                    <div class="gc-card-content">
                        <h3><?php the_title(); ?></h3>
                        <div class="gc-card-footer">
                            <span class="price"><?php echo $price ? '$' . esc_html($price) : 'Contact Us'; ?></span>
                            <a href="<?php the_permalink(); ?>" class="gc-btn-sm">View Deal</a>
                        </div>
                    </div>
                </article>
            <?php endwhile;
            wp_reset_postdata(); ?>
        </div>
    </div>
<?php
    return ob_get_clean();
}
add_shortcode('globalconnect_trending', 'globalconnect_trending_shortcode');
