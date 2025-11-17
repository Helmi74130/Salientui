/**
 * SalientUI - Sparkle Glow Button Component JavaScript
 * Gestion des interactions du bouton avec effet sparkle
 *
 * @package SalientUI
 * @since 1.0.0
 */

(function($) {
	'use strict';

	/**
	 * Composant Sparkle Glow Button
	 */
	const SparkleGlowButtonComponent = {
		/**
		 * Sélecteur
		 */
		selector: '.salient-ui-sgb-button',

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
				if ($button.data('sui-sgb-initialized')) {
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

				// Marquer comme initialisé
				$button.data('sui-sgb-initialized', true);
			});

			if (window.SalientUI) {
				window.SalientUI.log(`Sparkle Glow Button: ${buttons.length} button(s) initialized`);
			}
		},
	};

	/**
	 * Enregistrer le composant dans SalientUI
	 */
	if (window.SalientUI) {
		window.SalientUI.registerComponent('SparkleGlowButton', SparkleGlowButtonComponent);
	} else {
		$(document).ready(() => {
			SparkleGlowButtonComponent.init();
		});
	}

})(jQuery);