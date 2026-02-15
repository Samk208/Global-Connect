<?php

/**
 * Template Name: How It Works Page
 * A premium, step-by-step guide to the GlobalConnect export process.
 */

get_header();
$whatsapp = get_option('gc_whatsapp_number', '12672900254');
?>

<div id="gc-how-it-works">

    <!-- ═══ HERO ═══ -->
    <section class="hiw-hero">
        <div class="hiw-hero-bg">
            <div class="hiw-hero-grain"></div>
        </div>
        <div class="gc-container hiw-hero-inner">
            <span class="hiw-eyebrow">Simple &middot; Secure &middot; Transparent</span>
            <h1>HOW<span class="gc-tech-divider">\</span>IT<span class="gc-tech-divider">\</span>WORKS</h1>
            <p class="hiw-lead">From selecting your vehicle to final delivery at an African port &mdash; we handle every step so you don&rsquo;t have to.</p>
            <div class="hiw-hero-stats">
                <div class="hiw-stat"><strong>3</strong><span>Simple Steps</span></div>
                <div class="hiw-stat-divider"></div>
                <div class="hiw-stat"><strong>30</strong><span>Days Avg. Delivery</span></div>
                <div class="hiw-stat-divider"></div>
                <div class="hiw-stat"><strong>24/7</strong><span>WhatsApp Support</span></div>
            </div>
        </div>
        <div class="hiw-wave">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" preserveAspectRatio="none">
                <path fill="#F8FAFC" d="M0,64L80,58.7C160,53,320,43,480,48C640,53,800,75,960,80C1120,85,1280,75,1360,69.3L1440,64L1440,120L0,120Z"></path>
            </svg>
        </div>
    </section>

    <!-- ═══ PROCESS TIMELINE ═══ -->
    <section class="hiw-timeline">
        <div class="gc-container">

            <!-- Connector Line (desktop only) -->
            <div class="hiw-connector" aria-hidden="true"></div>

            <!-- ── STEP 1 ── -->
            <div class="hiw-step gc-reveal-up">
                <div class="hiw-step-visual">
                    <div class="hiw-badge">
                        <span class="hiw-badge-num">01</span>
                        <span class="hiw-badge-label">Select</span>
                    </div>
                    <div class="hiw-img-wrap">
                        <img src="https://images.unsplash.com/photo-1552519507-da3b142c6e3d?auto=format&fit=crop&w=720&q=80"
                            alt="Browse and choose your export vehicle" loading="lazy">
                        <div class="hiw-img-tag"><span class="dashicons dashicons-car"></span> USA &middot; Europe &middot; China</div>
                    </div>
                </div>
                <div class="hiw-step-body">
                    <h2>Choose<span class="gc-tech-divider">\</span>Your<span class="gc-tech-divider">\</span>Vehicle</h2>
                    <p>Browse our curated inventory of export-ready vehicles. If we don&rsquo;t have what you want, our team will search nationwide auctions (Copart, IAAI) to find it for you.</p>
                    <ul class="hiw-checks">
                        <li><span class="dashicons dashicons-yes-alt"></span> Browse verified inventory online</li>
                        <li><span class="dashicons dashicons-yes-alt"></span> Request a specific Make / Model</li>
                        <li><span class="dashicons dashicons-yes-alt"></span> Get a transparent, all-inclusive quote</li>
                    </ul>
                    <a href="<?php echo esc_url(site_url('/shop/')); ?>" class="hiw-link">Browse Inventory <span>&rarr;</span></a>
                </div>
            </div>

            <!-- ── STEP 2 ── -->
            <div class="hiw-step hiw-step--reverse gc-reveal-up">
                <div class="hiw-step-visual">
                    <div class="hiw-badge">
                        <span class="hiw-badge-num">02</span>
                        <span class="hiw-badge-label">Ship</span>
                    </div>
                    <div class="hiw-img-wrap">
                        <img src="https://images.unsplash.com/photo-1578575437130-527eed3abbec?auto=format&fit=crop&w=720&q=80"
                            alt="Logistics and shipping operations" loading="lazy">
                        <div class="hiw-img-tag"><span class="dashicons dashicons-admin-site-alt3"></span> Philadelphia &middot; East Coast</div>
                    </div>
                </div>
                <div class="hiw-step-body">
                    <h2>Logistics<span class="gc-tech-divider">\</span>&amp;<span class="gc-tech-divider">\</span>Shipping</h2>
                    <p>Once payment is confirmed, we transport your vehicle to the nearest US port. We handle all customs documentation, title clearance, and secure loading.</p>
                    <ul class="hiw-checks">
                        <li><span class="dashicons dashicons-yes-alt"></span> Inland transport to port</li>
                        <li><span class="dashicons dashicons-yes-alt"></span> Customs clearance &amp; Title fixing</li>
                        <li><span class="dashicons dashicons-yes-alt"></span> Secure loading (RoRo or Container)</li>
                    </ul>
                    <div class="hiw-methods">
                        <div class="hiw-method-chip"><span class="dashicons dashicons-admin-site-alt3"></span> RoRo Shipping</div>
                        <div class="hiw-method-chip"><span class="dashicons dashicons-archive"></span> Container Load</div>
                    </div>
                </div>
            </div>

            <!-- ── STEP 3 ── -->
            <div class="hiw-step gc-reveal-up">
                <div class="hiw-step-visual">
                    <div class="hiw-badge">
                        <span class="hiw-badge-num">03</span>
                        <span class="hiw-badge-label">Deliver</span>
                    </div>
                    <div class="hiw-img-wrap">
                        <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=720&q=80"
                            alt="Vehicle delivery at destination port" loading="lazy">
                        <div class="hiw-img-tag"><span class="dashicons dashicons-location"></span> Conakry &middot; Monrovia &middot; Lagos</div>
                    </div>
                </div>
                <div class="hiw-step-body">
                    <h2>Track<span class="gc-tech-divider">\</span>&amp;<span class="gc-tech-divider">\</span>Receive</h2>
                    <p>Track your shipment in real-time via our portal or WhatsApp updates. Your vehicle arrives at the destination port ready for pickup.</p>
                    <ul class="hiw-checks">
                        <li><span class="dashicons dashicons-yes-alt"></span> Live tracking number provided</li>
                        <li><span class="dashicons dashicons-yes-alt"></span> Bill of Lading documentation</li>
                        <li><span class="dashicons dashicons-yes-alt"></span> On-ground agent support at destination</li>
                    </ul>
                    <a href="<?php echo esc_url(site_url('/track/')); ?>" class="hiw-link">Track a Shipment <span>&rarr;</span></a>
                </div>
            </div>

        </div>
    </section>

    <!-- ═══ TRUST BAR ═══ -->
    <section class="hiw-trust">
        <div class="gc-container">
            <div class="hiw-trust-grid">
                <div class="hiw-trust-item">
                    <span class="dashicons dashicons-shield-alt"></span>
                    <div>
                        <strong>Secure Payments</strong>
                        <span>Wire transfer &amp; escrow options</span>
                    </div>
                </div>
                <div class="hiw-trust-item">
                    <span class="dashicons dashicons-media-text"></span>
                    <div>
                        <strong>Full Documentation</strong>
                        <span>Title, BL, customs papers included</span>
                    </div>
                </div>
                <div class="hiw-trust-item">
                    <span class="dashicons dashicons-whatsapp"></span>
                    <div>
                        <strong>24/7 WhatsApp</strong>
                        <span>Real-time updates on every shipment</span>
                    </div>
                </div>
                <div class="hiw-trust-item">
                    <span class="dashicons dashicons-groups"></span>
                    <div>
                        <strong>Local Agents</strong>
                        <span>Destination support in West Africa</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══ CTA SECTION ═══ -->
    <section class="hiw-cta">
        <div class="hiw-cta-bg"></div>
        <div class="gc-container hiw-cta-inner">
            <span class="hiw-eyebrow" style="color: var(--gc-gold);">Start Today</span>
            <h2>Ready to Import Your Next Vehicle?</h2>
            <p>Join hundreds of satisfied customers in Guinea, Liberia, Nigeria, and beyond. Get a free, no-obligation quote in minutes.</p>
            <div class="hiw-cta-actions">
                <a href="<?php echo esc_url(site_url('/contact/')); ?>" class="gc-btn gc-btn-gold gc-btn-magnetic">
                    <span class="dashicons dashicons-money-alt"></span> Get a Free Quote
                </a>
                <a href="https://wa.me/<?php echo esc_attr($whatsapp); ?>?text=Hi, I'd like to know how to import a vehicle." target="_blank" class="gc-btn gc-btn-glass gc-btn-magnetic">
                    <span class="dashicons dashicons-whatsapp"></span> WhatsApp Us Directly
                </a>
            </div>
        </div>
    </section>

</div>

<?php get_footer(); ?>
