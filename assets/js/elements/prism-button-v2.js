/**
 * SalientUI - Prism Button v2 Component JavaScript
 * Gestion des interactions du composant Prism Button v2
 *
 * @package SalientUI
 * @since 1.0.0
 */

(function($) {
	'use strict';

	/**
	 * Composant Prism Button v2
	 * L'effet 3D est principalement géré par CSS
	 * Ce fichier peut être étendu pour ajouter des interactions supplémentaires
	 */
	const PrismButtonV2Component = {
		/**
		 * Sélecteur
		 */
		selector: '.salient-ui-prism-button-v2',

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
				if ($button.data('sui-prism-button-v2-initialized')) {
					return;
				}

				// Ajouter un attribut role pour l'accessibilité si ce n'est pas un lien
				if (!$button.is('a') && !$button.attr('role')) {
					$button.attr('role', 'button');
					$button.attr('tabindex', '0');
				}

				// Support du clavier pour les boutons qui ne sont pas des liens
				if (!$button.is('a')) {
					$button.on('keydown', function(e) {
						if (e.key === 'Enter' || e.key === ' ') {
							e.preventDefault();
							$(this).trigger('click');
						}
					});
				}

				// Désactiver le comportement par défaut pour les liens vides
				if ($button.is('a') && ($button.attr('href') === '#' || !$button.attr('href'))) {
					$button.on('click', function(e) {
						e.preventDefault();
					});
				}

				// Animation GSAP optionnelle si GSAP est chargé
				if (typeof gsap !== 'undefined') {
					this.setupGSAPAnimation($button);
				}

				// Marquer comme initialisé
				$button.data('sui-prism-button-v2-initialized', true);
			});

			if (window.SalientUI) {
				window.SalientUI.log(`Prism Button v2: ${buttons.length} button(s) initialized`);
			}
		},

		/**
		 * Configuration de l'animation GSAP (optionnelle)
		 * Peut être utilisée pour des effets plus complexes
		 *
		 * @param {jQuery} $button - Élément jQuery du bouton
		 */
		setupGSAPAnimation($button) {
			const $inner = $button.find('.salient-ui-prism-button-v2__inner');

			if ($inner.length === 0) {
				return;
			}

			// Animation au hover avec GSAP (alternative au CSS)
			// Décommenté si vous voulez utiliser GSAP au lieu du CSS
			/*
			$button.on('mouseenter', function() {
				gsap.to($inner[0], {
					rotationX: 180,
					duration: 0.7,
					ease: 'back.out(1.7)',
				});
			});

			$button.on('mouseleave', function() {
				gsap.to($inner[0], {
					rotationX: 0,
					duration: 0.7,
					ease: 'back.out(1.7)',
				});
			});
			*/
		},
	};

	/**
	 * Enregistrer le composant dans SalientUI
	 */
	if (window.SalientUI) {
		window.SalientUI.registerComponent('PrismButtonV2', PrismButtonV2Component);
	} else {
		// Fallback si le core n'est pas chargé
		$(document).ready(() => {
			PrismButtonV2Component.init();
		});
	}

})(jQuery);
