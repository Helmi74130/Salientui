<?php
/**
 * Élément Realism Button pour WPBakery Page Builder
 * Bouton réaliste avec gradients radiaux et effets de blob lumineux
 *
 * @package SalientUI
 * @since 1.0.0
 */

// Si ce fichier est appelé directement, on arrête l'exécution
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Salient_UI_Realism_Button
 *
 * Élément WPBakery pour afficher un bouton réaliste avec effets lumineux
 */
class Salient_UI_Realism_Button extends Salient_UI_Element_Base {

	/**
	 * Obtenir le tag du shortcode
	 *
	 * @return string Tag du shortcode
	 */
	protected function get_shortcode_tag() {
		return 'salient_ui_realism_button';
	}

	/**
	 * Obtenir le slug de l'élément (pour les assets CSS/JS)
	 *
	 * @return string Slug de l'élément
	 */
	protected function get_element_slug() {
		return 'realism-button';
	}

	/**
	 * Obtenir la configuration WPBakery pour cet élément
	 *
	 * @return array Configuration de l'élément pour vc_map()
	 */
	protected function get_vc_config() {
		return array(
			'name'        => __( 'Realism Button', 'salient-ui' ),
			'base'        => $this->get_shortcode_tag(),
			'category'    => __( 'SalientUI', 'salient-ui' ),
			'icon'        => SALIENT_UI_URL . 'assets/images/icon-realism-button.svg',
			'description' => __( 'Bouton réaliste avec gradients radiaux et effets de lumière', 'salient-ui' ),
			'params'      => array(
				// === CONTENU ===
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Texte du bouton', 'salient-ui' ),
					'param_name'  => 'text',
					'value'       => 'Realism',
					'description' => __( 'Texte affiché sur le bouton', 'salient-ui' ),
					'admin_label' => true,
				),

				// Lien
				array(
					'type'        => 'vc_link',
					'heading'     => __( 'Lien', 'salient-ui' ),
					'param_name'  => 'link',
					'description' => __( 'URL du lien du bouton', 'salient-ui' ),
				),

				// === STYLE GÉNÉRAL ===
				array(
					'type'       => 'dropdown',
					'heading'    => __( 'Style Général', 'salient-ui' ),
					'param_name' => 'general_separator',
					'value'      => array( '' => '' ),
					'group'      => __( 'Style Général', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Taille de police', 'salient-ui' ),
					'param_name'  => 'font_size',
					'value'       => '1.4rem',
					'description' => __( 'Taille de la police (ex: 1.4rem ou 22px)', 'salient-ui' ),
					'group'       => __( 'Style Général', 'salient-ui' ),
				),

				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Graisse de police', 'salient-ui' ),
					'param_name'  => 'font_weight',
					'value'       => array(
						__( 'Normal', 'salient-ui' )    => '400',
						__( 'Medium', 'salient-ui' )    => '500',
						__( 'Semi-Bold', 'salient-ui' ) => '600',
						__( 'Bold', 'salient-ui' )      => '700',
					),
					'std'         => '400',
					'group'       => __( 'Style Général', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Rayon de bordure externe', 'salient-ui' ),
					'param_name'  => 'border_radius_outer',
					'value'       => '16px',
					'description' => __( 'Rayon de bordure du conteneur (ex: 16px)', 'salient-ui' ),
					'group'       => __( 'Style Général', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Rayon de bordure interne', 'salient-ui' ),
					'param_name'  => 'border_radius_inner',
					'value'       => '14px',
					'description' => __( 'Rayon de bordure du contenu (ex: 14px)', 'salient-ui' ),
					'group'       => __( 'Style Général', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Padding', 'salient-ui' ),
					'param_name'  => 'padding',
					'value'       => '14px 25px',
					'description' => __( 'Padding du contenu (ex: 14px 25px)', 'salient-ui' ),
					'group'       => __( 'Style Général', 'salient-ui' ),
				),

				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur du texte', 'salient-ui' ),
					'param_name'  => 'text_color',
					'value'       => '#ffffff',
					'description' => __( 'Couleur du texte', 'salient-ui' ),
					'group'       => __( 'Style Général', 'salient-ui' ),
				),

				// === GRADIENT EXTERNE ===
				array(
					'type'       => 'dropdown',
					'heading'    => __( 'Gradient Externe', 'salient-ui' ),
					'param_name' => 'gradient_outer_separator',
					'value'      => array( '' => '' ),
					'group'      => __( 'Gradient Externe', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Taille du cercle radial', 'salient-ui' ),
					'param_name'  => 'gradient_outer_size',
					'value'       => '80px',
					'description' => __( 'Taille du cercle du gradient (ex: 80px)', 'salient-ui' ),
					'group'       => __( 'Gradient Externe', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Position horizontale', 'salient-ui' ),
					'param_name'  => 'gradient_outer_x',
					'value'       => '80%',
					'description' => __( 'Position X du centre (ex: 80%)', 'salient-ui' ),
					'group'       => __( 'Gradient Externe', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Position verticale', 'salient-ui' ),
					'param_name'  => 'gradient_outer_y',
					'value'       => '-10%',
					'description' => __( 'Position Y du centre (ex: -10%)', 'salient-ui' ),
					'group'       => __( 'Gradient Externe', 'salient-ui' ),
				),

				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur 1 (centre)', 'salient-ui' ),
					'param_name'  => 'gradient_outer_color1',
					'value'       => '#ffffff',
					'description' => __( 'Couleur au centre du gradient', 'salient-ui' ),
					'group'       => __( 'Gradient Externe', 'salient-ui' ),
				),

				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur 2 (extérieur)', 'salient-ui' ),
					'param_name'  => 'gradient_outer_color2',
					'value'       => '#181b1b',
					'description' => __( 'Couleur extérieure du gradient', 'salient-ui' ),
					'group'       => __( 'Gradient Externe', 'salient-ui' ),
				),

				// === GRADIENT INTERNE ===
				array(
					'type'       => 'dropdown',
					'heading'    => __( 'Gradient Interne', 'salient-ui' ),
					'param_name' => 'gradient_inner_separator',
					'value'      => array( '' => '' ),
					'group'      => __( 'Gradient Interne', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Taille du cercle radial', 'salient-ui' ),
					'param_name'  => 'gradient_inner_size',
					'value'       => '80px',
					'description' => __( 'Taille du cercle du gradient (ex: 80px)', 'salient-ui' ),
					'group'       => __( 'Gradient Interne', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Position horizontale', 'salient-ui' ),
					'param_name'  => 'gradient_inner_x',
					'value'       => '80%',
					'description' => __( 'Position X du centre (ex: 80%)', 'salient-ui' ),
					'group'       => __( 'Gradient Interne', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Position verticale', 'salient-ui' ),
					'param_name'  => 'gradient_inner_y',
					'value'       => '-50%',
					'description' => __( 'Position Y du centre (ex: -50%)', 'salient-ui' ),
					'group'       => __( 'Gradient Interne', 'salient-ui' ),
				),

				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur 1 (centre)', 'salient-ui' ),
					'param_name'  => 'gradient_inner_color1',
					'value'       => '#777777',
					'description' => __( 'Couleur au centre du gradient', 'salient-ui' ),
					'group'       => __( 'Gradient Interne', 'salient-ui' ),
				),

				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur 2 (extérieur)', 'salient-ui' ),
					'param_name'  => 'gradient_inner_color2',
					'value'       => '#0f1111',
					'description' => __( 'Couleur extérieure du gradient', 'salient-ui' ),
					'group'       => __( 'Gradient Interne', 'salient-ui' ),
				),

				// === BLOB LUMINEUX ===
				array(
					'type'       => 'dropdown',
					'heading'    => __( 'Blob Lumineux', 'salient-ui' ),
					'param_name' => 'blob_separator',
					'value'      => array( '' => '' ),
					'group'      => __( 'Blob Lumineux', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Largeur du blob', 'salient-ui' ),
					'param_name'  => 'blob_width',
					'value'       => '70px',
					'description' => __( 'Largeur du blob (ex: 70px)', 'salient-ui' ),
					'group'       => __( 'Blob Lumineux', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Taille du cercle radial blob', 'salient-ui' ),
					'param_name'  => 'blob_gradient_size',
					'value'       => '60px',
					'description' => __( 'Taille du cercle du gradient blob (ex: 60px)', 'salient-ui' ),
					'group'       => __( 'Blob Lumineux', 'salient-ui' ),
				),

				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur blob 1 (centre)', 'salient-ui' ),
					'param_name'  => 'blob_color1',
					'value'       => '#3fe9ff',
					'description' => __( 'Couleur centrale du blob', 'salient-ui' ),
					'group'       => __( 'Blob Lumineux', 'salient-ui' ),
				),

				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur blob 2 (milieu)', 'salient-ui' ),
					'param_name'  => 'blob_color2',
					'value'       => 'rgba(0, 0, 255, 0.5)',
					'description' => __( 'Couleur intermédiaire du blob', 'salient-ui' ),
					'group'       => __( 'Blob Lumineux', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Couleur ombre du blob', 'salient-ui' ),
					'param_name'  => 'blob_shadow_color',
					'value'       => 'rgba(0, 81, 255, 0.18)',
					'description' => __( 'Couleur de l\'ombre du blob (rgba)', 'salient-ui' ),
					'group'       => __( 'Blob Lumineux', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Intensité ombre blob', 'salient-ui' ),
					'param_name'  => 'blob_shadow_blur',
					'value'       => '30px',
					'description' => __( 'Flou de l\'ombre (ex: 30px)', 'salient-ui' ),
					'group'       => __( 'Blob Lumineux', 'salient-ui' ),
				),

				// === OVERLAY INTERNE ===
				array(
					'type'       => 'dropdown',
					'heading'    => __( 'Overlay Interne', 'salient-ui' ),
					'param_name' => 'overlay_separator',
					'value'      => array( '' => '' ),
					'group'      => __( 'Overlay Interne', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Taille du cercle radial overlay', 'salient-ui' ),
					'param_name'  => 'overlay_gradient_size',
					'value'       => '60px',
					'description' => __( 'Taille du cercle (ex: 60px)', 'salient-ui' ),
					'group'       => __( 'Overlay Interne', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Couleur overlay 1', 'salient-ui' ),
					'param_name'  => 'overlay_color1',
					'value'       => 'rgba(0, 225, 255, 0.1)',
					'description' => __( 'Couleur centrale overlay (rgba)', 'salient-ui' ),
					'group'       => __( 'Overlay Interne', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Couleur overlay 2', 'salient-ui' ),
					'param_name'  => 'overlay_color2',
					'value'       => 'rgba(0, 0, 255, 0.07)',
					'description' => __( 'Couleur intermédiaire overlay (rgba)', 'salient-ui' ),
					'group'       => __( 'Overlay Interne', 'salient-ui' ),
				),

				// === EFFET DE LUMIÈRE ===
				array(
					'type'       => 'dropdown',
					'heading'    => __( 'Effet de Lumière', 'salient-ui' ),
					'param_name' => 'glow_separator',
					'value'      => array( '' => '' ),
					'group'      => __( 'Effet de Lumière', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Largeur de la lumière', 'salient-ui' ),
					'param_name'  => 'glow_width',
					'value'       => '65%',
					'description' => __( 'Largeur de l\'effet de lumière (ex: 65%)', 'salient-ui' ),
					'group'       => __( 'Effet de Lumière', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Hauteur de la lumière', 'salient-ui' ),
					'param_name'  => 'glow_height',
					'value'       => '60%',
					'description' => __( 'Hauteur de l\'effet de lumière (ex: 60%)', 'salient-ui' ),
					'group'       => __( 'Effet de Lumière', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Rayon de bordure lumière', 'salient-ui' ),
					'param_name'  => 'glow_border_radius',
					'value'       => '120px',
					'description' => __( 'Rayon de bordure de la lumière (ex: 120px)', 'salient-ui' ),
					'group'       => __( 'Effet de Lumière', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Couleur ombre lumière', 'salient-ui' ),
					'param_name'  => 'glow_shadow_color',
					'value'       => 'rgba(255, 255, 255, 0.22)',
					'description' => __( 'Couleur de l\'ombre lumineuse (rgba)', 'salient-ui' ),
					'group'       => __( 'Effet de Lumière', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Intensité ombre lumière', 'salient-ui' ),
					'param_name'  => 'glow_shadow_blur',
					'value'       => '20px',
					'description' => __( 'Flou de l\'ombre lumineuse (ex: 20px)', 'salient-ui' ),
					'group'       => __( 'Effet de Lumière', 'salient-ui' ),
				),

				// Classe CSS personnalisée
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Classe CSS supplémentaire', 'salient-ui' ),
					'param_name'  => 'el_class',
					'value'       => '',
					'description' => __( 'Classe CSS personnalisée', 'salient-ui' ),
					'group'       => __( 'Style Général', 'salient-ui' ),
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
				'text'                   => 'Realism',
				'link'                   => '',
				'font_size'              => '1.4rem',
				'font_weight'            => '400',
				'border_radius_outer'    => '16px',
				'border_radius_inner'    => '14px',
				'padding'                => '14px 25px',
				'text_color'             => '#ffffff',
				'gradient_outer_size'    => '80px',
				'gradient_outer_x'       => '80%',
				'gradient_outer_y'       => '-10%',
				'gradient_outer_color1'  => '#ffffff',
				'gradient_outer_color2'  => '#181b1b',
				'gradient_inner_size'    => '80px',
				'gradient_inner_x'       => '80%',
				'gradient_inner_y'       => '-50%',
				'gradient_inner_color1'  => '#777777',
				'gradient_inner_color2'  => '#0f1111',
				'blob_width'             => '70px',
				'blob_gradient_size'     => '60px',
				'blob_color1'            => '#3fe9ff',
				'blob_color2'            => 'rgba(0, 0, 255, 0.5)',
				'blob_shadow_color'      => 'rgba(0, 81, 255, 0.18)',
				'blob_shadow_blur'       => '30px',
				'overlay_gradient_size'  => '60px',
				'overlay_color1'         => 'rgba(0, 225, 255, 0.1)',
				'overlay_color2'         => 'rgba(0, 0, 255, 0.07)',
				'glow_width'             => '65%',
				'glow_height'            => '60%',
				'glow_border_radius'     => '120px',
				'glow_shadow_color'      => 'rgba(255, 255, 255, 0.22)',
				'glow_shadow_blur'       => '20px',
				'el_class'               => '',
			),
			$atts,
			$this->get_shortcode_tag()
		);

		// Parser le lien
		$link_data = $this->parse_vc_link( $atts['link'] );

		// Déterminer la balise HTML
		$tag = ! empty( $link_data['url'] ) ? 'a' : 'button';

		// Générer un ID unique pour les styles inline
		$unique_id = 'sui-rb-' . uniqid();

		// Construire les classes CSS
		$classes = array(
			'salient-ui-rb-button',
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
			'realism-button',
			array(
				'text'     => $atts['text'],
				'tag'      => $tag,
				'href'     => $link_data['url'],
				'target'   => $link_data['target'],
				'title'    => $link_data['title'],
				'classes'  => $this->build_classes( $classes ),
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

		// Variables CSS personnalisées
		$styles .= ".{$unique_id} {";
		$styles .= "--sui-rb-font-size: {$atts['font_size']};";
		$styles .= "--sui-rb-font-weight: {$atts['font_weight']};";
		$styles .= "--sui-rb-border-radius-outer: {$atts['border_radius_outer']};";
		$styles .= "--sui-rb-border-radius-inner: {$atts['border_radius_inner']};";
		$styles .= "--sui-rb-padding: {$atts['padding']};";
		$styles .= "--sui-rb-text-color: {$atts['text_color']};";
		$styles .= "}";

		// Gradient externe (fond du bouton)
		$styles .= ".{$unique_id} {";
		$styles .= "background: radial-gradient(";
		$styles .= "circle {$atts['gradient_outer_size']} at {$atts['gradient_outer_x']} {$atts['gradient_outer_y']}, ";
		$styles .= "{$atts['gradient_outer_color1']}, ";
		$styles .= "{$atts['gradient_outer_color2']}";
		$styles .= ");";
		$styles .= "}";

		// Gradient interne (inner)
		$styles .= ".{$unique_id} .salient-ui-rb-inner {";
		$styles .= "background: radial-gradient(";
		$styles .= "circle {$atts['gradient_inner_size']} at {$atts['gradient_inner_x']} {$atts['gradient_inner_y']}, ";
		$styles .= "{$atts['gradient_inner_color1']}, ";
		$styles .= "{$atts['gradient_inner_color2']}";
		$styles .= ");";
		$styles .= "}";

		// Blob
		$styles .= ".{$unique_id} .salient-ui-rb-blob {";
		$styles .= "width: {$atts['blob_width']};";
		$styles .= "background: radial-gradient(";
		$styles .= "circle {$atts['blob_gradient_size']} at 0% 100%, ";
		$styles .= "{$atts['blob_color1']}, ";
		$styles .= "{$atts['blob_color2']}, ";
		$styles .= "transparent";
		$styles .= ");";
		$styles .= "box-shadow: -10px 10px {$atts['blob_shadow_blur']} {$atts['blob_shadow_color']};";
		$styles .= "}";

		// Overlay interne
		$styles .= ".{$unique_id} .salient-ui-rb-inner::before {";
		$styles .= "background: radial-gradient(";
		$styles .= "circle {$atts['overlay_gradient_size']} at 0% 100%, ";
		$styles .= "{$atts['overlay_color1']}, ";
		$styles .= "{$atts['overlay_color2']}, ";
		$styles .= "transparent";
		$styles .= ");";
		$styles .= "}";

		// Effet de lumière (::after)
		$styles .= ".{$unique_id}::after {";
		$styles .= "width: {$atts['glow_width']};";
		$styles .= "height: {$atts['glow_height']};";
		$styles .= "border-radius: {$atts['glow_border_radius']};";
		$styles .= "box-shadow: 0 0 {$atts['glow_shadow_blur']} {$atts['glow_shadow_color']};";
		$styles .= "}";

		$styles .= "</style>";

		return $styles;
	}
}