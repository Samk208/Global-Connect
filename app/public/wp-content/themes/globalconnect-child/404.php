<?php get_header(); ?>

<div class="gc-404-container">
    <div class="gc-container">
        <div class="gc-404-content">
            <h1 class="gc-404-title" aria-label="Error 404 - Page not found">404</h1>
            <h2 class="gc-404-subtitle">Lost in Transit?</h2>
            <p class="gc-404-text">The page you are looking for seems to have been moved, deleted, or never existed.</p>

            <div class="gc-404-actions">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="gc-btn gc-btn-primary">
                    <span class="dashicons dashicons-house" aria-hidden="true"></span> Back Home
                </a>
                <a href="<?php echo esc_url(home_url('/shop')); ?>" class="gc-btn gc-btn-gold">
                    <span class="dashicons dashicons-cart" aria-hidden="true"></span> Browse Inventory
                </a>
                <a href="https://wa.me/<?php echo esc_attr(get_option('gc_whatsapp_number', '12672900254')); ?>" class="gc-btn gc-btn-whatsapp" target="_blank" rel="noopener">
                    <span class="dashicons dashicons-whatsapp" aria-hidden="true"></span> Contact Us
                </a>
            </div>

            <div class="gc-404-search">
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>
</div>

<style>
    .gc-404-container {
        min-height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: radial-gradient(circle at center, #1e293b 0%, #0f172a 100%);
        text-align: center;
        padding: 60px 20px;
    }

    .gc-404-title {
        font-size: 150px;
        font-weight: 800;
        color: transparent;
        -webkit-text-stroke: 4px rgba(255, 255, 255, 0.1);
        margin: 0;
        line-height: 1;
        position: relative;
        display: inline-block;
    }

    .gc-404-title::before {
        content: '404';
        position: absolute;
        top: 0;
        left: 0;
        color: var(--gc-gold);
        overflow: hidden;
        height: 50%;
        border-bottom: 2px solid rgba(0, 0, 0, 0.5);
    }

    .gc-404-subtitle {
        font-size: 32px;
        color: #fff;
        margin: 20px 0;
    }

    .gc-404-text {
        color: #94a3b8;
        max-width: 500px;
        margin: 0 auto 40px;
    }

    .gc-404-actions {
        display: flex;
        gap: 20px;
        justify-content: center;
        margin-bottom: 40px;
    }
</style>

<?php get_footer(); ?>