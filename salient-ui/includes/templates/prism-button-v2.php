<?php
/**
 * Template pour l'élément Prism Button v2
 * Affiche un bouton avec effet prisme 3D et animation flip
 *
 * Variables disponibles :
 * @var string $text       Texte du bouton
 * @var string $root_tag   Balise HTML (a, div, span, button)
 * @var string $href       URL du lien
 * @var string $target     Target du lien (_self ou _blank)
 * @var string $title      Attribut title du lien
 * @var string $classes    Classes CSS du bouton
 *
 * @package SalientUI
 * @since 1.0.0
 */

// Si ce fichier est appelé directement, on arrête l'exécution
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<<?php echo esc_attr( $root_tag ); ?>
	class="<?php echo esc_attr( $classes ); ?>"
	<?php if ( 'a' === $root_tag && ! empty( $href ) ) : ?>
		href="<?php echo esc_url( $href ); ?>"
		<?php if ( ! empty( $target ) ) : ?>
			target="<?php echo esc_attr( $target ); ?>"
		<?php endif; ?>
		<?php if ( ! empty( $title ) ) : ?>
			title="<?php echo esc_attr( $title ); ?>"
		<?php endif; ?>
	<?php endif; ?>
>
	<span data-text="<?php echo esc_attr( $text ); ?>" class="salient-ui-prism-button-v2__inner">
		<span class="salient-ui-prism-button-v2__text"><?php echo esc_html( $text ); ?></span>
	</span>
</<?php echo esc_attr( $root_tag ); ?>>
