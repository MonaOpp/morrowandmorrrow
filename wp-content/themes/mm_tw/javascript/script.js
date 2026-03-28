/**
 * Front-end JavaScript
 *
 * The JavaScript code you place here will be processed by esbuild. The output
 * file will be created at `../theme/js/script.min.js` and enqueued in
 * `../theme/functions.php`.
 *
 * For esbuild documentation, please see:
 * https://esbuild.github.io/
 */

// Mobile Menu Toggle Functionality
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            const isExpanded = mobileMenuButton.getAttribute('aria-expanded') === 'true';
            
            // Toggle menu visibility
            mobileMenu.classList.toggle('hidden');
            
            // Update aria-expanded attribute
            mobileMenuButton.setAttribute('aria-expanded', !isExpanded);
            
            // Toggle button icon (optional - you can add hamburger to X animation here)
            const svg = mobileMenuButton.querySelector('svg');
            if (svg) {
                if (!isExpanded) {
                    // Change to X icon
                    svg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
                } else {
                    // Change back to hamburger icon
                    svg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>';
                }
            }
        });
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!mobileMenuButton.contains(e.target) && !mobileMenu.contains(e.target)) {
                if (!mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                    mobileMenuButton.setAttribute('aria-expanded', 'false');
                    
                    // Reset icon to hamburger
                    const svg = mobileMenuButton.querySelector('svg');
                    if (svg) {
                        svg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>';
                    }
                }
            }
        });
        
        // Close mobile menu on window resize (when switching to desktop)
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) { // lg breakpoint
                mobileMenu.classList.add('hidden');
                mobileMenuButton.setAttribute('aria-expanded', 'false');
                
                // Reset icon to hamburger
                const svg = mobileMenuButton.querySelector('svg');
                if (svg) {
                    svg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>';
                }
            }
        });
    }
});

// Home page mobile menu toggle
document.addEventListener('DOMContentLoaded', function() {
    var homeMenuButton = document.getElementById('home-mobile-menu-button');
    var homeMenu = document.getElementById('home-mobile-menu');

    if (homeMenuButton && homeMenu) {
        homeMenuButton.addEventListener('click', function() {
            var isExpanded = homeMenuButton.getAttribute('aria-expanded') === 'true';
            homeMenu.classList.toggle('hidden');
            homeMenuButton.setAttribute('aria-expanded', !isExpanded);

            var svg = homeMenuButton.querySelector('svg');
            if (svg) {
                if (!isExpanded) {
                    svg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
                } else {
                    svg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>';
                }
            }
        });
    }
});

// Location Accordion - always keep one card active
document.addEventListener('DOMContentLoaded', function () {
    const cards = document.querySelectorAll('.location-accordion .location-card');
    if (!cards.length) return;

    // Set the first card as active by default
    cards[0].classList.add('active');

    cards.forEach(function (card) {
        card.addEventListener('mouseenter', function () {
            cards.forEach(function (c) {
                c.classList.remove('active');
            });
            card.classList.add('active');
        });
    });
});

// Service Accordion
document.addEventListener('DOMContentLoaded', function () {
    const triggers = document.querySelectorAll('.service-accordion__trigger');
    if (!triggers.length) return;

    triggers.forEach(function (trigger) {
        trigger.addEventListener('click', function () {
            const panel = trigger.nextElementSibling;
            const isOpen = trigger.getAttribute('aria-expanded') === 'true';

            // Close all other panels in the same accordion
            const accordion = trigger.closest('.service-accordion');
            accordion.querySelectorAll('.service-accordion__trigger').forEach(function (otherTrigger) {
                if (otherTrigger !== trigger) {
                    otherTrigger.setAttribute('aria-expanded', 'false');
                    otherTrigger.nextElementSibling.classList.remove('is-open');
                }
            });

            // Toggle current
            trigger.setAttribute('aria-expanded', !isOpen);
            panel.classList.toggle('is-open', !isOpen);
        });
    });

    // Smooth scroll for service nav links
    document.querySelectorAll('.service-nav__link').forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(link.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
});

// Page transition: fly content out before navigating
document.addEventListener('DOMContentLoaded', function () {
    var isHomePage = document.querySelector('.home-landing') !== null;
    var homeLanding = document.querySelector('.home-landing');

    // If arriving at the home page, fly it down from top
    if (isHomePage && homeLanding) {
        homeLanding.classList.add('page-enter');
    }

    document.addEventListener('click', function (e) {
        var link = e.target.closest('a');
        if (!link) return;

        var href = link.getAttribute('href');
        if (!href) return;

        // Skip non-navigation links (anchors, external, new tab, special)
        if (
            link.target === '_blank' ||
            link.hasAttribute('download') ||
            e.ctrlKey || e.metaKey || e.shiftKey ||
            href.startsWith('#') ||
            href.startsWith('mailto:') ||
            href.startsWith('tel:') ||
            href.startsWith('javascript:')
        ) return;

        // Only handle same-origin links
        try {
            var url = new URL(href, window.location.origin);
            if (url.origin !== window.location.origin) return;
        } catch (_) {
            return;
        }

        e.preventDefault();

        // On the home page: fly up
        if (isHomePage && homeLanding) {
            homeLanding.classList.remove('page-enter');
            homeLanding.classList.add('page-exit');
            setTimeout(function () {
                window.location.href = href;
            }, 350);
        } else {
            // On inner pages: fly out left
            var page = document.getElementById('page');
            if (page) {
                page.classList.add('page-exit');
            }
            setTimeout(function () {
                window.location.href = href;
            }, 250);
        }
    });
});

// Scroll to Top Button
document.addEventListener('DOMContentLoaded', function () {
    var scrollBtn = document.getElementById('scroll-to-top');
    if (!scrollBtn) return;

    // On desktop, only allow on who-we-are and our-services pages
    var isDesktop = window.innerWidth >= 1024;
    var allowedPage = document.querySelector('.who-we-are-page') !== null ||
                      document.querySelector('.our-services-page') !== null;

    if (isDesktop && allowedPage) {
        scrollBtn.classList.add('desktop-allowed');
    }

    window.addEventListener('scroll', function () {
        if (window.scrollY > 300) {
            scrollBtn.classList.add('visible');
        } else {
            scrollBtn.classList.remove('visible');
        }
    });

    window.addEventListener('resize', function () {
        var nowDesktop = window.innerWidth >= 1024;
        var onAllowedPage = document.querySelector('.who-we-are-page') !== null ||
                            document.querySelector('.our-services-page') !== null;

        if (nowDesktop && onAllowedPage) {
            scrollBtn.classList.add('desktop-allowed');
        } else if (nowDesktop) {
            scrollBtn.classList.remove('desktop-allowed');
        }
    });

    scrollBtn.addEventListener('click', function () {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
});
