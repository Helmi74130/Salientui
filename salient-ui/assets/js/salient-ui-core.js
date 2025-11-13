/**
 * SalientUI - Core JavaScript
 * Fonctions utilitaires communes et objet principal
 *
 * @package SalientUI
 * @since 1.0.0
 */

(function($) {
	'use strict';

	/**
	 * Objet principal SalientUI
	 * Contient les utilitaires communs et la gestion globale
	 */
	window.SalientUI = window.SalientUI || {
		/**
		 * Registre des composants
		 */
		components: {},

		/**
		 * Configuration globale
		 */
		config: {
			debug: false,
		},

		/**
		 * Initialiser SalientUI
		 */
		init() {
			this.log('✨ SalientUI Core initialized');

			// Initialiser tous les composants enregistrés
			Object.keys(this.components).forEach(componentName => {
				if (typeof this.components[componentName].init === 'function') {
					this.components[componentName].init();
					this.log(`Component initialized: ${componentName}`);
				}
			});

			// Observer pour le contenu dynamique
			this.setupDynamicContentObserver();
		},

		/**
		 * Enregistrer un nouveau composant
		 *
		 * @param {string} name - Nom du composant
		 * @param {Object} component - Objet du composant avec méthode init()
		 */
		registerComponent(name, component) {
			this.components[name] = component;
			this.log(`Component registered: ${name}`);

			// Si SalientUI est déjà initialisé, initialiser le composant immédiatement
			if (this.initialized && typeof component.init === 'function') {
				component.init();
			}
		},

		/**
		 * Observer pour détecter le contenu chargé dynamiquement
		 */
		setupDynamicContentObserver() {
			const observer = new MutationObserver((mutations) => {
				mutations.forEach((mutation) => {
					if (mutation.addedNodes.length) {
						mutation.addedNodes.forEach((node) => {
							if (node.nodeType === 1) {
								// Réinitialiser les composants pour le nouveau contenu
								Object.keys(this.components).forEach(componentName => {
									const component = this.components[componentName];
									if (typeof component.reinit === 'function') {
										component.reinit(node);
									}
								});
							}
						});
					}
				});
			});

			observer.observe(document.body, {
				childList: true,
				subtree: true,
			});
		},

		/**
		 * Log en mode debug
		 *
		 * @param {string} message - Message à logger
		 */
		log(message) {
			if (this.config.debug || (typeof salientUI !== 'undefined' && salientUI.debug)) {
				console.log(`[SalientUI] ${message}`);
			}
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
		SalientUI.initialized = true;
		SalientUI.init();
	});

})(jQuery);
