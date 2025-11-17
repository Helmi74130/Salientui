<?php
/**
 * Élément Button pour WPBakery Page Builder
 * Bouton moderne avec différentes variantes et tailles (style shadcn/ui)
 *
 * @package SalientUI
 * @since 1.0.0
 */

// Si ce fichier est appelé directement, on arrête l'exécution
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Salient_UI_Button
 *
 * Élément WPBakery pour afficher un bouton moderne
 */
class Salient_UI_Button extends Salient_UI_Element_Base {

	/**
	 * Obtenir le tag du shortcode
	 *
	 * @return string Tag du shortcode
	 */
	protected function get_shortcode_tag() {
		return 'salient_ui_button';
	}

	/**
	 * Obtenir le slug de l'élément (pour les assets CSS/JS)
	 *
	 * @return string Slug de l'élément
	 */
	protected function get_element_slug() {
		return 'button';
	}

	/**
	 * Obtenir la configuration WPBakery pour cet élément
	 *
	 * @return array Configuration de l'élément pour vc_map()
	 */
	protected function get_vc_config() {
		return array(
			'name'        => __( 'Modern Button', 'salient-ui' ),
			'base'        => $this->get_shortcode_tag(),
			'category'    => __( 'SalientUI', 'salient-ui' ),
			'icon'        => SALIENT_UI_URL . 'assets/images/icon-button.svg',
			'description' => __( 'Modern styled button with multiple variants', 'salient-ui' ),
			'params'      => array(
				// Texte du bouton
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Texte du bouton', 'salient-ui' ),
					'param_name'  => 'text',
					'value'       => __( 'Click me', 'salient-ui' ),
					'description' => __( 'Texte affiché sur le bouton', 'salient-ui' ),
				),

				// Variante du bouton
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Variante', 'salient-ui' ),
					'param_name'  => 'variant',
					'value'       => array(
						__( 'Default', 'salient-ui' )      => 'default',
						__( 'Secondary', 'salient-ui' )    => 'secondary',
						__( 'Outline', 'salient-ui' )      => 'outline',
						__( 'Ghost', 'salient-ui' )        => 'ghost',
						__( 'Destructive', 'salient-ui' )  => 'destructive',
					),
					'std'         => 'default',
					'description' => __( 'Style du bouton', 'salient-ui' ),
				),

				// Taille du bouton
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Taille', 'salient-ui' ),
					'param_name'  => 'size',
					'value'       => array(
						__( 'Small', 'salient-ui' )   => 'sm',
						__( 'Medium', 'salient-ui' )  => 'md',
						__( 'Large', 'salient-ui' )   => 'lg',
					),
					'std'         => 'md',
					'description' => __( 'Taille du bouton', 'salient-ui' ),
				),

				// Lien du bouton
				array(
					'type'        => 'vc_link',
					'heading'     => __( 'Lien', 'salient-ui' ),
					'param_name'  => 'link',
					'description' => __( 'URL du lien du bouton', 'salient-ui' ),
				),

				// Icône (classe)
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Classe d\'icône', 'salient-ui' ),
					'param_name'  => 'icon',
					'value'       => '',
					'description' => __( 'Classe CSS de l\'icône (ex: fa fa-arrow-right)', 'salient-ui' ),
				),

				// Position de l'icône
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Position de l\'icône', 'salient-ui' ),
					'param_name'  => 'icon_position',
					'value'       => array(
						__( 'Left', 'salient-ui' )  => 'left',
						__( 'Right', 'salient-ui' ) => 'right',
					),
					'std'         => 'left',
					'description' => __( 'Position de l\'icône par rapport au texte', 'salient-ui' ),
					'dependency'  => array(
						'element'   => 'icon',
						'not_empty' => true,
					),
				),

				// Classe CSS personnalisée
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Classe CSS supplémentaire', 'salient-ui' ),
					'param_name'  => 'el_class',
					'value'       => '',
					'description' => __( 'Classe CSS personnalisée pour ce bouton', 'salient-ui' ),
				),
			),
		);
	}

	/**
	 * Render le shortcode
	 *
	 * @param array  $atts    Attributs du shortcode
	 * @param string $content Contenu du shortcode (non utilisé pour le bouton)
	 * @return string HTML de l'élément
	 */
	public function render( $atts, $content = null ) {
		// Valeurs par défaut des attributs
		$atts = shortcode_atts(
			array(
				'text'          => __( 'Click me', 'salient-ui' ),
				'variant'       => 'default',
				'size'          => 'md',
				'link'          => '',
				'icon'          => '',
				'icon_position' => 'left',
				'el_class'      => '',
			),
			$atts,
			$this->get_shortcode_tag()
		);

		// Parser le lien
		$link_data = $this->parse_vc_link( $atts['link'] );

		// Construire les classes CSS
		$classes = array(
			'salient-ui-button',
			'salient-ui-button--' . esc_attr( $atts['variant'] ),
			'salient-ui-button--' . esc_attr( $atts['size'] ),
		);

		// Ajouter la classe personnalisée si fournie
		if ( ! empty( $atts['el_class'] ) ) {
			$classes[] = esc_attr( $atts['el_class'] );
		}

		// Ajouter la classe pour l'icône si fournie
		if ( ! empty( $atts['icon'] ) ) {
			$classes[] = 'salient-ui-button--with-icon';
			$classes[] = 'salient-ui-button--icon-' . esc_attr( $atts['icon_position'] );
		}

		// Charger le template avec les variables
		return $this->load_template(
			'button',
			array(
				'text'          => $atts['text'],
				'href'          => $link_data['url'],
				'target'        => $link_data['target'],
				'title'         => $link_data['title'],
				'classes'       => $this->build_classes( $classes ),
				'icon'          => $atts['icon'],
				'icon_position' => $atts['icon_position'],
			)
		);
	}
}
