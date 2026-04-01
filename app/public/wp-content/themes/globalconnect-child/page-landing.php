<?php

/**
 * Template Name: GlobalConnect Landing Page
 * Description: A custom, high-performance landing page template.
 */

get_header();
?>

<div id="gc-landing-page">

    <!-- 1. ADVANCED HERO SECTION (Glidtech Style) -->
    <section class="gc-hero">

        <!-- Hero Background Image (replaced video — Pexels blocks hotlinking with 403) -->
        <div class="gc-hero-video-container">
            <img src="<?php echo esc_url(content_url('/uploads/2026/03/cargo-ship-hero.jpg')); ?>"
                alt="Container ship at port — GlobalConnect logistics"
                class="gc-hero-bg-image"
                loading="eager"
                fetchpriority="high">
        </div>

        <!-- Floating Particles Overlay -->
        <div class="gc-hero-overlay">
            <div class="gc-floating-element"></div>
            <div class="gc-floating-element"></div>
            <div class="gc-floating-element"></div>
        </div>

        <div class="gc-container">
            <div class="gc-hero-content">

                <!-- Trust Badge -->
                <div class="gc-hero-badge">
                    <span class="gc-badge-icon"><span class="dashicons dashicons-admin-site-alt3"></span></span>
                    TRUSTED GLOBAL WHOLESALE PARTNER
                </div>

                <!-- Animated Headline -->
                <h1>
                    <span class="gc-headline-line">USA<span class="gc-headline-divider" aria-hidden="true">\</span>Europe<span
                            class="gc-headline-divider" aria-hidden="true">\</span>China</span>
                    <span class="gc-headline-line">Meet Global Markets</span>
                </h1>

                <!-- Subheadline -->
                <p>
                    Quality vehicles from <span class="gc-highlight-text">USA & Europe</span>.
                    Heavy trucks, tires & parts from <span class="gc-highlight-text">China</span>.
                    Delivering wholesale solutions to Africa, Asia & the Americas.
                </p>

                <!-- CTA Buttons -->
                <div class="gc-hero-actions">
                    <a href="#inventory" class="gc-btn gc-btn-primary gc-btn-magnetic">
                        <span class="dashicons dashicons-car"></span> Browse Inventory
                    </a>
                    <a href="<?php echo esc_url(home_url('/contact')); ?>" class="gc-btn gc-btn-gold gc-btn-magnetic">
                        <span class="dashicons dashicons-money-alt"></span> Get Wholesale Quote
                    </a>
                    <a href="#shipping" class="gc-btn gc-btn-glass gc-btn-magnetic">
                        <span class="dashicons dashicons-chart-bar"></span> Container Pricing
                    </a>
                </div>

                <!-- Trust Badges (Bottom) -->
                <div class="gc-trust-badges-hero">
                    <span><span class="dashicons dashicons-awards"></span> 10+ Years Experience</span>
                    <span><span class="dashicons dashicons-globe-alt"></span> 3-Continent Sourcing</span>
                    <span><span class="dashicons dashicons-store"></span> Export to 20+ Countries</span>
                </div>
            </div>
        </div>

        <!-- Decorative Wave (Preserved) -->
        <div class="gc-wave-bottom">
            <svg viewBox="0 0 1440 320" xmlns="http://www.w3.org/2000/svg">
                <path fill="#F8FAFC" fill-opacity="1"
                    d="M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,224C672,245,768,267,864,261.3C960,256,1056,224,1152,197.3C1248,171,1344,149,1392,138.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
                </path>
            </svg>
        </div>
    </section>

    <!-- LIVE OPERATION TICKER (Dynamic) -->
    <div class="gc-marquee-container" role="marquee" aria-label="Live shipping updates">
        <div class="gc-marquee-content">
            <?php
            $ticker_items = globalconnect_get_ticker_items();
            foreach ($ticker_items as $item):
            ?>
                <div class="gc-marquee-item"><span class="gc-live-dot" aria-hidden="true"></span> <?php echo esc_html($item['text']); ?></div>
            <?php endforeach; ?>
            <?php
            // Duplicate for seamless scroll
            foreach ($ticker_items as $item):
            ?>
                <div class="gc-marquee-item" aria-hidden="true"><span class="gc-live-dot" aria-hidden="true"></span> <?php echo esc_html($item['text']); ?></div>
            <?php endforeach; ?>
        </div>
        <button class="gc-marquee-pause" aria-label="Pause ticker" id="gc-ticker-pause">&#10074;&#10074;</button>
    </div>

    <!-- 2. PRODUCT CATEGORIES -->
    <section class="gc-section gc-categories-section"
        style="background: #0F172A; position: relative; overflow: hidden; padding: 80px 0;">
        <!-- Tech Grid Background -->
        <div
            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px); background-size: 40px 40px; pointer-events: none;">
        </div>

        <div class="gc-container" style="position: relative; z-index: 2;">
            <div class="gc-section-header text-center gc-reveal-up" data-target="gc-categories-section">
                <span class="gc-header-data"
                    style="color: var(--gc-gold); text-shadow: 0 0 10px rgba(250, 204, 21, 0.3);">INVENTORY +
                    CATEGORIES</span>
                <h2 class="gc-tech-title" style="color: white; margin-top: 10px;">Browse<span class="gc-tech-divider" aria-hidden="true"
                        style="opacity:0.6">\</span>by<span class="gc-tech-divider" style="opacity:0.6">\</span>Product
                </h2>
                <p style="color: #94a3b8; max-width: 600px; margin: 15px auto 0;">Find exactly what you need for your
                    business in West Africa. Direct from global hubs.</p>
            </div>

            <div class="gc-category-grid gc-stagger-child" data-target="gc-categories-section"
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 24px; margin-top: 50px;">

                <!-- Card 1: Vehicles -->
                <a href="<?php echo esc_url(site_url('/shop/?category=vehicles')); ?>" class="gc-tech-cat-card"
                    style="display: block; text-decoration: none;">
                    <article
                        style="background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 12px; padding: 30px; transition: all 0.3s ease; height: 100%; position: relative; overflow: hidden;">
                        <div class="gc-cat-glow"
                            style="position: absolute; top: -50px; right: -50px; width: 100px; height: 100px; background: var(--gc-blue-primary); filter: blur(60px); opacity: 0.2;">
                        </div>
                        <div class="gc-cat-icon"
                            style="background: rgba(59, 130, 246, 0.1); width: 60px; height: 60px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px; border: 1px solid rgba(59, 130, 246, 0.2);">
                            <span class="dashicons dashicons-car"
                                style="font-size: 32px; color: var(--gc-blue-accent); width: 32px; height: 32px;"></span>
                        </div>
                        <h3
                            style="color: white; font-family: 'Outfit', sans-serif; font-size: 1.25rem; margin-bottom: 8px;">
                            Cars & SUVs</h3>
                        <p style="color: #94a3b8; font-size: 0.9rem; line-height: 1.5;">Clean title used vehicles
                            sourced from USA & Europe auctions.</p>
                        <div class="gc-cat-arrow"
                            style="margin-top: 20px; color: var(--gc-gold); font-family: var(--gc-font-mono); font-size: 0.8rem; display: flex; align-items: center; gap: 5px;">
                            VIEW STOCK <span class="dashicons dashicons-arrow-right-alt2"
                                style="font-size: 14px;"></span>
                        </div>
                    </article>
                </a>

                <!-- Card 2: Machinery -->
                <a href="<?php echo esc_url(site_url('/shop/?category=machines-parts')); ?>" class="gc-tech-cat-card"
                    style="display: block; text-decoration: none;">
                    <article
                        style="background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 12px; padding: 30px; transition: all 0.3s ease; height: 100%; position: relative; overflow: hidden;">
                        <div class="gc-cat-glow"
                            style="position: absolute; top: -50px; right: -50px; width: 100px; height: 100px; background: var(--gc-gold); filter: blur(60px); opacity: 0.15;">
                        </div>
                        <div class="gc-cat-icon"
                            style="background: rgba(234, 179, 8, 0.1); width: 60px; height: 60px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px; border: 1px solid rgba(234, 179, 8, 0.2);">
                            <span class="dashicons dashicons-hammer"
                                style="font-size: 32px; color: var(--gc-gold); width: 32px; height: 32px;"></span>
                        </div>
                        <h3
                            style="color: white; font-family: 'Outfit', sans-serif; font-size: 1.25rem; margin-bottom: 8px;">
                            Heavy Machinery</h3>
                        <p style="color: #94a3b8; font-size: 0.9rem; line-height: 1.5;">Excavators, bulldozers, and
                            cranes direct from China factories.</p>
                        <div class="gc-cat-arrow"
                            style="margin-top: 20px; color: var(--gc-gold); font-family: var(--gc-font-mono); font-size: 0.8rem; display: flex; align-items: center; gap: 5px;">
                            VIEW STOCK <span class="dashicons dashicons-arrow-right-alt2"
                                style="font-size: 14px;"></span>
                        </div>
                    </article>
                </a>

                <!-- Card 3: Tires -->
                <a href="<?php echo esc_url(site_url('/shop/?category=tires')); ?>" class="gc-tech-cat-card"
                    style="display: block; text-decoration: none;">
                    <article
                        style="background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 12px; padding: 30px; transition: all 0.3s ease; height: 100%; position: relative; overflow: hidden;">
                        <div class="gc-cat-glow"
                            style="position: absolute; top: -50px; right: -50px; width: 100px; height: 100px; background: var(--gc-red-china); filter: blur(60px); opacity: 0.15;">
                        </div>
                        <div class="gc-cat-icon"
                            style="background: rgba(220, 38, 38, 0.1); width: 60px; height: 60px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px; border: 1px solid rgba(220, 38, 38, 0.2);">
                            <span class="dashicons dashicons-marker"
                                style="font-size: 32px; color: var(--gc-red-china); width: 32px; height: 32px;"></span>
                        </div>
                        <h3
                            style="color: white; font-family: 'Outfit', sans-serif; font-size: 1.25rem; margin-bottom: 8px;">
                            Bulk Tires</h3>
                        <p style="color: #94a3b8; font-size: 0.9rem; line-height: 1.5;">New and used tires in bulk
                            quantities. Container load pricing.</p>
                        <div class="gc-cat-arrow"
                            style="margin-top: 20px; color: var(--gc-gold); font-family: var(--gc-font-mono); font-size: 0.8rem; display: flex; align-items: center; gap: 5px;">
                            VIEW STOCK <span class="dashicons dashicons-arrow-right-alt2"
                                style="font-size: 14px;"></span>
                        </div>
                    </article>
                </a>

                <!-- Card 4: Parts -->
                <a href="<?php echo esc_url(site_url('/shop/?category=machines-parts')); ?>" class="gc-tech-cat-card"
                    style="display: block; text-decoration: none;">
                    <article
                        style="background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 12px; padding: 30px; transition: all 0.3s ease; height: 100%; position: relative; overflow: hidden;">
                        <div class="gc-cat-glow"
                            style="position: absolute; top: -50px; right: -50px; width: 100px; height: 100px; background: var(--gc-blue-secondary); filter: blur(60px); opacity: 0.2;">
                        </div>
                        <div class="gc-cat-icon"
                            style="background: rgba(71, 85, 105, 0.2); width: 60px; height: 60px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px; border: 1px solid rgba(71, 85, 105, 0.3);">
                            <span class="dashicons dashicons-admin-tools"
                                style="font-size: 32px; color: #94a3b8; width: 32px; height: 32px;"></span>
                        </div>
                        <h3
                            style="color: white; font-family: 'Outfit', sans-serif; font-size: 1.25rem; margin-bottom: 8px;">
                            Auto Parts</h3>
                        <p style="color: #94a3b8; font-size: 0.9rem; line-height: 1.5;">Engines, transmissions, and
                            spare parts for all major brands.</p>
                        <div class="gc-cat-arrow"
                            style="margin-top: 20px; color: var(--gc-gold); font-family: var(--gc-font-mono); font-size: 0.8rem; display: flex; align-items: center; gap: 5px;">
                            VIEW STOCK <span class="dashicons dashicons-arrow-right-alt2"
                                style="font-size: 14px;"></span>
                        </div>
                    </article>
                </a>

            </div>
        </div>
    </section>

    <!-- Global Sourcing Network -->
    <section class="gc-sourcing-section">
        <div class="gc-container">
            <div class="gc-section-header text-center gc-reveal-up" data-target="gc-sourcing-section">
                <span class="gc-header-data">GLOBAL + LOGISTICS + HUBS</span>
                <h2 class="gc-tech-title">Global<span class="gc-tech-divider" aria-hidden="true">\</span>Sourcing<span
                        class="gc-tech-divider" aria-hidden="true">\</span>Network</h2>
                <p>We source directly from the world's biggest automotive hubs.</p>
            </div>
            <div class="gc-card-row gc-stagger-child" data-target="gc-sourcing-section"> <!-- Grid for Sourcing -->

                <!-- USA Column -->
                <div class="gc-source-col usa">
                    <h3><img src="https://flagcdn.com/w40/us.png" alt="USA"> USA Sourcing</h3>
                    <ul class="gc-source-list">
                        <li><span class="dashicons dashicons-yes-alt"></span> Clean Title Vehicles</li>
                        <li><span class="dashicons dashicons-yes-alt"></span> Insurance Auto Auctions (IAA)</li>
                        <li><span class="dashicons dashicons-yes-alt"></span> Manheim & Copart Access</li>
                        <li><span class="dashicons dashicons-yes-alt"></span> Fast Shipping from East Coast</li>
                    </ul>
                </div>

                <!-- Europe Column -->
                <div class="gc-source-col europe">
                    <h3><img src="https://flagcdn.com/w40/eu.png" alt="Europe"> Europe Sourcing</h3>
                    <ul class="gc-source-list">
                        <li><span class="dashicons dashicons-yes-alt"></span> Diesel Engines (Toyota, Mercedes)</li>
                        <li><span class="dashicons dashicons-yes-alt"></span> Manual Transmission Vans</li>
                        <li><span class="dashicons dashicons-yes-alt"></span> High Quality Used Parts</li>
                        <li><span class="dashicons dashicons-yes-alt"></span> Shipping from Antwerp/Hamburg</li>
                    </ul>
                </div>

                <!-- China Column -->
                <div class="gc-source-col china">
                    <h3><img src="https://flagcdn.com/w40/cn.png" alt="China"> China Direct</h3>
                    <ul class="gc-source-list">
                        <li><span class="dashicons dashicons-yes-alt"></span> Brand New Heavy Trucks (Sinotruk)</li>
                        <li><span class="dashicons dashicons-yes-alt"></span> Construction Machinery (SANY, XCMG)</li>
                        <li><span class="dashicons dashicons-yes-alt"></span> Bulk Tires & Spare Parts</li>
                        <li><span class="dashicons dashicons-yes-alt"></span> Factory Direct Pricing</li>
                    </ul>
                </div>

            </div>
        </div>
    </section>

    <!-- Feature Section: China Heavy Machinery (Highlight) -->
    <section class="gc-china-highlight">
        <div class="gc-container">
            <div class="gc-china-grid">
                <div class="gc-china-content gc-reveal-left" data-target="gc-china-highlight">
                    <span class="gc-pill-label"
                        style="border-color: var(--gc-red-china); color: var(--gc-red-china);">Factory Direct</span>
                    <h2><span class="dashicons dashicons-hammer"></span> Heavy Duty Solutions from China</h2>
                    <p class="lead">We are your direct link to China's top manufacturers for heavy trucks, machinery,
                        and parts.</p>

                    <div class="gc-china-features">
                        <div class="gc-china-feat">
                            <h4><span class="dashicons dashicons-performance"></span> Sinotruk Howo</h4>
                            <p>Brand new tractor heads and dump trucks at factory prices.</p>
                        </div>
                        <div class="gc-china-feat">
                            <h4><span class="dashicons dashicons-category"></span> Bulk Tires</h4>
                            <p>Container loads of truck and PCR tires. Premium brands available.</p>
                        </div>
                    </div>

                    <a href="/china-sourcing" class="gc-btn gc-btn-primary gc-btn-magnetic">Explore China Inventory</a>
                </div>
                <div class="gc-china-image gc-reveal-right" data-target="gc-china-highlight">
                    <div class="gc-china-showcase"
                        style="position:relative; width:100%; height:100%; min-height:400px; background:#0f172a; border-radius:12px; overflow:hidden; border:1px solid #334155;">

                        <!-- Slide 1: Sinotruk -->
                        <div class="gc-showcase-slide active"
                            style="position:absolute; inset:0; transition: opacity 0.5s ease-in-out; opacity:1;">
                            <img src="<?php echo esc_url(content_url('/uploads/2026/03/sinotruk-howo-8x4-slider.jpg')); ?>"
                                alt="Sinotruk Howo 8x4 dump truck for export to Africa" width="800" height="533" loading="lazy" style="width:100%; height:100%; object-fit:cover; opacity:0.6;">
                            <div class="gc-slide-overlay"
                                style="position:absolute; bottom:20px; left:20px; right:20px; color:white;">
                                <div class="gc-tech-badge" style="display:inline-block; margin-bottom:10px;">HEAVY
                                    TRANSPORT</div>
                                <h3
                                    style="font-family:'Outfit',sans-serif; font-size:1.5rem; text-transform:uppercase;">
                                    Sinotruk Howo 8x4</h3>
                                <div class="gc-tech-grid"
                                    style="margin-top:10px; border-top:1px solid rgba(255,255,255,0.2); padding-top:10px;">
                                    <div class="gc-tech-data-point"><span style="color:#94a3b8;">PAYLOAD</span><span
                                            style="color:white; font-family:var(--gc-font-mono);">40 Tons</span></div>
                                    <div class="gc-tech-data-point"><span style="color:#94a3b8;">ENGINE</span><span
                                            style="color:white; font-family:var(--gc-font-mono);">420 HP</span></div>
                                </div>
                            </div>
                        </div>

                        <!-- Slide 2: Excavator -->
                        <div class="gc-showcase-slide"
                            style="position:absolute; inset:0; transition: opacity 0.5s ease-in-out; opacity:0;">
                            <img src="<?php echo esc_url(content_url('/uploads/2026/03/sany-sy215c-excavator-slider.jpg')); ?>"
                                alt="SANY SY215C excavator for construction export" width="800" height="533" loading="lazy" style="width:100%; height:100%; object-fit:cover; opacity:0.6;">
                            <div class="gc-slide-overlay"
                                style="position:absolute; bottom:20px; left:20px; right:20px; color:white;">
                                <div class="gc-tech-badge" style="display:inline-block; margin-bottom:10px;">
                                    CONSTRUCTION</div>
                                <h3
                                    style="font-family:'Outfit',sans-serif; font-size:1.5rem; text-transform:uppercase;">
                                    SANY SY215C</h3>
                                <div class="gc-tech-grid"
                                    style="margin-top:10px; border-top:1px solid rgba(255,255,255,0.2); padding-top:10px;">
                                    <div class="gc-tech-data-point"><span style="color:#94a3b8;">WEIGHT</span><span
                                            style="color:white; font-family:var(--gc-font-mono);">22 Tons</span></div>
                                    <div class="gc-tech-data-point"><span style="color:#94a3b8;">BUCKET</span><span
                                            style="color:white; font-family:var(--gc-font-mono);">1.0 m³</span></div>
                                </div>
                            </div>
                        </div>

                        <!-- Slide 3: Tires -->
                        <div class="gc-showcase-slide"
                            style="position:absolute; inset:0; transition: opacity 0.5s ease-in-out; opacity:0;">
                            <img src="<?php echo esc_url(content_url('/uploads/2026/03/pcr-tbr-tires-slider.jpg')); ?>"
                                alt="Chinese wholesale tires for export to West Africa" width="800" height="533" loading="lazy" style="width:100%; height:100%; object-fit:cover; opacity:0.6;">
                            <div class="gc-slide-overlay"
                                style="position:absolute; bottom:20px; left:20px; right:20px; color:white;">
                                <div class="gc-tech-badge" style="display:inline-block; margin-bottom:10px;">RUBBER &
                                    PARTS</div>
                                <h3
                                    style="font-family:'Outfit',sans-serif; font-size:1.5rem; text-transform:uppercase;">
                                    PCR & TBR Tires</h3>
                                <div class="gc-tech-grid"
                                    style="margin-top:10px; border-top:1px solid rgba(255,255,255,0.2); padding-top:10px;">
                                    <div class="gc-tech-data-point"><span style="color:#94a3b8;">MOQ</span><span
                                            style="color:white; font-family:var(--gc-font-mono);">1 Container</span>
                                    </div>
                                    <div class="gc-tech-data-point"><span style="color:#94a3b8;">ORIGIN</span><span
                                            style="color:white; font-family:var(--gc-font-mono);">Shandong</span></div>
                                </div>
                            </div>
                        </div>

                        <!-- Navigation -->
                        <div class="gc-slider-nav"
                            style="position:absolute; bottom:20px; right:20px; display:flex; gap:10px; z-index:10;">
                            <button onclick="prevSlide()"
                                style="background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.2); color:white; width:30px; height:30px; border-radius:50%; cursor:pointer; display:flex; align-items:center; justify-content:center;"><span
                                    class="dashicons dashicons-arrow-left-alt2"
                                    style="font-size:14px; width:14px; height:14px;"></span></button>
                            <button onclick="nextSlide()"
                                style="background:var(--gc-blue-primary); border:none; color:white; width:30px; height:30px; border-radius:50%; cursor:pointer; display:flex; align-items:center; justify-content:center;"><span
                                    class="dashicons dashicons-arrow-right-alt2"
                                    style="font-size:14px; width:14px; height:14px;"></span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. FEATURED INVENTORY (TABBED) -->
    <section id="inventory" class="gc-section gc-inventory-section">
        <div class="gc-container">
            <div class="gc-section-header">
                <span class="gc-header-data">LIVE + STOCK + DATA</span>
                <h2 class="gc-tech-title">Wholesale<span class="gc-tech-divider" aria-hidden="true">\</span>Inventory</h2>
            </div>

            <!-- Tabs -->
            <div class="gc-tabs-nav">
                <button class="gc-tab-btn active" onclick="openTab('inv-usa')">🇺🇸 USA Inventory</button>
                <button class="gc-tab-btn" data-tab="europe" onclick="openTab('inv-europe')">🇪🇺 Europe
                    Inventory</button>
                <button class="gc-tab-btn" data-tab="china" onclick="openTab('inv-china')">🇨🇳 China Direct</button>
            </div>

            <!-- Tab Content: USA -->
            <div id="inv-usa" class="gc-inventory-tab" style="display:block;">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/generated/inventory-usa-header.jpg"
                    class="gc-tab-header-image" alt="USA Inventory - Ports & Logistics" loading="lazy">
                <div class="gc-inventory-grid">
                    <?php
                    // Query for USA or Fallback
                    $args_usa = array(
                        'post_type' => 'vehicle',
                        'posts_per_page' => 4,
                        'tax_query' => array(
                            'relation' => 'OR',
                            array('taxonomy' => 'vehicle_source', 'field' => 'slug', 'terms' => 'usa'),
                            array('taxonomy' => 'vehicle_source', 'operator' => 'NOT EXISTS') // Fallback for existing items
                        )
                    );
                    $query_usa = new WP_Query($args_usa);
                    if ($query_usa->have_posts()) {
                        while ($query_usa->have_posts()) {
                            $query_usa->the_post();
                            get_template_part('includes/parts/content', 'vehicle-card');
                        }
                    } else {
                        echo '<p>No USA Inventory loaded yet.</p>';
                    }
                    wp_reset_postdata();
                    ?>
                </div>
            </div>

            <!-- Tab Content: Europe -->
            <div id="inv-europe" class="gc-inventory-tab" style="display:none;">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/generated/inventory-europe-header.jpg"
                    class="gc-tab-header-image" alt="Europe Inventory - Premium Sourcing" loading="lazy">
                <div class="gc-inventory-grid">
                    <?php
                    $args_eu = array(
                        'post_type' => 'vehicle',
                        'posts_per_page' => 4,
                        'tax_query' => array(
                            array('taxonomy' => 'vehicle_source', 'field' => 'slug', 'terms' => 'europe')
                        )
                    );
                    $query_eu = new WP_Query($args_eu);
                    if ($query_eu->have_posts()) {
                        while ($query_eu->have_posts()) {
                            $query_eu->the_post();
                            get_template_part('includes/parts/content', 'vehicle-card');
                        }
                    } else {
                        // European Placeholder
                        echo '<div class="gc-empty-msg">No European stock listed currently. <a href="/contact">Request European Sourcing</a></div>';
                    }
                    wp_reset_postdata();
                    ?>
                </div>
            </div>

            <!-- Tab Content: China (Hardcoded Examples as requested) -->
            <!-- Tab Content: China (Dynamic) -->
            <div id="inv-china" class="gc-inventory-tab" style="display:none;">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/generated/inventory-china-header.jpg"
                    class="gc-tab-header-image" alt="China Direct - Heavy Machinery & Tires" loading="lazy">
                <div class="gc-inventory-grid">
                    <?php
                    $args_cn = array(
                        'post_type' => array('vehicle', 'part'),
                        'posts_per_page' => 4,
                        'tax_query' => array(
                            array('taxonomy' => 'vehicle_source', 'field' => 'slug', 'terms' => 'china')
                        )
                    );
                    $query_cn = new WP_Query($args_cn);
                    if ($query_cn->have_posts()) {
                        while ($query_cn->have_posts()) {
                            $query_cn->the_post();
                            if (get_post_type() === 'vehicle') {
                                get_template_part('includes/parts/content', 'vehicle-card');
                            } else {
                                get_template_part('includes/parts/content', 'part-card');
                            }
                        }
                    } else {
                        echo '<div class="gc-empty-msg">No China direct inventory listed currently. <a href="/china-sourcing">View Catalog</a></div>';
                    }
                    wp_reset_postdata();
                    ?>
                </div>
            </div>

        </div>
    </section>

    <!-- 6. CALCULATORS -->
    <section id="shipping" class="gc-section" style="background:var(--gc-off-white);">
        <div class="gc-container">
            <div class="gc-section-header">
                <h2>Shipping Cost Calculators</h2>
            </div>
            <div class="gc-card-row">
                <!-- Vehicle Calc -->
                <div class="gc-glass-panel">
                    <h3>📦 Vehicle Shipping</h3>
                    <?php echo do_shortcode('[globalconnect_calculator]'); ?>
                </div>

                <!-- Tire/Container Calc -->
                <div class="gc-glass-panel">
                    <?php echo do_shortcode('[globalconnect_tire_calculator]'); ?>
                </div>
            </div>
        </div>
    </section>

    <!-- 7. FAQ China Specific -->
    <section class="gc-section" style="background:var(--gc-off-white);">
        <div class="gc-container">
            <div class="gc-section-header">
                <span class="gc-header-data">KNOWLEDGE + BASE</span>
                <h2 class="gc-tech-title">Frequently<span class="gc-tech-divider" aria-hidden="true">\</span>Asked<span
                        class="gc-tech-divider" aria-hidden="true">\</span>Questions</h2>
            </div>
            <div style="max-width:800px; margin:0 auto;">
                <details style="background:white; padding:20px; border-radius:8px; margin-bottom:15px; cursor:pointer;">
                    <summary style="font-weight:bold; color:var(--gc-blue-primary);">What vehicles can I get from China?
                    </summary>
                    <p style="margin-top:10px; color:var(--gc-text-muted);">Heavy commercial trucks only - dump trucks,
                        tractor heads, cargo trucks. For cars and SUVs, we source from USA and Europe.</p>
                </details>
                <details style="background:white; padding:20px; border-radius:8px; margin-bottom:15px; cursor:pointer;">
                    <summary style="font-weight:bold; color:var(--gc-blue-primary);">Are Chinese heavy trucks reliable?
                    </summary>
                    <p style="margin-top:10px; color:var(--gc-text-muted);">Yes, brands like Sinotruk and FAW are proven
                        workhorses used worldwide, especially suited for developing markets and heavy-duty applications.
                    </p>
                </details>
                <details style="background:white; padding:20px; border-radius:8px; margin-bottom:15px; cursor:pointer;">
                    <summary style="font-weight:bold; color:var(--gc-blue-primary);">What's the advantage of Chinese
                        tires?</summary>
                    <p style="margin-top:10px; color:var(--gc-text-muted);">Unbeatable wholesale pricing for bulk
                        quantities. Perfect for tire dealers and fleet operators. 40ft container holds 800-1200 tires.
                    </p>
                </details>
            </div>
        </div>
    </section>

