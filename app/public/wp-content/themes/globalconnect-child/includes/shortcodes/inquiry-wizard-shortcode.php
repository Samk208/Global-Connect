<?php

/**
 * Shortcode: [globalconnect_inquiry_wizard]
 * High-conversion multi-step inquiry flow for vehicles and parts.
 */

if (!defined('ABSPATH')) exit;

function globalconnect_inquiry_wizard_shortcode($atts)
{
    // Attributes
    $atts = shortcode_atts(array(
        'product_id' => get_the_ID(),
        'product_type' => get_post_type(),
    ), $atts);

    $product_title = get_the_title($atts['product_id']);
    $price = ($atts['product_type'] == 'vehicle') ? get_post_meta($atts['product_id'], 'vehicle_price', true) : get_post_meta($atts['product_id'], 'part_price', true);

    ob_start();
?>
    <div id="gc-wizard-container" class="gc-wizard-glass">
        <!-- Progress Bar -->
        <div class="gc-wizard-progress">
            <div class="gc-progress-step active" data-step="1"><span>1</span><label>Shipping</label></div>
            <div class="gc-progress-step" data-step="2"><span>2</span><label>Review</label></div>
            <div class="gc-progress-step" data-step="3"><span>3</span><label>Contact</label></div>
            <div class="gc-progress-line"></div>
        </div>

        <form id="gc-inquiry-wizard-form">
            <input type="hidden" name="product_id" value="<?php echo esc_attr($atts['product_id']); ?>">
            <input type="hidden" name="action" value="gc_submit_inquiry">
            <?php wp_nonce_field('gc_wizard_nonce', 'wizard_nonce'); ?>

            <!-- Honeypot Field (Hidden from humans, visible to bots) -->
            <input type="text" name="website_url" value="" style="position:absolute;left:-9999px;" tabindex="-1" autocomplete="off">

            <!-- Step 1: Destination & Shipping -->
            <div class="gc-wizard-step active" id="step-1">
                <div class="gc-step-header">
                    <h3>Shipping Configuration</h3>
                    <p>Configure your export details for <strong><?php echo esc_html($product_title); ?></strong></p>
                </div>

                <div class="gc-form-grid">
                    <div class="gc-form-group">
                        <label>Destination Port</label>
                        <select name="destination_port" id="gc-port-select" required>
                            <option value="">Select Port...</option>
                            <option value="conakry" data-fee="1200">Conakry, Guinea</option>
                            <option value="monrovia" data-fee="1350">Monrovia, Liberia</option>
                            <option value="abidjan" data-fee="1100">Abidjan, Ivory Coast</option>
                            <option value="lagos" data-fee="1500">Lagos, Nigeria</option>
                        </select>
                    </div>
                    <div class="gc-form-group">
                        <label>Shipping Method</label>
                        <select name="shipping_method">
                            <option value="roro">RoRo (Standard)</option>
                            <option value="container">Shared Container (+ $250)</option>
                        </select>
                    </div>
                </div>

                <div class="gc-wizard-toggles">
                    <label class="gc-toggle-label">
                        <input type="checkbox" name="shipping_insurance" value="yes" checked>
                        <span class="gc-toggle-custom"></span>
                        Add Shipping Insurance (Recommended)
                    </label>
                </div>

                <div class="gc-wizard-footer">
                    <button type="button" class="gc-btn gc-btn-next" data-next="2">Next: Review Quote &rarr;</button>
                </div>
            </div>

            <!-- Step 2: Review & Trust -->
            <div class="gc-wizard-step" id="step-2">
                <div class="gc-step-header">
                    <h3>Review Quote</h3>
                    <p>Transparent cost breakdown for your shipment.</p>
                </div>

                <div class="gc-review-summary">
                    <div class="gc-summary-row">
                        <span>Product Price</span>
                        <strong>$<?php echo esc_html($price ?: '0'); ?></strong>
                    </div>
                    <div class="gc-summary-row">
                        <span>Freight to <span id="summary-port">Selected Port</span></span>
                        <strong id="summary-freight">$0</strong>
                    </div>
                    <div class="gc-summary-row gc-row-highlight">
                        <span>Est. Customs & Clearing</span>
                        <strong id="summary-customs">Calculating...</strong>
                    </div>
                    <div class="gc-summary-total">
                        <span>Estimated Total</span>
                        <strong id="summary-total">$<?php echo esc_html($price ?: '0'); ?></strong>
                    </div>
                </div>

                <div class="gc-trust-badges-checkout">
                    <div class="gc-badge">
                        <span class="dashicons dashicons-shield-alt"></span>
                        <span>Secured by GlobalConnect</span>
                    </div>
                    <div class="gc-badge">
                        <span class="dashicons dashicons-whatsapp"></span>
                        <span>WhatsApp Updates Enabled</span>
                    </div>
                </div>

                <div class="gc-wizard-footer">
                    <button type="button" class="gc-btn gc-btn-prev" data-prev="1">&larr; Back</button>
                    <button type="button" class="gc-btn gc-btn-next" data-next="3">Next: Contact Info &rarr;</button>
                </div>
            </div>

            <!-- Step 3: Contact & Lead Capture -->
            <div class="gc-wizard-step" id="step-3">
                <div class="gc-step-header">
                    <h3>Finalize Inquiry</h3>
                    <p>Enter your details to receive a formal pro-forma invoice.</p>
                </div>

                <div class="gc-form-grid">
                    <div class="gc-form-group">
                        <label>Full Name</label>
                        <input type="text" name="full_name" placeholder="John Doe" required>
                    </div>
                    <div class="gc-form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" placeholder="john@example.com" required>
                    </div>
                    <div class="gc-form-group">
                        <label>Phone / WhatsApp</label>
                        <input type="tel" name="phone" placeholder="+1..." required>
                    </div>
                </div>

                <div class="gc-wizard-toggles">
                    <label class="gc-toggle-label">
                        <input type="checkbox" name="whatsapp_updates" value="yes" checked>
                        <span class="gc-toggle-custom"></span>
                        Receive real-time tracking via WhatsApp
                    </label>
                </div>

                <div class="gc-encryption-note">
                    <span class="dashicons dashicons-lock"></span>
                    Your information is widely encrypted and secure.
                </div>

                <div class="gc-wizard-footer">
                    <button type="button" class="gc-btn gc-btn-prev" data-prev="2">&larr; Back</button>
                    <button type="submit" class="gc-btn gc-btn-submit">Request Formal Invoice</button>
                </div>
            </div>
        </form>

        <div id="gc-wizard-success" style="display:none;">
            <div class="gc-success-content">
                <span class="dashicons dashicons-yes-alt"></span>
                <h3>Inquiry Sent!</h3>
                <p>One of our export agents will contact you within 1 hour with your formal invoice.</p>
                <a href="https://wa.me/<?php echo esc_attr(get_option('gc_whatsapp_number', '12672900254')); ?>" class="gc-btn-whatsapp-large">
                    <span class="dashicons dashicons-whatsapp"></span> Chat with Agent Now
                </a>
            </div>
        </div>
    </div>

    <script>
        jQuery(document).ready(function($) {
            let currentStep = 1;
            const price = parseFloat('<?php echo esc_js($price ? str_replace(',', '', $price) : 0); ?>');

            function updateSummary() {
                const portSelect = $('#gc-port-select option:selected');
                const portName = portSelect.text();
                const freight = parseFloat(portSelect.data('fee') || 0);
                const customs = freight * 0.15; // Mock 15% customs logic
                const total = price + freight + customs;

                $('#summary-port').text(portName);
                $('#summary-freight').text('$' + freight.toLocaleString());
                $('#summary-customs').text('$' + customs.toLocaleString());
                $('#summary-total').text('$' + total.toLocaleString());
            }

            $('.gc-btn-next').on('click', function() {
                const next = $(this).data('next');
                if (next === 2) updateSummary();

                $(`#step-${currentStep}`).removeClass('active');
                $(`#step-${next}`).addClass('active');
                $(`.gc-progress-step[data-step="${next}"]`).addClass('active');
                currentStep = next;
            });

            $('.gc-btn-prev').on('click', function() {
                const prev = $(this).data('prev');
                $(`#step-${currentStep}`).removeClass('active');
                $(`#step-${prev}`).addClass('active');
                $(`.gc-progress-step[data-step="${currentStep}"]`).removeClass('active');
                currentStep = prev;
            });

            $('#gc-inquiry-wizard-form').on('submit', function(e) {
                e.preventDefault();
                const $form = $(this);
                const $btn = $form.find('.gc-btn-submit');

                $btn.prop('disabled', true).text('Processing...');

                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    method: 'POST',
                    data: $form.serialize(),
                    success: function(response) {
                        if (response.success) {
                            $form.hide();
                            $('.gc-wizard-progress').hide();
                            $('#gc-wizard-success').fadeIn();
                        } else {
                            alert('Error: ' + response.data);
                            $btn.prop('disabled', false).text('Request Formal Invoice');
                        }
                    }
                });
            });
        });
    </script>
<?php
    return ob_get_clean();
}
add_shortcode('globalconnect_inquiry_wizard', 'globalconnect_inquiry_wizard_shortcode');
