/**
 * SalientUI - Button Component JavaScript
 * Gestion des interactions du composant Button
 *
 * @package SalientUI
 * @since 1.0.0
 */

(function($) {
	'use strict';

	/**
	 * Composant Button
	 */
	const ButtonComponent = {
		/**
		 * Sélecteur
		 */
		selector: '.salient-ui-button',

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
				if ($button.data('sui-button-initialized')) {
					return;
				}

				// Ajouter un attribut role pour l'accessibilité
				if (!$button.attr('role')) {
					$button.attr('role', 'button');
				}

				// Gérer les boutons sans href (href="#")
				if ($button.attr('href') === '#') {
					$button.on('click', function(e) {
						e.preventDefault();
					});
				}

				// Support du clavier pour les boutons qui ne sont pas des liens
				if (!$button.is('a')) {
					$button.attr('tabindex', '0');
					$button.on('keydown', function(e) {
						if (e.key === 'Enter' || e.key === ' ') {
							e.preventDefault();
							$(this).trigger('click');
						}
					});
				}

				// Marquer comme initialisé
				$button.data('sui-button-initialized', true);
			});

			if (window.SalientUI) {
				window.SalientUI.log(`Button: ${buttons.length} button(s) initialized`);
			}
		},
	};

	/**
	 * Enregistrer le composant dans SalientUI
	 */
	if (window.SalientUI) {
		window.SalientUI.registerComponent('Button', ButtonComponent);
	} else {
		// Fallback si le core n'est pas chargé
		$(document).ready(() => {
			ButtonComponent.init();
		});
	}

})(jQuery);
