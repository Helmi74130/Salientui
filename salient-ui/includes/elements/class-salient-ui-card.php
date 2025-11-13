<?php
/**
 * Élément Card pour WPBakery Page Builder
 * Card moderne avec header, contenu, et footer (style shadcn/ui)
 *
 * @package SalientUI
 * @since 1.0.0
 */

// Si ce fichier est appelé directement, on arrête l'exécution
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Salient_UI_Card
 *
 * Élément WPBakery pour afficher une card moderne
 */
class Salient_UI_Card extends Salient_UI_Element_Base {

	/**
	 * Obtenir le tag du shortcode
	 *
	 * @return string Tag du shortcode
	 */
	protected function get_shortcode_tag() {
		return 'salient_ui_card';
	}

	/**
	 * Obtenir le slug de l'élément (pour les assets CSS/JS)
	 *
	 * @return string Slug de l'élément
	 */
	protected function get_element_slug() {
		return 'card';
	}

	/**
	 * Obtenir la configuration WPBakery pour cet élément
	 *
	 * @return array Configuration de l'élément pour vc_map()
	 */
	protected function get_vc_config() {
		return array(
			'name'        => __( 'Modern Card', 'salient-ui' ),
			'base'        => $this->get_shortcode_tag(),
			'category'    => __( 'SalientUI', 'salient-ui' ),
			'icon'        => SALIENT_UI_URL . 'assets/images/icon-card.svg',
			'description' => __( 'Card container with header, content, and footer', 'salient-ui' ),
			'params'      => array(
				// Titre de la card
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Titre', 'salient-ui' ),
					'param_name'  => 'title',
					'value'       => '',
					'description' => __( 'Titre de la card', 'salient-ui' ),
				),

				// Contenu de la card
				array(
					'type'        => 'textarea_html',
					'heading'     => __( 'Contenu', 'salient-ui' ),
					'param_name'  => 'content',
					'value'       => '',
					'description' => __( 'Contenu principal de la card', 'salient-ui' ),
				),

				// Image
				array(
					'type'        => 'attach_image',
					'heading'     => __( 'Image', 'salient-ui' ),
					'param_name'  => 'image',
					'value'       => '',
					'description' => __( 'Image de la card (optionnelle)', 'salient-ui' ),
				),

				// Lien
				array(
					'type'        => 'vc_link',
					'heading'     => __( 'Lien', 'salient-ui' ),
					'param_name'  => 'link',
					'description' => __( 'Lien de la card (optionnel)', 'salient-ui' ),
				),

				// Variante
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Variante', 'salient-ui' ),
					'param_name'  => 'variant',
					'value'       => array(
						__( 'Default', 'salient-ui' )   => 'default',
						__( 'Bordered', 'salient-ui' )  => 'bordered',
						__( 'Elevated', 'salient-ui' )  => 'elevated',
					),
					'std'         => 'default',
					'description' => __( 'Style de la card', 'salient-ui' ),
				),

				// Classe CSS personnalisée
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Classe CSS supplémentaire', 'salient-ui' ),
					'param_name'  => 'el_class',
					'value'       => '',
					'description' => __( 'Classe CSS personnalisée pour cette card', 'salient-ui' ),
				),
			),
		);
	}

	/**
	 * Render le shortcode
	 *
	 * @param array  $atts    Attributs du shortcode
	 * @param string $content Contenu du shortcode
	 * @return string HTML de l'élément
	 */
	public function render( $atts, $content = null ) {
		// Valeurs par défaut des attributs
		$atts = shortcode_atts(
			array(
				'title'    => '',
				'image'    => '',
				'link'     => '',
				'variant'  => 'default',
				'el_class' => '',
			),
			$atts,
			$this->get_shortcode_tag()
		);

		// Parser le lien
		$link_data = $this->parse_vc_link( $atts['link'] );

		// Récupérer l'URL de l'image si un ID est fourni
		$image_url = '';
		if ( ! empty( $atts['image'] ) ) {
			$image_url = $this->get_image_url( $atts['image'], 'large' );
		}

		// Traiter le contenu (shortcodes et paragraphes automatiques)
		if ( ! empty( $content ) ) {
			$content = wpautop( do_shortcode( $content ) );
		}

		// Construire les classes CSS
		$classes = array(
			'salient-ui-card',
			'salient-ui-card--' . esc_attr( $atts['variant'] ),
		);

		// Ajouter la classe personnalisée si fournie
		if ( ! empty( $atts['el_class'] ) ) {
			$classes[] = esc_attr( $atts['el_class'] );
		}

		// Ajouter une classe si la card a une image
		if ( ! empty( $image_url ) ) {
			$classes[] = 'salient-ui-card--with-image';
		}

		// Ajouter une classe si la card a un lien
		if ( ! empty( $link_data['url'] ) ) {
			$classes[] = 'salient-ui-card--clickable';
		}

		// Charger le template avec les variables
		return $this->load_template(
			'card',
			array(
				'title'     => $atts['title'],
				'content'   => $content,
				'image_url' => $image_url,
				'link_url'  => $link_data['url'],
				'link_title' => $link_data['title'],
				'link_target' => $link_data['target'],
				'classes'   => $this->build_classes( $classes ),
			)
		);
	}
}
