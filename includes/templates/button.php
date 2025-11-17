<?php
/**
 * Template pour l'élément Button
 * Affiche un bouton moderne avec icône optionnelle
 *
 * Variables disponibles :
 * @var string $text          Texte du bouton
 * @var string $href          URL du lien
 * @var string $target        Target du lien (_self ou _blank)
 * @var string $title         Attribut title du lien
 * @var string $classes       Classes CSS du bouton
 * @var string $icon          Classe CSS de l'icône
 * @var string $icon_position Position de l'icône (left ou right)
 *
 * @package SalientUI
 * @since 1.0.0
 */

// Si ce fichier est appelé directement, on arrête l'exécution
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Si pas d'URL, utiliser # par défaut
$href = ! empty( $href ) ? $href : '#';
?>

<a
	href="<?php echo esc_url( $href ); ?>"
	<?php if ( ! empty( $target ) ) : ?>
		target="<?php echo esc_attr( $target ); ?>"
	<?php endif; ?>
	<?php if ( ! empty( $title ) ) : ?>
		title="<?php echo esc_attr( $title ); ?>"
	<?php endif; ?>
	class="<?php echo esc_attr( $classes ); ?>"
>
	<?php if ( ! empty( $icon ) && 'left' === $icon_position ) : ?>
		<span class="salient-ui-button__icon salient-ui-button__icon--left">
			<i class="<?php echo esc_attr( $icon ); ?>"></i>
		</span>
	<?php endif; ?>

	<span class="salient-ui-button__text">
		<?php echo esc_html( $text ); ?>
	</span>

	<?php if ( ! empty( $icon ) && 'right' === $icon_position ) : ?>
		<span class="salient-ui-button__icon salient-ui-button__icon--right">
			<i class="<?php echo esc_attr( $icon ); ?>"></i>
		</span>
	<?php endif; ?>
</a>