</div>

<script>
    function openTab(tabId) {
        // Hide all tabs
        document.querySelectorAll('.gc-inventory-tab').forEach(el => el.style.display = 'none');
        // Show selected
        document.getElementById(tabId).style.display = 'block';

        // Update Active State
        document.querySelectorAll('.gc-tab-btn').forEach(el => el.classList.remove('active'));
        event.currentTarget.classList.add('active');
    }

    // --- Product Showcase Slider Logic ---
    let currentSlide = 0;
    const slides = document.querySelectorAll('.gc-showcase-slide');
    const totalSlides = slides.length;

    function showSlide(index) {
        // Handle wrapping
        if (index >= totalSlides) currentSlide = 0;
        else if (index < 0) currentSlide = totalSlides - 1;
        else currentSlide = index;

        // Update UI
        slides.forEach((slide, i) => {
            slide.style.opacity = (i === currentSlide) ? '1' : '0';
            slide.classList.toggle('active', i === currentSlide);
        });
    }

    function nextSlide() {
        showSlide(currentSlide + 1);
    }

    function prevSlide() {
        showSlide(currentSlide - 1);
    }

    // Auto-rotate every 5 seconds
    setInterval(() => {
        nextSlide();
    }, 5000);

    // Initial setup (ensure only first is visible if CSS didn't catch it)
    showSlide(0);
