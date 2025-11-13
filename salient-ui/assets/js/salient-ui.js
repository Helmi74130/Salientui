/**
 * SalientUI - Scripts des composants modernes
 * Code ES6+ moderne
 *
 * @package SalientUI
 * @since 1.0.0
 */

(function($) {
	'use strict';

	/**
	 * Objet principal SalientUI
	 */
	const SalientUI = {
		/**
		 * Sélecteurs des éléments
		 */
		selectors: {
			button: '.salient-ui-button',
			card: '.salient-ui-card',
			cardClickable: '.salient-ui-card--clickable',
		},

		/**
		 * Initialisation
		 */
		init() {
			this.initButtons();
			this.initCards();
			this.bindEvents();

			// Log pour debug (seulement en mode développement)
			if (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') {
				console.log('✨ SalientUI initialized');
			}
		},

		/**
		 * Initialiser les boutons
		 */
		initButtons() {
			const buttons = document.querySelectorAll(this.selectors.button);

			buttons.forEach(button => {
				// Ajouter un attribut role pour l'accessibilité
				if (!button.hasAttribute('role')) {
					button.setAttribute('role', 'button');
				}

				// Gérer les boutons sans href (href="#")
				if (button.getAttribute('href') === '#') {
					button.addEventListener('click', (e) => {
						e.preventDefault();
					});
				}
			});
		},

		/**
		 * Initialiser les cards
		 */
		initCards() {
			const clickableCards = document.querySelectorAll(this.selectors.cardClickable);

			clickableCards.forEach(card => {
				// Rendre toute la card cliquable si elle contient un lien
				const link = card.querySelector('.salient-ui-card__link');

				if (link) {
					// Ajouter un curseur pointer
					card.style.cursor = 'pointer';

					// Rendre toute la card cliquable
					card.addEventListener('click', (e) => {
						// Ne pas déclencher si on clique directement sur le lien
						if (e.target.closest('.salient-ui-card__link')) {
							return;
						}

						// Simuler un clic sur le lien
						link.click();
					});

					// Ajouter un attribut role pour l'accessibilité
					card.setAttribute('role', 'article');
					card.setAttribute('tabindex', '0');

					// Support clavier (Enter et Space)
					card.addEventListener('keydown', (e) => {
						if (e.key === 'Enter' || e.key === ' ') {
							e.preventDefault();
							link.click();
						}
					});
				}
			});
		},

		/**
		 * Bind les événements globaux
		 */
		bindEvents() {
			// Support pour le chargement dynamique de contenu (ex: AJAX)
			document.addEventListener('DOMContentLoaded', () => {
				// Re-initialiser si du nouveau contenu est ajouté
				const observer = new MutationObserver((mutations) => {
					mutations.forEach((mutation) => {
						if (mutation.addedNodes.length) {
							mutation.addedNodes.forEach((node) => {
								if (node.nodeType === 1) { // Element node
									// Vérifier si le nouveau nœud contient nos composants
									if (node.matches(this.selectors.button) ||
									    node.querySelector(this.selectors.button)) {
										this.initButtons();
									}

									if (node.matches(this.selectors.card) ||
									    node.querySelector(this.selectors.card)) {
										this.initCards();
									}
								}
							});
						}
					});
				});

				// Observer le body pour les changements
				observer.observe(document.body, {
					childList: true,
					subtree: true,
				});
			});
		},

		/**
		 * Utilitaire : Debounce
		 * Limite le nombre d'exécutions d'une fonction
		 *
		 * @param {Function} func - Fonction à debouncer
		 * @param {number} wait - Délai en millisecondes
		 * @return {Function} Fonction debouncée
		 */
		debounce(func, wait = 300) {
			let timeout;

			return function executedFunction(...args) {
				const later = () => {
					clearTimeout(timeout);
					func(...args);
				};

				clearTimeout(timeout);
				timeout = setTimeout(later, wait);
			};
		},

		/**
		 * Utilitaire : Throttle
		 * Limite la fréquence d'exécution d'une fonction
		 *
		 * @param {Function} func - Fonction à throttler
		 * @param {number} limit - Limite en millisecondes
		 * @return {Function} Fonction throttlée
		 */
		throttle(func, limit = 300) {
			let inThrottle;

			return function executedFunction(...args) {
				if (!inThrottle) {
					func.apply(this, args);
					inThrottle = true;
					setTimeout(() => inThrottle = false, limit);
				}
			};
		},
	};

	/**
	 * Initialisation au chargement du DOM
	 */
	$(document).ready(() => {
		SalientUI.init();
	});

	/**
	 * Exposer l'objet SalientUI globalement pour permettre l'extension
	 */
	window.SalientUI = SalientUI;

})(jQuery);
