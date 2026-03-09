<?php

/**
 * Template Name: Tracking Page
 * Description: Shipment tracking page using the tracker shortcode.
 */

get_header();

// Get WhatsApp from settings
$whatsapp = get_option('gc_whatsapp_number', '12672900254');
?>

<div class="gc-page-wrapper gc-track-page">

    <!-- Hero Section -->
    <section class="gc-hero gc-hero-sm" style="background: linear-gradient(135deg, #0F172A 0%, #1E3A5F 100%);">
        <div class="gc-container">
            <div class="gc-hero-content" style="text-align: center;">
                <span class="gc-pill-label">Live Tracking</span>
                <h1 style="font-family: 'Outfit', sans-serif; font-weight: 800; text-transform: uppercase; color: white;">
                    TRACK<span class="gc-tech-divider">\</span>YOUR<span class="gc-tech-divider">\</span>SHIPMENT
                </h1>
                <p style="color: #E2E8F0; max-width: 600px; margin: 0 auto;">
                    Enter your tracking number to see real-time updates on your vehicle or cargo shipment.
                </p>
            </div>
        </div>
        <div class="gc-wave-bottom">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#f8f9fa" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,112C672,96,768,96,864,112C960,128,1056,160,1152,160C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
        </div>
    </section>

    <!-- Tracker Section -->
    <section class="gc-section" style="background: #f8f9fa; padding: 60px 0;">
        <div class="gc-container">
            <div style="max-width: 800px; margin: 0 auto;">

                <!-- Tracker Shortcode -->
                <?php echo do_shortcode('[globalconnect_tracker]'); ?>

                <!-- Demo Info -->
                <div style="margin-top: 40px; background: white; padding: 25px 30px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                    <h3 style="font-family: 'Outfit', sans-serif; font-size: 1.2rem; margin-bottom: 15px; display: flex; align-items: center; gap: 10px;">
                        <span class="dashicons dashicons-info-outline" style="color: var(--gc-blue-primary);"></span>
                        How It Works
                    </h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
                        <div>
                            <h4 style="font-size: 0.95rem; color: #0F172A; margin-bottom: 5px;">1. Get Your Number</h4>
                            <p style="color: #64748b; font-size: 0.9rem; margin: 0;">You'll receive a tracking number (e.g., GC-1001-US) after your invoice is processed.</p>
                        </div>
                        <div>
                            <h4 style="font-size: 0.95rem; color: #0F172A; margin-bottom: 5px;">2. Track Anytime</h4>
                            <p style="color: #64748b; font-size: 0.9rem; margin: 0;">Enter your number above to see live status updates from port to destination.</p>
                        </div>
                        <div>
                            <h4 style="font-size: 0.95rem; color: #0F172A; margin-bottom: 5px;">3. Save to Dashboard</h4>
                            <p style="color: #64748b; font-size: 0.9rem; margin: 0;">Log in to pin shipments to your personal dashboard for easy access.</p>
                        </div>
                    </div>
                </div>

                <!-- Demo Tracking Number (admin only in production) -->
                <?php if (current_user_can('manage_options')): ?>
                <div style="margin-top: 20px; background: linear-gradient(135deg, #0F172A 0%, #1E3A5F 100%); padding: 20px 25px; border-radius: 12px; color: white;">
                    <p style="margin: 0; font-size: 0.95rem;">
                        <span class="dashicons dashicons-lightbulb" style="color: var(--gc-gold); margin-right: 8px;"></span>
                        <strong>Admin Demo:</strong> Enter <code style="background: rgba(255,255,255,0.1); padding: 3px 8px; border-radius: 4px; font-family: var(--gc-font-mono);">DEMO-LIVE</code> to see a sample shipment in transit.
                    </p>
                </div>
                <?php endif; ?>

            </div>
        </div>
    </section>

    <!-- Tracking Stages Info -->
    <section class="gc-section" style="background: white; padding: 60px 0;">
        <div class="gc-container">
            <div class="gc-section-header" style="text-align: center; margin-bottom: 50px;">
                <span class="gc-header-data">STAGES + STATUS + UPDATES</span>
                <h2 class="gc-tech-title">Shipment<span class="gc-tech-divider">\</span>Stages</h2>
                <p style="color: #64748b; max-width: 600px; margin: 15px auto 0;">Understanding your shipment's journey from purchase to delivery.</p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 20px; max-width: 900px; margin: 0 auto;">

                <div style="text-align: center; padding: 20px;">
                    <div style="width: 50px; height: 50px; background: #E0F2FE; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;">
                        <span class="dashicons dashicons-inbox" style="color: #0369A1; font-size: 24px;"></span>
                    </div>
                    <h4 style="font-size: 0.95rem; margin-bottom: 5px;">Received</h4>
                    <p style="color: #64748b; font-size: 0.8rem; margin: 0;">Order confirmed</p>
                </div>

                <div style="text-align: center; padding: 20px;">
                    <div style="width: 50px; height: 50px; background: #FEF3C7; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;">
                        <span class="dashicons dashicons-admin-tools" style="color: #D97706; font-size: 24px;"></span>
                    </div>
                    <h4 style="font-size: 0.95rem; margin-bottom: 5px;">Processing</h4>
                    <p style="color: #64748b; font-size: 0.8rem; margin: 0;">Title & docs</p>
                </div>

                <div style="text-align: center; padding: 20px;">
                    <div style="width: 50px; height: 50px; background: #DBEAFE; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;">
                        <span class="dashicons dashicons-migrate" style="color: #2563EB; font-size: 24px;"></span>
                    </div>
                    <h4 style="font-size: 0.95rem; margin-bottom: 5px;">Sailing</h4>
                    <p style="color: #64748b; font-size: 0.8rem; margin: 0;">In transit</p>
                </div>

                <div style="text-align: center; padding: 20px;">
                    <div style="width: 50px; height: 50px; background: #FEE2E2; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;">
                        <span class="dashicons dashicons-clipboard" style="color: #DC2626; font-size: 24px;"></span>
                    </div>
                    <h4 style="font-size: 0.95rem; margin-bottom: 5px;">Customs</h4>
                    <p style="color: #64748b; font-size: 0.8rem; margin: 0;">Clearance</p>
                </div>

                <div style="text-align: center; padding: 20px;">
                    <div style="width: 50px; height: 50px; background: #D1FAE5; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;">
                        <span class="dashicons dashicons-location" style="color: #059669; font-size: 24px;"></span>
                    </div>
                    <h4 style="font-size: 0.95rem; margin-bottom: 5px;">Arrived</h4>
                    <p style="color: #64748b; font-size: 0.8rem; margin: 0;">At port</p>
                </div>

                <div style="text-align: center; padding: 20px;">
                    <div style="width: 50px; height: 50px; background: #22C55E; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;">
                        <span class="dashicons dashicons-yes-alt" style="color: white; font-size: 24px;"></span>
                    </div>
                    <h4 style="font-size: 0.95rem; margin-bottom: 5px;">Delivered</h4>
                    <p style="color: #64748b; font-size: 0.8rem; margin: 0;">Complete!</p>
                </div>

            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="gc-cta-banner" style="background: #0F172A; padding: 50px 0; text-align: center;">
        <div class="gc-container">
            <h2 style="font-family: 'Outfit', sans-serif; color: white; font-size: 1.75rem; margin-bottom: 15px;">Need Help With Your Shipment?</h2>
            <p style="color: #94a3b8; max-width: 500px; margin: 0 auto 25px;">Our team is available 24/7 to assist with tracking updates and delivery questions.</p>
            <div style="display: flex; justify-content: center; gap: 15px; flex-wrap: wrap;">
                <a href="https://wa.me/<?php echo esc_attr($whatsapp); ?>?text=Hi, I need help tracking my shipment" class="gc-btn gc-btn-gold">
                    <span class="dashicons dashicons-whatsapp"></span> WhatsApp Support
                </a>
                <a href="/dashboard" class="gc-btn gc-btn-outline" style="border-color: white; color: white;">View Dashboard</a>
            </div>
        </div>
    </section>

</div>

<?php get_footer(); ?>