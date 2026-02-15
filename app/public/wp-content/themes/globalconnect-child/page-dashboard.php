<?php

/**
 * Template Name: User Dashboard Page
 * Description: User dashboard page using the dashboard shortcode.
 */

get_header();

// Get WhatsApp from settings
$whatsapp = get_option('gc_whatsapp_number', '12672900254');
?>

<div class="gc-page-wrapper gc-dashboard-page">

    <!-- Hero Section -->
    <section class="gc-hero gc-hero-sm" style="background: linear-gradient(135deg, #0F172A 0%, #1E3A5F 100%); padding: 40px 0 60px;">
        <div class="gc-container">
            <div class="gc-hero-content" style="text-align: center;">
                <span class="gc-pill-label">Customer Portal</span>
                <h1 style="font-family: 'Outfit', sans-serif; font-weight: 800; text-transform: uppercase; color: white; font-size: 2.5rem;">
                    MY<span class="gc-tech-divider">\</span>DASHBOARD
                </h1>
                <p style="color: #E2E8F0; max-width: 500px; margin: 0 auto;">
                    Track your shipments, manage pinned items, and access your export history.
                </p>
            </div>
        </div>
        <div class="gc-wave-bottom">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#f8f9fa" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,112C672,96,768,96,864,112C960,128,1056,160,1152,160C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
        </div>
    </section>

    <!-- Dashboard Section -->
    <section class="gc-section" style="background: #f8f9fa; padding: 60px 0;">
        <div class="gc-container">

            <!-- Dashboard Shortcode -->
            <?php echo do_shortcode('[globalconnect_user_dashboard]'); ?>

            <?php if (!is_user_logged_in()): ?>
                <!-- Additional Info for Logged Out Users -->
                <div style="max-width: 800px; margin: 40px auto 0;">
                    <div style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                        <h3 style="font-family: 'Outfit', sans-serif; font-size: 1.3rem; margin-bottom: 20px; text-align: center;">Why Create an Account?</h3>

                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 25px;">
                            <div style="text-align: center;">
                                <div style="width: 50px; height: 50px; background: #DBEAFE; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;">
                                    <span class="dashicons dashicons-location-alt" style="color: #2563EB; font-size: 24px;"></span>
                                </div>
                                <h4 style="font-size: 1rem; margin-bottom: 8px;">Track All Shipments</h4>
                                <p style="color: #64748b; font-size: 0.9rem; margin: 0;">View all your active exports in one place.</p>
                            </div>

                            <div style="text-align: center;">
                                <div style="width: 50px; height: 50px; background: #FEF3C7; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;">
                                    <span class="dashicons dashicons-admin-post" style="color: #D97706; font-size: 24px;"></span>
                                </div>
                                <h4 style="font-size: 1rem; margin-bottom: 8px;">Pin Favorites</h4>
                                <p style="color: #64748b; font-size: 0.9rem; margin: 0;">Save tracking numbers for quick access.</p>
                            </div>

                            <div style="text-align: center;">
                                <div style="width: 50px; height: 50px; background: #D1FAE5; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;">
                                    <span class="dashicons dashicons-bell" style="color: #059669; font-size: 24px;"></span>
                                </div>
                                <h4 style="font-size: 1rem; margin-bottom: 8px;">Get Notifications</h4>
                                <p style="color: #64748b; font-size: 0.9rem; margin: 0;">Receive updates when status changes.</p>
                            </div>
                        </div>

                        <div style="text-align: center; margin-top: 30px; padding-top: 25px; border-top: 1px solid #E2E8F0;">
                            <p style="color: #64748b; margin-bottom: 15px;">Don't have an account yet?</p>
                            <a href="<?php echo wp_registration_url(); ?>" class="gc-btn gc-btn-primary">Create Free Account</a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </section>

    <!-- Quick Actions for Logged In Users -->
    <?php if (is_user_logged_in()): ?>
        <section class="gc-section" style="background: white; padding: 50px 0;">
            <div class="gc-container">
                <div class="gc-section-header" style="text-align: center; margin-bottom: 40px;">
                    <h2 class="gc-tech-title" style="font-size: 1.5rem;">Quick<span class="gc-tech-divider">\</span>Actions</h2>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; max-width: 900px; margin: 0 auto;">

                    <a href="/track" style="display: block; background: linear-gradient(135deg, #0F172A 0%, #1E3A5F 100%); padding: 25px; border-radius: 12px; text-decoration: none; transition: transform 0.3s;">
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <div style="width: 50px; height: 50px; background: rgba(255,255,255,0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                <span class="dashicons dashicons-search" style="color: var(--gc-gold); font-size: 24px;"></span>
                            </div>
                            <div>
                                <h4 style="color: white; font-size: 1.1rem; margin-bottom: 3px;">Track New Shipment</h4>
                                <p style="color: #94a3b8; font-size: 0.85rem; margin: 0;">Enter a tracking number</p>
                            </div>
                        </div>
                    </a>

                    <a href="/shop" style="display: block; background: linear-gradient(135deg, #0F172A 0%, #1E3A5F 100%); padding: 25px; border-radius: 12px; text-decoration: none; transition: transform 0.3s;">
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <div style="width: 50px; height: 50px; background: rgba(255,255,255,0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                <span class="dashicons dashicons-car" style="color: var(--gc-gold); font-size: 24px;"></span>
                            </div>
                            <div>
                                <h4 style="color: white; font-size: 1.1rem; margin-bottom: 3px;">Browse Inventory</h4>
                                <p style="color: #94a3b8; font-size: 0.85rem; margin: 0;">Find your next vehicle</p>
                            </div>
                        </div>
                    </a>

                    <a href="https://wa.me/<?php echo esc_attr($whatsapp); ?>?text=Hi, I need assistance with my account" target="_blank" style="display: block; background: linear-gradient(135deg, #0F172A 0%, #1E3A5F 100%); padding: 25px; border-radius: 12px; text-decoration: none; transition: transform 0.3s;">
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <div style="width: 50px; height: 50px; background: rgba(37, 211, 102, 0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                <span class="dashicons dashicons-whatsapp" style="color: #25D366; font-size: 24px;"></span>
                            </div>
                            <div>
                                <h4 style="color: white; font-size: 1.1rem; margin-bottom: 3px;">Contact Support</h4>
                                <p style="color: #94a3b8; font-size: 0.85rem; margin: 0;">Chat on WhatsApp</p>
                            </div>
                        </div>
                    </a>

                </div>
            </div>
        </section>
    <?php endif; ?>

</div>

<style>
    .gc-dashboard-page a[style*="linear-gradient"]:hover {
        transform: translateY(-3px);
    }
</style>

<?php get_footer(); ?>