<?php
/**
 * Template pour l'élément Marquee Button
 * Affiche un bouton avec effet de texte défilant
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
  <span class="salient-ui-mb-text"><?php echo esc_html( $text ); ?></span>
  <span class="salient-ui-mb-marquee" aria-hidden="true"><?php echo esc_html( $text ); ?></span>
</<?php echo esc_attr( $tag ); ?>>