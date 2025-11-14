<?php
/**
 * Élément Prism Button v2 pour WPBakery Page Builder
 * Bouton avec effet prisme 3D et animation flip
 *
 * @package SalientUI
 * @since 1.0.0
 */

// Si ce fichier est appelé directement, on arrête l'exécution
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Salient_UI_Prism_Button_V2
 *
 * Élément WPBakery pour afficher un bouton avec effet prisme 3D
 */
class Salient_UI_Prism_Button_V2 extends Salient_UI_Element_Base {

	/**
	 * Obtenir le tag du shortcode
	 *
	 * @return string Tag du shortcode
	 */
	protected function get_shortcode_tag() {
		return 'salient_ui_prism_button_v2';
	}

	/**
	 * Obtenir le slug de l'élément (pour les assets CSS/JS)
	 *
	 * @return string Slug de l'élément
	 */
	protected function get_element_slug() {
		return 'prism-button-v2';
	}

	/**
	 * Obtenir la configuration WPBakery pour cet élément
	 *
	 * @return array Configuration de l'élément pour vc_map()
	 */
	protected function get_vc_config() {
		return array(
			'name'        => __( 'Prism Button v2', 'salient-ui' ),
			'base'        => $this->get_shortcode_tag(),
			'category'    => __( 'SalientUI', 'salient-ui' ),
			'icon'        => SALIENT_UI_URL . 'assets/images/icon-prism-button-v2.svg',
			'description' => __( 'Bouton avec effet prisme 3D et animation flip', 'salient-ui' ),
			'params'      => array(
				// Contenu
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Texte du bouton', 'salient-ui' ),
					'param_name'  => 'text',
					'value'       => __( 'Prism Button v2', 'salient-ui' ),
					'description' => __( 'Texte affiché sur le bouton', 'salient-ui' ),
					'admin_label' => true,
				),

				// HTML Tag
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Balise HTML', 'salient-ui' ),
					'param_name'  => 'html_tag',
					'value'       => array(
						__( 'div', 'salient-ui' )    => 'div',
						__( 'span', 'salient-ui' )   => 'span',
						__( 'button', 'salient-ui' ) => 'button',
					),
					'std'         => 'div',
					'description' => __( 'Balise HTML du conteneur', 'salient-ui' ),
				),

				// Lien
				array(
					'type'        => 'vc_link',
					'heading'     => __( 'Lien', 'salient-ui' ),
					'param_name'  => 'link',
					'description' => __( 'URL du lien du bouton', 'salient-ui' ),
				),

				// === STYLE ===
				array(
					'type'       => 'dropdown',
					'heading'    => __( 'Style', 'salient-ui' ),
					'param_name' => 'style_separator',
					'value'      => array( '' => '' ),
					'group'      => __( 'Style', 'salient-ui' ),
				),

				// Padding
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Padding (ex: 10px 15px)', 'salient-ui' ),
					'param_name'  => 'padding',
					'value'       => '10px 15px',
					'description' => __( 'Padding du bouton', 'salient-ui' ),
					'group'       => __( 'Style', 'salient-ui' ),
				),

