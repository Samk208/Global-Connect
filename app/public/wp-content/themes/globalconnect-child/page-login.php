<?php

/**
 * Template Name: Login Register Page
 * Description: Custom login and registration page with site branding.
 */

// Redirect if already logged in
if (is_user_logged_in()) {
    wp_redirect(home_url('/dashboard'));
    exit;
}

get_header();

// Get WhatsApp from settings
$whatsapp = get_option('gc_whatsapp_number', '12672900254');

// Determine active tab
$active_tab = isset($_GET['action']) && $_GET['action'] == 'register' ? 'register' : 'login';

// Handle login errors
$login_error = '';
if (isset($_GET['login']) && $_GET['login'] == 'failed') {
    $login_error = 'Invalid username or password. Please try again.';
}
if (isset($_GET['login']) && $_GET['login'] == 'empty') {
    $login_error = 'Please enter your username and password.';
}

// Handle registration
$register_error = '';
$register_success = '';
if (isset($_GET['register']) && $_GET['register'] == 'success') {
    $register_success = 'Registration successful! Please log in with your credentials.';
    $active_tab = 'login';
}
if (isset($_GET['register']) && $_GET['register'] == 'failed') {
    $register_error = 'Registration failed. Please try again or contact support.';
    $active_tab = 'register';
}
?>

