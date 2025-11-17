/**
 * SalientUI - Card Component JavaScript
 * Gestion des interactions du composant Card
 *
 * @package SalientUI
 * @since 1.0.0
 */

(function($) {
	'use strict';

	/**
	 * Composant Card
	 */
	const CardComponent = {
		/**
		 * Sélecteurs
		 */
		selectors: {
			card: '.salient-ui-card',
			clickable: '.salient-ui-card--clickable',
			link: '.salient-ui-card__link',
		},

		/**
		 * Initialiser le composant
		 */
		init() {
			this.setupCards();
		},

		/**
		 * Réinitialiser pour le contenu dynamique
		 *
		 * @param {HTMLElement} context - Contexte DOM
		 */
		reinit(context) {
			const cards = context.querySelectorAll ?
				context.querySelectorAll(this.selectors.card) :
				$(context).find(this.selectors.card);

			if (cards.length > 0) {
				this.setupCards(context);
			}
		},

		/**
		 * Configurer les cards
		 *
		 * @param {HTMLElement} context - Contexte DOM (optionnel)
		 */
		setupCards(context) {
			const cards = context ?
				$(context).find(this.selectors.clickable) :
				$(this.selectors.clickable);

			cards.each((index, card) => {
				const $card = $(card);

				// Éviter la double initialisation
				if ($card.data('sui-card-initialized')) {
					return;
				}

				const $link = $card.find(this.selectors.link);

				if ($link.length > 0) {
					// Rendre toute la card cliquable
					$card.css('cursor', 'pointer');

					// Ajouter les attributs pour l'accessibilité
					$card.attr({
						'role': 'article',
						'tabindex': '0',
					});

					// Gestion du clic sur la card
					$card.on('click', function(e) {
						// Ne pas déclencher si on clique directement sur le lien
						if ($(e.target).closest(CardComponent.selectors.link).length > 0) {
							return;
						}

						// Simuler un clic sur le lien
						$link[0].click();
					});

					// Support clavier (Enter et Space)
					$card.on('keydown', function(e) {
						if (e.key === 'Enter' || e.key === ' ') {
							e.preventDefault();
							$link[0].click();
						}
					});
				}

				// Marquer comme initialisé
				$card.data('sui-card-initialized', true);
			});

			if (window.SalientUI) {
				window.SalientUI.log(`Card: ${cards.length} card(s) initialized`);
			}
		},
	};

	/**
	 * Enregistrer le composant dans SalientUI
	 */
	if (window.SalientUI) {
		window.SalientUI.registerComponent('Card', CardComponent);
	} else {
		// Fallback si le core n'est pas chargé
		$(document).ready(() => {
			CardComponent.init();
		});
	}

})(jQuery);
