</div> <!-- #et-main-area -->

<!-- Deep Tech Footer -->
<footer class="gc-main-footer" role="contentinfo">

    <!-- Top Footer: Main Widgets -->
    <div class="gc-footer-top gc-container">
        <div class="gc-footer-col gc-col-about">
            <div class="gc-logo gc-logo-footer">
                <span class="gc-logo-icon dashicons dashicons-earth"></span>
                <span class="gc-logo-text">Global<span class="gc-highlight">Connect</span></span>
            </div>
            <p class="gc-footer-desc">
                Connecting West Africa to the Global Market. We specialize in exporting reliable vehicles, heavy
                machinery, and quality parts from the USA and China.
            </p>
            <div class="gc-social-links">
                <a href="https://www.facebook.com/profile.php?id=100071518400878" target="_blank"
                    aria-label="Facebook"><span class="dashicons dashicons-facebook-alt"></span></a>
                <a href="#" aria-label="Instagram"><span class="dashicons dashicons-instagram"></span></a>
                <a href="#" aria-label="Twitter"><span class="dashicons dashicons-twitter"></span></a>
                <a href="#" aria-label="WhatsApp"><span class="dashicons dashicons-whatsapp"></span></a>
            </div>
        </div>

        <div class="gc-footer-col gc-col-links">
            <h4 class="gc-footer-heading">Quick Links</h4>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'footer-menu',
                'container' => false,
                'menu_class' => 'gc-footer-nav',
                'fallback_cb' => false,
            ));
            ?>
        </div>

        <div class="gc-footer-col gc-col-contact">
            <h4 class="gc-footer-heading">Contact Us</h4>
            <ul class="gc-contact-list">
                <li>
                    <span class="dashicons dashicons-location" aria-hidden="true"></span>
                    <span>5909 Elmwood Avenue,<br>Philadelphia, PA 19143</span>
                </li>
                <li>
                    <span class="dashicons dashicons-whatsapp" aria-hidden="true"></span>
                    <span><?php echo esc_html(get_option('gc_whatsapp_number', '12672900254')); ?></span>
                </li>
                <li>
                    <span class="dashicons dashicons-email" aria-hidden="true"></span>
                    <span>info@globalconnectshipping.com</span>
                </li>
            </ul>
        </div>

        <div class="gc-footer-col gc-col-newsletter">
            <h4 class="gc-footer-heading">Newsletter</h4>
            <p>Subscribe for latest inventory updates and shipping schedules.</p>
            <form class="gc-newsletter-form" id="gc-newsletter-form">
                <input type="email" placeholder="Your Email Address" required aria-label="Email address for newsletter">
                <button type="submit" class="gc-btn-icon" aria-label="Subscribe"><span
                        class="dashicons dashicons-arrow-right-alt2"></span></button>
                <div class="gc-form-feedback" role="status" aria-live="polite"></div>
            </form>
        </div>
    </div>

    <!-- Bottom Footer: Copyright & Legal -->
    <div class="gc-footer-bottom">
        <div class="gc-container">
            <div class="gc-footer-flex">
                <p class="gc-copyright">
                    &copy; <?php echo date('Y'); ?> Global Connect Shipping. All Rights Reserved.
                </p>
                <div class="gc-legal-links">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Service</a>
                </div>
            </div>
        </div>
    </div>
</footer>

</div> <!-- #page-container -->

<?php wp_footer(); ?>
</body>

</html>