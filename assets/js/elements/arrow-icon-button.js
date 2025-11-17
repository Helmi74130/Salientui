/**
 * SalientUI - Arrow Icon Button Component JavaScript
 * Gestion des interactions du bouton avec icône flèche
 *
 * @package SalientUI
 * @since 1.0.0
 */

(function($) {
	'use strict';

	/**
	 * Composant Arrow Icon Button
	 */
	const ArrowIconButtonComponent = {
		/**
		 * Sélecteur
		 */
		selector: '.salient-ui-aib-button',

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
				if ($button.data('sui-aib-initialized')) {
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

				// Effet de ripple au clic (optionnel)
				this.setupRippleEffect($button);

				// Marquer comme initialisé
				$button.data('sui-aib-initialized', true);
			});

			if (window.SalientUI) {
				window.SalientUI.log(`Arrow Icon Button: ${buttons.length} button(s) initialized`);
			}
		},

		/**
		 * Configurer l'effet ripple au clic (optionnel)
		 *
		 * @param {jQuery} $button - Élément jQuery du bouton
		 */
		setupRippleEffect($button) {
			// Décommenter pour activer l'effet ripple
			/*
			$button.on('click', function(e) {
				const $ripple = $('<span class="salient-ui-aib-ripple"></span>');
				const rect = this.getBoundingClientRect();
				const size = Math.max(rect.width, rect.height);
				const x = e.clientX - rect.left - size / 2;
				const y = e.clientY - rect.top - size / 2;
				
				$ripple.css({
					width: size,
					height: size,
					left: x,
					top: y,
					position: 'absolute',
					borderRadius: '50%',
					background: 'rgba(255, 255, 255, 0.5)',
					transform: 'scale(0)',
					animation: 'sui-aib-ripple 0.6s ease-out',
					pointerEvents: 'none'
				});
				
				$(this).css('position', 'relative').css('overflow', 'hidden').append($ripple);
				
				setTimeout(() => {
					$ripple.remove();
				}, 600);
			});
			*/
		},
	};

	/**
	 * Enregistrer le composant dans SalientUI
	 */
	if (window.SalientUI) {
		window.SalientUI.registerComponent('ArrowIconButton', ArrowIconButtonComponent);
	} else {
		$(document).ready(() => {
			ArrowIconButtonComponent.init();
		});
	}

})(jQuery);