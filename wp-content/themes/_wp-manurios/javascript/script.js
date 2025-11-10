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

	if (header) {
		window.addEventListener('scroll', function() {
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
