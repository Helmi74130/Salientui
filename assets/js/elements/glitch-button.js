/**
 * SalientUI - Glitch Button Component JavaScript
 * Gestion des interactions du bouton avec effet glitch
 *
 * @package SalientUI
 * @since 1.0.0
 */

(function($) {
	'use strict';

	/**
	 * Composant Glitch Button
	 */
	const GlitchButtonComponent = {
		/**
		 * Sélecteur
		 */
		selector: '.salient-ui-gb-button',

		/**
		 * Initialiser le composant
		 */
		init() {
			this.setupButtons();
		},

		/**
		 * Réinitialiser pour le contenu dynamique
		 *
		 * @param {HTMLElement} context - Contexte DOM
		 */
		reinit(context) {
			const buttons = context.querySelectorAll ?
				context.querySelectorAll(this.selector) :
				$(context).find(this.selector);

			if (buttons.length > 0) {
				this.setupButtons(context);
			}
		},

		/**
		 * Configurer les boutons
		 *
		 * @param {HTMLElement} context - Contexte DOM (optionnel)
		 */
		setupButtons(context) {
			const buttons = context ?
				$(context).find(this.selector) :
				$(this.selector);

			buttons.each((index, button) => {
				const $button = $(button);

				// Éviter la double initialisation
				if ($button.data('sui-gb-initialized')) {
					return;
				}

				// Accessibilité
				if ($button.is('button') && !$button.attr('role')) {
					$button.attr('role', 'button');
					$button.attr('tabindex', '0');
				}

				// Support clavier
				if ($button.is('button')) {
					$button.on('keydown', function(e) {
						if (e.key === 'Enter' || e.key === ' ') {
							e.preventDefault();
							$(this).trigger('click');
						}
					});
				}

				// Désactiver liens vides
				if ($button.is('a') && ($button.attr('href') === '#' || !$button.attr('href'))) {
					$button.on('click', function(e) {
						e.preventDefault();
					});
				}

				// Ajouter un compteur de hover pour l'analytics (optionnel)
				this.setupAnalytics($button);

				// Marquer comme initialisé
				$button.data('sui-gb-initialized', true);
			});

			if (window.SalientUI) {
				window.SalientUI.log(`Glitch Button: ${buttons.length} button(s) initialized`);
			}
		},

		/**
		 * Configurer l'analytics (optionnel)
		 *
		 * @param {jQuery} $button - Élément jQuery du bouton
		 */
		setupAnalytics($button) {
			// Décommenter pour activer le tracking
			/*
			let hoverCount = 0;
			
			$button.on('mouseenter', function() {
				hoverCount++;
				$(this).data('hover-count', hoverCount);
				
				// Optionnel: envoyer à Google Analytics ou autre
				if (typeof gtag !== 'undefined') {
					gtag('event', 'hover', {
						'event_category': 'Button',
						'event_label': 'Glitch Button',
						'value': hoverCount
					});
				}
			});
			*/
		},
	};

	/**
	 * Enregistrer le composant dans SalientUI
	 */
	if (window.SalientUI) {
		window.SalientUI.registerComponent('GlitchButton', GlitchButtonComponent);
	} else {
		$(document).ready(() => {
			GlitchButtonComponent.init();
		});
	}

})(jQuery);