/**
 * SalientUI - Orbital Glow Button Component JavaScript
 * Gestion des interactions et filtres SVG du composant
 *
 * @package SalientUI
 * @since 1.0.0
 */

(function($) {
	'use strict';

	/**
	 * Composant Orbital Glow Button
	 * Gère l'initialisation et les effets avancés
	 */
	const OrbitalGlowButtonComponent = {
		/**
		 * Sélecteur
		 */
		selector: '.salient-ui-ogb-container',

		/**
		 * Initialiser le composant
		 */
		init() {
			this.setupButtons();
			this.applyDynamicFilters();
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
				this.applyDynamicFilters(context);
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

			buttons.each((index, container) => {
				const $container = $(container);

				// Éviter la double initialisation
				if ($container.data('sui-ogb-initialized')) {
					return;
				}

				const $realButton = $container.find('.salient-ui-ogb-real-button');

				// Ajouter un attribut role pour l'accessibilité si c'est un bouton
				if ($realButton.is('button') && !$realButton.attr('role')) {
					$realButton.attr('role', 'button');
					$realButton.attr('tabindex', '0');
				}

				// Support du clavier pour les boutons
				if ($realButton.is('button')) {
					$realButton.on('keydown', function(e) {
						if (e.key === 'Enter' || e.key === ' ') {
							e.preventDefault();
							$(this).trigger('click');
						}
					});
				}

				// Désactiver le comportement par défaut pour les liens vides
				if ($realButton.is('a') && ($realButton.attr('href') === '#' || !$realButton.attr('href'))) {
					$realButton.on('click', function(e) {
						e.preventDefault();
					});
				}

				// Support de l'animation pause/resume avec Intersection Observer
				this.setupVisibilityObserver($container);

				// Marquer comme initialisé
				$container.data('sui-ogb-initialized', true);
			});

			if (window.SalientUI) {
				window.SalientUI.log(`Orbital Glow Button: ${buttons.length} button(s) initialized`);
			}
		},

		/**
		 * Appliquer les filtres SVG dynamiques
		 * Récupère les IDs des filtres depuis les attributs data-filter
		 *
		 * @param {HTMLElement} context - Contexte DOM (optionnel)
		 */
		applyDynamicFilters(context) {
			const containers = context ?
				$(context).find(this.selector) :
				$(this.selector);

			containers.each((index, container) => {
				const $container = $(container);
				const $spins = $container.find('.salient-ui-ogb-spin');

				$spins.each((i, spin) => {
					const $spin = $(spin);
					const filterId = $spin.data('filter');

					if (filterId) {
						// Récupérer le filtre actuel
						const currentFilter = $spin.css('filter');
						
						// Ajouter l'URL du filtre SVG
						const svgFilter = `url(#${filterId})`;
						
						// Combiner avec le blur existant
						if (currentFilter && currentFilter !== 'none') {
							// Extraire le blur
							const blurMatch = currentFilter.match(/blur\([^)]+\)/);
							if (blurMatch) {
								$spin.css('filter', `${blurMatch[0]} ${svgFilter}`);
							} else {
								$spin.css('filter', svgFilter);
							}
						} else {
							$spin.css('filter', svgFilter);
						}
					}
				});
			});
		},

		/**
		 * Configurer l'observateur de visibilité
		 * Pause l'animation quand l'élément n'est pas visible
		 *
		 * @param {jQuery} $container - Élément jQuery du conteneur
		 */
		setupVisibilityObserver($container) {
			// Vérifier si IntersectionObserver est supporté
			if (!('IntersectionObserver' in window)) {
				return;
			}

			const $spins = $container.find('.salient-ui-ogb-spin');

			// Créer un observateur
			const observer = new IntersectionObserver((entries) => {
				entries.forEach((entry) => {
					if (entry.isIntersecting) {
						// L'élément est visible, reprendre l'animation
						$spins.css('animation-play-state', '');
					} else {
						// L'élément n'est pas visible, mettre en pause
						$spins.css('animation-play-state', 'paused');
					}
				});
			}, {
				threshold: 0.1, // Déclencher quand 10% de l'élément est visible
			});

			// Observer le conteneur
			observer.observe($container[0]);

			// Stocker l'observateur pour le nettoyage
			$container.data('sui-ogb-observer', observer);
		},

		/**
		 * Nettoyer les observateurs (utile pour les SPA)
		 *
		 * @param {jQuery} $container - Élément jQuery du conteneur
		 */
		cleanup($container) {
			const observer = $container.data('sui-ogb-observer');
			if (observer) {
				observer.disconnect();
				$container.removeData('sui-ogb-observer');
			}
		},
	};

	/**
	 * Enregistrer le composant dans SalientUI
	 */
	if (window.SalientUI) {
		window.SalientUI.registerComponent('OrbitalGlowButton', OrbitalGlowButtonComponent);
	} else {
		// Fallback si le core n'est pas chargé
		$(document).ready(() => {
			OrbitalGlowButtonComponent.init();
		});
	}

})(jQuery);