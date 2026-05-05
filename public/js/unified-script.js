/**
 * Academic Creativity Week - Unified JavaScript
 * Clean & Modern Implementation
 */

jQuery(document).ready(function($) {
    
    console.log('Unified Script Loaded');

    // ===================================
    // Sidebar Menu Toggle
    // ===================================
    $(document).on('click', '.sidebar-sub-toggle', function(e) {
        e.preventDefault();
        console.log('Sidebar toggle clicked');
        
        var $this = $(this);
        var $parent = $this.parent('li');
        var $submenu = $this.next('ul');
        var $icon = $this.find('.sidebar-collapse-icon');
        
        console.log('Submenu found:', $submenu.length);
        
        // Close other submenus
        $('.sidebar-sub-toggle').not($this).each(function() {
            $(this).parent('li').removeClass('active');
            $(this).next('ul').slideUp(200);
            $(this).find('.sidebar-collapse-icon').removeClass('rotate-180');
        });
        
        // Toggle current submenu
        if ($parent.hasClass('active')) {
            $parent.removeClass('active');
            $submenu.slideUp(200);
            $icon.removeClass('rotate-180');
        } else {
            $parent.addClass('active');
            $submenu.slideDown(200);
            $icon.addClass('rotate-180');
        }
    });

    // Keep submenu open if child link is active
    setTimeout(function() {
        $('.sidebar ul li ul li a').each(function() {
            var currentUrl = window.location.href.split('?')[0];
            var linkUrl = this.href.split('?')[0];
            
            if (linkUrl === currentUrl) {
                $(this).addClass('active');
                $(this).closest('ul').show();
                $(this).closest('ul').prev('.sidebar-sub-toggle').find('.sidebar-collapse-icon').addClass('rotate-180');
                $(this).closest('ul').parent('li').addClass('active');
            }
        });
    }, 100);

    // Highlight active page in sidebar
    $('.sidebar ul li > a').not('.sidebar-sub-toggle').each(function() {
        var currentUrl = window.location.href.split('?')[0];
        var linkUrl = this.href.split('?')[0];
        
        if (linkUrl === currentUrl) {
            $(this).parent('li').addClass('active');
        }
    });

    // ===================================
    // Mobile Sidebar Toggle
    // ===================================
    $('.hamburger').on('click', function() {
        $('.sidebar').toggleClass('active');
        $('body').toggleClass('sidebar-open');
    });

    // Close sidebar when clicking overlay
    $(document).on('click', function(e) {
        if ($(window).width() < 768) {
            if (!$(e.target).closest('.sidebar, .hamburger').length) {
                $('.sidebar').removeClass('active');
                $('body').removeClass('sidebar-open');
            }
        }
    });

    // ===================================
    // User Dropdown
    // ===================================
    $('.header-icon').on('click', function(e) {
        e.stopPropagation();
        $(this).find('.dropdown-profile').fadeToggle(200);
    });

    $(document).on('click', function(e) {
        if (!$(e.target).closest('.header-icon').length) {
            $('.dropdown-profile').fadeOut(200);
        }
    });

    // ===================================
    // Card Animations
    // ===================================
    $('.card').each(function(index) {
        $(this).css({
            'animation-delay': (index * 0.1) + 's'
        }).addClass('animate-fadeInUp');
    });

    // ===================================
    // Form Submit Enhancement
    // ===================================
    $('form').on('submit', function() {
        var $btn = $(this).find('button[type="submit"]');
        if (!$btn.prop('disabled')) {
            $btn.prop('disabled', true);
            var originalText = $btn.html();
            $btn.html('<i class="ti-reload fa-spin"></i> Processing...');
            
            // Re-enable after 3 seconds as fallback
            setTimeout(function() {
                $btn.prop('disabled', false).html(originalText);
            }, 3000);
        }
    });

    // ===================================
    // Auto-hide Alerts
    // ===================================
    setTimeout(function() {
        $('.alert-success, .alert-info').fadeOut('slow');
    }, 5000);

    // ===================================
    // Tooltips (if Bootstrap is used)
    // ===================================
    if (typeof $().tooltip === 'function') {
        $('[data-toggle="tooltip"]').tooltip();
    }

    // ===================================
    // Table Row Hover
    // ===================================
    $('table tbody tr').hover(
        function() {
            $(this).css('background-color', '#f8fafc');
        },
        function() {
            $(this).css('background-color', '');
        }
    );

    // ===================================
    // Smooth Scroll for Anchors
    // ===================================
    $('a[href*="#"]').not('[href="#"]').on('click', function(e) {
        if (this.hash !== '') {
            var target = $(this.hash);
            if (target.length) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top - 70
                }, 600);
            }
        }
    });

    // ===================================
    // Print Function
    // ===================================
    $('.btn-print').on('click', function(e) {
        e.preventDefault();
        window.print();
    });

    // ===================================
    // Console Branding
    // ===================================
    console.log(
        '%c Academic Creativity Week ',
        'background: linear-gradient(135deg, #6366f1 0%, #0ea5e9 100%); color: white; font-size: 16px; font-weight: bold; padding: 10px 20px; border-radius: 5px;'
    );

});

// ===================================
// Loading State
// ===================================
window.addEventListener('load', function() {
    document.body.classList.add('loaded');
});
