/**
 * SalientUI - Word Rotator Loader Component JavaScript
 * Gestion des interactions du composant Word Rotator Loader
 *
 * @package SalientUI
 * @since 1.0.0
 */

(function ($) {
  'use strict';

  /**
   * Composant Word Rotator Loader
   * Gère l'initialisation et les interactions du loader
   */
  const WordRotatorLoaderComponent = {
    /**
     * Sélecteur
     */
    selector: '.salient-ui-wrl-container',

    /**
     * Initialiser le composant
     */
    init() {
      this.setupLoaders();
      this.observeAccessibility();
    },

    /**
     * Réinitialiser pour le contenu dynamique
     *
     * @param {HTMLElement} context - Contexte DOM
     */
    reinit(context) {
      const loaders = context.querySelectorAll ?
        context.querySelectorAll(this.selector) :
        $(context).find(this.selector);

      if (loaders.length > 0) {
        this.setupLoaders(context);
      }
    },

    /**
     * Configurer les loaders
     *
     * @param {HTMLElement} context - Contexte DOM (optionnel)
     */
    setupLoaders(context) {
      const loaders = context ?
        $(context).find(this.selector) :
        $(this.selector);

      loaders.each((index, loader) => {
        const $loader = $(loader);

        // Éviter la double initialisation
        if ($loader.data('sui-wrl-initialized')) {
          return;
        }

        // Ajouter un attribut aria-live pour l'accessibilité
        const $mainText = $loader.find('.salient-ui-wrl-main-text');
        const $wordsContainer = $loader.find('.salient-ui-wrl-words');

        if ($wordsContainer.length > 0) {
          $wordsContainer.attr('aria-live', 'polite');
          $wordsContainer.attr('aria-atomic', 'true');
        }

        // Calculer la durée de l'animation pour synchroniser l'aria-label
        this.setupAccessibilityUpdates($loader);

        // Support de la pause/reprise (optionnel)
        this.setupPlayPauseControl($loader);

        // Marquer comme initialisé
        $loader.data('sui-wrl-initialized', true);
      });

      if (window.SalientUI) {
        window.SalientUI.log(`Word Rotator Loader: ${loaders.length} loader(s) initialized`);
      }
    },

    /**
     * Configurer les mises à jour d'accessibilité
     * Met à jour l'aria-label avec le mot actuellement visible
     *
     * @param {jQuery} $loader - Élément jQuery du loader
     */
    setupAccessibilityUpdates($loader) {
      const $words = $loader.find('.salient-ui-wrl-word');
      const $mainText = $loader.find('.salient-ui-wrl-main-text');

      if ($words.length === 0) {
        return;
      }

      // Récupérer la durée d'animation depuis les styles inline
      const animationDuration = $words.css('animation-duration');
      const duration = this.parseDuration(animationDuration) || 4000;

      // Calculer le temps par mot
      const timePerWord = duration / $words.length;

      let currentIndex = 0;

      // Fonction pour mettre à jour l'aria-label
      const updateAriaLabel = () => {
        const currentWord = $words.eq(currentIndex).text();
        const mainText = $mainText.text();
        $loader.attr('aria-label', `${mainText} ${currentWord}`);
      };

      // Initialiser
      updateAriaLabel();

      // Mettre à jour périodiquement
      setInterval(() => {
        currentIndex = (currentIndex + 1) % $words.length;
        updateAriaLabel();
      }, timePerWord);
    },

    /**
     * Parser la durée d'animation CSS en millisecondes
     *
     * @param {string} duration - Durée CSS (ex: "4s" ou "400ms")
     * @return {number} Durée en millisecondes
     */
    parseDuration(duration) {
      if (!duration) {
        return 0;
      }

      const value = parseFloat(duration);

      if (duration.includes('ms')) {
        return value;
      } else if (duration.includes('s')) {
        return value * 1000;
      }

      return 0;
    },

    /**
     * Configurer le contrôle play/pause (optionnel)
     * Permet de mettre en pause l'animation au clic
     *
     * @param {jQuery} $loader - Élément jQuery du loader
     */
    setupPlayPauseControl($loader) {
      // Décommenter pour activer le contrôle play/pause au clic
      /*
      let isPaused = false;
      const $words = $loader.find('.salient-ui-wrl-word');

      $loader.on('click', function() {
        isPaused = !isPaused;
      	
        if (isPaused) {
          $words.css('animation-play-state', 'paused');
          $loader.attr('aria-label', $loader.attr('aria-label') + ' (en pause)');
        } else {
          $words.css('animation-play-state', 'running');
          $loader.attr('aria-label', $loader.attr('aria-label').replace(' (en pause)', ''));
        }
      });

      // Ajouter un curseur pointer pour indiquer l'interactivité
      $loader.css('cursor', 'pointer');
      $loader.attr('title', 'Cliquer pour mettre en pause/reprendre');
      */
    },

    /**
     * Observer les préférences d'accessibilité
     * Respecte la préférence "prefers-reduced-motion"
     */
    observeAccessibility() {
      // Vérifier si le navigateur supporte matchMedia
      if (!window.matchMedia) {
        return;
      }

      const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

      // Fonction pour gérer le changement
      const handleMotionPreference = (e) => {
        const $words = $('.salient-ui-wrl-word');

        if (e.matches) {
          // L'utilisateur préfère un mouvement réduit
          $words.css('animation', 'none');

          // Afficher seulement le premier mot
          $words.hide();
          $words.first().show();

          if (window.SalientUI) {
            window.SalientUI.log('Word Rotator Loader: Animation désactivée (prefers-reduced-motion)');
          }
        } else {
          // Réactiver l'animation
          $words.css('animation', '');
          $words.show();
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
    window.SalientUI.registerComponent('WordRotatorLoader', WordRotatorLoaderComponent);
  } else {
    // Fallback si le core n'est pas chargé
    $(document).ready(() => {
      WordRotatorLoaderComponent.init();
    });
  }

})(jQuery);