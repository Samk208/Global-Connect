<?php

/**
 * Shortcode: [globalconnect_tire_calculator]
 * Usage: Displays a tire container cost calculator for bulk orders.
 */

if (!defined('ABSPATH')) {
    exit;
}

function globalconnect_tire_calculator_shortcode()
{
    ob_start();
?>
    <div class="gc-tire-calculator-container">
        <div class="gc-tire-calc-header">
            <span class="dashicons dashicons-marker" style="color: var(--gc-gold); font-size: 24px;"></span>
            <h3><?php esc_html_e('Tire Container Calculator', 'globalconnect-child'); ?></h3>
        </div>

        <form id="gc-tire-calculator" class="gc-calculator-form">
            <div class="gc-form-group">
                <label><?php esc_html_e('Tire Type', 'globalconnect-child'); ?></label>
                <select id="gc-tire-type" name="tire_type">
                    <option value="tbr" data-price="95" data-qty="400">TBR Truck Tires (11R22.5, 295/80R22.5)</option>
                    <option value="pcr" data-price="35" data-qty="1200">PCR Passenger Tires (185-225 Series)</option>
                    <option value="otr" data-price="450" data-qty="80">OTR Mining Tires (17.5-25, 20.5-25)</option>
                    <option value="agri" data-price="120" data-qty="250">Agricultural Tires (12.4-24, 14.9-28)</option>
                </select>
            </div>

            <div class="gc-form-group">
                <label><?php esc_html_e('Container Size', 'globalconnect-child'); ?></label>
                <select id="gc-container-size" name="container_size">
                    <option value="20ft" data-multiplier="0.5">20ft Container (Half Load)</option>
                    <option value="40ft" data-multiplier="1" selected>40ft Container (Full Load)</option>
                    <option value="40hc" data-multiplier="1.15">40ft High Cube (Max Capacity)</option>
                </select>
            </div>

            <div class="gc-form-group">
                <label><?php esc_html_e('Tire Condition', 'globalconnect-child'); ?></label>
                <select id="gc-tire-condition" name="tire_condition">
                    <option value="new" data-multiplier="1">Brand New (Factory)</option>
                    <option value="used_a" data-multiplier="0.5">Grade A Used (5-7mm Tread)</option>
                    <option value="used_b" data-multiplier="0.35">Grade B Used (3-5mm Tread)</option>
                </select>
            </div>

            <div class="gc-form-group">
                <label><?php esc_html_e('Destination Port', 'globalconnect-child'); ?></label>
                <select id="gc-tire-destination" name="destination">
                    <option value="conakry" data-freight="2800">Conakry, Guinea</option>
                    <option value="monrovia" data-freight="2900">Monrovia, Liberia</option>
                    <option value="abidjan" data-freight="2700">Abidjan, Ivory Coast</option>
                    <option value="lagos" data-freight="3200">Lagos, Nigeria</option>
                    <option value="tema" data-freight="2850">Tema, Ghana</option>
                    <option value="dakar" data-freight="2600">Dakar, Senegal</option>
                </select>
            </div>

            <button type="button" id="gc-tire-calc-btn" class="gc-btn gc-btn-primary" style="width: 100%;">
                <span class="dashicons dashicons-calculator"></span>
                <?php esc_html_e('Calculate Total Cost', 'globalconnect-child'); ?>
            </button>
        </form>

        <div id="gc-tire-calc-result" style="display:none; margin-top:20px;">
            <div class="gc-tire-result-card">
                <div class="gc-tire-result-header">
                    <span class="dashicons dashicons-yes-alt" style="color: #22C55E;"></span>
                    <span>Estimate Ready</span>
                </div>
                <div class="gc-tire-result-body" id="gc-tire-cost-display"></div>
                <div class="gc-tire-result-footer">
                    <p><small><?php esc_html_e('*Prices are FOB estimates. Final CIF pricing includes inspection fees. Contact us for exact quote.', 'globalconnect-child'); ?></small></p>
                    <?php $whatsapp = get_option('gc_whatsapp_number', '12672900254'); ?>
                    <a href="https://wa.me/<?php echo esc_attr($whatsapp); ?>?text=Hi, I'm interested in bulk tire order. Can you provide a quote?" class="gc-btn gc-btn-gold" style="width: 100%; margin-top: 10px;">
                        <span class="dashicons dashicons-whatsapp"></span> Request Final Quote
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('gc-tire-calc-btn');
            const resultBox = document.getElementById('gc-tire-calc-result');
            const costDisplay = document.getElementById('gc-tire-cost-display');

            if (btn) {
                btn.addEventListener('click', function() {
                    const tireSelect = document.getElementById('gc-tire-type');
                    const containerSelect = document.getElementById('gc-container-size');
                    const conditionSelect = document.getElementById('gc-tire-condition');
                    const destSelect = document.getElementById('gc-tire-destination');

                    // Get selected options
                    const tireOption = tireSelect.options[tireSelect.selectedIndex];
                    const containerOption = containerSelect.options[containerSelect.selectedIndex];
                    const conditionOption = conditionSelect.options[conditionSelect.selectedIndex];
                    const destOption = destSelect.options[destSelect.selectedIndex];

                    // Get values
                    const basePricePerTire = parseFloat(tireOption.getAttribute('data-price'));
                    const baseQty = parseInt(tireOption.getAttribute('data-qty'));
                    const containerMultiplier = parseFloat(containerOption.getAttribute('data-multiplier'));
                    const conditionMultiplier = parseFloat(conditionOption.getAttribute('data-multiplier'));
                    const freightCost = parseFloat(destOption.getAttribute('data-freight'));

                    // Calculate
                    const actualQty = Math.round(baseQty * containerMultiplier);
                    const pricePerTire = Math.round(basePricePerTire * conditionMultiplier);
                    const tireCost = actualQty * pricePerTire;
                    const inspectionFee = 150;
                    const docFees = 100;
                    const containerFreight = Math.round(freightCost * containerMultiplier);

                    const totalCost = tireCost + containerFreight + inspectionFee + docFees;
                    const costPerTire = Math.round(totalCost / actualQty);

                    // Build breakdown HTML
                    let breakdownHtml = `
                        <div class="gc-tire-breakdown">
                            <div class="gc-tire-row highlight">
                                <span>Quantity:</span>
                                <span><strong>${actualQty} Tires</strong></span>
                            </div>
                            <div class="gc-tire-row">
                                <span>Tire Cost (${pricePerTire}/tire):</span>
                                <span>$${tireCost.toLocaleString()}</span>
                            </div>
                            <div class="gc-tire-row">
                                <span>Container Freight:</span>
                                <span>$${containerFreight.toLocaleString()}</span>
                            </div>
                            <div class="gc-tire-row">
                                <span>Inspection Fee:</span>
                                <span>$${inspectionFee}</span>
                            </div>
                            <div class="gc-tire-row">
                                <span>Documentation:</span>
                                <span>$${docFees}</span>
                            </div>
                            <div class="gc-tire-row total">
                                <span>Total Estimate:</span>
                                <span>$${totalCost.toLocaleString()}</span>
                            </div>
                            <div class="gc-tire-row per-unit">
                                <span>Cost Per Tire (Landed):</span>
                                <span>~$${costPerTire}</span>
                            </div>
                        </div>
                    `;

                    costDisplay.innerHTML = breakdownHtml;
                    resultBox.style.display = 'block';
                    resultBox.scrollIntoView({
                        behavior: 'smooth',
                        block: 'nearest'
                    });
                });
            }
        });
    </script>

    <style>
        .gc-tire-calculator-container {
            padding: 25px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .gc-tire-calc-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #E2E8F0;
        }

        .gc-tire-calc-header h3 {
            margin: 0;
            font-family: 'Outfit', sans-serif;
            font-size: 1.2rem;
            color: #0F172A;
        }

        .gc-tire-calculator-container .gc-form-group {
            margin-bottom: 18px;
        }

        .gc-tire-calculator-container .gc-form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            font-size: 0.9rem;
            color: #334155;
        }

        .gc-tire-calculator-container .gc-form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #E2E8F0;
            border-radius: 8px;
            font-size: 0.95rem;
            background: #F8FAFC;
            transition: border-color 0.2s;
        }

        .gc-tire-calculator-container .gc-form-group select:focus {
            outline: none;
            border-color: var(--gc-blue-primary);
        }

        .gc-tire-result-card {
            background: #F8FAFC;
            border: 1px solid #E2E8F0;
            border-radius: 12px;
            overflow: hidden;
        }

        .gc-tire-result-header {
            background: linear-gradient(135deg, #0F172A 0%, #1E3A5F 100%);
            color: white;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
        }

        .gc-tire-result-body {
            padding: 20px;
        }

        .gc-tire-result-footer {
            padding: 15px 20px;
            background: white;
            border-top: 1px solid #E2E8F0;
        }

        .gc-tire-result-footer p {
            margin: 0;
            color: #64748b;
            font-size: 0.8rem;
        }

        .gc-tire-breakdown {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .gc-tire-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px dashed #E2E8F0;
            font-size: 0.95rem;
        }

        .gc-tire-row.highlight {
            background: #DBEAFE;
            margin: -8px -10px 8px;
            padding: 12px;
            border-radius: 8px;
            border: none;
        }

        .gc-tire-row.total {
            border-bottom: none;
            border-top: 2px solid #0F172A;
            margin-top: 10px;
            padding-top: 15px;
            font-size: 1.1rem;
            font-weight: 700;
            color: #0F172A;
        }

        .gc-tire-row.per-unit {
            background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%);
            margin: 10px -10px -10px;
            padding: 12px;
            border-radius: 0 0 8px 8px;
            border: none;
            font-weight: 600;
            color: #92400E;
        }
    </style>
<?php
    return ob_get_clean();
}
add_shortcode('globalconnect_tire_calculator', 'globalconnect_tire_calculator_shortcode');
