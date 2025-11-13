<?php
/**
 * Template pour l'élément Card
 * Affiche une card moderne avec image, titre, contenu et lien optionnels
 *
 * Variables disponibles :
 * @var string $title       Titre de la card
 * @var string $content     Contenu de la card
 * @var string $image_url   URL de l'image
 * @var string $link_url    URL du lien
 * @var string $link_title  Titre du lien
 * @var string $link_target Target du lien (_self ou _blank)
 * @var string $classes     Classes CSS de la card
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
	<?php if ( ! empty( $image_url ) ) : ?>
		<div class="salient-ui-card__image">
			<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $title ); ?>" />
		</div>
	<?php endif; ?>

	<div class="salient-ui-card__body">
		<?php if ( ! empty( $title ) ) : ?>
			<h3 class="salient-ui-card__title">
				<?php echo esc_html( $title ); ?>
			</h3>
		<?php endif; ?>

		<?php if ( ! empty( $content ) ) : ?>
			<div class="salient-ui-card__content">
				<?php
				// Le contenu a déjà été traité par wpautop() et do_shortcode()
				// On utilise wp_kses_post() pour autoriser le HTML basique
				echo wp_kses_post( $content );
				?>
			</div>
		<?php endif; ?>

		<?php if ( ! empty( $link_url ) ) : ?>
			<div class="salient-ui-card__footer">
				<a
					href="<?php echo esc_url( $link_url ); ?>"
					class="salient-ui-card__link"
					<?php if ( ! empty( $link_target ) ) : ?>
						target="<?php echo esc_attr( $link_target ); ?>"
					<?php endif; ?>
					<?php if ( ! empty( $link_title ) ) : ?>
						title="<?php echo esc_attr( $link_title ); ?>"
					<?php endif; ?>
				>
					<?php
					echo ! empty( $link_title ) ? esc_html( $link_title ) : esc_html__( 'En savoir plus', 'salient-ui' );
					?>
					<span class="salient-ui-card__link-arrow" aria-hidden="true">→</span>
				</a>
			</div>
		<?php endif; ?>
	</div>
</div>