<div class="gc-page-wrapper gc-auth-page">

    <!-- Hero Section -->
    <section class="gc-hero gc-hero-sm" style="background: linear-gradient(135deg, #0F172A 0%, #1E3A5F 100%); min-height: 100vh; display: flex; align-items: center; padding: 60px 0;">
        <div class="gc-container">
            <div style="max-width: 450px; margin: 0 auto;">

                <!-- Logo/Branding -->
                <div style="text-align: center; margin-bottom: 30px;">
                    <a href="<?php echo home_url(); ?>" style="text-decoration: none;">
                        <h2 style="font-family: 'Outfit', sans-serif; font-weight: 800; color: white; font-size: 1.8rem; margin: 0;">
                            GLOBAL<span style="color: var(--gc-gold);">CONNECT</span>
                        </h2>
                        <p style="color: #64748b; font-size: 0.85rem; margin-top: 5px;">Customer Portal</p>
                    </a>
                </div>

                <!-- Auth Card -->
                <div style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 20px 50px rgba(0,0,0,0.3);">

                    <!-- Tab Navigation -->
                    <div style="display: flex; border-bottom: 1px solid #E2E8F0;">
                        <a href="?action=login"
                            style="flex: 1; padding: 18px; text-align: center; font-weight: 600; text-decoration: none; 
                                  <?php echo ($active_tab == 'login') ? 'color: var(--gc-blue-primary); border-bottom: 3px solid var(--gc-blue-primary); margin-bottom: -1px;' : 'color: #64748b;'; ?>">
                            Sign In
                        </a>
                        <a href="?action=register"
                            style="flex: 1; padding: 18px; text-align: center; font-weight: 600; text-decoration: none;
                                  <?php echo ($active_tab == 'register') ? 'color: var(--gc-blue-primary); border-bottom: 3px solid var(--gc-blue-primary); margin-bottom: -1px;' : 'color: #64748b;'; ?>">
                            Create Account
                        </a>
                    </div>

                    <div style="padding: 30px;">

                        <?php if ($login_error): ?>
                            <div style="background: #FEE2E2; color: #DC2626; padding: 12px 15px; border-radius: 8px; margin-bottom: 20px; font-size: 0.9rem;">
                                <?php echo esc_html($login_error); ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($register_success): ?>
                            <div style="background: #D1FAE5; color: #059669; padding: 12px 15px; border-radius: 8px; margin-bottom: 20px; font-size: 0.9rem;">
                                <?php echo esc_html($register_success); ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($register_error): ?>
                            <div style="background: #FEE2E2; color: #DC2626; padding: 12px 15px; border-radius: 8px; margin-bottom: 20px; font-size: 0.9rem;">
                                <?php echo esc_html($register_error); ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($active_tab == 'login'): ?>
                            <!-- Login Form -->
                            <form method="post" action="<?php echo esc_url(site_url('wp-login.php', 'login_post')); ?>">
                                <div style="margin-bottom: 20px;">
                                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #334155; font-size: 0.9rem;">Username or Email</label>
                                    <input type="text" name="log" required
                                        style="width: 100%; padding: 14px 18px; border: 1px solid #E2E8F0; border-radius: 8px; font-size: 1rem; box-sizing: border-box;"
                                        placeholder="Enter your username or email">
                                </div>

                                <div style="margin-bottom: 20px;">
                                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #334155; font-size: 0.9rem;">Password</label>
                                    <input type="password" name="pwd" required
                                        style="width: 100%; padding: 14px 18px; border: 1px solid #E2E8F0; border-radius: 8px; font-size: 1rem; box-sizing: border-box;"
                                        placeholder="Enter your password">
                                </div>

                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
                                    <label style="display: flex; align-items: center; gap: 8px; color: #64748b; font-size: 0.9rem; cursor: pointer;">
                                        <input type="checkbox" name="rememberme" value="forever" style="width: 16px; height: 16px;">
                                        Remember me
                                    </label>
                                    <a href="<?php echo wp_lostpassword_url(); ?>" style="color: var(--gc-blue-primary); font-size: 0.9rem; text-decoration: none;">Forgot password?</a>
                                </div>

                                <input type="hidden" name="redirect_to" value="<?php echo esc_url(home_url('/dashboard')); ?>">

                                <button type="submit" name="wp-submit" class="gc-btn gc-btn-primary"
                                    style="width: 100%; padding: 16px; font-size: 1rem; font-weight: 700; border: none; cursor: pointer;">
                                    Sign In to Dashboard
                                </button>
                            </form>

                        <?php else: ?>
                            <!-- Registration Form -->
                            <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                                <input type="hidden" name="action" value="gc_custom_registration">
                                <?php wp_nonce_field('gc_registration_nonce', 'gc_reg_nonce'); ?>

                                <div style="margin-bottom: 20px;">
                                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #334155; font-size: 0.9rem;">Full Name</label>
                                    <input type="text" name="full_name" required
                                        style="width: 100%; padding: 14px 18px; border: 1px solid #E2E8F0; border-radius: 8px; font-size: 1rem; box-sizing: border-box;"
                                        placeholder="Your full name">
                                </div>

                                <div style="margin-bottom: 20px;">
                                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #334155; font-size: 0.9rem;">Email Address</label>
                                    <input type="email" name="email" required
                                        style="width: 100%; padding: 14px 18px; border: 1px solid #E2E8F0; border-radius: 8px; font-size: 1rem; box-sizing: border-box;"
                                        placeholder="your@email.com">
                                </div>

                                <div style="margin-bottom: 20px;">
                                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #334155; font-size: 0.9rem;">Username</label>
                                    <input type="text" name="username" required
                                        style="width: 100%; padding: 14px 18px; border: 1px solid #E2E8F0; border-radius: 8px; font-size: 1rem; box-sizing: border-box;"
                                        placeholder="Choose a username">
                                </div>

                                <div style="margin-bottom: 20px;">
                                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #334155; font-size: 0.9rem;">Password</label>
                                    <input type="password" name="password" required minlength="6"
                                        style="width: 100%; padding: 14px 18px; border: 1px solid #E2E8F0; border-radius: 8px; font-size: 1rem; box-sizing: border-box;"
                                        placeholder="Create a password (min 6 characters)">
                                </div>

                                <div style="margin-bottom: 25px;">
                                    <label style="display: flex; align-items: flex-start; gap: 10px; color: #64748b; font-size: 0.85rem; cursor: pointer;">
                                        <input type="checkbox" name="agree_terms" required style="width: 16px; height: 16px; margin-top: 2px;">
                                        <span>I agree to the Terms of Service and Privacy Policy</span>
                                    </label>
                                </div>

                                <button type="submit" class="gc-btn gc-btn-primary"
                                    style="width: 100%; padding: 16px; font-size: 1rem; font-weight: 700; border: none; cursor: pointer;">
                                    Create Account
                                </button>
                            </form>
                        <?php endif; ?>

                    </div>
                </div>

                <!-- Help Section -->
                <div style="text-align: center; margin-top: 30px;">
                    <p style="color: #64748b; font-size: 0.9rem; margin-bottom: 15px;">Need help accessing your account?</p>
                    <a href="https://wa.me/<?php echo esc_attr($whatsapp); ?>?text=Hi, I need help with my account"
                        style="display: inline-flex; align-items: center; gap: 8px; color: #25D366; text-decoration: none; font-weight: 600;">
                        <span class="dashicons dashicons-whatsapp"></span> Contact Support via WhatsApp
                    </a>
                </div>

                <!-- Back to Site -->
                <div style="text-align: center; margin-top: 20px;">
                    <a href="<?php echo home_url(); ?>" style="color: #64748b; text-decoration: none; font-size: 0.85rem;">
                        &larr; Back to GlobalConnect
                    </a>
                </div>

            </div>
        </div>
    </section>

</div>

<?php get_footer(); ?>