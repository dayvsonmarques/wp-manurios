// Header scroll effect for home page
document.addEventListener('DOMContentLoaded', function() {
	const header = document.getElementById('masthead');

	if (!header) return;

	window.addEventListener('scroll', function() {
		if (window.pageYOffset > 50) {
			header.classList.add('scrolled');
		} else {
			header.classList.remove('scrolled');
		}
	});
});
