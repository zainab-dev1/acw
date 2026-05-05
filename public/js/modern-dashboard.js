/**
 * Modern Dashboard JavaScript
 * AVC Activities System
 */

(function($) {
    'use strict';

    // Sidebar Sub-menu Toggle
    $('.sidebar-sub-toggle').on('click', function(e) {
        e.preventDefault();
        
        var $this = $(this);
        var $submenu = $this.next('ul');
        var $icon = $this.find('.sidebar-collapse-icon');
        
        // Close other submenus
        $('.sidebar-sub-toggle').not($this).next('ul').slideUp(300);
        $('.sidebar-sub-toggle').not($this).find('.sidebar-collapse-icon').removeClass('rotate-180');
        
        // Toggle current submenu
        $submenu.slideToggle(300);
        $icon.toggleClass('rotate-180');
        
        // Add active class to parent
        $this.parent('li').toggleClass('active');
    });

    // Keep submenu open if child is active
    $('.sidebar ul li ul li a').each(function() {
        if (this.href === window.location.href) {
            $(this).closest('ul').show();
            $(this).closest('ul').prev('.sidebar-sub-toggle').find('.sidebar-collapse-icon').addClass('rotate-180');
            $(this).addClass('active');
        }
    });

    // Smooth Scroll
    $('a[href*="#"]').on('click', function(e) {
        if (this.hash !== '') {
            e.preventDefault();
            var hash = this.hash;
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 800);
        }
    });

    // Card Hover Effect Enhancement
    $('.card').hover(
        function() {
            $(this).addClass('shadow-lg');
        },
        function() {
            $(this).removeClass('shadow-lg');
        }
    );

    // Sidebar Active Link
    var url = window.location.href;
    $('.sidebar ul li a').each(function() {
        if (this.href === url) {
            $(this).closest('li').addClass('active');
            $(this).closest('li').parent().closest('li').addClass('active');
        }
    });

    // Stats Counter Animation
    function animateCounter() {
        $('.stat-digit').each(function() {
            var $this = $(this);
            var countTo = $this.attr('data-count');
            
            if (countTo) {
                $({ countNum: 0 }).animate(
                    { countNum: countTo },
                    {
                        duration: 2000,
                        easing: 'swing',
                        step: function() {
                            $this.text(Math.floor(this.countNum));
                        },
                        complete: function() {
                            $this.text(this.countNum);
                        }
                    }
                );
            }
        });
    }

    // Trigger animation on page load
    $(window).on('load', function() {
        animateCounter();
    });

    // Dropdown Enhancement
    $('.dropdown-toggle').on('click', function(e) {
        e.preventDefault();
        $(this).next('.dropdown-menu').fadeToggle(200);
    });

    // Close dropdown when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.dropdown').length) {
            $('.dropdown-menu').fadeOut(200);
        }
    });

    // Notification Badge Animation
    $('.notification-badge').each(function() {
        $(this).addClass('animate__animated animate__bounce');
    });

    // Welcome Message Animation
    $('.welcome-card').addClass('animate__animated animate__fadeInDown');

    // Form Validation Enhancement
    $('form').on('submit', function() {
        var $submitBtn = $(this).find('button[type="submit"]');
        $submitBtn.html('<i class="ti-reload"></i> Processing...').prop('disabled', true);
    });

    // Tooltip Initialization (if Bootstrap tooltips are used)
    $('[data-toggle="tooltip"]').tooltip();

    // Table Row Hover Effect
    $('table tbody tr').hover(
        function() {
            $(this).css('background-color', '#f8fafc');
        },
        function() {
            $(this).css('background-color', '');
        }
    );

    // Loading Overlay
    function showLoading() {
        $('body').append('<div class="loading-overlay"><div class="spinner"></div></div>');
    }

    function hideLoading() {
        $('.loading-overlay').fadeOut(300, function() {
            $(this).remove();
        });
    }

    // Ajax Error Handler
    $(document).ajaxError(function(event, jqxhr, settings, thrownError) {
        console.error('Ajax Error:', thrownError);
        hideLoading();
    });

    // Success Message Auto Hide
    setTimeout(function() {
        $('.alert-success, .alert-info').fadeOut('slow');
    }, 5000);

    // Mobile Sidebar Toggle
    $('.hamburger').on('click', function() {
        $('.sidebar').toggleClass('active');
        $('body').toggleClass('sidebar-open');
    });

    // Close sidebar when clicking outside on mobile
    $(document).on('click', function(e) {
        if ($(window).width() < 768) {
            if (!$(e.target).closest('.sidebar, .hamburger').length) {
                $('.sidebar').removeClass('active');
                $('body').removeClass('sidebar-open');
            }
        }
    });

    // Search Enhancement
    $('.search-input').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $('.searchable-item').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    // Print Function
    $('.print-btn').on('click', function(e) {
        e.preventDefault();
        window.print();
    });

    // Export to Excel (if needed)
    $('.export-excel-btn').on('click', function(e) {
        e.preventDefault();
        // Add your export logic here
        console.log('Exporting to Excel...');
    });

    // Dark Mode Toggle (Optional)
    $('.dark-mode-toggle').on('click', function(e) {
        e.preventDefault();
        $('body').toggleClass('dark-mode');
        localStorage.setItem('darkMode', $('body').hasClass('dark-mode'));
    });

    // Check saved dark mode preference
    if (localStorage.getItem('darkMode') === 'true') {
        $('body').addClass('dark-mode');
    }

    // Page Transition Effect
    $('.page-link').on('click', function(e) {
        if (!$(this).attr('target')) {
            e.preventDefault();
            var url = $(this).attr('href');
            $('body').fadeOut(300, function() {
                window.location = url;
            });
        }
    });

    // Console Info
    console.log('%c AVC Activities System ', 'background: #4f46e5; color: white; font-size: 16px; font-weight: bold; padding: 10px;');
    console.log('%c Developed by System Development Team - Educational Technology Center ', 'color: #64748b; font-size: 12px;');

})(jQuery);