</script>

<?php $fb_img_path = content_url('/docs/Images/Facebook_images/Unsorted'); ?>

<!-- FROM THE FIELD - Trust Gallery -->
<section style="background: #F8FAFC; padding: 70px 0; overflow: hidden;">
    <div class="gc-container">
        <div style="text-align: center; margin-bottom: 40px;">
            <span style="
                    display: inline-block;
                    background: rgba(15,23,42,0.08);
                    color: #0F172A;
                    padding: 8px 20px;
                    border-radius: 30px;
                    font-size: 0.8rem;
                    font-weight: 700;
                    letter-spacing: 2px;
                    margin-bottom: 15px;
                ">FROM THE FIELD</span>
            <h2
                style="font-family: 'Outfit', sans-serif; font-size: 2.2rem; font-weight: 800; color: #0F172A; margin: 0;">
                Real Operations<span class="gc-tech-divider" aria-hidden="true">\</span>Real Results
            </h2>
            <p style="color: #64748b; max-width: 500px; margin: 10px auto 0; font-size: 0.95rem;">
                See our team at work across 3 continents. Every photo is from our actual operations.
            </p>
        </div>

        <div class="gc-field-gallery" style="
                display: grid;
                grid-template-columns: 2fr 1fr 1fr;
                gap: 20px;
                max-width: 1000px;
                margin: 0 auto;
            ">
            <!-- Large Feature Image: Jeep Wrangler at Container -->
            <div style="
                    grid-row: span 2;
                    border-radius: 16px;
                    overflow: hidden;
                    position: relative;
                    min-height: 400px;
                ">
                <img src="<?php echo esc_url($fb_img_path); ?>/fb_import_20260131_204852_8.jpg"
                    alt="Jeep Wrangler being loaded for export at our Philadelphia facility" loading="lazy"
                    style="width: 100%; height: 100%; object-fit: cover;">
                <div style="
                        position: absolute; bottom: 0; left: 0; right: 0;
                        background: linear-gradient(transparent, rgba(15,23,42,0.85));
                        padding: 40px 25px 25px;
                    ">
                    <span
                        style="background: var(--gc-gold); color: #0F172A; padding: 4px 12px; border-radius: 4px; font-size: 0.7rem; font-weight: 700; letter-spacing: 1px;">PHILADELPHIA,
                        USA</span>
                    <p style="color: white; font-weight: 600; margin: 10px 0 0; font-size: 1rem;">Container Loading
                        Operations</p>
                </div>
            </div>

            <!-- Top Right: Container Tire Loading -->
            <div style="
                    border-radius: 16px;
                    overflow: hidden;
                    position: relative;
                ">
                <img src="<?php echo esc_url($fb_img_path); ?>/fb_import_20260131_204852_10.jpg"
                    alt="Team loading tires into shipping container" loading="lazy"
                    style="width: 100%; height: 100%; object-fit: cover; min-height: 190px;">
                <div style="
                        position: absolute; bottom: 0; left: 0; right: 0;
                        background: linear-gradient(transparent, rgba(15,23,42,0.85));
                        padding: 30px 15px 15px;
                    ">
                    <span
                        style="background: var(--gc-gold); color: #0F172A; padding: 3px 10px; border-radius: 4px; font-size: 0.65rem; font-weight: 700;">LOGISTICS</span>
                    <p style="color: white; font-weight: 600; margin: 8px 0 0; font-size: 0.85rem;">Tire Container
                        Packing</p>
                </div>
            </div>

            <!-- Bottom Right: MVK Inspecting Engines -->
            <div style="
                    border-radius: 16px;
                    overflow: hidden;
                    position: relative;
                ">
                <img src="<?php echo esc_url($fb_img_path); ?>/fb_import_20260131_204852_9.jpg"
                    alt="Founder MVK inspecting CAT engines at destination market" loading="lazy"
                    style="width: 100%; height: 100%; object-fit: cover; object-position: center top; min-height: 190px;">
                <div style="
                        position: absolute; bottom: 0; left: 0; right: 0;
                        background: linear-gradient(transparent, rgba(15,23,42,0.85));
                        padding: 30px 15px 15px;
                    ">
                    <span
                        style="background: var(--gc-gold); color: #0F172A; padding: 3px 10px; border-radius: 4px; font-size: 0.65rem; font-weight: 700;">WEST
                        AFRICA</span>
                    <p style="color: white; font-weight: 600; margin: 8px 0 0; font-size: 0.85rem;">Quality Inspection
                        On-Site</p>
                </div>
            </div>
        </div>

        <!-- Trust Stats Bar -->
        <div style="
                display: flex;
                justify-content: center;
                gap: 40px;
                margin-top: 35px;
                flex-wrap: wrap;
            ">
            <div style="text-align: center;">
                <div style="font-family: 'Outfit', sans-serif; font-size: 1.8rem; font-weight: 800; color: #0F172A;">
                    500+</div>
                <div style="color: #64748b; font-size: 0.8rem; font-weight: 600;">Containers Shipped</div>
            </div>
            <div style="text-align: center;">
                <div style="font-family: 'Outfit', sans-serif; font-size: 1.8rem; font-weight: 800; color: #0F172A;">10+
                </div>
                <div style="color: #64748b; font-size: 0.8rem; font-weight: 600;">Years In Business</div>
            </div>
            <div style="text-align: center;">
                <div style="font-family: 'Outfit', sans-serif; font-size: 1.8rem; font-weight: 800; color: #0F172A;">3
                </div>
                <div style="color: #64748b; font-size: 0.8rem; font-weight: 600;">Continents Served</div>
            </div>
            <div style="text-align: center;">
                <div style="font-family: 'Outfit', sans-serif; font-size: 1.8rem; font-weight: 800; color: #0F172A;">
                    24/7</div>
                <div style="color: #64748b; font-size: 0.8rem; font-weight: 600;">WhatsApp Support</div>
            </div>
        </div>
    </div>
