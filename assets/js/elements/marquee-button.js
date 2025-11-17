/**
 * SalientUI - Marquee Button Component JavaScript
 * Gestion des interactions du bouton avec effet marquee
 *
 * @package SalientUI
 * @since 1.0.0
 */

(function($) {
	'use strict';

	/**
	 * Composant Marquee Button
	 */
	const MarqueeButtonComponent = {
		/**
		 * Sélecteur
		 */
		selector: '.salient-ui-mb-button',

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
				if ($button.data('sui-mb-initialized')) {
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

				// Ajuster la vitesse du marquee selon la longueur du texte
				this.adjustMarqueeSpeed($button);

				// Marquer comme initialisé
				$button.data('sui-mb-initialized', true);
			});

			if (window.SalientUI) {
				window.SalientUI.log(`Marquee Button: ${buttons.length} button(s) initialized`);
			}
		},

		/**
		 * Ajuster la vitesse du marquee selon la longueur du texte
		 *
		 * @param {jQuery} $button - Élément jQuery du bouton
		 */
		adjustMarqueeSpeed($button) {
			const $marquee = $button.find('.salient-ui-mb-marquee');
			
			if ($marquee.length === 0) {
				return;
			}

			// Obtenir la longueur du texte
			const textLength = $marquee.text().length;
			
			// Si le texte est très court, on peut accélérer
			// Si le texte est long, on peut ralentir
			// Cette logique est optionnelle et peut être décommentée si souhaitée
			
			/*
			const baseDuration = parseFloat($button.css('--sui-mb-marquee-duration')) || 1;
			let adjustedDuration = baseDuration;
			
			if (textLength < 5) {
				adjustedDuration = baseDuration * 0.7; // Plus rapide pour texte court
			} else if (textLength > 15) {
				adjustedDuration = baseDuration * 1.3; // Plus lent pour texte long
			}
			
			$button.css('--sui-mb-marquee-duration', adjustedDuration + 's');
			*/
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
					$buttons.addClass('sui-mb-reduced-motion');
					
					if (window.SalientUI) {
						window.SalientUI.log('Marquee Button: Animation désactivée (prefers-reduced-motion)');
					}
				} else {
					// Réactiver l'animation
					$buttons.removeClass('sui-mb-reduced-motion');
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
		window.SalientUI.registerComponent('MarqueeButton', MarqueeButtonComponent);
	} else {
		$(document).ready(() => {
			MarqueeButtonComponent.init();
		});
	}

})(jQuery);