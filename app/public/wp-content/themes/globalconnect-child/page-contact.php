<?php

/**
 * Template Name: Contact Page
 * Description: Premium contact & quote page for GlobalConnect.
 */

get_header();
$whatsapp = get_option('gc_whatsapp_number', '12672900254');
?>

<div id="gc-contact-page">

    <!-- ═══ HERO ═══ -->
    <section class="ct-hero">
        <div class="ct-hero-bg"></div>
        <div class="gc-container ct-hero-inner">
            <span class="hiw-eyebrow">Contact &middot; Quote &middot; Support</span>
            <h1>CONTACT<span class="gc-tech-divider">\</span>&amp;<span class="gc-tech-divider">\</span>QUOTE</h1>
            <p class="ct-lead">Questions about a vehicle, shipping rates, or an order? Our team is available 24/7 via WhatsApp and ready to help.</p>
        </div>
        <div class="hiw-wave">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" preserveAspectRatio="none">
                <path fill="#F8FAFC" d="M0,64L80,58.7C160,53,320,43,480,48C640,53,800,75,960,80C1120,85,1280,75,1360,69.3L1440,64L1440,120L0,120Z"></path>
            </svg>
        </div>
    </section>

    <!-- ═══ QUICK CONTACT BAR ═══ -->
    <section class="ct-quick-bar">
        <div class="gc-container">
            <div class="ct-quick-grid">
                <a href="https://wa.me/<?php echo esc_attr($whatsapp); ?>" class="ct-quick-item ct-quick-whatsapp" target="_blank">
                    <span class="dashicons dashicons-whatsapp"></span>
                    <div>
                        <strong>WhatsApp</strong>
                        <span>+1 (267) 290-0254</span>
                    </div>
                </a>
                <a href="tel:+<?php echo esc_attr($whatsapp); ?>" class="ct-quick-item ct-quick-phone">
                    <span class="dashicons dashicons-phone"></span>
                    <div>
                        <strong>Call Direct</strong>
                        <span>Mon-Sat 9AM-7PM EST</span>
                    </div>
                </a>
                <a href="mailto:info@globalconnectshipping.com" class="ct-quick-item ct-quick-email">
                    <span class="dashicons dashicons-email-alt"></span>
                    <div>
                        <strong>Email Us</strong>
                        <span>info@globalconnectshipping.com</span>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- ═══ MAIN CONTENT ═══ -->
    <section class="ct-main">
        <div class="gc-container">
            <div class="ct-grid">

                <!-- ── LEFT: Contact Form ── -->
                <div class="ct-form-card">
                    <div class="ct-form-header">
                        <span class="dashicons dashicons-edit"></span>
                        <div>
                            <h3>Send a Message</h3>
                            <p>Fill out the form below and our team will get back to you within 24 hours.</p>
                        </div>
                    </div>

                    <?php
                    $form_id = get_option('gc_contact_form_id', '1');
                    if ($form_id && shortcode_exists('wpforms')) {
                        echo do_shortcode('[wpforms id="' . esc_attr($form_id) . '" title="false" description="false"]');
                    } else {
                    ?>
                        <form action="mailto:info@globalconnectshipping.com" method="post" enctype="text/plain" class="ct-form">
                            <div class="ct-form-row">
                                <div class="ct-field">
                                    <label for="ct-name">Full Name <span class="ct-req">*</span></label>
                                    <input type="text" id="ct-name" name="name" required placeholder="Your full name">
                                </div>
                                <div class="ct-field">
                                    <label for="ct-email">Email Address <span class="ct-req">*</span></label>
                                    <input type="email" id="ct-email" name="email" required placeholder="your@email.com">
                                </div>
                            </div>
                            <div class="ct-form-row">
                                <div class="ct-field">
                                    <label for="ct-phone">Phone / WhatsApp</label>
                                    <input type="tel" id="ct-phone" name="phone" placeholder="+1 (xxx) xxx-xxxx">
                                </div>
                                <div class="ct-field">
                                    <label for="ct-subject">Subject <span class="ct-req">*</span></label>
                                    <select id="ct-subject" name="subject" required>
                                        <option value="">Select a topic...</option>
                                        <option value="Vehicle Inquiry">Vehicle Inquiry</option>
                                        <option value="Shipping Quote">Shipping Quote Request</option>
                                        <option value="Parts/Machinery">Parts &amp; Machinery</option>
                                        <option value="Tracking">Shipment Tracking</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="ct-field">
                                <label for="ct-message">Message <span class="ct-req">*</span></label>
                                <textarea id="ct-message" name="message" rows="5" required placeholder="Tell us how we can help you..."></textarea>
                            </div>
                            <button type="submit" class="ct-submit-btn">
                                <span class="dashicons dashicons-email-alt"></span> Send Message
                            </button>
                            <p class="ct-form-note"><span class="dashicons dashicons-whatsapp"></span> For faster response, contact us directly via WhatsApp.</p>
                        </form>
                    <?php } ?>
                </div>

                <!-- ── RIGHT: Info Sidebar ── -->
                <div class="ct-sidebar">

                    <!-- Contact Details Card -->
                    <div class="ct-info-card">
                        <h3>Contact Information</h3>

                        <div class="ct-info-item">
                            <div class="ct-info-icon ct-icon-green">
                                <span class="dashicons dashicons-whatsapp"></span>
                            </div>
                            <div>
                                <h4>WhatsApp (Fastest)</h4>
                                <a href="https://wa.me/<?php echo esc_attr($whatsapp); ?>">+1 (267) 290-0254</a>
                                <p>Available 24/7 for urgent inquiries</p>
                            </div>
                        </div>

                        <div class="ct-info-item">
                            <div class="ct-info-icon ct-icon-blue">
                                <span class="dashicons dashicons-phone"></span>
                            </div>
                            <div>
                                <h4>Phone</h4>
                                <a href="tel:+<?php echo esc_attr($whatsapp); ?>">+1 (267) 290-0254</a>
                                <p>Mon-Sat: 9AM - 7PM EST</p>
                            </div>
                        </div>

                        <div class="ct-info-item">
                            <div class="ct-info-icon ct-icon-amber">
                                <span class="dashicons dashicons-email"></span>
                            </div>
                            <div>
                                <h4>Email</h4>
                                <a href="mailto:info@globalconnectshipping.com">info@globalconnectshipping.com</a>
                                <p>Response within 24 hours</p>
                            </div>
                        </div>

                        <div class="ct-info-item">
                            <div class="ct-info-icon ct-icon-navy">
                                <span class="dashicons dashicons-location"></span>
                            </div>
                            <div>
                                <h4>US Headquarters</h4>
                                <address>5909 Elmwood Avenue<br>Philadelphia, PA 19143<br>United States</address>
                            </div>
                        </div>
                    </div>

                    <!-- Google Map -->
                    <div class="ct-map-wrap">
                        <iframe
                            src="https://www.google.com/maps?q=39.9251,-75.2411&z=17&output=embed"
                            title="GlobalConnect Shipping US Headquarters Location"
                            width="100%" height="240" style="border:0; display: block;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>

                    <!-- Business Hours Card -->
                    <div class="ct-hours-card">
                        <h4><span class="dashicons dashicons-clock"></span> Business Hours</h4>
                        <div class="ct-hours-grid">
                            <span class="ct-hours-day">Monday - Friday</span>
                            <span class="ct-hours-time">9:00 AM - 7:00 PM</span>
                            <span class="ct-hours-day">Saturday</span>
                            <span class="ct-hours-time">10:00 AM - 5:00 PM</span>
                            <span class="ct-hours-day">Sunday</span>
                            <span class="ct-hours-time">Closed</span>
                        </div>
                        <p class="ct-hours-note">
                            <span class="dashicons dashicons-whatsapp"></span>
                            WhatsApp available 24/7 for urgent matters
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- ═══ CTA ═══ -->
    <section class="hiw-cta">
        <div class="hiw-cta-bg"></div>
        <div class="gc-container hiw-cta-inner">
            <span class="hiw-eyebrow" style="color: var(--gc-gold);">Start Today</span>
            <h2>Ready to Import Your Next Vehicle?</h2>
            <p>Browse our inventory of export-ready vehicles or get a free shipping quote today.</p>
            <div class="hiw-cta-actions">
                <a href="<?php echo esc_url(site_url('/shop/')); ?>" class="gc-btn gc-btn-primary gc-btn-magnetic">
                    <span class="dashicons dashicons-car"></span> Browse Inventory
                </a>
                <a href="https://wa.me/<?php echo esc_attr($whatsapp); ?>?text=Hi, I'd like to get a shipping quote" target="_blank" class="gc-btn gc-btn-gold gc-btn-magnetic">
                    <span class="dashicons dashicons-money-alt"></span> Get Free Quote
                </a>
            </div>
        </div>
    </section>

</div>

<?php get_footer(); ?>
