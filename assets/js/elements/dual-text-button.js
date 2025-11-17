/**
 * SalientUI - Dual Text Button Component JavaScript
 * Gestion des interactions du bouton avec texte dual
 *
 * @package SalientUI
 * @since 1.0.0
 */

(function($) {
	'use strict';

	/**
	 * Composant Dual Text Button
	 */
	const DualTextButtonComponent = {
		/**
		 * Sélecteur
		 */
		selector: '.salient-ui-dtb-button',

		/**
		 * Initialiser le composant
		 */
		init() {
			this.setupButtons();
			this.observeAccessibility();
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
				if ($button.data('sui-dtb-initialized')) {
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

				// Mettre à jour l'aria-label au hover
				this.setupAriaLabel($button);

				// Marquer comme initialisé
				$button.data('sui-dtb-initialized', true);
			});

			if (window.SalientUI) {
				window.SalientUI.log(`Dual Text Button: ${buttons.length} button(s) initialized`);
			}
		},

		/**
		 * Configurer l'aria-label pour l'accessibilité
		 *
		 * @param {jQuery} $button - Élément jQuery du bouton
		 */
		setupAriaLabel($button) {
			const $textOne = $button.find('.salient-ui-dtb-text-one');
			const $textTwo = $button.find('.salient-ui-dtb-text-two');
			
			if ($textOne.length === 0 || $textTwo.length === 0) {
				return;
			}

			const textOne = $textOne.text();
			const textTwo = $textTwo.text();

			// Définir l'aria-label initial
			$button.attr('aria-label', textOne);

			// Changer l'aria-label au hover
			$button.on('mouseenter focus', function() {
				$(this).attr('aria-label', textTwo);
			});

			$button.on('mouseleave blur', function() {
				$(this).attr('aria-label', textOne);
			});
		},

		/**
		 * Observer les préférences d'accessibilité
		 */
		observeAccessibility() {
			// Vérifier si matchMedia est supporté
			if (!window.matchMedia) {
				return;
			}

			const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

			// Fonction pour gérer le changement
			const handleMotionPreference = (e) => {
				const $buttons = $(this.selector);
				
				if (e.matches) {
					// L'utilisateur préfère un mouvement réduit
					$buttons.addClass('sui-dtb-reduced-motion');
					
					if (window.SalientUI) {
						window.SalientUI.log('Dual Text Button: Animation réduite (prefers-reduced-motion)');
					}
				} else {
					// Réactiver l'animation
					$buttons.removeClass('sui-dtb-reduced-motion');
				}
			};

			// Vérifier au chargement
			handleMotionPreference(prefersReducedMotion);

			// Observer les changements
			if (prefersReducedMotion.addEventListener) {
				prefersReducedMotion.addEventListener('change', handleMotionPreference);
			} else if (prefersReducedMotion.addListener) {
				// Fallback pour anciens navigateurs
				prefersReducedMotion.addListener(handleMotionPreference);
			}
		},
	};

	/**
	 * Enregistrer le composant dans SalientUI
	 */
	if (window.SalientUI) {
		window.SalientUI.registerComponent('DualTextButton', DualTextButtonComponent);
	} else {
		$(document).ready(() => {
			DualTextButtonComponent.init();
		});
	}

})(jQuery);