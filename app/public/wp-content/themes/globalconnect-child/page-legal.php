<?php

/**
 * Template Name: Legal Page
 * Description: Full-width, branded template for Privacy Policy, Terms, and Shipping Policy pages.
 *
 * @package GlobalConnect
 */

get_header();
$whatsapp = get_option('gc_whatsapp_number', '12672900254');
?>

<div class="gc-legal-page">

    <!-- Hero Banner -->
    <section class="gc-legal-hero">
        <div class="gc-legal-hero-bg"></div>
        <div class="gc-container gc-legal-hero-inner">
            <nav class="gc-legal-breadcrumb" aria-label="Breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                <span class="gc-breadcrumb-sep" aria-hidden="true">/</span>
                <span aria-current="page"><?php the_title(); ?></span>
            </nav>
            <h1 class="gc-legal-title"><?php the_title(); ?></h1>
            <?php
            $last_modified = get_the_modified_date('F j, Y');
            if ($last_modified) :
            ?>
                <p class="gc-legal-updated">Last updated: <?php echo esc_html($last_modified); ?></p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Table of Contents + Content -->
    <section class="gc-legal-body">
        <div class="gc-container gc-legal-layout">

            <!-- Sidebar: Table of Contents -->
            <aside class="gc-legal-toc" aria-label="Table of Contents">
                <h2 class="gc-legal-toc-title">Contents</h2>
                <nav id="gc-legal-toc-nav">
                    <!-- Populated by JS from h3 headings -->
                </nav>
            </aside>

            <!-- Main Content -->
            <article class="gc-legal-content" id="gc-legal-content">
                <?php
                while (have_posts()) :
                    the_post();
                    the_content();
                endwhile;
                ?>
            </article>

        </div>
    </section>

    <!-- Contact CTA -->
    <section class="gc-legal-cta">
        <div class="gc-container gc-legal-cta-inner">
            <div class="gc-legal-cta-text">
                <h2>Have Questions About Our Policies?</h2>
                <p>Our team is happy to clarify any terms or answer your questions about privacy, shipping, or our services.</p>
            </div>
            <div class="gc-legal-cta-actions">
                <a href="<?php echo esc_url(home_url('/contact-quote/')); ?>" class="gc-btn gc-btn-primary">
                    <span class="dashicons dashicons-email" aria-hidden="true"></span> Contact Us
                </a>
                <a href="https://wa.me/<?php echo esc_attr($whatsapp); ?>" class="gc-btn gc-btn-whatsapp" target="_blank" rel="noopener">
                    <span class="dashicons dashicons-whatsapp" aria-hidden="true"></span> WhatsApp
                </a>
            </div>
        </div>
    </section>

</div>

<script>
(function() {
    // Auto-generate Table of Contents from h3 headings
    var content = document.getElementById('gc-legal-content');
    var tocNav = document.getElementById('gc-legal-toc-nav');
    if (!content || !tocNav) return;

    var headings = content.querySelectorAll('h3');
    if (headings.length === 0) return;

    var list = document.createElement('ul');
    list.className = 'gc-toc-list';

    headings.forEach(function(heading, index) {
        var id = 'section-' + (index + 1);
        heading.setAttribute('id', id);

        var li = document.createElement('li');
        var a = document.createElement('a');
        a.href = '#' + id;
        a.textContent = heading.textContent.replace(/^\d+\.\s*/, '');
        li.appendChild(a);
        list.appendChild(li);
    });

    tocNav.appendChild(list);

    // Smooth scroll + active state
    tocNav.addEventListener('click', function(e) {
        if (e.target.tagName === 'A') {
            e.preventDefault();
            var target = document.querySelector(e.target.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                history.pushState(null, '', e.target.getAttribute('href'));
            }
        }
    });

    // Highlight active TOC item on scroll
    var tocLinks = tocNav.querySelectorAll('a');
    var scrollTimer;
    window.addEventListener('scroll', function() {
        if (scrollTimer) return;
        scrollTimer = requestAnimationFrame(function() {
            scrollTimer = null;
            var fromTop = window.scrollY + 120;
            tocLinks.forEach(function(link) {
                var section = document.querySelector(link.getAttribute('href'));
                if (!section) return;
                if (section.offsetTop <= fromTop && section.offsetTop + section.offsetHeight > fromTop) {
                    link.classList.add('gc-toc-active');
                } else {
                    link.classList.remove('gc-toc-active');
                }
            });
        });
    });
})();
</script>

<?php get_footer(); ?>
