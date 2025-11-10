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

// Header scroll effect for home page
document.addEventListener('DOMContentLoaded', function() {
	const header = document.getElementById('masthead');
	const isHome = document.body.classList.contains('home');

	if (header) {
		window.addEventListener('scroll', function() {
			const heroSection = document.querySelector('.site-main > section:first-child');
			const heroHeight = heroSection ? heroSection.offsetHeight : 0;

			// On home page: make header fixed when scrolling past hero
			if (isHome) {
				if (window.pageYOffset >= heroHeight - 100) {
					if (!header.classList.contains('fixed-header')) {
						header.classList.add('fixed-header');
						header.classList.remove('absolute');
						header.style.position = 'fixed';
						document.body.classList.add('fixed-header-active');
					}
				} else {
					if (header.classList.contains('fixed-header')) {
						header.classList.remove('fixed-header');
						header.classList.add('absolute');
						header.style.position = 'absolute';
						document.body.classList.remove('fixed-header-active');
					}
				}
			}

			// Add scrolled class for styling
			if (window.pageYOffset > 50) {
				header.classList.add('scrolled');
			} else {
				header.classList.remove('scrolled');
			}
		});
	}

	// Newsletter Form Handler
	const newsletterForm = document.getElementById('newsletter-form');

	if (newsletterForm && typeof newsletterData !== 'undefined') {
		newsletterForm.addEventListener('submit', function(e) {
			e.preventDefault();

			const formData = new FormData(this);
			const emailInput = this.querySelector('input[type="email"]');

			// Use Alpine.js data if available
			const alpineData = Alpine.$data(this);
			if (alpineData) {
				alpineData.submitting = true;
				alpineData.message = '';
			}

			fetch(newsletterData.ajax_url, {
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded',
				},
				body: new URLSearchParams({
					action: 'newsletter_subscribe',
					email: formData.get('email'),
					nonce: newsletterData.nonce,
				}),
			})
			.then(response => response.json())
			.then(data => {
				if (alpineData) {
					alpineData.submitting = false;
					alpineData.success = data.success;
					alpineData.message = data.data.message;

					if (data.success) {
						emailInput.value = '';
					}
				}
			})
			.catch(error => {
				if (alpineData) {
					alpineData.submitting = false;
					alpineData.success = false;
					alpineData.message = 'Erro ao processar sua solicitação. Tente novamente.';
				}
			});
		});
	}
});
