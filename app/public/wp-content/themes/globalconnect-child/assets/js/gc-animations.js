/**
 * GlobalConnect Advanced Animations (Glidtech-inspired)
 * Handles scroll reveal, parallax, and micro-interactions.
 */

document.addEventListener('DOMContentLoaded', () => {

    // 1. Scroll Reveal Observer
    const ObserverOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.15 // Trigger when 15% visible
    };

    const revealObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('gc-revealed');
                observer.unobserve(entry.target); // Only animate once
            }
        });
    }, ObserverOptions);

    // Target elements
    const revealElements = document.querySelectorAll('.gc-reveal-up, .gc-reveal-left, .gc-reveal-right, .gc-stagger-child > *');
    revealElements.forEach(el => revealObserver.observe(el));


    // 2. Parallax Effect for Backgrounds & Floating Elements
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;

        // Floating elements in Hero
        document.querySelectorAll('.gc-floating-element').forEach((el, index) => {
            const speed = (index + 1) * 0.1;
            el.style.transform = `translateY(${scrolled * speed}px)`;
        });

        // Parallax for China Section Background (if applicable)
        const chinaSection = document.querySelector('.gc-china-highlight');
        if (chinaSection) {
            const offset = chinaSection.offsetTop - scrolled;
            chinaSection.style.backgroundPositionY = `${offset * 0.5}px`;
        }
    });


    // 3. Magnetic Button Effect (Micro-interaction)
    // Applies a subtle "magnetic" pull to primary buttons on hover
    const buttons = document.querySelectorAll('.gc-btn-magnetic');

    buttons.forEach(btn => {
        btn.addEventListener('mousemove', (e) => {
            const rect = btn.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;

            btn.style.transform = `translate(${x * 0.2}px, ${y * 0.2}px)`;
        });

        btn.addEventListener('mouseleave', () => {
            btn.style.transform = 'translate(0, 0)';
        });
    });

    // 4. Counter Up Animation for Stats
    // Only runs when stats become visible
    const statsObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counter = entry.target;
                const target = parseInt(counter.getAttribute('data-target'));
                const duration = 2000; // 2 seconds
                const start = 0;
                const startTime = performance.now();

                const updateCount = (currentTime) => {
                    const elapsed = currentTime - startTime;
                    const progress = Math.min(elapsed / duration, 1);

                    // EaseOutQuart function for smooth deceleration
                    const ease = 1 - Math.pow(1 - progress, 4);

                    const current = Math.floor(start + (target - start) * ease);
                    counter.innerText = current + (counter.getAttribute('data-suffix') || '');

                    if (progress < 1) {
                        requestAnimationFrame(updateCount);
                    } else {
                        counter.innerText = target + (counter.getAttribute('data-suffix') || '');
                    }
                };

                requestAnimationFrame(updateCount);
                observer.unobserve(counter);
            }
        });
    });

    document.querySelectorAll('.gc-counter').forEach(el => statsObserver.observe(el));

});
