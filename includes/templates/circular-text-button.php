<?php
/**
 * Template pour l'élément Circular Text Button
 * Affiche un bouton circulaire avec texte rotatif
 *
 * Variables disponibles :
 * @var array   $text_chars Tableau de caractères
 * @var string  $tag        Balise HTML (a ou button)
 * @var string  $href       URL du lien
 * @var string  $target     Target du lien (_self ou _blank)
 * @var string  $title      Attribut title du lien
 * @var string  $classes    Classes CSS du bouton
 * @var boolean $show_icon  Afficher l'icône
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
  <p class="salient-ui-ctb-text">
    <?php foreach ( $text_chars as $index => $char ) : ?>
    <span style="--index: <?php echo esc_attr( $index ); ?>;"><?php echo esc_html( $char ); ?></span>
    <?php endforeach; ?>
  </p>

  <?php if ( $show_icon ) : ?>
  <div class="salient-ui-ctb-circle">
    <svg viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg" class="salient-ui-ctb-icon"
      aria-hidden="true">
      <path
        d="M13.376 11.552l-.264-10.44-10.44-.24.024 2.28 6.96-.048L.2 12.56l1.488 1.488 9.432-9.432-.048 6.912 2.304.024z"
        fill="currentColor"></path>
    </svg>
    <svg viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg"
      class="salient-ui-ctb-icon salient-ui-ctb-icon--copy" aria-hidden="true">
      <path
        d="M13.376 11.552l-.264-10.44-10.44-.24.024 2.28 6.96-.048L.2 12.56l1.488 1.488 9.432-9.432-.048 6.912 2.304.024z"
        fill="currentColor"></path>
    </svg>
  </div>
  <?php endif; ?>
</<?php echo esc_attr( $tag ); ?>>