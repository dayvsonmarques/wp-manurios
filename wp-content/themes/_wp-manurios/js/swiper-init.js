document.addEventListener('DOMContentLoaded', function() {
    const swiperContainer = document.querySelector('.midia-swiper');
    if (swiperContainer) {
        // Initialize Swiper
        const swiper = new Swiper('.midia-swiper', {
            // Optional parameters
            loop: true,
            speed: 600,
            spaceBetween: 30, // Margin between slides
            slidesPerView: 1, // Default mobile
            
            // Auto play settings
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true
            },

            // Pagination
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                dynamicBullets: true,
            },

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

            // Accessibility
            a11y: {
                prevSlideMessage: 'Slide anterior',
                nextSlideMessage: 'Próximo slide',
            },

            // Breakpoints for responsive design
            breakpoints: {
                // when window width is >= 640px (Tablet)
                640: {
                    slidesPerView: 2,
                    spaceBetween: 30
                },
                // when window width is >= 1024px (Desktop)
                1024: {
                    slidesPerView: 3.5, // See half of the next slide to encourage scrolling
                    spaceBetween: 30,
                    centeredSlides: false, // Start from left for horizontal scroll feel
                },
                // Large screens
                1280: {
                    slidesPerView: 4,
                    spaceBetween: 30,
                }
            }
        });
    }
});