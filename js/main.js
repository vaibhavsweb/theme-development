/**
 * Luminous Blog - Main JavaScript
 * 
 * @package Luminous_Blog
 */

(function() {
	'use strict';

	/**
	 * Mobile Menu Toggle
	 */
	const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
	const mainNav = document.getElementById('primary-menu');

	if (mobileMenuToggle && mainNav) {
		mobileMenuToggle.addEventListener('click', function() {
			mainNav.classList.toggle('active');
			const isActive = mainNav.classList.contains('active');
			this.setAttribute('aria-expanded', isActive);
		});

		// Close menu when a link is clicked
		const menuLinks = mainNav.querySelectorAll('a');
		menuLinks.forEach(link => {
			link.addEventListener('click', function() {
				mainNav.classList.remove('active');
				mobileMenuToggle.setAttribute('aria-expanded', 'false');
			});
		});
	}

	/**
	 * Smooth scroll for anchor links
	 */
	document.querySelectorAll('a[href^="#"]').forEach(anchor => {
		anchor.addEventListener('click', function(e) {
			const href = this.getAttribute('href');
			if (href !== '#' && document.querySelector(href)) {
				e.preventDefault();
				const target = document.querySelector(href);
				target.scrollIntoView({
					behavior: 'smooth',
					block: 'start'
				});
			}
		});
	});

	/**
	 * Image lazy loading
	 */
	if ('IntersectionObserver' in window) {
		const images = document.querySelectorAll('img[loading="lazy"]');
		const imageObserver = new IntersectionObserver((entries, observer) => {
			entries.forEach(entry => {
				if (entry.isIntersecting) {
					const img = entry.target;
					img.src = img.dataset.src;
					img.removeAttribute('loading');
					observer.unobserve(img);
				}
			});
		});

		images.forEach(img => imageObserver.observe(img));
	}

	/**
	 * Post card hover effect
	 */
	const postCards = document.querySelectorAll('.post-card');
	postCards.forEach(card => {
		card.addEventListener('mouseenter', function() {
			this.style.cursor = 'pointer';
		});
	});

	/**
	 * Dark mode toggle (if enabled)
	 */
	const prefersColorScheme = window.matchMedia('(prefers-color-scheme: dark)');
	const root = document.documentElement;

	// Check for saved preference or system preference
	const darkMode = localStorage.getItem('darkMode') ?? 
		(prefersColorScheme.matches ? 'on' : 'off');

	if (darkMode === 'on') {
		root.style.colorScheme = 'dark';
	} else {
		root.style.colorScheme = 'light';
	}

	// Listen for system theme changes
	prefersColorScheme.addEventListener('change', e => {
		const newColorScheme = e.matches ? 'dark' : 'light';
		root.style.colorScheme = newColorScheme;
		localStorage.setItem('darkMode', e.matches ? 'on' : 'off');
	});

	/**
	 * Add stagger animation to post list
	 */
	const postList = document.querySelector('.post-list');
	if (postList) {
		const posts = postList.querySelectorAll('article');
		posts.forEach((post, index) => {
			post.style.animationDelay = (index * 50) + 'ms';
			post.classList.add('slide-up');
		});
	}

	/**
	 * Form validation
	 */
	const forms = document.querySelectorAll('form');
	forms.forEach(form => {
		form.addEventListener('submit', function(e) {
			const inputs = this.querySelectorAll('input[required], textarea[required], select[required]');
			let isValid = true;

			inputs.forEach(input => {
				if (!input.value.trim()) {
					isValid = false;
					input.style.borderColor = 'var(--color-accent)';
				} else {
					input.style.borderColor = '';
				}
			});

			if (!isValid) {
				e.preventDefault();
				console.warn('Please fill in all required fields');
			}
		});
	});

	/**
	 * Add active class to current navigation item
	 */
	const currentUrl = window.location.href;
	const navLinks = document.querySelectorAll('.main-navigation a');
	
	navLinks.forEach(link => {
		if (link.href === currentUrl) {
			link.parentElement.classList.add('current-menu-item');
		}
	});

	/**
	 * Keyboard shortcuts
	 */
	document.addEventListener('keydown', function(e) {
		// Ctrl/Cmd + K for search focus
		if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
			e.preventDefault();
			const searchInput = document.querySelector('.search-bar input');
			if (searchInput) {
				searchInput.focus();
			}
		}

		// Escape to close mobile menu
		if (e.key === 'Escape') {
			if (mainNav && mainNav.classList.contains('active')) {
				mainNav.classList.remove('active');
				mobileMenuToggle.setAttribute('aria-expanded', 'false');
			}
		}
	});

	/**
	 * Print post functionality
	 */
	const printButton = document.querySelector('.print-post');
	if (printButton) {
		printButton.addEventListener('click', function(e) {
			e.preventDefault();
			window.print();
		});
	}

	/**
	 * Share functionality
	 */
	const shareButtons = document.querySelectorAll('[data-share]');
	shareButtons.forEach(button => {
		button.addEventListener('click', function(e) {
			e.preventDefault();
			
			const shareData = {
				title: document.title,
				text: this.dataset.shareText || document.title,
				url: window.location.href
			};

			if (navigator.share) {
				navigator.share(shareData).catch(err => console.log('Error sharing:', err));
			} else {
				// Fallback: copy link to clipboard
				const tempInput = document.createElement('input');
				tempInput.value = window.location.href;
				document.body.appendChild(tempInput);
				tempInput.select();
				document.execCommand('copy');
				document.body.removeChild(tempInput);
				alert('Link copied to clipboard!');
			}
		});
	});

	/**
	 * Table of contents generation for long posts
	 */
	const postBody = document.querySelector('.post-body');
	if (postBody) {
		const headings = postBody.querySelectorAll('h2, h3');
		
		if (headings.length > 3) {
			const toc = document.createElement('div');
			toc.className = 'table-of-contents';
			toc.style.cssText = 'background: var(--color-bg-light); padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem; border-left: 4px solid var(--color-accent);';
			
			const tocList = document.createElement('ul');
			tocList.style.listStyle = 'none';
			tocList.style.padding = '0';
			
			headings.forEach((heading, index) => {
				const id = heading.id || `heading-${index}`;
				heading.id = id;
				
				const li = document.createElement('li');
				li.style.marginBottom = '0.5rem';
				li.style.paddingLeft = heading.tagName === 'H3' ? '1rem' : '0';
				
				const link = document.createElement('a');
				link.href = `#${id}`;
				link.textContent = heading.textContent;
				link.style.color = 'var(--color-accent)';
				link.style.textDecoration = 'none';
				
				link.addEventListener('hover', function() {
					this.style.textDecoration = 'underline';
				});
				
				li.appendChild(link);
				tocList.appendChild(li);
			});
			
			const tocTitle = document.createElement('h3');
			tocTitle.textContent = 'Table of Contents';
			tocTitle.style.marginTop = '0';
			tocTitle.style.marginBottom = '1rem';
			
			toc.appendChild(tocTitle);
			toc.appendChild(tocList);
			
			if (postBody.firstChild) {
				postBody.insertBefore(toc, postBody.firstChild);
			}
		}
	}

	/**
	 * Accessibility: Focus management
	 */
	document.addEventListener('keydown', function(e) {
		if (e.key === 'Tab') {
			document.body.classList.add('keyboard-navigation');
		}
	});

	document.addEventListener('click', function() {
		document.body.classList.remove('keyboard-navigation');
	});

	/**
	 * Scroll to top button
	 */
	const scrollToTopBtn = document.createElement('button');
	scrollToTopBtn.innerHTML = '<i class="fas fa-arrow-up"></i>';
	scrollToTopBtn.style.cssText = `
		position: fixed;
		bottom: 2rem;
		right: 2rem;
		width: 50px;
		height: 50px;
		border-radius: 50%;
		background-color: var(--color-accent);
		color: white;
		border: none;
		cursor: pointer;
		display: none;
		align-items: center;
		justify-content: center;
		z-index: 100;
		transition: all 0.3s ease;
		box-shadow: var(--shadow-lg);
	`;
	document.body.appendChild(scrollToTopBtn);

	window.addEventListener('scroll', function() {
		if (window.scrollY > 300) {
			scrollToTopBtn.style.display = 'flex';
		} else {
			scrollToTopBtn.style.display = 'none';
		}
	});

	scrollToTopBtn.addEventListener('click', function() {
		window.scrollTo({
			top: 0,
			behavior: 'smooth'
		});
	});

	scrollToTopBtn.addEventListener('mouseenter', function() {
		this.style.backgroundColor = 'var(--color-accent-dark)';
		this.style.transform = 'scale(1.1)';
	});

	scrollToTopBtn.addEventListener('mouseleave', function() {
		this.style.backgroundColor = 'var(--color-accent)';
		this.style.transform = 'scale(1)';
	});

})();
