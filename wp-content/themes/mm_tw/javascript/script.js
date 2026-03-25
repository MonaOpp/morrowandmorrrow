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