				// Font Size
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Taille de police', 'salient-ui' ),
					'param_name'  => 'font_size',
					'value'       => '16px',
					'description' => __( 'Taille de la police', 'salient-ui' ),
					'group'       => __( 'Style', 'salient-ui' ),
				),

				// Font Weight
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Graisse de police', 'salient-ui' ),
					'param_name'  => 'font_weight',
					'value'       => array(
						__( 'Normal', 'salient-ui' )   => '400',
						__( 'Medium', 'salient-ui' )   => '500',
						__( 'Semi-Bold', 'salient-ui' ) => '600',
						__( 'Bold', 'salient-ui' )     => '700',
					),
					'std'         => '400',
					'group'       => __( 'Style', 'salient-ui' ),
				),

				// Text Color
				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur du texte', 'salient-ui' ),
					'param_name'  => 'text_color',
					'value'       => '#ffffff',
					'description' => __( 'Couleur du texte', 'salient-ui' ),
					'group'       => __( 'Style', 'salient-ui' ),
				),

				// Background Color
				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur de fond', 'salient-ui' ),
					'param_name'  => 'background_color',
					'value'       => '#000000',
					'description' => __( 'Couleur de fond du bouton', 'salient-ui' ),
					'group'       => __( 'Style', 'salient-ui' ),
				),

				// Border Radius
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Rayon de bordure', 'salient-ui' ),
					'param_name'  => 'border_radius',
					'value'       => '5px',
					'description' => __( 'Rayon de bordure (ex: 5px)', 'salient-ui' ),
					'group'       => __( 'Style', 'salient-ui' ),
				),

				// Border Width
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Épaisseur de bordure', 'salient-ui' ),
					'param_name'  => 'border_width',
					'value'       => '0px',
					'description' => __( 'Épaisseur de bordure (ex: 1px)', 'salient-ui' ),
					'group'       => __( 'Style', 'salient-ui' ),
				),

				// Border Color
				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur de bordure', 'salient-ui' ),
					'param_name'  => 'border_color',
					'value'       => '#000000',
					'description' => __( 'Couleur de bordure', 'salient-ui' ),
					'group'       => __( 'Style', 'salient-ui' ),
					'dependency'  => array(
						'element'   => 'border_width',
						'not_empty' => true,
					),
				),

				// === ANIMATION 3D ===
				array(
					'type'       => 'dropdown',
					'heading'    => __( 'Animation 3D', 'salient-ui' ),
					'param_name' => 'animation_separator',
					'value'      => array( '' => '' ),
					'group'      => __( 'Animation 3D', 'salient-ui' ),
				),

				// Perspective
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Perspective', 'salient-ui' ),
					'param_name'  => 'perspective',
					'value'       => '40em',
					'description' => __( 'Profondeur de perspective 3D', 'salient-ui' ),
					'group'       => __( 'Animation 3D', 'salient-ui' ),
				),

				// Translate
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Décalage 3D (Translate)', 'salient-ui' ),
					'param_name'  => 'translate',
					'value'       => '10px',
					'description' => __( 'Distance de décalage 3D', 'salient-ui' ),
					'group'       => __( 'Animation 3D', 'salient-ui' ),
				),

				// Duration
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Durée de l\'animation', 'salient-ui' ),
					'param_name'  => 'duration',
					'value'       => '0.7s',
					'description' => __( 'Durée de l\'animation (ex: 0.7s)', 'salient-ui' ),
					'group'       => __( 'Animation 3D', 'salient-ui' ),
				),

				// Classe CSS personnalisée
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Classe CSS supplémentaire', 'salient-ui' ),
					'param_name'  => 'el_class',
					'value'       => '',
					'description' => __( 'Classe CSS personnalisée', 'salient-ui' ),
					'group'       => __( 'Style', 'salient-ui' ),
				),
			),
		);
	}

	/**
	 * Render le shortcode
	 *
	 * @param array  $atts    Attributs du shortcode
	 * @param string $content Contenu du shortcode (non utilisé)
	 * @return string HTML de l'élément
	 */
	public function render( $atts, $content = null ) {
		// Valeurs par défaut des attributs
		$atts = shortcode_atts(
			array(
				'text'             => __( 'Prism Button v2', 'salient-ui' ),
				'html_tag'         => 'div',
				'link'             => '',
				'padding'          => '10px 15px',
				'font_size'        => '16px',
				'font_weight'      => '400',
				'text_color'       => '#ffffff',
				'background_color' => '#000000',
				'border_radius'    => '5px',
				'border_width'     => '0px',
				'border_color'     => '#000000',
				'perspective'      => '40em',
				'translate'        => '10px',
				'duration'         => '0.7s',
				'el_class'         => '',
			),
			$atts,
			$this->get_shortcode_tag()
		);

		// Parser le lien
		$link_data = $this->parse_vc_link( $atts['link'] );

		// Déterminer la balise HTML
		$root_tag = ! empty( $link_data['url'] ) ? 'a' : $atts['html_tag'];

		// Générer un ID unique pour les styles inline
		$unique_id = 'sui-prism-btn-v2-' . uniqid();

		// Construire les classes CSS
		$classes = array(
			'salient-ui-prism-button-v2',
			$unique_id,
		);

		// Ajouter la classe personnalisée si fournie
		if ( ! empty( $atts['el_class'] ) ) {
			$classes[] = esc_attr( $atts['el_class'] );
		}

		// Générer les styles inline pour cet élément spécifique
		$inline_styles = $this->generate_inline_styles( $unique_id, $atts );

		// Charger le template avec les variables
		return $inline_styles . $this->load_template(
			'prism-button-v2',
			array(
				'text'       => $atts['text'],
				'root_tag'   => $root_tag,
				'href'       => $link_data['url'],
				'target'     => $link_data['target'],
				'title'      => $link_data['title'],
				'classes'    => $this->build_classes( $classes ),
			)
		);
	}

	/**
	 * Générer les styles CSS inline pour cet élément
	 *
	 * @param string $unique_id ID unique de l'élément
	 * @param array  $atts      Attributs de l'élément
	 * @return string Balise <style> avec les CSS inline
	 */
	private function generate_inline_styles( $unique_id, $atts ) {
		$styles = "<style>";

		// Styles du conteneur principal
		$styles .= ".{$unique_id} {";
		$styles .= "perspective: {$atts['perspective']};";
		$styles .= "--translate: {$atts['translate']};";
		$styles .= "--translate-duration: {$atts['duration']};";
		$styles .= "}";

		// Styles du texte et des faces
		$styles .= ".{$unique_id} .salient-ui-prism-button-v2__text,";
		$styles .= ".{$unique_id} .salient-ui-prism-button-v2__inner::before,";
		$styles .= ".{$unique_id} .salient-ui-prism-button-v2__inner::after {";
		$styles .= "padding: {$atts['padding']};";
		$styles .= "font-size: {$atts['font_size']};";
		$styles .= "font-weight: {$atts['font_weight']};";
		$styles .= "color: {$atts['text_color']};";
		$styles .= "background: {$atts['background_color']};";
		$styles .= "border-radius: {$atts['border_radius']};";

		if ( ! empty( $atts['border_width'] ) && $atts['border_width'] !== '0px' ) {
			$styles .= "border: {$atts['border_width']} solid {$atts['border_color']};";
		}

		$styles .= "}";

		$styles .= "</style>";

		return $styles;
	}
}
