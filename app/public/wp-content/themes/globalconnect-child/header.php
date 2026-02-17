<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <a class="gc-skip-link screen-reader-text" href="#et-main-area">Skip to content</a>
    <div id="page-container">

        <!-- Header -->
        <header class="gc-main-header" role="banner">
            <div class="gc-header-container gc-container">
                <!-- Logo -->
                <div class="gc-logo">
                    <a href="<?php echo esc_url(home_url('/')); ?>"
                        title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
                        <span class="gc-logo-icon dashicons dashicons-earth"></span>
                        <span class="gc-logo-text">Global<span class="gc-highlight">Connect</span></span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <nav class="gc-desktop-nav" aria-label="Main Navigation">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'main-menu',
                        'container' => false,
                        'menu_class' => 'gc-nav-menu',
                        'fallback_cb' => false,
                    ));
                    ?>
                </nav>

                <!-- Header Actions -->
                <div class="gc-header-actions">
                    <a href="<?php echo esc_url(home_url('/shop')); ?>" class="gc-btn-header-action search-trigger" aria-label="Search Inventory">
                        <span class="dashicons dashicons-search"></span>
                    </a>

                    <?php if (is_user_logged_in()): ?>
                        <a href="<?php echo esc_url(home_url('/dashboard')); ?>" class="gc-btn-header-action account">
                            <span class="dashicons dashicons-dashboard"></span> My Dashboard
                        </a>
                    <?php else: ?>
                        <a href="<?php echo esc_url(home_url('/login')); ?>" class="gc-btn-header-action account">
                            <span class="dashicons dashicons-admin-users"></span> Login
                        </a>
                    <?php endif; ?>

                    <a href="<?php echo esc_url(home_url('/contact')); ?>" class="gc-btn gc-btn-header-cta">
                        Get a Quote
                    </a>

                    <!-- Mobile Menu Trigger -->
                    <button class="gc-mobile-menu-toggle" aria-label="Toggle Navigation">
                        <span class="gc-bar"></span>
                        <span class="gc-bar"></span>
                        <span class="gc-bar"></span>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu Dropdown -->
            <div class="gc-mobile-menu-dropdown">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'mobile-menu',
                    'container' => false,
                    'menu_class' => 'gc-mobile-nav-list',
                    'fallback_cb' => false,
                ));
                ?>
                <div class="gc-mobile-actions">
                    <a href="<?php echo esc_url(home_url('/track')); ?>" class="gc-btn-mobile-action">
                        <span class="dashicons dashicons-location-alt"></span> Track Shipment
                    </a>
                </div>
            </div>
        </header>

        <!-- Main Content Area Wrapper -->
        <div id="et-main-area">