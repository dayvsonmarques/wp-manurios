/**
 * WP Manurios Theme JavaScript
 */

(function($) {
    'use strict';

    // Document ready
    $(document).ready(function() {
        
        // Initialize Bootstrap tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Initialize Bootstrap popovers
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl);
        });

        // Smooth scrolling for anchor links
        $('a[href*="#"]:not([href="#"])').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html, body').animate({
                        scrollTop: target.offset().top - 100
                    }, 1000);
                    return false;
                }
            }
        });

        // Add loading state to forms
        $('form').on('submit', function() {
            var $form = $(this);
            var $submitBtn = $form.find('input[type="submit"], button[type="submit"]');
            
            if ($submitBtn.length) {
                $submitBtn.prop('disabled', true);
                $submitBtn.data('original-text', $submitBtn.text());
                $submitBtn.text('Enviando...');
            }
        });

        // Back to top button
        var $backToTop = $('<button class="btn btn-primary position-fixed" style="bottom: 20px; right: 20px; z-index: 1000; display: none;" id="back-to-top" title="Voltar ao topo"><i class="bi bi-arrow-up"></i></button>');
        $('body').append($backToTop);

        $(window).scroll(function() {
            if ($(this).scrollTop() > 100) {
                $backToTop.fadeIn();
            } else {
                $backToTop.fadeOut();
            }
        });

        $backToTop.click(function() {
            $('html, body').animate({scrollTop: 0}, 800);
            return false;
        });

        // Search form enhancement
        $('.search-form').on('submit', function(e) {
            var $form = $(this);
            var $input = $form.find('input[type="search"]');
            
            if ($input.val().trim() === '') {
                e.preventDefault();
                $input.focus();
                return false;
            }
        });

        // Comment form enhancement
        $('#commentform').on('submit', function() {
            var $form = $(this);
            var $submitBtn = $form.find('#submit');
            
            if ($submitBtn.length) {
                $submitBtn.prop('disabled', true);
                $submitBtn.val('Enviando comentário...');
            }
        });

    });

    // Window load
    $(window).on('load', function() {
        // Hide loading spinner if exists
        $('.loading-spinner').fadeOut();
    });

})(jQuery);