</section>

<style>
    @media (max-width: 768px) {
        .gc-field-gallery {
            grid-template-columns: 1fr !important;
        }

        .gc-field-gallery>div:first-child {
            grid-row: span 1 !important;
            min-height: 250px !important;
        }
    }
</style>

<!-- FOUNDER SECTION (Before Footer) -->
<section class="gc-founder-section" style="
        position: relative;
        min-height: 500px;
        background: linear-gradient(135deg, #0F172A 0%, #1E293B 50%, #0F172A 100%);
        overflow: hidden;
        display: flex;
        align-items: center;
    ">
    <!-- Background Pattern -->
    <div style="
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: 
                radial-gradient(circle at 20% 80%, rgba(212,175,55,0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(30,58,95,0.3) 0%, transparent 50%);
            pointer-events: none;
        "></div>

    <!-- Grid Lines Decoration -->
    <div style="
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
            background-size: 50px 50px;
            pointer-events: none;
        "></div>

    <div class="gc-container" style="position: relative; z-index: 2;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;"
            class="gc-founder-grid">

            <!-- Left: Text Content -->
            <div style="padding-right: 40px;">
                <span style="
                        display: inline-block;
                        background: rgba(212,175,55,0.2);
                        color: var(--gc-gold);
                        padding: 8px 20px;
                        border-radius: 30px;
                        font-size: 0.8rem;
                        font-weight: 700;
                        letter-spacing: 2px;
                        margin-bottom: 25px;
                    ">MEET THE FOUNDER</span>

                <h2 style="
                        font-family: 'Outfit', sans-serif;
                        font-size: 3.5rem;
                        font-weight: 800;
                        line-height: 1.1;
                        margin-bottom: 25px;
                        text-transform: uppercase;
                    ">
                    <span style="color: var(--gc-gold);">CONNECTING</span>
                    <span style="color: white;"> AFRICA</span><br>
                    <span style="color: white;">TO THE </span>
                    <span style="color: var(--gc-gold);">WORLD</span>
                </h2>

                <p style="
                        color: #94A3B8;
                        font-size: 1.1rem;
                        line-height: 1.8;
                        margin-bottom: 30px;
                        max-width: 500px;
                    ">
                    From Philadelphia to West Africa, we're building bridges that transform how businesses access
                    quality vehicles, machinery, and parts. Every shipment is a promise kept.
                </p>

                <!-- Social Media Links -->
                <div style="margin-bottom: 25px;">
                    <p style="color: #64748b; font-size: 0.85rem; margin-bottom: 12px; letter-spacing: 1px;">FOLLOW
                        GLOBALCONNECT</p>
                    <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                        <!-- Facebook (GlobalConnect Page) -->
                        <a href="https://www.facebook.com/profile.php?id=100071518400878" target="_blank" rel="noopener noreferrer"
                            title="GlobalConnect on Facebook" style="
                                width: 45px; height: 45px;
                                background: #1877F2;
                                border-radius: 10px;
                                display: flex; align-items: center; justify-content: center;
                                color: white;
                                transition: transform 0.3s, box-shadow 0.3s;
                            "
                            onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 25px rgba(24,119,242,0.5)';"
                            onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none';">
                            <svg width="22" height="22" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                        <!-- Instagram -->
                        <a href="#" target="_blank" rel="noopener noreferrer" title="GlobalConnect on Instagram" style="
                                width: 45px; height: 45px;
                                background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
                                border-radius: 10px;
                                display: flex; align-items: center; justify-content: center;
                                color: white;
                                transition: transform 0.3s, box-shadow 0.3s;
                            ">
                            <svg width="22" height="22" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </a>
                        <!-- X (Twitter) -->
                        <a href="#" target="_blank" rel="noopener noreferrer" title="GlobalConnect on X" style="
                                width: 45px; height: 45px;
                                background: #000000;
                                border-radius: 10px;
                                display: flex; align-items: center; justify-content: center;
                                color: white;
                                transition: transform 0.3s, box-shadow 0.3s;
                            ">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                            </svg>
                        </a>
                        <!-- TikTok -->
                        <a href="#" target="_blank" rel="noopener noreferrer" title="GlobalConnect on TikTok" style="
                                width: 45px; height: 45px;
                                background: #000000;
                                border-radius: 10px;
                                display: flex; align-items: center; justify-content: center;
                                color: white;
                                transition: transform 0.3s, box-shadow 0.3s;
                            ">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div style="display: flex; align-items: center; gap: 20px; flex-wrap: wrap;">
                    <a href="https://www.facebook.com/segbehmadee.konneh" target="_blank" rel="noopener noreferrer" style="
                            display: inline-flex;
                            align-items: center;
                            gap: 10px;
                            background: rgba(255,255,255,0.1);
                            border: 1px solid rgba(255,255,255,0.2);
                            color: white;
                            padding: 12px 25px;
                            border-radius: 8px;
                            text-decoration: none;
                            font-weight: 600;
                            transition: all 0.3s;
                        " onmouseover="this.style.background='rgba(255,255,255,0.2)';"
                        onmouseout="this.style.background='rgba(255,255,255,0.1)';">
                        <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                        </svg>
                        Meet MVK
                    </a>
                    <a href="/contact" style="
                            color: var(--gc-gold);
                            text-decoration: none;
                            font-weight: 600;
                            display: inline-flex;
                            align-items: center;
                            gap: 8px;
                        ">
                        Get in Touch <span>&rarr;</span>
                    </a>
                </div>
            </div>

            <!-- Right: Founder Image -->
            <div style="position: relative;">
                <!-- Decorative Frame -->
                <div style="
                        position: absolute;
                        top: -20px; right: -20px;
                        width: 100%; height: 100%;
                        border: 3px solid var(--gc-gold);
                        border-radius: 20px;
                        opacity: 0.3;
                    "></div>

                <div style="
                        position: relative;
                        border-radius: 20px;
                        overflow: hidden;
                        box-shadow: 0 30px 60px rgba(0,0,0,0.5);
                    ">
                    <img src="<?php echo esc_url(content_url('/docs/Images/Facebook_images/Unsorted/MVK.jpg')); ?>"
                        alt="MVK - Founder & CEO of GlobalConnect" style="
                                width: 100%;
                                height: 450px;
                                object-fit: cover;
                                object-position: center top;
                             ">

                    <!-- Name Overlay -->
                    <div style="
                            position: absolute;
                            bottom: 0; left: 0; right: 0;
                            background: linear-gradient(transparent, rgba(15,23,42,0.95));
                            padding: 60px 30px 30px;
                        ">
                        <h3 style="
                                font-family: 'Outfit', sans-serif;
                                font-size: 1.8rem;
                                font-weight: 700;
                                color: white;
                                margin: 0;
                            ">MVK</h3>
                        <p style="
                                color: var(--gc-gold);
                                font-size: 1rem;
                                font-weight: 600;
                                margin: 5px 0 0;
                                letter-spacing: 1px;
                            ">Founder & CEO</p>
                    </div>
                </div>

                <!-- Stats Badge -->
                <div style="
                        position: absolute;
                        bottom: 30px; left: -30px;
                        background: white;
                        padding: 20px 25px;
                        border-radius: 12px;
                        box-shadow: 0 10px 40px rgba(0,0,0,0.2);
                    ">
                    <div
                        style="font-family: 'Outfit', sans-serif; font-size: 2rem; font-weight: 800; color: var(--gc-blue-primary);">
                        10+</div>
                    <div style="font-size: 0.85rem; color: #64748b; font-weight: 600;">Years Experience</div>
                </div>
            </div>

        </div>
    </div>
</section>

<style>
    @media (max-width: 900px) {
        .gc-founder-grid {
            grid-template-columns: 1fr !important;
            gap: 40px !important;
            text-align: center;
        }

        .gc-founder-grid>div:first-child {
            padding-right: 0 !important;
        }

        .gc-founder-section h2 {
            font-size: 2.5rem !important;
        }

        .gc-founder-section p {
            margin-left: auto;
            margin-right: auto;
        }

        .gc-founder-grid>div:first-child>div:last-child {
            justify-content: center;
        }
    }
</style>


<!-- ================================================
     DESTINATION COUNTRIES — West Africa Focus
     ================================================ -->
<section class="gc-section gc-destinations-section" style="background: var(--gc-off-white); padding: 90px 0; position: relative; overflow: hidden;">
    <!-- Subtle background map texture feel -->
    <div style="position:absolute;top:0;left:0;width:100%;height:100%;background-image:radial-gradient(circle at 15% 50%, rgba(59,130,246,0.04) 0%, transparent 60%), radial-gradient(circle at 85% 20%, rgba(217,119,6,0.04) 0%, transparent 60%);pointer-events:none;"></div>

    <div class="gc-container" style="position:relative;z-index:2;">
        <div class="gc-section-header text-center gc-reveal-up" style="text-align:center;margin-bottom:60px;" data-target="gc-destinations-section">
            <span style="display:inline-block;background:rgba(217,119,6,0.1);color:var(--gc-gold);padding:6px 20px;border-radius:30px;font-size:0.75rem;font-weight:700;letter-spacing:2px;margin-bottom:15px;">WEST AFRICA PORTS</span>
            <h2 class="gc-tech-title" style="font-family:'Outfit',sans-serif;font-size:2.5rem;font-weight:800;color:var(--gc-blue-primary);margin:0;">We Deliver To Your Port<span class="gc-tech-divider" aria-hidden="true" style="color:var(--gc-gold);margin:0 10px;">›</span>On Time</h2>
            <p style="color:var(--gc-text-muted);max-width:580px;margin:15px auto 0;font-size:1rem;">Specializing in vehicle and cargo delivery to West Africa's major import hubs. Local expertise at every destination.</p>
        </div>

        <div class="gc-stagger-child" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:28px;" data-target="gc-destinations-section">

            <!-- Liberia -->
            <a href="<?php echo esc_url(home_url('/?s=liberia')); ?>" class="gc-dest-card" style="display:block;text-decoration:none;background:white;border-radius:20px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,0.06);border:1px solid var(--gc-gray-border);transition:all 0.4s ease;">
                <div style="height:8px;background:linear-gradient(90deg,#003F87,#CE1126);"></div>
                <div style="padding:30px;">
                    <div style="display:flex;align-items:center;gap:15px;margin-bottom:20px;">
                        <img src="https://flagcdn.com/w40/lr.png" alt="Liberia flag" style="width:40px;height:auto;border-radius:4px;box-shadow:0 2px 8px rgba(0,0,0,0.15);">
                        <div>
                            <h3 style="font-family:'Outfit',sans-serif;font-size:1.3rem;font-weight:700;color:var(--gc-blue-primary);margin:0;">Liberia</h3>
                            <span style="color:var(--gc-text-muted);font-size:0.85rem;">Freeport of Monrovia</span>
                        </div>
                    </div>
                    <ul style="list-style:none;padding:0;margin:0 0 20px;">
                        <li style="display:flex;align-items:center;gap:10px;padding:8px 0;border-bottom:1px dashed #e2e8f0;color:var(--gc-text-dark);font-size:0.9rem;"><span class="dashicons dashicons-clock" style="color:var(--gc-gold);font-size:16px;width:16px;height:16px;"></span> 21–28 days transit from Savannah</li>
                        <li style="display:flex;align-items:center;gap:10px;padding:8px 0;border-bottom:1px dashed #e2e8f0;color:var(--gc-text-dark);font-size:0.9rem;"><span class="dashicons dashicons-money-alt" style="color:var(--gc-gold);font-size:16px;width:16px;height:16px;"></span> 15–25% import duty on vehicles</li>
                        <li style="display:flex;align-items:center;gap:10px;padding:8px 0;color:var(--gc-text-dark);font-size:0.9rem;"><span class="dashicons dashicons-yes-alt" style="color:#059669;font-size:16px;width:16px;height:16px;"></span> RoRo &amp; Container accepted</li>
                    </ul>
                    <span style="color:var(--gc-blue-accent);font-weight:600;font-size:0.85rem;display:flex;align-items:center;gap:5px;">Read Liberia Import Guide <span class="dashicons dashicons-arrow-right-alt2" style="font-size:14px;"></span></span>
                </div>
            </a>

            <!-- Guinea -->
            <a href="<?php echo esc_url(home_url('/?s=conakry')); ?>" class="gc-dest-card" style="display:block;text-decoration:none;background:white;border-radius:20px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,0.06);border:1px solid var(--gc-gray-border);transition:all 0.4s ease;">
                <div style="height:8px;background:linear-gradient(90deg,#CE1126,#FCD116,#009A44);"></div>
                <div style="padding:30px;">
                    <div style="display:flex;align-items:center;gap:15px;margin-bottom:20px;">
                        <img src="https://flagcdn.com/w40/gn.png" alt="Guinea flag" style="width:40px;height:auto;border-radius:4px;box-shadow:0 2px 8px rgba(0,0,0,0.15);">
                        <div>
                            <h3 style="font-family:'Outfit',sans-serif;font-size:1.3rem;font-weight:700;color:var(--gc-blue-primary);margin:0;">Guinea</h3>
                            <span style="color:var(--gc-text-muted);font-size:0.85rem;">Port of Conakry</span>
                        </div>
                    </div>
                    <ul style="list-style:none;padding:0;margin:0 0 20px;">
                        <li style="display:flex;align-items:center;gap:10px;padding:8px 0;border-bottom:1px dashed #e2e8f0;color:var(--gc-text-dark);font-size:0.9rem;"><span class="dashicons dashicons-clock" style="color:var(--gc-gold);font-size:16px;width:16px;height:16px;"></span> 18–25 days transit time</li>
                        <li style="display:flex;align-items:center;gap:10px;padding:8px 0;border-bottom:1px dashed #e2e8f0;color:var(--gc-text-dark);font-size:0.9rem;"><span class="dashicons dashicons-admin-page" style="color:var(--gc-gold);font-size:16px;width:16px;height:16px;"></span> Clean title required at customs</li>
                        <li style="display:flex;align-items:center;gap:10px;padding:8px 0;color:var(--gc-text-dark);font-size:0.9rem;"><span class="dashicons dashicons-yes-alt" style="color:#059669;font-size:16px;width:16px;height:16px;"></span> Full customs guidance provided</li>
                    </ul>
                    <span style="color:var(--gc-blue-accent);font-weight:600;font-size:0.85rem;display:flex;align-items:center;gap:5px;">Read Conakry Customs Guide <span class="dashicons dashicons-arrow-right-alt2" style="font-size:14px;"></span></span>
                </div>
            </a>

            <!-- Ivory Coast -->
            <a href="<?php echo esc_url(home_url('/?s=ivory+coast')); ?>" class="gc-dest-card" style="display:block;text-decoration:none;background:white;border-radius:20px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,0.06);border:1px solid var(--gc-gray-border);transition:all 0.4s ease;">
                <div style="height:8px;background:linear-gradient(90deg,#F77F00,#FFFFFF,#009A44);"></div>
                <div style="padding:30px;">
                    <div style="display:flex;align-items:center;gap:15px;margin-bottom:20px;">
                        <img src="https://flagcdn.com/w40/ci.png" alt="Ivory Coast flag" style="width:40px;height:auto;border-radius:4px;box-shadow:0 2px 8px rgba(0,0,0,0.15);">
                        <div>
                            <h3 style="font-family:'Outfit',sans-serif;font-size:1.3rem;font-weight:700;color:var(--gc-blue-primary);margin:0;">Ivory Coast</h3>
                            <span style="color:var(--gc-text-muted);font-size:0.85rem;">Port of Abidjan</span>
                        </div>
                    </div>
                    <ul style="list-style:none;padding:0;margin:0 0 20px;">
                        <li style="display:flex;align-items:center;gap:10px;padding:8px 0;border-bottom:1px dashed #e2e8f0;color:var(--gc-text-dark);font-size:0.9rem;"><span class="dashicons dashicons-clock" style="color:var(--gc-gold);font-size:16px;width:16px;height:16px;"></span> 20–30 days transit time</li>
                        <li style="display:flex;align-items:center;gap:10px;padding:8px 0;border-bottom:1px dashed #e2e8f0;color:var(--gc-text-dark);font-size:0.9rem;"><span class="dashicons dashicons-warning" style="color:#f59e0b;font-size:16px;width:16px;height:16px;"></span> Max 5-year vehicle age limit</li>
                        <li style="display:flex;align-items:center;gap:10px;padding:8px 0;color:var(--gc-text-dark);font-size:0.9rem;"><span class="dashicons dashicons-yes-alt" style="color:#059669;font-size:16px;width:16px;height:16px;"></span> Compliant sourcing guaranteed</li>
                    </ul>
                    <span style="color:var(--gc-blue-accent);font-weight:600;font-size:0.85rem;display:flex;align-items:center;gap:5px;">Read Abidjan Import Guide <span class="dashicons dashicons-arrow-right-alt2" style="font-size:14px;"></span></span>
                </div>
            </a>

        </div><!-- /grid -->
    </div>
</section>

<style>
    .gc-dest-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(59, 130, 246, 0.12) !important;
        border-color: var(--gc-blue-accent) !important;
    }
</style>


<!-- ================================================
     SHIPPING PROCESS TIMELINE
     ================================================ -->
<section class="gc-section gc-process-section" style="background:#0F172A;padding:100px 0;position:relative;overflow:hidden;">
    <!-- Grid background -->
    <div style="position:absolute;top:0;left:0;width:100%;height:100%;background-image:linear-gradient(rgba(255,255,255,0.02) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,0.02) 1px,transparent 1px);background-size:50px 50px;pointer-events:none;"></div>

    <div class="gc-container" style="position:relative;z-index:2;">
        <div style="text-align:center;margin-bottom:70px;" class="gc-reveal-up" data-target="gc-process-section">
            <span style="display:inline-block;background:rgba(217,119,6,0.15);color:var(--gc-gold);padding:6px 20px;border-radius:30px;font-size:0.75rem;font-weight:700;letter-spacing:2px;margin-bottom:15px;">HOW IT WORKS</span>
            <h2 style="font-family:'Outfit',sans-serif;font-size:2.5rem;font-weight:800;color:white;margin:0;">From <span style="color:var(--gc-gold);">Auction</span> to <span style="color:var(--gc-blue-accent);">Your Port</span></h2>
            <p style="color:#94a3b8;max-width:550px;margin:15px auto 0;">We manage every step of the process. You just confirm the vehicle and destination.</p>
        </div>

        <!-- Timeline Steps -->
        <div class="gc-stagger-child" style="display:grid;grid-template-columns:repeat(3,1fr);gap:2px;max-width:1100px;margin:0 auto;" data-target="gc-process-section">

            <?php
            $steps = [
                ['num' => '01', 'icon' => 'dashicons-search', 'title' => 'Source Vehicle', 'time' => '1–3 days', 'desc' => 'We access Copart, IAAI &amp; dealer auctions to find your vehicle at the best price.', 'color' => 'var(--gc-blue-accent)'],
                ['num' => '02', 'icon' => 'dashicons-admin-page', 'title' => 'Export Docs', 'time' => '3–5 days', 'desc' => 'Title processing, ITN filing, bill of lading &amp; commercial invoice prepared.', 'color' => '#8b5cf6'],
                ['num' => '03', 'icon' => 'dashicons-location-alt', 'title' => 'Port Loading', 'time' => '7–14 days', 'desc' => 'Vehicle delivered to Savannah, Baltimore or NY port. RoRo or container loaded.', 'color' => 'var(--gc-gold)'],
                ['num' => '04', 'icon' => 'dashicons-admin-site-alt3', 'title' => 'Ocean Transit', 'time' => '21–35 days', 'desc' => 'Your cargo sails to Monrovia, Conakry, or Abidjan. You receive tracking updates.', 'color' => '#06b6d4'],
                ['num' => '05', 'icon' => 'dashicons-clipboard', 'title' => 'Customs Clearance', 'time' => '5–10 days', 'desc' => 'Duty payment, port inspection, and release handled with your local clearing agent.', 'color' => '#10b981'],
                ['num' => '06', 'icon' => 'dashicons-yes-alt', 'title' => 'Final Delivery', 'time' => '1–3 days', 'desc' => 'Vehicle cleared and delivered to your location. Transaction complete.', 'color' => '#f59e0b'],
            ];
            foreach ($steps as $i => $step):
            ?>
                <div style="background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.07);padding:35px 30px;position:relative;<?php echo ($i === 2) ? 'border-radius:0 12px 0 0;' : ($i === 5 ? 'border-radius:0 0 12px 0;' : ($i === 0 ? 'border-radius:12px 0 0 0;' : ($i === 3 ? 'border-radius:0 0 0 12px;' : ''))); ?>transition:background 0.3s;" onmouseover="this.style.background='rgba(255,255,255,0.06)';" onmouseout="this.style.background='rgba(255,255,255,0.03)';">
                    <div style="display:flex;align-items:flex-start;gap:15px;margin-bottom:20px;">
                        <div style="width:50px;height:50px;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <span class="dashicons <?php echo esc_attr($step['icon']); ?>" style="font-size:22px;color:<?php echo $step['color']; ?>;width:22px;height:22px;"></span>
                        </div>
                        <div>
                            <div style="font-size:0.7rem;font-weight:700;letter-spacing:2px;color:<?php echo $step['color']; ?>;margin-bottom:4px;">STEP <?php echo esc_html($step['num']); ?></div>
                            <h3 style="font-family:'Outfit',sans-serif;font-size:1.1rem;font-weight:700;color:white;margin:0;"><?php echo esc_html($step['title']); ?></h3>
                        </div>
                    </div>
                    <p style="color:#94a3b8;font-size:0.9rem;line-height:1.6;margin:0 0 15px;"><?php echo $step['desc']; ?></p>
                    <span style="display:inline-flex;align-items:center;gap:6px;background:rgba(255,255,255,0.05);padding:5px 12px;border-radius:20px;font-size:0.78rem;color:#64748b;"><span class="dashicons dashicons-clock" style="font-size:13px;width:13px;height:13px;color:var(--gc-gold);"></span><?php echo esc_html($step['time']); ?></span>
                </div>
            <?php endforeach; ?>

        </div><!-- /grid -->

        <div style="text-align:center;margin-top:50px;">
            <a href="<?php echo esc_url(home_url('/how-it-works')); ?>" class="gc-btn gc-btn-glass gc-btn-magnetic" style="display:inline-flex;align-items:center;gap:10px;padding:14px 32px;border-radius:8px;background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.15);color:white;text-decoration:none;font-weight:600;transition:all 0.3s;" onmouseover="this.style.background='rgba(255,255,255,0.14)';" onmouseout="this.style.background='rgba(255,255,255,0.08)';">
                See Full How It Works Guide <span class="dashicons dashicons-arrow-right-alt2" style="font-size:16px;"></span>
            </a>
        </div>

    </div>
</section>

<style>
    @media (max-width: 900px) {
        .gc-process-section .gc-stagger-child {
            grid-template-columns: 1fr 1fr !important;
        }
    }

    @media (max-width: 600px) {
        .gc-process-section .gc-stagger-child {
            grid-template-columns: 1fr !important;
        }
    }
</style>


<!-- ================================================
     FINAL CTA — Above Footer
     ================================================ -->
<section class="gc-section gc-final-cta" style="background:linear-gradient(135deg,var(--gc-gold) 0%,#b45309 100%);padding:80px 0;position:relative;overflow:hidden;">
    <!-- Subtle pattern -->
    <div style="position:absolute;top:0;left:0;width:100%;height:100%;background-image:radial-gradient(circle, rgba(255,255,255,0.08) 1px, transparent 1px);background-size:30px 30px;pointer-events:none;"></div>

    <div class="gc-container" style="position:relative;z-index:2;text-align:center;">
        <span style="display:inline-block;background:rgba(0,0,0,0.15);color:rgba(255,255,255,0.9);padding:6px 20px;border-radius:30px;font-size:0.75rem;font-weight:700;letter-spacing:2px;margin-bottom:20px;">START TODAY</span>
        <h2 style="font-family:'Outfit',sans-serif;font-size:clamp(2rem,5vw,3.5rem);font-weight:800;color:white;line-height:1.15;margin:0 auto 20px;max-width:750px;text-shadow:0 2px 20px rgba(0,0,0,0.2);">Ready to Ship Your Vehicle<br>to West Africa?</h2>
        <p style="color:rgba(255,255,255,0.85);font-size:1.1rem;max-width:500px;margin:0 auto 40px;">Get a free wholesale quote within 24 hours. No obligation, no pressure — just clarity on cost and process.</p>

        <div style="display:flex;justify-content:center;align-items:center;gap:20px;flex-wrap:wrap;">
            <a href="<?php echo esc_url(home_url('/contact')); ?>" id="homepage-final-cta-quote" style="display:inline-flex;align-items:center;gap:10px;background:rgba(255,255,255,0.1);border:2.5px solid white;color:white;padding:16px 36px;border-radius:8px;font-family:'Outfit',sans-serif;font-weight:700;font-size:1.05rem;text-decoration:none;transition:all 0.3s;backdrop-filter:blur(5px);" onmouseover="this.style.background='rgba(255,255,255,0.25)';" onmouseout="this.style.background='rgba(255,255,255,0.1)';">
                <span class="dashicons dashicons-email-alt" style="font-size:20px;width:20px;height:20px;"></span>
                Get a Free Quote
            </a>
            <a href="https://wa.me/<?php echo esc_attr(get_option('globalconnect_whatsapp', '12672900254')); ?>?text=Hi%20GlobalConnect%2C%20I%27d%20like%20a%20shipping%20quote" target="_blank" rel="noopener noreferrer" id="homepage-final-cta-whatsapp" style="display:inline-flex;align-items:center;gap:10px;background:white;color:#0F172A;padding:16px 36px;border-radius:8px;font-family:'Outfit',sans-serif;font-weight:700;font-size:1.05rem;text-decoration:none;transition:all 0.3s;box-shadow:0 8px 30px rgba(0,0,0,0.15);" onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 15px 40px rgba(0,0,0,0.25)';" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 8px 30px rgba(0,0,0,0.15)';">
                <!-- WhatsApp icon -->
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24" style="color:#25D366;flex-shrink:0;">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                </svg>
                WhatsApp Us Now
            </a>
        </div>

        <p style="color:rgba(255,255,255,0.7);margin-top:30px;font-size:0.9rem;">
            📍 Based in Philadelphia, PA &nbsp;|&nbsp; 📞 +1 (267) 290-0254 &nbsp;|&nbsp; ✉️ info@globalconnectshipping.com
        </p>
    </div>
</section>

<?php get_footer(); ?>