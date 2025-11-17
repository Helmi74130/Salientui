/**
 * SalientUI - Particle Glow Button Component JavaScript
 * Gestion des interactions du bouton avec particules
 *
 * @package SalientUI
 * @since 1.0.0
 */

(function($) {
	'use strict';

	/**
	 * Composant Particle Glow Button
	 */
	const ParticleGlowButtonComponent = {
		/**
		 * Sélecteur
		 */
		selector: '.salient-ui-pgb-button',

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
				if ($button.data('sui-pgb-initialized')) {
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

				// Effet de pause sur visibilité
				this.setupVisibilityControl($button);

				// Marquer comme initialisé
				$button.data('sui-pgb-initialized', true);
			});

			if (window.SalientUI) {
				window.SalientUI.log(`Particle Glow Button: ${buttons.length} button(s) initialized`);
			}
		},

		/**
		 * Contrôler les animations selon la visibilité
		 *
		 * @param {jQuery} $button - Élément jQuery du bouton
		 */
		setupVisibilityControl($button) {
			if (!('IntersectionObserver' in window)) {
				return;
			}

			const $circles = $button.find('.salient-ui-pgb-circle');

			const observer = new IntersectionObserver((entries) => {
				entries.forEach((entry) => {
					if (entry.isIntersecting) {
						$circles.css('animation-play-state', 'running');
					} else {
						$circles.css('animation-play-state', 'paused');
					}
				});
			}, {
				threshold: 0.1,
			});

			observer.observe($button[0]);
			$button.data('sui-pgb-observer', observer);
		},
	};

	/**
	 * Enregistrer le composant dans SalientUI
	 */
	if (window.SalientUI) {
		window.SalientUI.registerComponent('ParticleGlowButton', ParticleGlowButtonComponent);
	} else {
		$(document).ready(() => {
			ParticleGlowButtonComponent.init();
		});
	}

})(jQuery);