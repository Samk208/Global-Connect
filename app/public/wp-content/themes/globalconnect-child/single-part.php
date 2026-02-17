<?php

/**
 * Template Name: Single Part
 * Description: Displays details of a single part/machinery item.
 */

get_header();

// Get WhatsApp from settings
$whatsapp = get_option('gc_whatsapp_number', '12672900254');
?>

<div id="gc-single-part">

    <?php while (have_posts()):
        the_post();
        $price = get_post_meta(get_the_ID(), 'part_price', true);
        $condition = get_post_meta(get_the_ID(), 'part_condition', true);
        $demo_image = get_post_meta(get_the_ID(), 'part_demo_image', true);
        $categories = get_the_terms(get_the_ID(), 'part_category');
        $sources = get_the_terms(get_the_ID(), 'vehicle_source');
        $source_name = ($sources && !is_wp_error($sources)) ? $sources[0]->name : 'USA';
    ?>

        <!-- Breadcrumb / Header -->
        <div class="gc-page-header-sm" style="background: linear-gradient(135deg, #0F172A 0%, #1E3A5F 100%); padding: 30px 0;">
            <div class="gc-container">
                <?php
                // Breadcrumb with fallback
                if (function_exists('rank_math_the_breadcrumbs')) {
                    rank_math_the_breadcrumbs();
                } else {
                    echo '<nav class="gc-breadcrumb" style="margin-bottom: 15px;"><a href="' . home_url() . '" style="color: #94a3b8; text-decoration: none;">Home</a> <span style="color: #64748b; margin: 0 8px;">/</span> <a href="' . site_url('/shop/?category=machines-parts') . '" style="color: #94a3b8; text-decoration: none;">Parts & Machinery</a> <span style="color: #64748b; margin: 0 8px;">/</span> <span style="color: white;">' . get_the_title() . '</span></nav>';
                }
                ?>
                <a href="<?php echo esc_url(site_url('/shop/?category=machines-parts')); ?>" class="gc-back-link" style="color: var(--gc-gold); text-decoration: none; font-size: 0.9rem;">&larr; Back to Inventory</a>
                <h1 style="font-family: 'Outfit', sans-serif; font-weight: 800; color: white; font-size: 2rem; margin-top: 10px;"><?php the_title(); ?></h1>
            </div>
        </div>

        <div class="gc-container gc-single-layout" style="display: grid; grid-template-columns: 1fr 380px; gap: 40px; padding: 40px 20px;">

            <!-- Main Content (Image + Specs) -->
            <main class="gc-single-main">

                <!-- Gallery Section -->
                <div class="gc-gallery-container" style="position: relative; border-radius: 12px; overflow: hidden; background: #F1F5F9;">
                    <div class="gc-status-badge" style="position: absolute; top: 15px; left: 15px; background: <?php echo ($condition == 'New') ? '#22C55E' : 'var(--gc-gold)'; ?>; color: <?php echo ($condition == 'New') ? 'white' : '#0F172A'; ?>; padding: 6px 15px; border-radius: 20px; font-size: 0.8rem; font-weight: 700; z-index: 10;">
                        <?php echo esc_html($condition ?: 'Available'); ?>
                    </div>
                    <?php if (has_post_thumbnail()): ?>
                        <?php the_post_thumbnail('large', array('class' => 'gc-main-image', 'style' => 'width: 100%; height: auto; display: block;')); ?>
                    <?php elseif ($demo_image): ?>
                        <img src="<?php echo esc_url($demo_image); ?>" class="gc-main-image" alt="<?php the_title_attribute(); ?>" style="width: 100%; height: auto; display: block;">
                    <?php else: ?>
                        <div style="width: 100%; height: 400px; display: flex; align-items: center; justify-content: center; flex-direction: column; color: #94a3b8;">
                            <span class="dashicons dashicons-format-image" style="font-size: 60px; width: 60px; height: 60px;"></span>
                            <span style="margin-top: 15px; font-family: var(--gc-font-mono);">NO IMAGE DATA</span>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Specification Slab -->
                <div class="gc-spec-slab" style="background: white; padding: 30px; border-radius: 12px; margin-top: 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                    <h3 style="font-family: 'Outfit', sans-serif; font-size: 1.3rem; margin-bottom: 20px; color: #0F172A;">Item Specifications</h3>
                    <div class="gc-spec-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 20px;">
                        <div class="gc-spec-item" style="padding: 15px; background: #F8FAFC; border-radius: 8px;">
                            <span class="gc-spec-label" style="display: block; font-size: 0.75rem; color: #64748b; text-transform: uppercase; margin-bottom: 5px;">Condition</span>
                            <span class="gc-spec-value" style="font-weight: 700; color: #0F172A;"><?php echo esc_html($condition ?: 'N/A'); ?></span>
                        </div>
                        <div class="gc-spec-item" style="padding: 15px; background: #F8FAFC; border-radius: 8px;">
                            <span class="gc-spec-label" style="display: block; font-size: 0.75rem; color: #64748b; text-transform: uppercase; margin-bottom: 5px;">Category</span>
                            <span class="gc-spec-value" style="font-weight: 700; color: #0F172A;"><?php echo ($categories && !is_wp_error($categories)) ? esc_html($categories[0]->name) : 'Part'; ?></span>
                        </div>
                        <div class="gc-spec-item" style="padding: 15px; background: #F8FAFC; border-radius: 8px;">
                            <span class="gc-spec-label" style="display: block; font-size: 0.75rem; color: #64748b; text-transform: uppercase; margin-bottom: 5px;">Origin</span>
                            <span class="gc-spec-value" style="font-weight: 700; color: #0F172A;"><?php echo esc_html($source_name); ?></span>
                        </div>
                        <div class="gc-spec-item" style="padding: 15px; background: #F8FAFC; border-radius: 8px;">
                            <span class="gc-spec-label" style="display: block; font-size: 0.75rem; color: #64748b; text-transform: uppercase; margin-bottom: 5px;">Item ID</span>
                            <span class="gc-spec-value" style="font-weight: 700; color: #0F172A; font-family: var(--gc-font-mono);">GC-<?php echo get_the_ID(); ?></span>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <?php if (get_the_content()): ?>
                    <div class="gc-content-box" style="background: white; padding: 30px; border-radius: 12px; margin-top: 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                        <h3 style="font-family: 'Outfit', sans-serif; font-size: 1.3rem; margin-bottom: 15px; color: #0F172A;">Description</h3>
                        <div style="color: #334155; line-height: 1.7;">
                            <?php the_content(); ?>
                        </div>
                    </div>
                <?php endif; ?>

            </main>

            <!-- Sidebar -->
            <aside class="gc-sidebar">

                <!-- Price Card -->
                <div class="gc-price-card" style="background: linear-gradient(135deg, #0F172A 0%, #1E3A5F 100%); padding: 30px; border-radius: 12px; color: white; text-align: center;">
                    <div class="gc-price-amount" style="font-size: 2.5rem; font-weight: 800; font-family: 'Outfit', sans-serif; color: var(--gc-gold);">
                        <?php echo $price ? '$' . esc_html(number_format((float)str_replace(',', '', $price))) : 'Contact Us'; ?>
                    </div>
                    <div class="gc-price-note" style="font-size: 0.85rem; color: #94a3b8; margin-top: 5px;">Excludes Shipping & Customs</div>
                    <a href="javascript:void(0)" class="gc-btn gc-btn-gold gc-btn-block gc-wizard-trigger" style="margin-top: 20px; display: block; text-align: center;">Configure Export & Invoice</a>
                </div>

                <!-- Seller Trust Card -->
                <div class="gc-trust-card" style="background: white; padding: 25px; border-radius: 12px; margin-top: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                    <div class="gc-trust-header" style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #E2E8F0;">
                        <span class="dashicons dashicons-shield-alt" style="color: #22C55E; font-size: 24px;"></span>
                        <h4 style="margin: 0; font-family: 'Outfit', sans-serif; font-size: 1.1rem;">Verified Exporter</h4>
                    </div>
                    <div class="gc-trust-body">
                        <p style="margin: 0 0 10px 0; font-size: 0.9rem;"><strong>Member Since:</strong> 2018</p>
                        <p style="margin: 0 0 10px 0; font-size: 0.9rem;"><strong>Response Time:</strong> &lt; 1 Hour</p>
                        <p style="margin: 0 0 15px 0; font-size: 0.9rem;"><strong>Ships From:</strong> <?php echo esc_html($source_name); ?></p>
                        <a href="https://wa.me/<?php echo esc_attr($whatsapp); ?>?text=Hi, I'm interested in: <?php echo urlencode(get_the_title()); ?> (ID: GC-<?php echo get_the_ID(); ?>)" target="_blank" class="gc-btn-whatsapp" style="display: flex; align-items: center; justify-content: center; gap: 8px; background: #25D366; color: white; padding: 12px 20px; border-radius: 8px; text-decoration: none; font-weight: 600;">
                            <span class="dashicons dashicons-whatsapp"></span> Chat on WhatsApp
                        </a>
                    </div>
                </div>

                <!-- Security Badges -->
                <div class="gc-security-badges" style="text-align: center; margin-top: 20px; padding: 15px; background: #F8FAFC; border-radius: 8px;">
                    <p style="margin: 0 0 10px 0; color: #64748b; font-size: 0.8rem;">Secure Transaction</p>
                    <span class="dashicons dashicons-lock" style="color: #22C55E; font-size: 20px;"></span>
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

    <?php
    // JSON-LD Structured Data for Part/Machinery (Product schema)
    $schema_image = '';
    if (has_post_thumbnail()) {
        $schema_image = get_the_post_thumbnail_url(get_the_ID(), 'large');
    } elseif ($demo_image) {
        $schema_image = $demo_image;
    }
    $schema_price = $price ? str_replace(',', '', $price) : '';
    $schema_category = ($categories && !is_wp_error($categories)) ? $categories[0]->name : 'Part';
    ?>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Product",
        "name": <?php echo wp_json_encode(get_the_title()); ?>,
        "description": <?php echo wp_json_encode(wp_strip_all_tags(get_the_excerpt() ?: get_the_title())); ?>,
        <?php if ($schema_image): ?>"image": <?php echo wp_json_encode(esc_url($schema_image)); ?>,<?php endif; ?>
        "category": <?php echo wp_json_encode($schema_category); ?>,
        <?php if ($condition): ?>"itemCondition": "https://schema.org/<?php echo ($condition === 'New') ? 'NewCondition' : 'UsedCondition'; ?>",<?php endif; ?>
        <?php if ($schema_price): ?>
        "offers": {
            "@type": "Offer",
            "price": <?php echo wp_json_encode($schema_price); ?>,
            "priceCurrency": "USD",
            "availability": "https://schema.org/InStock",
            "url": <?php echo wp_json_encode(get_permalink()); ?>
        },
        <?php endif; ?>
        "url": <?php echo wp_json_encode(get_permalink()); ?>
    }
    </script>

</div>

<style>
    @media (max-width: 900px) {
        .gc-single-layout {
            grid-template-columns: 1fr !important;
        }
    }
</style>

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