<?php

/**
 * Shortcode: [globalconnect_tracker]
 * Usage: Displays a tracking form and results.
 */

if (!defined('ABSPATH')) {
    exit;
}

function globalconnect_tracker_shortcode()
{
    ob_start();
?>
    <div class="gc-tracker-card gc-glass-dark">
        <div class="gc-tracker-header">
            <span class="dashicons dashicons-location-alt"></span>
            <h2>Real-time Shipment Tracking</h2>
            <p>Enter your tracking number to see the current status of your export.</p>
        </div>

        <form method="get" action="" class="gc-tracker-form-modern">
            <div class="gc-search-box-wrapper">
                <input type="text" name="track"
                    placeholder="<?php esc_attr_e('e.g. GC-12345678', 'globalconnect-child'); ?>"
                    value="<?php echo isset($_GET['track']) ? esc_attr($_GET['track']) : ''; ?>" required />
                <button type="submit" class="gc-tracker-btn-primary">
                    <span class="dashicons dashicons-search"></span>
                    <span><?php esc_html_e('Locate Shipment', 'globalconnect-child'); ?></span>
                </button>
            </div>
        </form>

        <?php
        if (!empty($_GET['track'])) {
            $tracking_number = sanitize_text_field($_GET['track']);

            // Demo Simulation: Admin-only (disable for production visitors)
            if (strtoupper($tracking_number) === 'DEMO-LIVE' && current_user_can('manage_options')) {
                $status = 'Sailing';
                $location = 'Mid-Atlantic (En route to Conakry)';
                $eta = date('Y-m-d', strtotime('+12 days'));
                $container = 'MSCU-982341-0';
                $shipment_found = true;
            } else {
                // Query for the shipment by title (Tracking Number)
                $args = array(
                    'post_type' => 'shipment',
                    'title' => $tracking_number,
                    'post_status' => 'publish',
                    'numberposts' => 1,
                );
                $shipments = get_posts($args);
                $shipment_found = !empty($shipments);
                if ($shipment_found) {
                    $shipment = $shipments[0];
                    $status = get_post_meta($shipment->ID, 'shipment_status', true) ?: 'Received';
                    $location = get_post_meta($shipment->ID, 'current_location', true);
                    $eta = get_post_meta($shipment->ID, 'estimated_arrival', true);
                    $container = get_post_meta($shipment->ID, 'container_number', true);
                }
            }

            if ($shipment_found) {
                // Define Status Order
                $stages = ['Received', 'Processing', 'Sailing', 'Customs', 'Arrived', 'Delivered'];
                $current_stage_index = array_search($status, $stages);
                if ($current_stage_index === false) $current_stage_index = 0;
        ?>
                <div class="gc-tracker-results-modern">
                    <div class="gc-results-info">
                        <div class="gc-info-pill">
                            <span class="label">ID:</span> <strong><?php echo esc_html($tracking_number); ?></strong>
                        </div>
                        <?php if ($container): ?>
                            <div class="gc-info-pill">
                                <span class="label">Container:</span> <strong><?php echo esc_html($container); ?></strong>
                            </div>
                        <?php endif; ?>

                        <?php if (is_user_logged_in() && strtoupper($tracking_number) !== 'DEMO-LIVE'):
                            $user_id = get_current_user_id();
                            $saved_tracking = get_user_meta($user_id, 'gc_saved_tracking', true) ?: [];
                            $is_saved = in_array($tracking_number, $saved_tracking);
                        ?>
                            <button type="button" class="gc-pin-btn <?php echo $is_saved ? 'pinned' : ''; ?>" data-track="<?php echo esc_attr($tracking_number); ?>">
                                <span class="dashicons <?php echo $is_saved ? 'dashicons-admin-post' : 'dashicons-plus-alt'; ?>"></span>
                                <span><?php echo $is_saved ? 'Pinned to Dashboard' : 'Pin to Dashboard'; ?></span>
                            </button>
                        <?php endif; ?>
                    </div>

                    <div class="gc-status-hero">
                        <div class="gc-hero-left">
                            <span class="gc-status-badge-modern <?php echo strtolower($status); ?>"><?php echo esc_html($status); ?></span>
                            <div class="gc-location-text">
                                <span class="dashicons dashicons-marker"></span>
                                <?php echo $location ? esc_html($location) : 'Updating...'; ?>
                            </div>
                        </div>
                        <div class="gc-hero-right">
                            <span class="eta-label">Est. Arrival</span>
                            <span class="eta-date"><?php echo $eta ? esc_html(date('M d, Y', strtotime($eta))) : 'TBD'; ?></span>
                        </div>
                    </div>

                    <div class="gc-modern-timeline">
                        <div class="timeline-line">
                            <div class="timeline-fill" style="width: <?php echo ($current_stage_index / (count($stages) - 1)) * 100; ?>%;"></div>
                        </div>
                        <div class="timeline-steps">
                            <?php foreach ($stages as $index => $stage):
                                $class = '';
                                if ($index < $current_stage_index) $class = 'completed';
                                if ($index === $current_stage_index) $class = 'active';
                            ?>
                                <div class="timeline-step <?php echo $class; ?>">
                                    <div class="step-icon">
                                        <?php if ($index < $current_stage_index): ?>
                                            <span class="dashicons dashicons-yes"></span>
                                        <?php else: ?>
                                            <span class="step-num"><?php echo $index + 1; ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <span class="step-label"><?php echo esc_html($stage); ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
        <?php
            } else {
                echo '<div class="gc-tracker-error-modern"><span class="dashicons dashicons-warning"></span> ' . esc_html__('Tracking number not found in our global database.', 'globalconnect-child') . '</div>';
            }
        }
        ?>
    </div>

    <script>
        jQuery(document).ready(function($) {
            $('.gc-pin-btn').on('click', function() {
                const $btn = $(this);
                const trackNum = $btn.data('track');

                $btn.prop('disabled', true).css('opacity', '0.5');

                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    method: 'POST',
                    data: {
                        action: 'gc_toggle_pin_shipment',
                        track: trackNum,
                        nonce: '<?php echo wp_create_nonce('gc_pin_nonce'); ?>'
                    },
                    success: function(response) {
                        if (response.success) {
                            if (response.data.status === 'pinned') {
                                $btn.addClass('pinned').find('span:last').text('Pinned to Dashboard');
                                $btn.find('.dashicons').removeClass('dashicons-plus-alt').addClass('dashicons-admin-post');
                            } else {
                                $btn.removeClass('pinned').find('span:last').text('Pin to Dashboard');
                                $btn.find('.dashicons').removeClass('dashicons-admin-post').addClass('dashicons-plus-alt');
                            }
                        }
                        $btn.prop('disabled', false).css('opacity', '1');
                    }
                });
            });
        });
    </script>
<?php
    return ob_get_clean();
}
add_shortcode('globalconnect_tracker', 'globalconnect_tracker_shortcode');
