<?php
/**
 * Template pour l'élément Word Rotator Loader
 * Affiche un loader avec rotation de mots
 *
 * Variables disponibles :
 * @var string $main_text Texte principal (ex: "loading")
 * @var array  $words     Tableau des mots à afficher
 * @var string $classes   Classes CSS du conteneur
 *
 * @package SalientUI
 * @since 1.0.0
 */

// Si ce fichier est appelé directement, on arrête l'exécution
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="<?php echo esc_attr( $classes ); ?>">
  <div class="salient-ui-wrl-loader">
    <p class="salient-ui-wrl-main-text"><?php echo esc_html( $main_text ); ?></p>
    <div class="salient-ui-wrl-words">
      <?php foreach ( $words as $word ) : ?>
      <span class="salient-ui-wrl-word"><?php echo esc_html( $word ); ?></span>
      <?php endforeach; ?>
    </div>
  </div>
</div>