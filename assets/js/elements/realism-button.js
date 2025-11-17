/**
 * SalientUI - Realism Button Component JavaScript
 * Gestion des interactions et effets avancés du bouton
 *
 * @package SalientUI
 * @since 1.0.0
 */

(function($) {
	'use strict';

	/**
	 * Composant Realism Button
	 * Gère les interactions et effets 3D optionnels
	 */
	const RealismButtonComponent = {
		/**
		 * Sélecteur
		 */
		selector: '.salient-ui-rb-button',

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
				if ($button.data('sui-rb-initialized')) {
					return;
				}

				// Ajouter un attribut role pour l'accessibilité
				if ($button.is('button') && !$button.attr('role')) {
					$button.attr('role', 'button');
					$button.attr('tabindex', '0');
				}

				// Support du clavier
				if ($button.is('button')) {
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

				// Effet de parallaxe 3D au mouvement de la souris (optionnel)
				this.setup3DEffect($button);

				// Effet de ripple au clic (optionnel)
				this.setupRippleEffect($button);

				// Marquer comme initialisé
				$button.data('sui-rb-initialized', true);
			});

			if (window.SalientUI) {
				window.SalientUI.log(`Realism Button: ${buttons.length} button(s) initialized`);
			}
		},

		/**
		 * Configurer l'effet 3D au mouvement de la souris
		 * Crée un effet de parallaxe subtil
		 *
		 * @param {jQuery} $button - Élément jQuery du bouton
		 */
		setup3DEffect($button) {
			// Décommenter pour activer l'effet 3D
			/*
			$button.on('mousemove', function(e) {
				const rect = this.getBoundingClientRect();
				const x = e.clientX - rect.left;
				const y = e.clientY - rect.top;
				
				const centerX = rect.width / 2;
				const centerY = rect.height / 2;
				
				const deltaX = (x - centerX) / centerX;
				const deltaY = (y - centerY) / centerY;
				
				const rotateX = deltaY * -5; // Max 5 degrés
				const rotateY = deltaX * 5;
				
				$(this).css({
					transform: `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-2px)`,
				});
			});
			
			$button.on('mouseleave', function() {
				$(this).css({
					transform: '',
				});
			});
			*/
		},

		/**
		 * Configurer l'effet ripple au clic
		 * Crée un effet d'onde lors du clic
		 *
		 * @param {jQuery} $button - Élément jQuery du bouton
		 */
		setupRippleEffect($button) {
			// Décommenter pour activer l'effet ripple
			/*
			$button.on('click', function(e) {
				const $ripple = $('<span class="salient-ui-rb-ripple"></span>');
				const rect = this.getBoundingClientRect();
				const size = Math.max(rect.width, rect.height);
				const x = e.clientX - rect.left - size / 2;
				const y = e.clientY - rect.top - size / 2;
				
				$ripple.css({
					width: size,
					height: size,
					left: x,
					top: y,
				});
				
				$(this).append($ripple);
				
				setTimeout(() => {
					$ripple.remove();
				}, 600);
			});
			*/
		},

		/**
		 * Ajouter un effet de vibration au hover (optionnel)
		 *
		 * @param {jQuery} $button - Élément jQuery du bouton
		 */
		setupVibrateEffect($button) {
			// Décommenter pour activer la vibration tactile
			/*
			$button.on('mouseenter touchstart', function() {
				if ('vibrate' in navigator) {
					navigator.vibrate(10); // Vibration de 10ms
				}
			});
			*/
		},
	};

	/**
	 * Enregistrer le composant dans SalientUI
	 */
	if (window.SalientUI) {
		window.SalientUI.registerComponent('RealismButton', RealismButtonComponent);
	} else {
		// Fallback si le core n'est pas chargé
		$(document).ready(() => {
			RealismButtonComponent.init();
		});
	}

})(jQuery);