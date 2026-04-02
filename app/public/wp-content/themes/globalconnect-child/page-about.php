<?php

/**
 * Template Name: About Us (Compact)
 * Description: Compact about page template. Use page-about-us.php for the full version.
 */

get_header();
?>

<div id="gc-about-page" style="background-color: #0F172A; color: #e2e8f0; min-height: 100vh;">

    <!-- Hero Section -->
    <section class="gc-page-header"
        style="background: linear-gradient(180deg, rgba(15, 23, 42, 0.9) 0%, #0F172A 100%), url('<?php echo esc_url(content_url('/uploads/2026/03/tech-global-network.jpg')); ?>') no-repeat center center/cover; padding: 100px 0 60px; text-align: center; border-bottom: 1px solid rgba(255,255,255,0.05);">
        <div class="gc-container">
            <h1 style="color: #ffffff; font-size: 3.5rem; font-weight: 800; letter-spacing: -1px; margin-bottom: 20px;">
                Connecting the World to <span style="color: var(--gc-gold);">Global Inventory</span></h1>
            <p style="color: #cbd5e1; font-size: 1.25rem; max-width: 800px; margin: 0 auto; line-height: 1.6;">Global
                Connect Shipping is the premier deep-tech logistics partner bridging the gap between North America,
                Europe, Asia, and West Africa.</p>
        </div>
    </section>

    <!-- Mission Grid -->
    <section class="gc-mission-section" style="padding: 80px 0;">
        <div class="gc-container">
            <div class="gc-row"
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 40px;">

                <!-- Card 1 -->
                <div class="gc-mission-card"
                    style="background: rgba(30, 41, 59, 0.5); padding: 40px; border-radius: 20px; border: 1px solid rgba(255,255,255,0.05); backdrop-filter: blur(10px);">
                    <div class="gc-icon-box" style="margin-bottom: 20px;">
                        <span class="dashicons dashicons-globe"
                            style="font-size: 40px; color: var(--gc-blue-accent); background: rgba(59, 130, 246, 0.1); padding: 15px; border-radius: 50%;"></span>
                    </div>
                    <h3 style="color: white; font-size: 1.5rem; margin-bottom: 15px;">Global Sourcing</h3>
                    <p style="color: #64748b; line-height: 1.6;">We leverage proprietary technology to source vehicles,
                        machinery, and parts from verified suppliers in the USA, Europe, and China.</p>
                </div>

                <!-- Card 2 -->
                <div class="gc-mission-card"
                    style="background: rgba(30, 41, 59, 0.5); padding: 40px; border-radius: 20px; border: 1px solid rgba(255,255,255,0.05); backdrop-filter: blur(10px);">
                    <div class="gc-icon-box" style="margin-bottom: 20px;">
                        <span class="dashicons dashicons-shield"
                            style="font-size: 40px; color: var(--gc-gold); background: rgba(217, 119, 6, 0.1); padding: 15px; border-radius: 50%;"></span>
                    </div>
                    <h3 style="color: white; font-size: 1.5rem; margin-bottom: 15px;">Secure Logistics</h3>
                    <p style="color: #64748b; line-height: 1.6;">Our end-to-end logistics platform ensures your cargo is
                        tracked, insured, and delivered safely to ports like Conakry and beyond.</p>
                </div>

                <!-- Card 3 -->
                <div class="gc-mission-card"
                    style="background: rgba(30, 41, 59, 0.5); padding: 40px; border-radius: 20px; border: 1px solid rgba(255,255,255,0.05); backdrop-filter: blur(10px);">
                    <div class="gc-icon-box" style="margin-bottom: 20px;">
                        <span class="dashicons dashicons-chart-line"
                            style="font-size: 40px; color: var(--gc-green-europe); background: rgba(5, 150, 105, 0.1); padding: 15px; border-radius: 50%;"></span>
                    </div>
                    <h3 style="color: white; font-size: 1.5rem; margin-bottom: 15px;">Data-Driven Pricing</h3>
                    <p style="color: #64748b; line-height: 1.6;">We use AI to analyze market trends, ensuring you get
                        the most competitive prices on vehicles and shipping rates.</p>
                </div>

            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="gc-stats"
        style="background: rgba(15, 23, 42, 0.8); padding: 60px 0; border-top: 1px solid rgba(255,255,255,0.05); border-bottom: 1px solid rgba(255,255,255,0.05);">
        <div class="gc-container"
            style="display: flex; justify-content: space-around; flex-wrap: wrap; text-align: center;">
            <div class="gc-stat-item" style="margin: 20px;">
                <span class="gc-stat-number"
                    style="display: block; font-size: 3rem; font-weight: 800; color: white;">250+</span>
                <span class="gc-stat-label"
                    style="color: var(--gc-blue-accent); font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Vehicles
                    Shipped</span>
            </div>
            <div class="gc-stat-item" style="margin: 20px;">
                <span class="gc-stat-number"
                    style="display: block; font-size: 3rem; font-weight: 800; color: white;">15+</span>
                <span class="gc-stat-label"
                    style="color: var(--gc-gold); font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Global
                    Partners</span>
            </div>
            <div class="gc-stat-item" style="margin: 20px;">
                <span class="gc-stat-number"
                    style="display: block; font-size: 3rem; font-weight: 800; color: white;">3</span>
                <span class="gc-stat-label"
                    style="color: var(--gc-green-europe); font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Continents
                    Served</span>
            </div>
        </div>
    </section>

    <?php $fb_img_path = content_url('/docs/Images/Facebook_images/Unsorted'); ?>

    <!-- Our Operations Section -->
    <section style="background: #0F172A; padding: 70px 0;">
        <div class="gc-container">
            <div style="text-align: center; margin-bottom: 40px;">
                <span style="color: var(--gc-gold); font-size: 0.85rem; font-weight: 700; letter-spacing: 2px;">OUR OPERATIONS</span>
                <h2 style="font-family: 'Outfit', sans-serif; color: white; font-size: 2rem; font-weight: 800; margin: 10px 0 0;">Hands-On, End to End</h2>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 25px; max-width: 800px; margin: 0 auto;">
                <!-- MVK inspecting engines -->
                <div style="border-radius: 14px; overflow: hidden; position: relative;">
                    <img src="<?php echo esc_url($fb_img_path); ?>/fb_import_20260131_204852_9.jpg"
                        alt="Founder MVK personally inspecting machinery at destination"
                        loading="lazy"
                        style="width: 100%; height: 300px; object-fit: cover; object-position: center top;">
                    <div style="
                        position: absolute; bottom: 0; left: 0; right: 0;
                        background: linear-gradient(transparent, rgba(15,23,42,0.9));
                        padding: 35px 20px 20px;
                    ">
                        <p style="color: white; font-weight: 600; font-size: 0.95rem; margin: 0;">Founder-led quality checks at every destination</p>
                    </div>
                </div>

                <!-- Factory visit in China -->
                <div style="border-radius: 14px; overflow: hidden; position: relative;">
                    <img src="<?php echo esc_url($fb_img_path); ?>/fb_import_20260131_204852_2.jpg"
                        alt="Factory visit inspecting SINOTRUK heavy trucks in China"
                        loading="lazy"
                        style="width: 100%; height: 300px; object-fit: cover;">
                    <div style="
                        position: absolute; bottom: 0; left: 0; right: 0;
                        background: linear-gradient(transparent, rgba(15,23,42,0.9));
                        padding: 35px 20px 20px;
                    ">
                        <p style="color: white; font-weight: 600; font-size: 0.95rem; margin: 0;">Direct factory sourcing from Chinese manufacturers</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="gc-cta" style="padding: 100px 0; text-align: center;">
        <div class="gc-container">
            <h2 style="color: white; font-size: 2.5rem; margin-bottom: 30px;">Ready to start shipping?</h2>
            <a href="/inventory" class="gc-btn-gold"
                style="display: inline-block; padding: 16px 40px; background: linear-gradient(135deg, #d97706 0%, #b45309 100%); color: white; border-radius: 50px; font-weight: 700; text-decoration: none; font-size: 1.1rem; box-shadow: 0 10px 25px rgba(217, 119, 6, 0.4);">Browse
                Inventory</a>
        </div>
    </section>

</div>

<?php get_footer(); ?>