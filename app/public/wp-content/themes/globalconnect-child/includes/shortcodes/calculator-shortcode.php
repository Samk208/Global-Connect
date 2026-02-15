<?php
/**
 * Shortcode: [globalconnect_calculator]
 * Usage: Displays a shipping cost calculator.
 */

if (!defined('ABSPATH')) {
    exit;
}

function globalconnect_calculator_shortcode()
{
    ob_start();
    ?>
    <div class="gc-calculator-container">
        <h3><?php esc_html_e('Shipping Cost Calculator', 'globalconnect-child'); ?></h3>
        <form id="gc-shipping-calculator" class="gc-calculator-form">
            <div class="gc-form-group">
                <label><?php esc_html_e('Vehicle Type', 'globalconnect-child'); ?></label>
                <select id="gc-vehicle-type" name="vehicle_type">
                    <option value="sedan">Sedan ($900)</option>
                    <option value="suv">SUV ($1100)</option>
                    <option value="truck">Truck / Van ($1300)</option>
                </select>
            </div>
            <div class="gc-form-group">
                <label><?php esc_html_e('Destination', 'globalconnect-child'); ?></label>
                <select id="gc-destination" name="destination">
                    <option value="conakry">Conakry, Guinea</option>
                    <option value="monrovia">Monrovia, Liberia</option>
                    <option value="abidjan">Abidjan, Ivory Coast</option>
                    <option value="lagos">Lagos, Nigeria</option>
                    <option value="hamburg">Hamburg, Germany (Europe)</option>
                    <option value="dubai">Dubai, UAE (Asia)</option>
                    <option value="tokyo">Tokyo, Japan (Asia)</option>
                </select>
            </div>
            <button type="button" id="gc-calc-btn"
                class="et_pb_button"><?php esc_html_e('Get Estimate', 'globalconnect-child'); ?></button>
        </form>
        <div id="gc-calc-result"
            style="display:none; margin-top:15px; padding:15px; background:#eeffff; border-radius:5px;">
            <p><strong><?php esc_html_e('Estimated Shipping Cost:', 'globalconnect-child'); ?></strong> <span
                    id="gc-cost-display" style="font-size:1.2em; color:#0073aa;"></span></p>
            <p><small><?php esc_html_e('*Prices are estimates. Please contact us for a final quote.', 'globalconnect-child'); ?></small>
            </p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const btn = document.getElementById('gc-calc-btn');
            const resultBox = document.getElementById('gc-calc-result');
            const costDisplay = document.getElementById('gc-cost-display');

            if (btn) {
                btn.addEventListener('click', function () {
                    const type = document.getElementById('gc-vehicle-type').value;
                    const dest = document.getElementById('gc-destination').value;

                    // Base Ocean Freight
                    let oceanFreight = 0;
                    if (type === 'sedan') oceanFreight = 900;
                    if (type === 'suv') oceanFreight = 1100;
                    if (type === 'truck') oceanFreight = 1300;

                    // Destination Surcharge
                    if (dest === 'monrovia') oceanFreight += 50;
                    if (dest === 'abidjan') oceanFreight += 100;
                    if (dest === 'lagos') oceanFreight += 150;
                    if (dest === 'hamburg') oceanFreight += 200; // Europe Surcharge
                    if (dest === 'dubai') oceanFreight += 300; // Asia Surcharge
                    if (dest === 'tokyo') oceanFreight += 400; // Asia Surcharge

                    // Handling & Fees (Fixed for now)
                    const portHandling = 150;
                    const docFees = 75;

                    const total = oceanFreight + portHandling + docFees;

                    // Build the breakdown HTML
                    let breakdownHtml = `
                        <div class="gc-calc-breakdown">
                            <div class="gc-calc-row"><span>Ocean Freight:</span> <span>$${oceanFreight}</span></div>
                            <div class="gc-calc-row"><span>Port Handling:</span> <span>$${portHandling}</span></div>
                            <div class="gc-calc-row"><span>Documentation:</span> <span>$${docFees}</span></div>
                            <div class="gc-calc-row total"><span>Total Estimate:</span> <span>$${total}</span></div>
                        </div>
                    `;

                    costDisplay.innerHTML = breakdownHtml;
                    resultBox.style.display = 'block';
                });
            }
        });
    </script>
    <style>
        .gc-calculator-container {
            padding: 20px;
            border: 1px solid #eee;
            border-radius: 8px;
            background: #fff;
        }

        .gc-form-group {
            margin-bottom: 15px;
        }

        .gc-form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .gc-form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
    </style>
    <?php
    return ob_get_clean();
}
add_shortcode('globalconnect_calculator', 'globalconnect_calculator_shortcode');
