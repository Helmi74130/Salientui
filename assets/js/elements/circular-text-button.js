/**
 * SalientUI - Circular Text Button Component JavaScript
 * Gestion des interactions du bouton circulaire
 *
 * @package SalientUI
 * @since 1.0.0
 */

(function($) {
	'use strict';

	/**
	 * Composant Circular Text Button
	 */
	const CircularTextButtonComponent = {
		/**
		 * Sélecteur
		 */
		selector: '.salient-ui-ctb-button',

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
				if ($button.data('sui-ctb-initialized')) {
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

				// Aria-label pour le texte rotatif
				this.setupAriaLabel($button);

				// Marquer comme initialisé
				$button.data('sui-ctb-initialized', true);
			});

			if (window.SalientUI) {
				window.SalientUI.log(`Circular Text Button: ${buttons.length} button(s) initialized`);
			}
		},

		/**
		 * Configurer l'aria-label
		 *
		 * @param {jQuery} $button - Élément jQuery du bouton
		 */
		setupAriaLabel($button) {
			const $text = $button.find('.salient-ui-ctb-text');
			
			if ($text.length === 0) {
				return;
			}

			// Récupérer le texte complet
			let fullText = '';
			$text.find('span').each(function() {
				fullText += $(this).text();
			});

			// Définir l'aria-label
			if (fullText) {
				$button.attr('aria-label', fullText.trim());
			}
		},
	};

	/**
	 * Enregistrer le composant dans SalientUI
	 */
	if (window.SalientUI) {
		window.SalientUI.registerComponent('CircularTextButton', CircularTextButtonComponent);
	} else {
		$(document).ready(() => {
			CircularTextButtonComponent.init();
		});
	}

})(jQuery);