<?php
$price = get_post_meta(get_the_ID(), 'vehicle_price', true);
$mileage = get_post_meta(get_the_ID(), 'vehicle_mileage', true);
$year = get_post_meta(get_the_ID(), 'vehicle_year', true);
$img = get_post_meta(get_the_ID(), 'vehicle_demo_image', true);
$status_terms = get_the_terms(get_the_ID(), 'vehicle_status');
$status = $status_terms ? $status_terms[0]->name : 'Available';
$make = get_the_terms(get_the_ID(), 'vehicle_make');
$make_name = $make ? $make[0]->name : '';
?>
<article class="gc-card-tech">
    <div class="gc-card-tech-header">
        <span>ID: <?php echo get_the_ID(); ?></span>
        <span>STATUS: <?php echo esc_html(strtoupper($status)); ?></span>
    </div>
    <div class="gc-card-tech-image">
        <div class="gc-tech-badge"><?php echo esc_html($year); ?></div>
        <?php if ($img): ?>
            <img src="<?php echo esc_url($img); ?>" alt="<?php the_title_attribute(); ?>"
                loading="lazy" style="width:100%; height:100%; object-fit:cover;">
        <?php else: ?>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/generated/placeholder-vehicle.jpg"
                alt="Vehicle Placeholder" loading="lazy" style="width:100%; height:100%; object-fit:cover; opacity:0.8;">
        <?php endif; ?>
    </div>
    <div class="gc-card-tech-body">
        <h3><a href="<?php the_permalink(); ?>" style="color:inherit; text-decoration:none;"><?php the_title(); ?></a>
        </h3>
        <div class="gc-tech-grid"
            style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 15px; padding-top: 15px; border-top: 1px solid rgba(0,0,0,0.05);">
            <div class="gc-tech-data-point" style="display:flex; flex-direction:column;"><span
                    style="font-size:10px; color:#94a3b8; letter-spacing:1px;">MILEAGE</span><span
                    style="font-family:'Roboto Mono', monospace; font-size:14px; font-weight:500; color:#334155;"><?php echo esc_html($mileage ? number_format(floatval(str_replace(',', '', $mileage))) . ' mi' : 'N/A'); ?></span>
            </div>
            <div class="gc-tech-data-point" style="display:flex; flex-direction:column;"><span
                    style="font-size:10px; color:#94a3b8; letter-spacing:1px;">PRICE</span><span
                    style="font-family:'Roboto Mono', monospace; font-size:14px; font-weight:700; color:var(--gc-blue-primary, #2563eb);">$<?php echo esc_html($price ? number_format(floatval(str_replace(',', '', $price))) : 'Inquire'); ?></span>
            </div>
        </div>
        <a href="<?php the_permalink(); ?>" class="gc-btn-tech"
            style="display:flex; align-items:center; justify-content:center; gap:8px; width:100%; padding:12px; background:#f8fafc; border:1px solid #e2e8f0; border-radius:6px; color:#475569; font-weight:600; font-size:14px; margin-top:15px; text-decoration:none; transition:all 0.2s ease;">
            View Data Sheet <span class="dashicons dashicons-arrow-right-alt2" style="font-size:16px;"></span>
        </a>
    </div>
</article>