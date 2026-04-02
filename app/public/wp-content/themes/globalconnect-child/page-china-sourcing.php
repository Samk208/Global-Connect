<?php

/**
 * Template Name: China Sourcing Page
 * Description: Dedicated page for China Direct inventory - heavy trucks, machinery, tires.
 */

get_header();

// Get WhatsApp from settings
$whatsapp = get_option('gc_whatsapp_number', '12672900254');
?>

<div class="gc-page-wrapper gc-china-sourcing-page">

    <!-- Hero Section -->
    <section class="gc-hero gc-hero-china" style="background: linear-gradient(135deg, #0F172A 0%, #7F1D1D 100%); position: relative; overflow: hidden;">
        <!-- Chinese Pattern Overlay -->
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url('data:image/svg+xml,<svg xmlns=\" http://www.w3.org/2000/svg\" width=\"60\" height=\"60\">
            <rect fill=\"none\" width=\"60\" height=\"60\" />
            <path d=\"M30 0L60 30L30 60L0 30Z\" fill=\"rgba(255,255,255,0.02)\" /></svg>'); opacity: 0.5;">
        </div>

        <div class="gc-container" style="position: relative; z-index: 2;">
            <div class="gc-hero-content" style="text-align: center; padding: 80px 0;">
                <div style="display: inline-flex; align-items: center; gap: 10px; background: rgba(220,38,38,0.2); border: 1px solid rgba(220,38,38,0.4); padding: 8px 20px; border-radius: 50px; margin-bottom: 20px;">
                    <img src="https://flagcdn.com/w40/cn.png" alt="China" style="width: 24px; border-radius: 2px;">
                    <span style="color: #FCA5A5; font-family: var(--gc-font-mono); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">Factory Direct from China</span>
                </div>

                <h1 style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 3.5rem; text-transform: uppercase; color: white; margin-bottom: 20px;">
                    CHINA<span class="gc-tech-divider" style="color: #DC2626;">\</span>DIRECT<span class="gc-tech-divider" style="color: #DC2626;">\</span>SOURCING
                </h1>

                <p style="color: #E2E8F0; font-size: 1.2rem; max-width: 700px; margin: 0 auto 30px; line-height: 1.7;">
                    Access premium heavy trucks, construction machinery, and bulk tires directly from China's top manufacturers at factory prices.
                </p>

                <div style="display: flex; justify-content: center; gap: 15px; flex-wrap: wrap;">
                    <a href="#inventory" class="gc-btn gc-btn-primary">Browse China Inventory</a>
                    <a href="https://wa.me/<?php echo esc_attr($whatsapp); ?>?text=Hi, I'm interested in China sourcing" class="gc-btn gc-btn-outline" style="border-color: #DC2626; color: #FCA5A5;">Request Custom Quote</a>
                </div>
            </div>
        </div>

        <div class="gc-wave-bottom">
            <svg viewBox="0 0 1440 320" xmlns="http://www.w3.org/2000/svg">
                <path fill="#F8FAFC" fill-opacity="1" d="M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,224C672,245,768,267,864,261.3C960,256,1056,224,1152,197.3C1248,171,1344,149,1392,138.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
        </div>
    </section>

    <?php $fb_img_path = content_url('/docs/Images/Facebook_images/Unsorted'); ?>

    <!-- Factory Presence Banner -->
    <section style="background: #F8FAFC; padding: 0 0 40px;">
        <div class="gc-container" style="max-width: 900px;">
            <div style="
                border-radius: 16px;
                overflow: hidden;
                position: relative;
                box-shadow: 0 10px 40px rgba(0,0,0,0.12);
            ">
                <img src="<?php echo esc_url($fb_img_path); ?>/fb_import_20260131_204852_1.jpg"
                    alt="Our team at SHACMAN truck factory in China"
                    loading="lazy"
                    style="width: 100%; height: 320px; object-fit: cover; object-position: center 30%;">
                <div style="
                    position: absolute; bottom: 0; left: 0; right: 0;
                    background: linear-gradient(transparent, rgba(15,23,42,0.9));
                    padding: 50px 30px 25px;
                    display: flex;
                    justify-content: space-between;
                    align-items: flex-end;
                    flex-wrap: wrap;
                    gap: 15px;
                ">
                    <div>
                        <span style="background: #DC2626; color: white; padding: 4px 14px; border-radius: 4px; font-size: 0.7rem; font-weight: 700; letter-spacing: 1px;">ON THE GROUND IN CHINA</span>
                        <p style="color: white; font-weight: 700; font-size: 1.2rem; margin: 10px 0 0; font-family: 'Outfit', sans-serif;">We Visit Every Factory Before You Buy</p>
                    </div>
                    <a href="https://wa.me/<?php echo esc_attr($whatsapp); ?>?text=Hi, I want to source from China"
                        style="background: white; color: #0F172A; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.9rem; white-space: nowrap;">Request Factory Visit</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Categories -->
    <section class="gc-section" style="background: #F8FAFC; padding: 60px 0;">
        <div class="gc-container">
            <div class="gc-section-header" style="text-align: center; margin-bottom: 50px;">
                <span class="gc-header-data" style="color: #DC2626;">CATEGORIES + PRODUCTS + CHINA</span>
                <h2 class="gc-tech-title">What<span class="gc-tech-divider">\</span>We<span class="gc-tech-divider">\</span>Source</h2>
                <p style="color: #64748b; max-width: 600px; margin: 15px auto 0;">Direct partnerships with leading Chinese manufacturers</p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">

                <!-- Heavy Trucks -->
                <div class="gc-china-category-card" style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08); transition: transform 0.3s;">
                    <div style="height: 200px; background: url('<?php echo esc_url(content_url('/uploads/2026/03/heavy-trucks-fleet.jpg')); ?>') center/cover; position: relative;">
                        <div style="position: absolute; top: 15px; left: 15px; background: #DC2626; color: white; padding: 5px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 700;">BEST SELLER</div>
                    </div>
                    <div style="padding: 25px;">
                        <h3 style="font-family: 'Outfit', sans-serif; font-size: 1.4rem; margin-bottom: 10px; color: #0F172A;">Heavy Trucks</h3>
                        <p style="color: #64748b; font-size: 0.95rem; line-height: 1.6; margin-bottom: 15px;">Brand new Sinotruk, FAW, Shacman dump trucks, tractor heads, and cargo trucks.</p>
                        <ul style="list-style: none; padding: 0; margin: 0 0 20px 0;">
                            <li style="display: flex; align-items: center; gap: 8px; color: #334155; font-size: 0.9rem; margin-bottom: 8px;">
                                <span class="dashicons dashicons-yes-alt" style="color: #22C55E;"></span> Sinotruk Howo 371/420 HP
                            </li>
                            <li style="display: flex; align-items: center; gap: 8px; color: #334155; font-size: 0.9rem; margin-bottom: 8px;">
                                <span class="dashicons dashicons-yes-alt" style="color: #22C55E;"></span> 6x4, 8x4 Configurations
                            </li>
                            <li style="display: flex; align-items: center; gap: 8px; color: #334155; font-size: 0.9rem;">
                                <span class="dashicons dashicons-yes-alt" style="color: #22C55E;"></span> Factory Warranty Included
                            </li>
                        </ul>
                        <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 15px; border-top: 1px solid #E2E8F0;">
                            <span style="font-family: var(--gc-font-mono); color: #64748b; font-size: 0.85rem;">FROM $38,000</span>
                            <a href="/shop/?category=vehicles&source=china" class="gc-btn-tech" style="font-size: 0.85rem;">View Stock</a>
                        </div>
                    </div>
                </div>

                <!-- Construction Machinery -->
                <div class="gc-china-category-card" style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08); transition: transform 0.3s;">
                    <div style="height: 200px; background: url('<?php echo esc_url(content_url('/uploads/2026/03/construction-equipment.jpg')); ?>') center/cover; position: relative;">
                        <div style="position: absolute; top: 15px; left: 15px; background: #F59E0B; color: white; padding: 5px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 700;">HIGH DEMAND</div>
                    </div>
                    <div style="padding: 25px;">
                        <h3 style="font-family: 'Outfit', sans-serif; font-size: 1.4rem; margin-bottom: 10px; color: #0F172A;">Construction Machinery</h3>
                        <p style="color: #64748b; font-size: 0.95rem; line-height: 1.6; margin-bottom: 15px;">Excavators, wheel loaders, bulldozers, and cranes from SANY, XCMG, and Liugong.</p>
                        <ul style="list-style: none; padding: 0; margin: 0 0 20px 0;">
                            <li style="display: flex; align-items: center; gap: 8px; color: #334155; font-size: 0.9rem; margin-bottom: 8px;">
                                <span class="dashicons dashicons-yes-alt" style="color: #22C55E;"></span> SANY Excavators (6-50 Ton)
                            </li>
                            <li style="display: flex; align-items: center; gap: 8px; color: #334155; font-size: 0.9rem; margin-bottom: 8px;">
                                <span class="dashicons dashicons-yes-alt" style="color: #22C55E;"></span> XCMG Wheel Loaders
                            </li>
                            <li style="display: flex; align-items: center; gap: 8px; color: #334155; font-size: 0.9rem;">
                                <span class="dashicons dashicons-yes-alt" style="color: #22C55E;"></span> New & Certified Used
                            </li>
                        </ul>
                        <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 15px; border-top: 1px solid #E2E8F0;">
                            <span style="font-family: var(--gc-font-mono); color: #64748b; font-size: 0.85rem;">FROM $25,000</span>
                            <a href="/shop/?category=machines-parts" class="gc-btn-tech" style="font-size: 0.85rem;">View Stock</a>
                        </div>
                    </div>
                </div>

                <!-- Bulk Tires -->
                <div class="gc-china-category-card" style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08); transition: transform 0.3s;">
                    <div style="height: 200px; background: url('<?php echo esc_url(content_url('/uploads/2026/03/tires-warehouse.jpg')); ?>') center/cover; position: relative;">
                        <div style="position: absolute; top: 15px; left: 15px; background: #3B82F6; color: white; padding: 5px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 700;">BULK PRICING</div>
                    </div>
                    <div style="padding: 25px;">
                        <h3 style="font-family: 'Outfit', sans-serif; font-size: 1.4rem; margin-bottom: 10px; color: #0F172A;">Bulk Tires</h3>
                        <p style="color: #64748b; font-size: 0.95rem; line-height: 1.6; margin-bottom: 15px;">TBR truck tires, PCR passenger tires, and OTR mining tires in container loads.</p>
                        <ul style="list-style: none; padding: 0; margin: 0 0 20px 0;">
                            <li style="display: flex; align-items: center; gap: 8px; color: #334155; font-size: 0.9rem; margin-bottom: 8px;">
                                <span class="dashicons dashicons-yes-alt" style="color: #22C55E;"></span> TBR: 11R22.5, 295/80R22.5
                            </li>
                            <li style="display: flex; align-items: center; gap: 8px; color: #334155; font-size: 0.9rem; margin-bottom: 8px;">
                                <span class="dashicons dashicons-yes-alt" style="color: #22C55E;"></span> MOQ: 1 x 40ft Container
                            </li>
                            <li style="display: flex; align-items: center; gap: 8px; color: #334155; font-size: 0.9rem;">
                                <span class="dashicons dashicons-yes-alt" style="color: #22C55E;"></span> Brand Options Available
                            </li>
                        </ul>
                        <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 15px; border-top: 1px solid #E2E8F0;">
                            <span style="font-family: var(--gc-font-mono); color: #64748b; font-size: 0.85rem;">FROM $80/TIRE</span>
                            <a href="/shop/?category=tires" class="gc-btn-tech" style="font-size: 0.85rem;">View Stock</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- China Inventory Section -->
    <section id="inventory" class="gc-section" style="background: #0F172A; padding: 60px 0;">
        <div class="gc-container">
            <div class="gc-section-header" style="text-align: center; margin-bottom: 40px;">
                <span class="gc-header-data" style="color: var(--gc-gold);">LIVE + CHINA + INVENTORY</span>
                <h2 class="gc-tech-title" style="color: white;">Available<span class="gc-tech-divider">\</span>Stock</h2>
            </div>

            <div class="gc-inventory-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 25px;">
                <?php
                // Query China inventory
                $args = array(
                    'post_type' => array('vehicle', 'part'),
                    'posts_per_page' => 8,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'vehicle_source',
                            'field' => 'slug',
                            'terms' => 'china'
                        )
                    )
                );
                $china_query = new WP_Query($args);

                if ($china_query->have_posts()):
                    while ($china_query->have_posts()): $china_query->the_post();
                        $type = get_post_type();
                        $price = ($type == 'vehicle') ? get_post_meta(get_the_ID(), 'vehicle_price', true) : get_post_meta(get_the_ID(), 'part_price', true);
                        $demo_image = ($type == 'vehicle') ? get_post_meta(get_the_ID(), 'vehicle_demo_image', true) : get_post_meta(get_the_ID(), 'part_demo_image', true);
                        $year = get_post_meta(get_the_ID(), 'vehicle_year', true);
                        $condition = get_post_meta(get_the_ID(), 'part_condition', true);
                ?>
                        <article class="gc-card-tech">
                            <div class="gc-card-tech-header">
                                <span>ID: GC-<?php the_ID(); ?></span>
                                <span style="color: #DC2626;">CHINA DIRECT</span>
                            </div>
                            <div class="gc-card-tech-image">
                                <?php if (has_post_thumbnail()): the_post_thumbnail('medium_large');
                                elseif ($demo_image): ?>
                                    <img src="<?php echo esc_url($demo_image); ?>" alt="<?php the_title_attribute(); ?>">
                                <?php else: ?>
                                    <div style="width:100%; height:100%; background:#1E293B; display:flex; align-items:center; justify-content:center; color:#64748b;">
                                        <span class="dashicons dashicons-format-image" style="font-size:40px;"></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="gc-card-tech-body">
                                <h3><a href="<?php the_permalink(); ?>" style="text-decoration:none; color:inherit;"><?php the_title(); ?></a></h3>
                                <div class="gc-tech-grid">
                                    <?php if ($year): ?><div class="gc-tech-data-point"><span>YEAR</span><?php echo esc_html($year); ?></div><?php endif; ?>
                                    <?php if ($condition): ?><div class="gc-tech-data-point"><span>COND</span><?php echo esc_html($condition); ?></div><?php endif; ?>
                                    <div class="gc-tech-data-point"><span>ORIGIN</span>China</div>
                                    <div class="gc-tech-data-point"><span>PRICE</span><span style="color:var(--gc-gold); font-weight:bold;"><?php echo $price ? '$' . esc_html($price) : 'Quote'; ?></span></div>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="gc-btn-tech">View Details</a>
                            </div>
                        </article>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                else:
                    ?>
                    <div style="grid-column: 1/-1; text-align: center; padding: 60px 20px; background: rgba(255,255,255,0.05); border-radius: 12px;">
                        <span class="dashicons dashicons-archive" style="font-size: 48px; color: #64748b; margin-bottom: 15px;"></span>
                        <h3 style="color: white; margin-bottom: 10px;">No China Stock Listed Yet</h3>
                        <p style="color: #64748b; margin-bottom: 20px;">Contact us to request specific items from our China suppliers.</p>
                        <a href="https://wa.me/<?php echo esc_attr($whatsapp); ?>?text=Hi, I need a quote for China sourcing" class="gc-btn gc-btn-primary">Request Custom Quote</a>
                    </div>
                <?php endif; ?>
            </div>

            <div style="text-align: center; margin-top: 40px;">
                <a href="/shop/?category=all" class="gc-btn gc-btn-outline" style="border-color: var(--gc-gold); color: var(--gc-gold);">View All Inventory</a>
            </div>
        </div>
    </section>

    <!-- Why China Section -->
    <section class="gc-section" style="background: #F8FAFC; padding: 60px 0;">
        <div class="gc-container">
            <div class="gc-section-header" style="text-align: center; margin-bottom: 50px;">
                <span class="gc-header-data">ADVANTAGES + VALUE + QUALITY</span>
                <h2 class="gc-tech-title">Why<span class="gc-tech-divider">\</span>Source<span class="gc-tech-divider">\</span>From China?</h2>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 25px;">
                <div style="background: white; padding: 30px; border-radius: 12px; text-align: center; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                    <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #DC2626 0%, #991B1B 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                        <span class="dashicons dashicons-money-alt" style="color: white; font-size: 28px;"></span>
                    </div>
                    <h3 style="font-family: 'Outfit', sans-serif; font-size: 1.2rem; margin-bottom: 10px;">Factory Pricing</h3>
                    <p style="color: #64748b; font-size: 0.95rem;">Direct manufacturer relationships mean 30-50% savings vs middlemen.</p>
                </div>

                <div style="background: white; padding: 30px; border-radius: 12px; text-align: center; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                    <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                        <span class="dashicons dashicons-awards" style="color: white; font-size: 28px;"></span>
                    </div>
                    <h3 style="font-family: 'Outfit', sans-serif; font-size: 1.2rem; margin-bottom: 10px;">Proven Quality</h3>
                    <p style="color: #64748b; font-size: 0.95rem;">Sinotruk, SANY & XCMG are trusted globally for durability.</p>
                </div>

                <div style="background: white; padding: 30px; border-radius: 12px; text-align: center; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                    <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #3B82F6 0%, #1D4ED8 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                        <span class="dashicons dashicons-admin-multisite" style="color: white; font-size: 28px;"></span>
                    </div>
                    <h3 style="font-family: 'Outfit', sans-serif; font-size: 1.2rem; margin-bottom: 10px;">Bulk Capacity</h3>
                    <p style="color: #64748b; font-size: 0.95rem;">Container loads of tires, parts & multiple units per shipment.</p>
                </div>

                <div style="background: white; padding: 30px; border-radius: 12px; text-align: center; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                    <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #22C55E 0%, #16A34A 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                        <span class="dashicons dashicons-shield-alt" style="color: white; font-size: 28px;"></span>
                    </div>
                    <h3 style="font-family: 'Outfit', sans-serif; font-size: 1.2rem; margin-bottom: 10px;">Our Guarantee</h3>
                    <p style="color: #64748b; font-size: 0.95rem;">We inspect every unit before shipping. Quality assured.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="gc-cta-banner" style="background: linear-gradient(135deg, #7F1D1D 0%, #0F172A 100%); padding: 60px 0; text-align: center;">
        <div class="gc-container">
            <h2 style="font-family: 'Outfit', sans-serif; color: white; font-size: 2rem; margin-bottom: 15px;">Ready to Source from China?</h2>
            <p style="color: #E2E8F0; max-width: 600px; margin: 0 auto 30px;">Get factory-direct pricing on heavy trucks, machinery, and bulk tires. Our team handles everything from sourcing to delivery.</p>
            <div style="display: flex; justify-content: center; gap: 15px; flex-wrap: wrap;">
                <a href="https://wa.me/<?php echo esc_attr($whatsapp); ?>?text=Hi, I want to discuss China sourcing options" class="gc-btn gc-btn-gold">
                    <span class="dashicons dashicons-whatsapp"></span> WhatsApp Us Now
                </a>
                <a href="/contact" class="gc-btn gc-btn-outline" style="border-color: white; color: white;">Send Inquiry</a>
            </div>
        </div>
    </section>

</div>

<style>
    .gc-china-category-card:hover {
        transform: translateY(-5px);
    }

    @media (max-width: 768px) {
        .gc-hero-china h1 {
            font-size: 2.5rem !important;
        }
    }
</style>

<?php get_footer(); ?>