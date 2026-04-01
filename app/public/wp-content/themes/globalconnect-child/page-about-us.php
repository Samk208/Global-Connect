<?php

/**
 * Template Name: About Us
 * Description: Comprehensive About Us page for GlobalConnect Shipping LLC.
 */

get_header();

$whatsapp    = get_option('gc_whatsapp_number', '12672900254');
$fb_img_path = content_url('/docs/Images/Facebook_images/Unsorted');
$mvk_img     = $fb_img_path . '/MVK.jpg';
?>

<div id="gc-about-page" style="background: #0F172A; color: #E2E8F0; overflow: hidden;">

    <!-- ============================================
     1. HERO SECTION
     ============================================ -->
    <section style="
    position: relative;
    padding: 120px 0 80px;
    background: linear-gradient(180deg, rgba(15,23,42,0.95) 0%, rgba(15,23,42,0.8) 100%),
                url('<?php echo esc_url(content_url('/uploads/2026/03/cargo-ship-hero.jpg')); ?>') no-repeat center center/cover;
    text-align: center;
">
        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0;
         background-image: linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
                           linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
         background-size: 60px 60px; pointer-events: none;"></div>
        <div class="gc-container" style="position: relative; z-index: 2;">
            <span style="display: inline-block; background: rgba(212,175,55,0.15); color: var(--gc-gold); padding: 8px 24px; border-radius: 30px; font-size: 0.8rem; font-weight: 700; letter-spacing: 2px; margin-bottom: 20px; border: 1px solid rgba(212,175,55,0.3);">ESTABLISHED 1998</span>
            <h1 style="font-family: 'Outfit', sans-serif; font-size: 3.5rem; font-weight: 800; color: white; margin: 0 0 20px; line-height: 1.15;">
                Connecting <span style="color: var(--gc-gold);">Africa</span> to the<br>World's Best Inventory
            </h1>
            <p style="font-size: 1.2rem; color: #94A3B8; max-width: 700px; margin: 0 auto 35px; line-height: 1.7;">
                GlobalConnect Shipping LLC is a Philadelphia-based export company specializing in vehicles, heavy machinery, parts, and tires &mdash; serving businesses and individuals across West Africa since 1998.
            </p>
            <div style="display: flex; justify-content: center; gap: 15px; flex-wrap: wrap;">
                <a href="/shop" style="display: inline-flex; align-items: center; gap: 8px; padding: 14px 32px; background: linear-gradient(135deg, #D4AF37 0%, #B8941F 100%); color: #0F172A; border-radius: 50px; font-weight: 700; text-decoration: none; font-size: 0.95rem;">Browse Inventory</a>
                <a href="https://wa.me/<?php echo esc_attr($whatsapp); ?>?text=Hi, I'd like to learn more about GlobalConnect" style="display: inline-flex; align-items: center; gap: 8px; padding: 14px 32px; border: 2px solid rgba(255,255,255,0.2); color: white; border-radius: 50px; font-weight: 600; text-decoration: none; font-size: 0.95rem;">Chat With Us</a>
            </div>
        </div>
    </section>

    <!-- ============================================
     2. OUR STORY
     ============================================ -->
    <section style="background: #F8FAFC; padding: 80px 0;">
        <div class="gc-container">
            <div class="gc-about-story-grid" style="display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 60px; align-items: center;">
                <!-- Text -->
                <div>
                    <span style="color: var(--gc-gold); font-size: 0.8rem; font-weight: 700; letter-spacing: 2px;">OUR STORY</span>
                    <h2 style="font-family: 'Outfit', sans-serif; font-size: 2.5rem; font-weight: 800; color: #0F172A; margin: 12px 0 20px; line-height: 1.2;">
                        From Philadelphia<br>to West Africa
                    </h2>
                    <p style="color: #475569; font-size: 1.05rem; line-height: 1.8; margin-bottom: 20px;">
                        Founded by <strong>Mr. Mohamed V. Konneh</strong> in 1998, GlobalConnect Shipping began as a small freight forwarding operation connecting the African diaspora in Philadelphia with reliable shipping routes back home.
                    </p>
                    <p style="color: #475569; font-size: 1.05rem; line-height: 1.8; margin-bottom: 20px;">
                        Over 26 years, we've grown into a full-service export company &mdash; sourcing quality vehicles, heavy trucks, construction machinery, engines, and tires from the USA and China, and delivering them to markets across Guinea, Sierra Leone, Liberia, Senegal, and beyond.
                    </p>
                    <p style="color: #475569; font-size: 1.05rem; line-height: 1.8;">
                        What sets us apart is our hands-on approach: our founder personally inspects inventory, visits factories in China, and oversees container loading in Philadelphia. Every shipment carries our reputation.
                    </p>
                </div>
                <!-- Stats Sidebar -->
                <div style="display: flex; flex-direction: column; gap: 20px;">
                    <div style="background: white; border-radius: 16px; padding: 30px; box-shadow: 0 4px 20px rgba(0,0,0,0.06); border-left: 4px solid var(--gc-gold);">
                        <div style="font-family: 'Outfit', sans-serif; font-size: 2.8rem; font-weight: 800; color: #0F172A;">1998</div>
                        <div style="color: #64748b; font-weight: 600; font-size: 0.9rem;">Year Founded</div>
                    </div>
                    <div style="background: white; border-radius: 16px; padding: 30px; box-shadow: 0 4px 20px rgba(0,0,0,0.06); border-left: 4px solid #3B82F6;">
                        <div style="font-family: 'Outfit', sans-serif; font-size: 2.8rem; font-weight: 800; color: #0F172A;">26+</div>
                        <div style="color: #64748b; font-weight: 600; font-size: 0.9rem;">Years In Business</div>
                    </div>
                    <div style="background: white; border-radius: 16px; padding: 30px; box-shadow: 0 4px 20px rgba(0,0,0,0.06); border-left: 4px solid #059669;">
                        <div style="font-family: 'Outfit', sans-serif; font-size: 2.8rem; font-weight: 800; color: #0F172A;">3</div>
                        <div style="color: #64748b; font-weight: 600; font-size: 0.9rem;">Continents Served</div>
                    </div>
                    <div style="background: white; border-radius: 16px; padding: 30px; box-shadow: 0 4px 20px rgba(0,0,0,0.06); border-left: 4px solid #DC2626;">
                        <div style="font-family: 'Outfit', sans-serif; font-size: 2.8rem; font-weight: 800; color: #0F172A;">500+</div>
                        <div style="color: #64748b; font-weight: 600; font-size: 0.9rem;">Containers Shipped</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================
     3. WHAT WE DO (Services)
     ============================================ -->
    <section style="background: #0F172A; padding: 80px 0;">
        <div class="gc-container">
            <div style="text-align: center; margin-bottom: 50px;">
                <span style="color: var(--gc-gold); font-size: 0.8rem; font-weight: 700; letter-spacing: 2px;">WHAT WE DO</span>
                <h2 style="font-family: 'Outfit', sans-serif; color: white; font-size: 2.5rem; font-weight: 800; margin: 12px 0 0;">
                    Our<span class="gc-tech-divider">\</span>Services
                </h2>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 25px;">
                <!-- Service 1: Vehicle Export -->
                <div style="background: rgba(30,41,59,0.6); border: 1px solid rgba(255,255,255,0.06); border-radius: 16px; padding: 35px; backdrop-filter: blur(10px); transition: transform 0.3s, border-color 0.3s;" onmouseenter="this.style.borderColor='rgba(212,175,55,0.4)';this.style.transform='translateY(-5px)'" onmouseleave="this.style.borderColor='rgba(255,255,255,0.06)';this.style.transform='translateY(0)'">
                    <div style="width: 55px; height: 55px; background: rgba(212,175,55,0.15); border-radius: 14px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                        <span class="dashicons dashicons-car" style="font-size: 28px; width: 28px; height: 28px; color: var(--gc-gold);"></span>
                    </div>
                    <h3 style="color: white; font-size: 1.3rem; margin-bottom: 12px; font-family: 'Outfit', sans-serif;">Vehicle Export</h3>
                    <p style="color: #94A3B8; line-height: 1.7; font-size: 0.95rem;">Sedans, SUVs, trucks, and specialty vehicles sourced from US auctions, dealers, and private sellers &mdash; inspected and shipped to West African ports.</p>
                </div>

                <!-- Service 2: Heavy Machinery -->
                <div style="background: rgba(30,41,59,0.6); border: 1px solid rgba(255,255,255,0.06); border-radius: 16px; padding: 35px; backdrop-filter: blur(10px); transition: transform 0.3s, border-color 0.3s;" onmouseenter="this.style.borderColor='rgba(59,130,246,0.4)';this.style.transform='translateY(-5px)'" onmouseleave="this.style.borderColor='rgba(255,255,255,0.06)';this.style.transform='translateY(0)'">
                    <div style="width: 55px; height: 55px; background: rgba(59,130,246,0.15); border-radius: 14px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                        <span class="dashicons dashicons-hammer" style="font-size: 28px; width: 28px; height: 28px; color: #3B82F6;"></span>
                    </div>
                    <h3 style="color: white; font-size: 1.3rem; margin-bottom: 12px; font-family: 'Outfit', sans-serif;">Heavy Machinery</h3>
                    <p style="color: #94A3B8; line-height: 1.7; font-size: 0.95rem;">CAT engines, excavators, loaders, and construction equipment. We deal in all kinds of Caterpillar engines, generators, and industrial parts.</p>
                </div>

                <!-- Service 3: China Sourcing -->
                <div style="background: rgba(30,41,59,0.6); border: 1px solid rgba(255,255,255,0.06); border-radius: 16px; padding: 35px; backdrop-filter: blur(10px); transition: transform 0.3s, border-color 0.3s;" onmouseenter="this.style.borderColor='rgba(220,38,38,0.4)';this.style.transform='translateY(-5px)'" onmouseleave="this.style.borderColor='rgba(255,255,255,0.06)';this.style.transform='translateY(0)'">
                    <div style="width: 55px; height: 55px; background: rgba(220,38,38,0.15); border-radius: 14px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                        <span class="dashicons dashicons-admin-site-alt3" style="font-size: 28px; width: 28px; height: 28px; color: #DC2626;"></span>
                    </div>
                    <h3 style="color: white; font-size: 1.3rem; margin-bottom: 12px; font-family: 'Outfit', sans-serif;">China Direct</h3>
                    <p style="color: #94A3B8; line-height: 1.7; font-size: 0.95rem;">Brand-new Sinotruk, SHACMAN, and FAW trucks sourced direct from Chinese factories at wholesale prices. We visit every factory before you buy.</p>
                </div>

                <!-- Service 4: Freight & Logistics -->
                <div style="background: rgba(30,41,59,0.6); border: 1px solid rgba(255,255,255,0.06); border-radius: 16px; padding: 35px; backdrop-filter: blur(10px); transition: transform 0.3s, border-color 0.3s;" onmouseenter="this.style.borderColor='rgba(5,150,105,0.4)';this.style.transform='translateY(-5px)'" onmouseleave="this.style.borderColor='rgba(255,255,255,0.06)';this.style.transform='translateY(0)'">
                    <div style="width: 55px; height: 55px; background: rgba(5,150,105,0.15); border-radius: 14px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                        <span class="dashicons dashicons-migrate" style="font-size: 28px; width: 28px; height: 28px; color: #059669;"></span>
                    </div>
                    <h3 style="color: white; font-size: 1.3rem; margin-bottom: 12px; font-family: 'Outfit', sans-serif;">Freight Forwarding</h3>
                    <p style="color: #94A3B8; line-height: 1.7; font-size: 0.95rem;">Full container shipping, RoRo, and consolidated freight. Real-time tracking from Philadelphia or China to Conakry, Freetown, Monrovia, and Dakar.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================
     4. OUR JOURNEY - Timeline
     ============================================ -->
    <section style="background: #F8FAFC; padding: 80px 0;">
        <div class="gc-container" style="max-width: 800px;">
            <div style="text-align: center; margin-bottom: 50px;">
                <span style="color: var(--gc-gold); font-size: 0.8rem; font-weight: 700; letter-spacing: 2px;">OUR JOURNEY</span>
                <h2 style="font-family: 'Outfit', sans-serif; color: #0F172A; font-size: 2.5rem; font-weight: 800; margin: 12px 0 0;">26+ Years of Growth</h2>
            </div>

            <div class="gc-timeline" style="position: relative; padding-left: 40px;">
                <!-- Timeline Line -->
                <div style="position: absolute; left: 14px; top: 0; bottom: 0; width: 3px; background: linear-gradient(to bottom, var(--gc-gold), #3B82F6, #059669); border-radius: 2px;"></div>

                <!-- 1998 -->
                <div style="position: relative; margin-bottom: 40px;">
                    <div style="position: absolute; left: -40px; top: 5px; width: 30px; height: 30px; background: var(--gc-gold); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <div style="width: 10px; height: 10px; background: white; border-radius: 50%;"></div>
                    </div>
                    <div style="background: white; border-radius: 14px; padding: 25px 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.06);">
                        <span style="color: var(--gc-gold); font-weight: 800; font-family: 'Outfit', sans-serif; font-size: 1.1rem;">1998</span>
                        <h3 style="color: #0F172A; font-size: 1.2rem; margin: 8px 0;">The Beginning</h3>
                        <p style="color: #64748b; line-height: 1.7; margin: 0;">Mr. Mohamed V. Konneh founds GlobalConnect as a freight forwarding service in Philadelphia, helping the African community ship goods back home.</p>
                    </div>
                </div>

                <!-- 2005 -->
                <div style="position: relative; margin-bottom: 40px;">
                    <div style="position: absolute; left: -40px; top: 5px; width: 30px; height: 30px; background: #3B82F6; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <div style="width: 10px; height: 10px; background: white; border-radius: 50%;"></div>
                    </div>
                    <div style="background: white; border-radius: 14px; padding: 25px 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.06);">
                        <span style="color: #3B82F6; font-weight: 800; font-family: 'Outfit', sans-serif; font-size: 1.1rem;">2005</span>
                        <h3 style="color: #0F172A; font-size: 1.2rem; margin: 8px 0;">Vehicle Export Launch</h3>
                        <p style="color: #64748b; line-height: 1.7; margin: 0;">Expanded into vehicle sourcing and export, becoming a trusted name for quality used cars, SUVs, and trucks shipped to Guinea and neighboring countries.</p>
                    </div>
                </div>

                <!-- 2015 -->
                <div style="position: relative; margin-bottom: 40px;">
                    <div style="position: absolute; left: -40px; top: 5px; width: 30px; height: 30px; background: #DC2626; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <div style="width: 10px; height: 10px; background: white; border-radius: 50%;"></div>
                    </div>
                    <div style="background: white; border-radius: 14px; padding: 25px 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.06);">
                        <span style="color: #DC2626; font-weight: 800; font-family: 'Outfit', sans-serif; font-size: 1.1rem;">2015</span>
                        <h3 style="color: #0F172A; font-size: 1.2rem; margin: 8px 0;">China Operations Begin</h3>
                        <p style="color: #64748b; line-height: 1.7; margin: 0;">Established direct relationships with Chinese manufacturers including Sinotruk, SHACMAN, and FAW &mdash; offering brand-new heavy trucks at factory prices.</p>
                    </div>
                </div>

                <!-- 2024+ -->
                <div style="position: relative;">
                    <div style="position: absolute; left: -40px; top: 5px; width: 30px; height: 30px; background: #059669; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <div style="width: 10px; height: 10px; background: white; border-radius: 50%;"></div>
                    </div>
                    <div style="background: white; border-radius: 14px; padding: 25px 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.06);">
                        <span style="color: #059669; font-weight: 800; font-family: 'Outfit', sans-serif; font-size: 1.1rem;">TODAY</span>
                        <h3 style="color: #0F172A; font-size: 1.2rem; margin: 8px 0;">Digital-First Platform</h3>
                        <p style="color: #64748b; line-height: 1.7; margin: 0;">Launched our online platform with real-time inventory, shipment tracking, and WhatsApp-integrated support &mdash; making global trade accessible to everyone.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================
     5. MEET THE FOUNDER
     ============================================ -->
    <section style="background: linear-gradient(135deg, #0F172A 0%, #1E293B 50%, #0F172A 100%); padding: 80px 0; position: relative; overflow: hidden;">
        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0;
         background-image: radial-gradient(circle at 20% 80%, rgba(212,175,55,0.08) 0%, transparent 50%),
                           radial-gradient(circle at 80% 20%, rgba(30,58,95,0.2) 0%, transparent 50%);
         pointer-events: none;"></div>
        <div class="gc-container" style="position: relative; z-index: 2;">
            <div class="gc-founder-about-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;">

                <!-- Photo Side -->
                <div style="position: relative;">
                    <div style="border-radius: 20px; overflow: hidden; position: relative; box-shadow: 0 20px 60px rgba(0,0,0,0.4);">
                        <img src="<?php echo esc_url($mvk_img); ?>" alt="Mr. Mohamed V. Konneh - Founder &amp; CEO of GlobalConnect Shipping" loading="lazy" style="width: 100%; height: 500px; object-fit: cover; object-position: center top;">
                        <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(15,23,42,0.95)); padding: 50px 25px 25px;">
                            <h3 style="color: white; font-family: 'Outfit', sans-serif; font-size: 1.5rem; margin: 0;">Mr. Mohamed V. Konneh</h3>
                            <p style="color: var(--gc-gold); font-size: 0.9rem; font-weight: 600; margin: 5px 0 0;">Founder &amp; CEO</p>
                        </div>
                    </div>
                    <!-- Experience Badge -->
                    <div style="position: absolute; top: 25px; right: -15px; background: var(--gc-gold); color: #0F172A; padding: 15px 20px; border-radius: 12px; text-align: center; box-shadow: 0 10px 30px rgba(212,175,55,0.3);">
                        <div style="font-family: 'Outfit', sans-serif; font-size: 2rem; font-weight: 800; line-height: 1;">26+</div>
                        <div style="font-size: 0.7rem; font-weight: 700; letter-spacing: 1px;">YEARS</div>
                    </div>
                </div>

                <!-- Text Side -->
                <div>
                    <span style="display: inline-block; background: rgba(212,175,55,0.15); color: var(--gc-gold); padding: 8px 20px; border-radius: 30px; font-size: 0.8rem; font-weight: 700; letter-spacing: 2px; margin-bottom: 20px; border: 1px solid rgba(212,175,55,0.3);">MEET THE FOUNDER</span>
                    <h2 style="font-family: 'Outfit', sans-serif; font-size: 2.5rem; font-weight: 800; color: white; margin: 0 0 20px; line-height: 1.2;">
                        The Man Behind<br>the <span style="color: var(--gc-gold);">Mission</span>
                    </h2>
                    <p style="color: #94A3B8; font-size: 1.05rem; line-height: 1.8; margin-bottom: 20px;">
                        Mr. Mohamed V. Konneh built GlobalConnect from the ground up. As a proud African American entrepreneur rooted in Philadelphia, he saw firsthand the need for reliable, affordable access to quality vehicles and machinery in West Africa.
                    </p>
                    <p style="color: #94A3B8; font-size: 1.05rem; line-height: 1.8; margin-bottom: 30px;">
                        Today, he still travels to China to visit factories, inspects every major shipment, and personally ensures that clients from Conakry to Freetown receive exactly what they ordered. His philosophy is simple: <em style="color: white;">"Every container carries our name."</em>
                    </p>

                    <!-- Contact/Social -->
                    <div style="display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
                        <a href="https://www.facebook.com/profile.php?id=100071518400878" target="_blank" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; background: #1877F2; color: white; border-radius: 10px; text-decoration: none; font-weight: 600; font-size: 0.9rem;">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                            Follow on Facebook
                        </a>
                        <a href="https://wa.me/<?php echo esc_attr($whatsapp); ?>?text=Hi Mr. Konneh, I'd like to discuss business" target="_blank" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; background: #25D366; color: white; border-radius: 10px; text-decoration: none; font-weight: 600; font-size: 0.9rem;">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z" />
                                <path d="M12 0C5.373 0 0 5.373 0 12c0 2.625.846 5.059 2.284 7.034L.789 23.492l4.587-1.473A11.937 11.937 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.82c-2.169 0-4.206-.58-5.963-1.585l-.428-.254-2.72.874.727-2.652-.279-.443A9.783 9.783 0 012.18 12c0-5.414 4.406-9.82 9.82-9.82 5.414 0 9.82 4.406 9.82 9.82 0 5.414-4.406 9.82-9.82 9.82z" />
                            </svg>
                            WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================
     6. OUR OPERATIONS (Trust Photos)
     ============================================ -->
    <section style="background: #0F172A; padding: 80px 0;">
        <div class="gc-container">
            <div style="text-align: center; margin-bottom: 50px;">
                <span style="color: var(--gc-gold); font-size: 0.8rem; font-weight: 700; letter-spacing: 2px;">FROM THE FIELD</span>
                <h2 style="font-family: 'Outfit', sans-serif; color: white; font-size: 2.5rem; font-weight: 800; margin: 12px 0 0;">Real Operations, Real Results</h2>
                <p style="color: #64748b; max-width: 550px; margin: 12px auto 0;">Every photo is from our actual operations across the USA, China, and West Africa.</p>
            </div>

            <div class="gc-ops-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; max-width: 950px; margin: 0 auto;">
                <!-- MVK inspecting engines -->
                <div style="border-radius: 14px; overflow: hidden; position: relative;">
                    <img src="<?php echo esc_url($fb_img_path); ?>/fb_import_20260131_204852_9.jpg"
                        alt="Founder MVK personally inspecting CAT engines at destination market"
                        loading="lazy"
                        style="width: 100%; height: 280px; object-fit: cover; object-position: center top;">
                    <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(15,23,42,0.9)); padding: 35px 18px 18px;">
                        <span style="background: var(--gc-gold); color: #0F172A; padding: 3px 10px; border-radius: 4px; font-size: 0.65rem; font-weight: 700;">WEST AFRICA</span>
                        <p style="color: white; font-weight: 600; font-size: 0.85rem; margin: 8px 0 0;">Quality inspection on-site</p>
                    </div>
                </div>

                <!-- Jeep at container -->
                <div style="border-radius: 14px; overflow: hidden; position: relative;">
                    <img src="<?php echo esc_url($fb_img_path); ?>/fb_import_20260131_204852_8.jpg"
                        alt="Jeep Wrangler at our Philadelphia container loading facility"
                        loading="lazy"
                        style="width: 100%; height: 280px; object-fit: cover;">
                    <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(15,23,42,0.9)); padding: 35px 18px 18px;">
                        <span style="background: #3B82F6; color: white; padding: 3px 10px; border-radius: 4px; font-size: 0.65rem; font-weight: 700;">PHILADELPHIA</span>
                        <p style="color: white; font-weight: 600; font-size: 0.85rem; margin: 8px 0 0;">Container loading operations</p>
                    </div>
                </div>

                <!-- SINOTRUK factory -->
                <div style="border-radius: 14px; overflow: hidden; position: relative;">
                    <img src="<?php echo esc_url($fb_img_path); ?>/fb_import_20260131_204852_2.jpg"
                        alt="Factory visit inspecting SINOTRUK heavy trucks in China"
                        loading="lazy"
                        style="width: 100%; height: 280px; object-fit: cover;">
                    <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(15,23,42,0.9)); padding: 35px 18px 18px;">
                        <span style="background: #DC2626; color: white; padding: 3px 10px; border-radius: 4px; font-size: 0.65rem; font-weight: 700;">CHINA</span>
                        <p style="color: white; font-weight: 600; font-size: 0.85rem; margin: 8px 0 0;">Direct factory sourcing</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================
     7. WHY CHOOSE US
     ============================================ -->
    <section style="background: #F8FAFC; padding: 80px 0;">
        <div class="gc-container">
            <div style="text-align: center; margin-bottom: 50px;">
                <span style="color: var(--gc-gold); font-size: 0.8rem; font-weight: 700; letter-spacing: 2px;">WHY GLOBALCONNECT</span>
                <h2 style="font-family: 'Outfit', sans-serif; color: #0F172A; font-size: 2.5rem; font-weight: 800; margin: 12px 0 0;">What Sets Us Apart</h2>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; max-width: 1000px; margin: 0 auto;">
                <div style="display: flex; gap: 20px; align-items: flex-start;">
                    <div style="width: 50px; height: 50px; min-width: 50px; background: rgba(212,175,55,0.12); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <span class="dashicons dashicons-visibility" style="color: var(--gc-gold); font-size: 24px; width: 24px; height: 24px;"></span>
                    </div>
                    <div>
                        <h3 style="color: #0F172A; font-size: 1.15rem; margin: 0 0 8px; font-family: 'Outfit', sans-serif;">Founder-Led Inspections</h3>
                        <p style="color: #64748b; line-height: 1.7; margin: 0;">MVK personally inspects major inventory. No middlemen &mdash; what you see is what you get.</p>
                    </div>
                </div>
                <div style="display: flex; gap: 20px; align-items: flex-start;">
                    <div style="width: 50px; height: 50px; min-width: 50px; background: rgba(59,130,246,0.12); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <span class="dashicons dashicons-location" style="color: #3B82F6; font-size: 24px; width: 24px; height: 24px;"></span>
                    </div>
                    <div>
                        <h3 style="color: #0F172A; font-size: 1.15rem; margin: 0 0 8px; font-family: 'Outfit', sans-serif;">On the Ground, Everywhere</h3>
                        <p style="color: #64748b; line-height: 1.7; margin: 0;">With presence in Philadelphia, Chinese factories, and West African markets, we manage the full chain.</p>
                    </div>
                </div>
                <div style="display: flex; gap: 20px; align-items: flex-start;">
                    <div style="width: 50px; height: 50px; min-width: 50px; background: rgba(5,150,105,0.12); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <span class="dashicons dashicons-shield-alt" style="color: #059669; font-size: 24px; width: 24px; height: 24px;"></span>
                    </div>
                    <div>
                        <h3 style="color: #0F172A; font-size: 1.15rem; margin: 0 0 8px; font-family: 'Outfit', sans-serif;">26 Years of Trust</h3>
                        <p style="color: #64748b; line-height: 1.7; margin: 0;">Since 1998, hundreds of businesses and families have relied on us. Our reputation is our greatest asset.</p>
                    </div>
                </div>
                <div style="display: flex; gap: 20px; align-items: flex-start;">
                    <div style="width: 50px; height: 50px; min-width: 50px; background: rgba(220,38,38,0.12); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <span class="dashicons dashicons-whatsapp" style="color: #25D366; font-size: 24px; width: 24px; height: 24px;"></span>
                    </div>
                    <div>
                        <h3 style="color: #0F172A; font-size: 1.15rem; margin: 0 0 8px; font-family: 'Outfit', sans-serif;">24/7 WhatsApp Support</h3>
                        <p style="color: #64748b; line-height: 1.7; margin: 0;">Questions at midnight? Need tracking updates? We're always just a message away on WhatsApp.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================
     8. WHERE WE OPERATE
     ============================================ -->
    <section style="background: #0F172A; padding: 80px 0; border-top: 1px solid rgba(255,255,255,0.05);">
        <div class="gc-container">
            <div style="text-align: center; margin-bottom: 50px;">
                <span style="color: var(--gc-gold); font-size: 0.8rem; font-weight: 700; letter-spacing: 2px;">GLOBAL REACH</span>
                <h2 style="font-family: 'Outfit', sans-serif; color: white; font-size: 2.5rem; font-weight: 800; margin: 12px 0 0;">Where We Operate</h2>
            </div>

            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 25px; max-width: 900px; margin: 0 auto;" class="gc-reach-grid">
                <!-- USA -->
                <div style="background: rgba(30,41,59,0.5); border: 1px solid rgba(255,255,255,0.06); border-radius: 16px; padding: 35px; text-align: center;">
                    <img src="https://flagcdn.com/w80/us.png" alt="USA" style="width: 50px; border-radius: 4px; margin-bottom: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.2);">
                    <h3 style="color: white; font-family: 'Outfit', sans-serif; margin-bottom: 8px;">United States</h3>
                    <p style="color: #94A3B8; font-size: 0.9rem; line-height: 1.6; margin: 0;">Headquarters in Philadelphia, PA. Sourcing from auctions, dealers &amp; private sellers nationwide.</p>
                    <div style="margin-top: 15px; padding-top: 15px; border-top: 1px solid rgba(255,255,255,0.06);">
                        <span style="color: #64748b; font-size: 0.8rem;">Philadelphia, PA 19143</span>
                    </div>
                </div>

                <!-- China -->
                <div style="background: rgba(30,41,59,0.5); border: 1px solid rgba(255,255,255,0.06); border-radius: 16px; padding: 35px; text-align: center;">
                    <img src="https://flagcdn.com/w80/cn.png" alt="China" style="width: 50px; border-radius: 4px; margin-bottom: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.2);">
                    <h3 style="color: white; font-family: 'Outfit', sans-serif; margin-bottom: 8px;">China</h3>
                    <p style="color: #94A3B8; font-size: 0.9rem; line-height: 1.6; margin: 0;">Direct factory relationships with Sinotruk, SHACMAN, FAW, SANY, XCMG, and more.</p>
                    <div style="margin-top: 15px; padding-top: 15px; border-top: 1px solid rgba(255,255,255,0.06);">
                        <span style="color: #64748b; font-size: 0.8rem;">Factory Direct Sourcing</span>
                    </div>
                </div>

                <!-- West Africa -->
                <div style="background: rgba(30,41,59,0.5); border: 1px solid rgba(255,255,255,0.06); border-radius: 16px; padding: 35px; text-align: center;">
                    <img src="https://flagcdn.com/w80/gn.png" alt="Guinea" style="width: 50px; border-radius: 4px; margin-bottom: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.2);">
                    <h3 style="color: white; font-family: 'Outfit', sans-serif; margin-bottom: 8px;">West Africa</h3>
                    <p style="color: #94A3B8; font-size: 0.9rem; line-height: 1.6; margin: 0;">Delivering to Conakry, Freetown, Monrovia, Dakar &amp; ports across the region.</p>
                    <div style="margin-top: 15px; padding-top: 15px; border-top: 1px solid rgba(255,255,255,0.06);">
                        <span style="color: #64748b; font-size: 0.8rem;">Guinea &bull; Sierra Leone &bull; Liberia &bull; Senegal</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================
     9. CTA
     ============================================ -->
    <section style="background: linear-gradient(135deg, #1E293B 0%, #0F172A 100%); padding: 80px 0; text-align: center; position: relative;">
        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0;
         background-image: radial-gradient(circle at 50% 50%, rgba(212,175,55,0.06) 0%, transparent 60%);
         pointer-events: none;"></div>
        <div class="gc-container" style="position: relative; z-index: 2;">
            <h2 style="font-family: 'Outfit', sans-serif; color: white; font-size: 2.5rem; font-weight: 800; margin-bottom: 15px;">Ready to Work With Us?</h2>
            <p style="color: #94A3B8; max-width: 550px; margin: 0 auto 35px; font-size: 1.1rem; line-height: 1.7;">
                Whether you're buying a single vehicle or shipping a full container, we're here to make it happen.
            </p>
            <div style="display: flex; justify-content: center; gap: 15px; flex-wrap: wrap;">
                <a href="/shop" style="display: inline-flex; align-items: center; gap: 8px; padding: 16px 36px; background: linear-gradient(135deg, #D4AF37 0%, #B8941F 100%); color: #0F172A; border-radius: 50px; font-weight: 700; text-decoration: none; font-size: 1rem; box-shadow: 0 10px 30px rgba(212,175,55,0.3);">Browse Inventory</a>
                <a href="/contact" style="display: inline-flex; align-items: center; gap: 8px; padding: 16px 36px; border: 2px solid rgba(255,255,255,0.2); color: white; border-radius: 50px; font-weight: 600; text-decoration: none; font-size: 1rem;">Contact Us</a>
                <a href="https://wa.me/<?php echo esc_attr($whatsapp); ?>?text=Hi, I'd like a quote" style="display: inline-flex; align-items: center; gap: 8px; padding: 16px 36px; background: #25D366; color: white; border-radius: 50px; font-weight: 700; text-decoration: none; font-size: 1rem;">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z" />
                        <path d="M12 0C5.373 0 0 5.373 0 12c0 2.625.846 5.059 2.284 7.034L.789 23.492l4.587-1.473A11.937 11.937 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.82c-2.169 0-4.206-.58-5.963-1.585l-.428-.254-2.72.874.727-2.652-.279-.443A9.783 9.783 0 012.18 12c0-5.414 4.406-9.82 9.82-9.82 5.414 0 9.82 4.406 9.82 9.82 0 5.414-4.406 9.82-9.82 9.82z" />
                    </svg>
                    WhatsApp Us
                </a>
            </div>
        </div>
    </section>

</div>

<!-- Responsive Styles -->
<style>
    @media (max-width: 768px) {
        .gc-about-story-grid {
            grid-template-columns: 1fr !important;
            gap: 40px !important;
        }

        .gc-founder-about-grid {
            grid-template-columns: 1fr !important;
            gap: 40px !important;
        }

        .gc-ops-grid {
            grid-template-columns: 1fr !important;
        }

        .gc-reach-grid {
            grid-template-columns: 1fr !important;
        }

        #gc-about-page section:first-child h1 {
            font-size: 2.5rem !important;
        }
    }
</style>

<?php get_footer(); ?>