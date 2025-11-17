<?php
/**
 * Template pour l'élément Particle Glow Button
 * Affiche un bouton avec particules animées
 *
 * Variables disponibles :
 * @var string $text    Texte du bouton
 * @var string $tag     Balise HTML (a ou button)
 * @var string $href    URL du lien
 * @var string $target  Target du lien (_self ou _blank)
 * @var string $title   Attribut title du lien
 * @var string $classes Classes CSS du bouton
 *
 * @package SalientUI
 * @since 1.0.0
 */

// Si ce fichier est appelé directement, on arrête l'exécution
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<<?php echo esc_attr( $tag ); ?> class="<?php echo esc_attr( $classes ); ?>"
  <?php if ( 'a' === $tag && ! empty( $href ) ) : ?> href="<?php echo esc_url( $href ); ?>"
  <?php if ( ! empty( $target ) ) : ?> target="<?php echo esc_attr( $target ); ?>" <?php endif; ?>
  <?php if ( ! empty( $title ) ) : ?> title="<?php echo esc_attr( $title ); ?>" <?php endif; ?> <?php endif; ?>
  <?php if ( 'button' === $tag ) : ?> type="button" <?php endif; ?>>
  <div class="salient-ui-pgb-wrapper">
    <span><?php echo esc_html( $text ); ?></span>
    <div class="salient-ui-pgb-circle salient-ui-pgb-circle-12"></div>
    <div class="salient-ui-pgb-circle salient-ui-pgb-circle-11"></div>
    <div class="salient-ui-pgb-circle salient-ui-pgb-circle-10"></div>
    <div class="salient-ui-pgb-circle salient-ui-pgb-circle-9"></div>
    <div class="salient-ui-pgb-circle salient-ui-pgb-circle-8"></div>
    <div class="salient-ui-pgb-circle salient-ui-pgb-circle-7"></div>
    <div class="salient-ui-pgb-circle salient-ui-pgb-circle-6"></div>
    <div class="salient-ui-pgb-circle salient-ui-pgb-circle-5"></div>
    <div class="salient-ui-pgb-circle salient-ui-pgb-circle-4"></div>
    <div class="salient-ui-pgb-circle salient-ui-pgb-circle-3"></div>
    <div class="salient-ui-pgb-circle salient-ui-pgb-circle-2"></div>
    <div class="salient-ui-pgb-circle salient-ui-pgb-circle-1"></div>
  </div>
</<?php echo esc_attr( $tag ); ?>>