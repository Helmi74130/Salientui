<?php
/**
 * Template pour l'élément Orbital Glow Button
 * Affiche un bouton avec effet orbital lumineux
 *
 * Variables disponibles :
 * @var string $text       Texte du bouton
 * @var string $href       URL du lien
 * @var string $target     Target du lien (_self ou _blank)
 * @var string $title      Attribut title du lien
 * @var string $classes    Classes CSS du conteneur
 * @var string $unique_id  ID unique pour les filtres SVG
 * @var array  $atts       Tous les attributs
 *
 * @package SalientUI
 * @since 1.0.0
 */

// Si ce fichier est appelé directement, on arrête l'exécution
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// IDs uniques pour les filtres SVG
$filter_id_outer   = $unique_id . '-filter-outer';
$filter_id_intense = $unique_id . '-filter-intense';
$filter_id_inner   = $unique_id . '-filter-inner';
?>

<div class="<?php echo esc_attr( $classes ); ?>">
  <!-- Filtres SVG uniques pour cet élément -->
  <svg class="salient-ui-ogb-svg-filters" aria-hidden="true">
    <defs>
      <filter id="<?php echo esc_attr( $filter_id_outer ); ?>" width="300%" x="-100%" height="300%" y="-100%">
        <feColorMatrix values="1 0 0 0 0 
										0 1 0 0 0 
										0 0 1 0 0 
										0 0 0 <?php echo esc_attr( $atts['filter_alpha_outer'] ); ?> 0"></feColorMatrix>
      </filter>
      <filter id="<?php echo esc_attr( $filter_id_intense ); ?>" width="300%" x="-100%" height="300%" y="-100%">
        <feColorMatrix values="1 0 0 0 0 
										0 1 0 0 0 
										0 0 1 0 0 
										0 0 0 <?php echo esc_attr( $atts['filter_alpha_intense'] ); ?> 0"></feColorMatrix>
      </filter>
      <filter id="<?php echo esc_attr( $filter_id_inner ); ?>" width="300%" x="-100%" height="300%" y="-100%">
        <feColorMatrix values="1 0 0 0.2 0 
										0 1 0 0.2 0 
										0 0 1 0.2 0 
										0 0 0 <?php echo esc_attr( $atts['filter_alpha_inner'] ); ?> 0"></feColorMatrix>
      </filter>
    </defs>
  </svg>

  <!-- Bouton réel (invisible) pour les interactions -->
  <?php if ( ! empty( $href ) ) : ?>
  <a href="<?php echo esc_url( $href ); ?>" class="salient-ui-ogb-real-button" <?php if ( ! empty( $target ) ) : ?>
    target="<?php echo esc_attr( $target ); ?>" <?php endif; ?> <?php if ( ! empty( $title ) ) : ?>
    title="<?php echo esc_attr( $title ); ?>" <?php endif; ?> aria-label="<?php echo esc_attr( $text ); ?>">
  </a>
  <?php else : ?>
  <button class="salient-ui-ogb-real-button" aria-label="<?php echo esc_attr( $text ); ?>"></button>
  <?php endif; ?>

  <!-- Backdrop extérieur -->
  <div class="salient-ui-ogb-backdrop"></div>

  <!-- Conteneur du bouton avec effets -->
  <div class="salient-ui-ogb-button-container">
    <!-- Spin blur (flou externe) -->
    <div class="salient-ui-ogb-spin salient-ui-ogb-spin-blur" data-filter="<?php echo esc_attr( $filter_id_outer ); ?>">
    </div>

    <!-- Spin intense (flou moyen) -->
    <div class="salient-ui-ogb-spin salient-ui-ogb-spin-intense"
      data-filter="<?php echo esc_attr( $filter_id_intense ); ?>"></div>

    <!-- Backdrop interne -->
    <div class="salient-ui-ogb-backdrop"></div>

    <!-- Bordure du bouton -->
    <div class="salient-ui-ogb-button-border">
      <!-- Spin inside (flou interne) -->
      <div class="salient-ui-ogb-spin salient-ui-ogb-spin-inside"
        data-filter="<?php echo esc_attr( $filter_id_inner ); ?>"></div>

      <!-- Bouton visible -->
      <div class="salient-ui-ogb-button">
        <?php echo esc_html( $text ); ?>
      </div>
    </div>
  </div>
</div>