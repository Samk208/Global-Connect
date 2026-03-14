<?php

/**
 * Shortcode: [globalconnect_user_dashboard]
 * Displays an elite user portal for tracking personal shipments.
 */

if (!defined('ABSPATH')) exit;

function globalconnect_user_dashboard_shortcode()
{
    if (!is_user_logged_in()) {
        return '<div class="gc-auth-notice gc-glass-dark">
            <span class="dashicons dashicons-lock"></span>
            <h3>Secure Portal Access</h3>
            <p>Please log in to view your private shipment dashboard and export history.</p>
            <a href="' . wp_login_url(get_permalink()) . '" class="gc-btn gc-btn-primary">Login to Dashboard</a>
        </div>';
    }

    $current_user = wp_get_current_user();

    // Logic: Fetch shipments where 'shipment_client_email' meta matches user email
    $args = array(
        'post_type' => 'shipment',
        'meta_query' => array(
            array(
                'key' => 'shipment_client_email',
                'value' => $current_user->user_email,
                'compare' => '='
            )
        ),
        'posts_per_page' => 50
    );
    $shipments = get_posts($args);

    // Fetch "Saved" (Pinned) shipments from user meta
    $saved_tracking = get_user_meta($current_user->ID, 'gc_saved_tracking', true) ?: [];
    $saved_shipments = [];
    if (!empty($saved_tracking)) {
        $saved_shipments = get_posts(array(
            'post_type' => 'shipment',
            'post_name__in' => $saved_tracking,
            'posts_per_page' => 50
        ));
    }

    ob_start();
?>
    <div class="gc-dashboard-container">
        <!-- Dashboard Header -->
        <header class="gc-dashboard-header gc-glass-dark">
            <div class="gc-user-profile">
                <div class="gc-avatar"><?php echo substr($current_user->display_name, 0, 1); ?></div>
                <div class="gc-user-info">
                    <h2>Welcome back, <?php echo esc_html($current_user->display_name); ?></h2>
                    <p><?php echo esc_html($current_user->user_email); ?></p>
                </div>
            </div>
            <div class="gc-dashboard-stats">
                <div class="stat-item">
                    <span class="val"><?php echo count($shipments); ?></span>
                    <span class="lbl">Active Exports</span>
                </div>
                <?php if (!empty($saved_shipments)): ?>
                    <div class="stat-item" style="margin-top:10px; border-top: 1px solid rgba(255,255,255,0.1); padding-top:10px;">
                        <span class="val" style="font-size:1.5rem;"><?php echo count($saved_shipments); ?></span>
                        <span class="lbl">Pinned Items</span>
                    </div>
                <?php endif; ?>
            </div>
        </header>

        <div class="gc-dashboard-grid">
            <!-- Main Content: Shipments -->
            <main class="gc-dashboard-main">
                <div class="gc-section-title">
                    <h3>Your Export Inventory</h3>
                    <div class="gc-line"></div>
                </div>

                <?php if (empty($shipments) && empty($saved_shipments)): ?>
                    <div class="gc-empty-state gc-glass-light">
                        <span class="dashicons dashicons-calendar-alt"></span>
                        <h4>No shipments found.</h4>
                        <p>Once you finalize an export invoice, your vehicles will appear here. You can also "pin" any public tracking number to your dashboard.</p>
                        <a href="/shop" class="gc-btn gc-btn-outline">Browse Inventory</a>
                    </div>
                <?php else: ?>
                    <div class="gc-shipment-list">
                        <?php
                        $all_to_show = array_merge($shipments, $saved_shipments);
                        // Remove duplicates
                        $temp_ids = [];
                        $final_list = [];
                        foreach ($all_to_show as $s) {
                            if (!in_array($s->ID, $temp_ids)) {
                                $temp_ids[] = $s->ID;
                                $final_list[] = $s;
                            }
                        }

                        foreach ($final_list as $ship):
                            $status = get_post_meta($ship->ID, 'shipment_status', true) ?: 'Received';
                            $location = get_post_meta($ship->ID, 'current_location', true);
                            $eta = get_post_meta($ship->ID, 'estimated_arrival', true);
                            $is_pinned = in_array($ship->post_name, $saved_tracking);
                        ?>
                            <div class="gc-shipment-card gc-glass-light">
                                <div class="card-header">
                                    <span class="track-id">
                                        <?php if ($is_pinned): ?><span class="dashicons dashicons-admin-post" title="Pinned" style="color:var(--gc-gold); margin-right:5px;"></span><?php endif; ?>
                                        <?php echo esc_html($ship->post_title); ?>
                                    </span>
                                    <span class="status-badge <?php echo strtolower($status); ?>"><?php echo esc_html($status); ?></span>
                                </div>
                                <div class="card-body">
                                    <div class="info-group">
                                        <label>Last Update</label>
                                        <p><?php echo $location ? esc_html($location) : 'N/A'; ?></p>
                                    </div>
                                    <div class="info-group">
                                        <label>Est. Arrival</label>
                                        <p><?php echo $eta ? date('M d, Y', strtotime($eta)) : 'TBD'; ?></p>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="/track/?track=<?php echo urlencode($ship->post_title); ?>" class="gc-btn-track-sm">View Full Tracking &rarr;</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </main>

            <!-- Sidebar: Quick Actions -->
            <aside class="gc-dashboard-sidebar">
                <div class="gc-action-card gc-glass-gold">
                    <h4>Need Assistance?</h4>
                    <p>Contact your dedicated export agent via WhatsApp for immediate updates.</p>
                    <a href="https://wa.me/<?php echo esc_attr(get_option('gc_whatsapp_number', '12672900254')); ?>" class="gc-btn-wa-sm">
                        <span class="dashicons dashicons-whatsapp"></span> Chat with Agent
                    </a>
                </div>

                <div class="gc-action-card gc-glass-light">
                    <h4>Settings</h4>
                    <a href="<?php echo wp_logout_url(home_url()); ?>" class="gc-logout-link">
                        <span class="dashicons dashicons-exit"></span> Sign Out
                    </a>
                </div>
            </aside>
        </div>
    </div>
<?php
    return ob_get_clean();
}
add_shortcode('globalconnect_user_dashboard', 'globalconnect_user_dashboard_shortcode');
