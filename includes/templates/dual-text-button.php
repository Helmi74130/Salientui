<?php
/**
 * Template pour l'élément Dual Text Button
 * Affiche un bouton avec deux textes qui s'échangent
 *
 * Variables disponibles :
 * @var string $text_one Texte principal (repos)
 * @var string $text_two Texte secondaire (hover)
 * @var string $tag      Balise HTML (a ou button)
 * @var string $href     URL du lien
 * @var string $target   Target du lien (_self ou _blank)
 * @var string $title    Attribut title du lien
 * @var string $classes  Classes CSS du bouton
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
  <span class="salient-ui-dtb-text-one"><?php echo esc_html( $text_one ); ?></span>
  <span class="salient-ui-dtb-text-two"><?php echo esc_html( $text_two ); ?></span>
</<?php echo esc_attr( $tag ); ?>>