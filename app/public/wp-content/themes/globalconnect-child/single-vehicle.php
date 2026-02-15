<?php

/**
 * Template Name: Single Vehicle
 * Description: Custom single post template for 'vehicle' post type.
 */

get_header();
?>

<div id="gc-single-vehicle">

    <?php while (have_posts()):
        the_post();
        $price = get_post_meta(get_the_ID(), 'vehicle_price', true);
        $mileage = get_post_meta(get_the_ID(), 'vehicle_mileage', true);
        $vin = get_post_meta(get_the_ID(), 'vehicle_vin', true);
        $year = get_post_meta(get_the_ID(), 'vehicle_year', true);
        $make = get_the_term_list(get_the_ID(), 'vehicle_make', '', ', ');
        $model = get_the_term_list(get_the_ID(), 'vehicle_model', '', ', ');
        $engine = get_post_meta(get_the_ID(), 'vehicle_engine', true);
        $transmission = get_post_meta(get_the_ID(), 'vehicle_transmission', true);
        $drivetrain = get_post_meta(get_the_ID(), 'vehicle_drivetrain', true);
        $fuel = get_post_meta(get_the_ID(), 'vehicle_fuel', true);
    ?>

        <!-- Breadcrumb / Header -->
        <div class="gc-page-header-sm">
            <div class="gc-container">
                <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
                <a href="/inventory" class="gc-back-link">&larr; Back to Inventory</a>
                <h1><?php echo esc_html($year . ' ' . strip_tags($make) . ' ' . strip_tags($model)); ?></h1>
            </div>
        </div>

        <div class="gc-container gc-single-layout">

            <!-- Main Content (Images + Specs) -->
            <main class="gc-single-main">

                <!-- Gallery Section -->
                <div class="gc-gallery-container">
                    <div class="gc-status-badge">Shipping Ready</div>
                    <?php
                    $demo_image = get_post_meta(get_the_ID(), 'vehicle_demo_image', true);
                    if (has_post_thumbnail()) {
                        the_post_thumbnail('large', array('class' => 'gc-main-image', 'loading' => 'eager'));
                    } elseif ($demo_image) {
                        echo '<img src="' . esc_url($demo_image) . '" class="gc-main-image" alt="' . esc_attr(get_the_title()) . '" loading="eager">';
                    } else {
                        echo '<img src="' . get_stylesheet_directory_uri() . '/assets/images/generated/placeholder-vehicle.jpg" class="gc-main-image" alt="Vehicle Image" loading="eager">';
                    }
                    ?>
                </div>

                <!-- Description -->
                <?php if (get_the_content()): ?>
                    <div class="gc-spec-slab" style="margin-top: 25px;">
                        <h3>Description</h3>
                        <div style="color: #cbd5e1; line-height: 1.7;">
                            <?php the_content(); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- "Specification Slab" (Adoption Item #1) -->
                <div class="gc-spec-slab">
                    <h3>Vehicle Specifications</h3>
                    <div class="gc-spec-grid">
                        <div class="gc-spec-item">
                            <span class="gc-spec-label">VIN</span>
                            <span class="gc-spec-value"><?php echo $vin ? esc_html($vin) : 'N/A'; ?></span>
                        </div>
                        <div class="gc-spec-item">
                            <span class="gc-spec-label">Engine</span>
                            <span class="gc-spec-value"><?php echo $engine ? esc_html($engine) : 'N/A'; ?></span>
                        </div>
                        <div class="gc-spec-item">
                            <span class="gc-spec-label">Transmission</span>
                            <span
                                class="gc-spec-value"><?php echo $transmission ? esc_html($transmission) : 'Automatic'; ?></span>
                        </div>
                        <div class="gc-spec-item">
                            <span class="gc-spec-label">Drivetrain</span>
                            <span class="gc-spec-value"><?php echo $drivetrain ? esc_html($drivetrain) : 'FWD'; ?></span>
                        </div>
                        <div class="gc-spec-item">
                            <span class="gc-spec-label">Fuel Type</span>
                            <span class="gc-spec-value"><?php echo $fuel ? esc_html($fuel) : 'Gasoline'; ?></span>
                        </div>
                        <div class="gc-spec-item">
                            <span class="gc-spec-label">Mileage</span>
                            <span class="gc-spec-value"><?php echo $mileage ? esc_html($mileage) . ' mi' : 'N/A'; ?></span>
                        </div>
                    </div>
                </div>

            </main>

            <!-- Sidebar -->
            <aside class="gc-sidebar">

                <!-- Price Card -->
                <div class="gc-price-card">
                    <div class="gc-price-amount"><?php echo $price ? '$' . esc_html($price) : 'Contact Us'; ?></div>
                    <div class="gc-price-note">Excludes Shipping</div>
                    <a href="javascript:void(0)" class="gc-btn gc-btn-primary gc-btn-block gc-wizard-trigger">Configure Export & Invoice</a>
                </div>

                <!-- "Seller Trust Card" (Adoption Item #2) -->
                <div class="gc-trust-card">
                    <div class="gc-trust-header">
                        <span class="dashicons dashicons-shield-alt"></span>
                        <h4>Verified Exporter</h4>
                    </div>
                    <div class="gc-trust-body">
                        <p><strong>Member Since:</strong> 2018</p>
                        <p><strong>Response Time:</strong> &lt; 1 Hour</p>
                        <p><strong>Location:</strong> USA</p>
                        <?php $whatsapp = get_option('gc_whatsapp_number', '12672900254'); ?>
                        <a href="https://wa.me/<?php echo esc_attr($whatsapp); ?>?text=I'm interested in <?php echo urlencode(get_the_title()); ?>" target="_blank" class="gc-btn-whatsapp">
                            <span class="dashicons dashicons-whatsapp"></span> Chat on WhatsApp
                        </a>
                    </div>
                </div>

                <!-- Security Badges (Adoption Item #3 - referenced in checkout flow but good here too) -->
                <div class="gc-security-badges text-center">
                    <p><small>Secure Transaction</small></p>
                    <span class="dashicons dashicons-lock"></span>
                </div>

            </aside>

        </div>

    <?php endwhile; ?>

    <!-- Inquiry Wizard Modal -->
    <div id="gc-wizard-modal" class="gc-modal">
        <div class="gc-modal-content">
            <button class="gc-modal-close">&times;</button>
            <?php echo do_shortcode('[globalconnect_inquiry_wizard]'); ?>
        </div>
    </div>

</div>

<script>
    jQuery(document).ready(function($) {
        $('.gc-wizard-trigger').on('click', function() {
            $('#gc-wizard-modal').fadeIn();
        });
        $('.gc-modal-close').on('click', function() {
            $('#gc-wizard-modal').fadeOut();
        });
        $(window).on('click', function(event) {
            if ($(event.target).is('#gc-wizard-modal')) {
                $('#gc-wizard-modal').fadeOut();
            }
        });
    });
</script>

<?php get_footer(); ?>