<?php
/**
 * Élément Dual Text Button pour WPBakery Page Builder
 * Bouton avec deux textes qui s'échangent verticalement au survol
 *
 * @package SalientUI
 * @since 1.0.0
 */

// Si ce fichier est appelé directement, on arrête l'exécution
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Salient_UI_Dual_Text_Button
 *
 * Élément WPBakery pour afficher un bouton avec effet de texte dual
 */
class Salient_UI_Dual_Text_Button extends Salient_UI_Element_Base {

	/**
	 * Obtenir le tag du shortcode
	 *
	 * @return string Tag du shortcode
	 */
	protected function get_shortcode_tag() {
		return 'salient_ui_dual_text_button';
	}

	/**
	 * Obtenir le slug de l'élément (pour les assets CSS/JS)
	 *
	 * @return string Slug de l'élément
	 */
	protected function get_element_slug() {
		return 'dual-text-button';
	}

	/**
	 * Obtenir la configuration WPBakery pour cet élément
	 *
	 * @return array Configuration de l'élément pour vc_map()
	 */
	protected function get_vc_config() {
		return array(
			'name'        => __( 'Dual Text Button', 'salient-ui' ),
			'base'        => $this->get_shortcode_tag(),
			'category'    => __( 'SalientUI', 'salient-ui' ),
			'icon'        => SALIENT_UI_URL . 'assets/images/icon-dual-text-button.svg',
			'description' => __( 'Bouton avec deux textes qui s\'échangent verticalement au survol', 'salient-ui' ),
			'params'      => array(
				// === CONTENU ===
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Texte principal (repos)', 'salient-ui' ),
					'param_name'  => 'text_one',
					'value'       => 'Hover me',
					'description' => __( 'Texte affiché au repos', 'salient-ui' ),
					'admin_label' => true,
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Texte secondaire (hover)', 'salient-ui' ),
					'param_name'  => 'text_two',
					'value'       => 'Great!',
					'description' => __( 'Texte affiché au survol', 'salient-ui' ),
					'admin_label' => true,
				),

				array(
					'type'        => 'vc_link',
					'heading'     => __( 'Lien', 'salient-ui' ),
					'param_name'  => 'link',
					'description' => __( 'URL du lien du bouton', 'salient-ui' ),
				),

				// === DIMENSIONS ===
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Largeur', 'salient-ui' ),
					'param_name'  => 'width',
					'value'       => '140px',
					'description' => __( 'Largeur du bouton (ex: 140px)', 'salient-ui' ),
					'group'       => __( 'Dimensions', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Hauteur', 'salient-ui' ),
					'param_name'  => 'height',
					'value'       => '50px',
					'description' => __( 'Hauteur du bouton (ex: 50px)', 'salient-ui' ),
					'group'       => __( 'Dimensions', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Rayon de bordure', 'salient-ui' ),
					'param_name'  => 'border_radius',
					'value'       => '50px',
					'description' => __( 'Rayon de bordure (ex: 50px)', 'salient-ui' ),
					'group'       => __( 'Dimensions', 'salient-ui' ),
				),

				// === STYLE TEXTE ===
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Taille de police', 'salient-ui' ),
					'param_name'  => 'font_size',
					'value'       => '12px',
					'description' => __( 'Taille de la police (ex: 12px)', 'salient-ui' ),
					'group'       => __( 'Style Texte', 'salient-ui' ),
				),

				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Graisse de police', 'salient-ui' ),
					'param_name'  => 'font_weight',
					'value'       => array(
						__( 'Normal', 'salient-ui' )       => '400',
						__( 'Medium', 'salient-ui' )       => '500',
						__( 'Semi-Bold', 'salient-ui' )    => '600',
						__( 'Bold', 'salient-ui' )         => '700',
						__( 'Extra-Bold', 'salient-ui' )   => '800',
					),
					'std'         => '400',
					'group'       => __( 'Style Texte', 'salient-ui' ),
				),

				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Transformation du texte', 'salient-ui' ),
					'param_name'  => 'text_transform',
					'value'       => array(
						__( 'Majuscules', 'salient-ui' )     => 'uppercase',
						__( 'Aucune', 'salient-ui' )         => 'none',
						__( 'Minuscules', 'salient-ui' )     => 'lowercase',
						__( 'Capitaliser', 'salient-ui' )    => 'capitalize',
					),
					'std'         => 'uppercase',
					'group'       => __( 'Style Texte', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Espacement des lettres', 'salient-ui' ),
					'param_name'  => 'letter_spacing',
					'value'       => '1px',
					'description' => __( 'Espacement entre les lettres (ex: 1px)', 'salient-ui' ),
					'group'       => __( 'Style Texte', 'salient-ui' ),
				),

				// === COULEURS ===
				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur gradient - Haut', 'salient-ui' ),
					'param_name'  => 'gradient_color_top',
					'value'       => '#00154c',
					'description' => __( 'Couleur en haut du gradient', 'salient-ui' ),
					'group'       => __( 'Couleurs', 'salient-ui' ),
				),

				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur gradient - Milieu', 'salient-ui' ),
					'param_name'  => 'gradient_color_middle',
					'value'       => '#12376e',
					'description' => __( 'Couleur au milieu du gradient', 'salient-ui' ),
					'group'       => __( 'Couleurs', 'salient-ui' ),
				),

				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur gradient - Bas', 'salient-ui' ),
					'param_name'  => 'gradient_color_bottom',
					'value'       => '#23487f',
					'description' => __( 'Couleur en bas du gradient', 'salient-ui' ),
					'group'       => __( 'Couleurs', 'salient-ui' ),
				),

				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur du texte', 'salient-ui' ),
					'param_name'  => 'text_color',
					'value'       => '#ffffff',
					'description' => __( 'Couleur du texte', 'salient-ui' ),
					'group'       => __( 'Couleurs', 'salient-ui' ),
				),

				// === OMBRE ===
				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur de l\'ombre', 'salient-ui' ),
					'param_name'  => 'shadow_color',
					'value'       => 'rgba(0, 0, 0, 0.5)',
					'description' => __( 'Couleur de l\'ombre portée', 'salient-ui' ),
					'group'       => __( 'Ombre', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Offset vertical ombre', 'salient-ui' ),
					'param_name'  => 'shadow_y',
					'value'       => '15px',
					'description' => __( 'Décalage vertical de l\'ombre (ex: 15px)', 'salient-ui' ),
					'group'       => __( 'Ombre', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Flou de l\'ombre', 'salient-ui' ),
					'param_name'  => 'shadow_blur',
					'value'       => '30px',
					'description' => __( 'Intensité du flou (ex: 30px)', 'salient-ui' ),
					'group'       => __( 'Ombre', 'salient-ui' ),
				),

				// === ANIMATION ===
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Durée de l\'animation', 'salient-ui' ),
					'param_name'  => 'transition_duration',
					'value'       => '0.5s',
					'description' => __( 'Durée de la transition (ex: 0.5s)', 'salient-ui' ),
					'group'       => __( 'Animation', 'salient-ui' ),
				),

				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Type de transition', 'salient-ui' ),
					'param_name'  => 'transition_timing',
					'value'       => array(
						__( 'Ease', 'salient-ui' )        => 'ease',
						__( 'Linear', 'salient-ui' )      => 'linear',
						__( 'Ease In', 'salient-ui' )     => 'ease-in',
						__( 'Ease Out', 'salient-ui' )    => 'ease-out',
						__( 'Ease In Out', 'salient-ui' ) => 'ease-in-out',
					),
					'std'         => 'ease',
					'group'       => __( 'Animation', 'salient-ui' ),
				),

				// Classe CSS personnalisée
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Classe CSS supplémentaire', 'salient-ui' ),
					'param_name'  => 'el_class',
					'value'       => '',
					'description' => __( 'Classe CSS personnalisée', 'salient-ui' ),
					'group'       => __( 'Dimensions', 'salient-ui' ),
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
				'text_one'              => 'Hover me',
				'text_two'              => 'Great!',
				'link'                  => '',
				'width'                 => '140px',
				'height'                => '50px',
				'border_radius'         => '50px',
				'font_size'             => '12px',
				'font_weight'           => '400',
				'text_transform'        => 'uppercase',
				'letter_spacing'        => '1px',
				'gradient_color_top'    => '#00154c',
				'gradient_color_middle' => '#12376e',
				'gradient_color_bottom' => '#23487f',
				'text_color'            => '#ffffff',
				'shadow_color'          => 'rgba(0, 0, 0, 0.5)',
				'shadow_y'              => '15px',
				'shadow_blur'           => '30px',
				'transition_duration'   => '0.5s',
				'transition_timing'     => 'ease',
				'el_class'              => '',
			),
			$atts,
			$this->get_shortcode_tag()
		);

		// Parser le lien
		$link_data = $this->parse_vc_link( $atts['link'] );

		// Déterminer la balise HTML
		$tag = ! empty( $link_data['url'] ) ? 'a' : 'button';

		// Générer un ID unique pour les styles inline
		$unique_id = 'sui-dtb-' . uniqid();

		// Construire les classes CSS
		$classes = array(
			'salient-ui-dtb-button',
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
			'dual-text-button',
			array(
				'text_one' => $atts['text_one'],
				'text_two' => $atts['text_two'],
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
		$styles .= "--sui-dtb-width: {$atts['width']};";
		$styles .= "--sui-dtb-height: {$atts['height']};";
		$styles .= "--sui-dtb-border-radius: {$atts['border_radius']};";
		$styles .= "--sui-dtb-font-size: {$atts['font_size']};";
		$styles .= "--sui-dtb-font-weight: {$atts['font_weight']};";
		$styles .= "--sui-dtb-text-transform: {$atts['text_transform']};";
		$styles .= "--sui-dtb-letter-spacing: {$atts['letter_spacing']};";
		$styles .= "--sui-dtb-text-color: {$atts['text_color']};";
		$styles .= "--sui-dtb-shadow-color: {$atts['shadow_color']};";
		$styles .= "--sui-dtb-shadow-y: {$atts['shadow_y']};";
		$styles .= "--sui-dtb-shadow-blur: {$atts['shadow_blur']};";
		$styles .= "--sui-dtb-transition-duration: {$atts['transition_duration']};";
		$styles .= "--sui-dtb-transition-timing: {$atts['transition_timing']};";
		
		// Gradient
		$styles .= "background: linear-gradient(to top, ";
		$styles .= "{$atts['gradient_color_top']}, ";
		$styles .= "{$atts['gradient_color_middle']}, ";
		$styles .= "{$atts['gradient_color_bottom']}";
		$styles .= ");";
		
		$styles .= "}";

		$styles .= "</style>";

		return $styles;
	}
}