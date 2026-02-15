/**
 * Homepage Category Cards - Link to Shop
 * Makes the "Browse by Product" cards clickable and links them to filtered shop pages
 */

jQuery(document).ready(function($) {
    
    // Category mapping: card text -> shop category parameter
    const categoryMap = {
        'Cars & SUVs': 'vehicles',
        'Heavy Machinery': 'machines-parts',
        'Tires': 'tires',
        'Auto Parts': 'machines-parts'
    };

    // Get the shop URL from localized script
    const shopBaseUrl = gc_shop_url.shop;

    // Method 1: Find and replace existing links in blurb modules
    $('.et_pb_blurb').each(function() {
        const $module = $(this);
        const $heading = $module.find('.et_pb_module_header');
        const headingText = $heading.text().trim();

        // Check if this is one of our category cards
        if (categoryMap[headingText]) {
            const category = categoryMap[headingText];
            const targetUrl = category === 'all' 
                ? shopBaseUrl 
                : shopBaseUrl + '?category=' + category;

            // Remove any existing links that might point to taxonomy archives
            $module.find('a[href*="part-category"]').each(function() {
                $(this).attr('href', targetUrl);
            });

            // If the entire module is wrapped in a link
            if ($module.is('a') || $module.parent('a').length) {
                const $link = $module.is('a') ? $module : $module.parent('a');
                $link.attr('href', targetUrl);
            }
            // If there's a link inside the module
            else if ($module.find('a').length) {
                $module.find('a').first().attr('href', targetUrl);
            }
            // If no link exists, make the whole card clickable
            else {
                $module.css({
                    'cursor': 'pointer',
                    'transition': 'transform 0.3s ease, box-shadow 0.3s ease'
                });

                $module.on('click', function(e) {
                    e.preventDefault();
                    window.location.href = targetUrl;
                });
            }

            // Add hover effect regardless of method
            $module.hover(
                function() {
                    $(this).css({
                        'transform': 'translateY(-8px)',
                        'box-shadow': '0 12px 30px rgba(0,0,0,0.15)'
                    });
                },
                function() {
                    $(this).css({
                        'transform': 'translateY(0)',
                        'box-shadow': ''
                    });
                }
            );
        }
    });

    // Method 2: Override any links that go to part-category pages
    $('a[href*="part-category/cars"], a[href*="part-category/machinery"], a[href*="part-category/tires"], a[href*="part-category/parts"]').each(function() {
        const $link = $(this);
        const href = $link.attr('href');
        
        // Determine which category based on the URL
        let newCategory = '';
        if (href.includes('cars')) {
            newCategory = 'vehicles';
        } else if (href.includes('machinery')) {
            newCategory = 'machines-parts';
        } else if (href.includes('tires')) {
            newCategory = 'tires';
        } else if (href.includes('parts')) {
            newCategory = 'machines-parts';
        }

        if (newCategory) {
            const newUrl = shopBaseUrl + '?category=' + newCategory;
            $link.attr('href', newUrl);
            
            // Prevent default click behavior and force new URL
            $link.on('click', function(e) {
                e.preventDefault();
                window.location.href = newUrl;
            });
        }
    });
});
