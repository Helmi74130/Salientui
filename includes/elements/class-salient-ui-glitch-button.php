<?php
/**
 * Élément Glitch Button pour WPBakery Page Builder
 * Bouton avec effet de caractères glitch au survol
 *
 * @package SalientUI
 * @since 1.0.0
 */

// Si ce fichier est appelé directement, on arrête l'exécution
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Salient_UI_Glitch_Button
 *
 * Élément WPBakery pour afficher un bouton avec effet glitch
 */
class Salient_UI_Glitch_Button extends Salient_UI_Element_Base {

	/**
	 * Obtenir le tag du shortcode
	 *
	 * @return string Tag du shortcode
	 */
	protected function get_shortcode_tag() {
		return 'salient_ui_glitch_button';
	}

	/**
	 * Obtenir le slug de l'élément (pour les assets CSS/JS)
	 *
	 * @return string Slug de l'élément
	 */
	protected function get_element_slug() {
		return 'glitch-button';
	}

	/**
	 * Obtenir la configuration WPBakery pour cet élément
	 *
	 * @return array Configuration de l'élément pour vc_map()
	 */
	protected function get_vc_config() {
		return array(
			'name'        => __( 'Glitch Button', 'salient-ui' ),
			'base'        => $this->get_shortcode_tag(),
			'category'    => __( 'SalientUI', 'salient-ui' ),
			'icon'        => SALIENT_UI_URL . 'assets/images/icon-glitch-button.svg',
			'description' => __( 'Bouton avec effet de caractères glitch animés au survol', 'salient-ui' ),
			'params'      => array(
				// === CONTENU ===
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Texte du bouton', 'salient-ui' ),
					'param_name'  => 'text',
					'value'       => 'Button',
					'description' => __( 'Texte affiché sur le bouton', 'salient-ui' ),
					'admin_label' => true,
				),

				array(
					'type'        => 'vc_link',
					'heading'     => __( 'Lien', 'salient-ui' ),
					'param_name'  => 'link',
					'description' => __( 'URL du lien du bouton', 'salient-ui' ),
				),

				// === STYLE ===
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Taille de police', 'salient-ui' ),
					'param_name'  => 'font_size',
					'value'       => '16px',
					'description' => __( 'Taille de la police (ex: 16px)', 'salient-ui' ),
					'group'       => __( 'Style', 'salient-ui' ),
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
					'std'         => '600',
					'group'       => __( 'Style', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Padding', 'salient-ui' ),
					'param_name'  => 'padding',
					'value'       => '15px 20px',
					'description' => __( 'Padding du bouton (ex: 15px 20px)', 'salient-ui' ),
					'group'       => __( 'Style', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Espacement des lettres', 'salient-ui' ),
					'param_name'  => 'letter_spacing',
					'value'       => '0.1rem',
					'description' => __( 'Espacement entre les lettres (ex: 0.1rem)', 'salient-ui' ),
					'group'       => __( 'Style', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Rayon de bordure', 'salient-ui' ),
					'param_name'  => 'border_radius',
					'value'       => '0px',
					'description' => __( 'Rayon de bordure (ex: 0px ou 8px)', 'salient-ui' ),
					'group'       => __( 'Style', 'salient-ui' ),
				),

				// === COULEURS ===
				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur de fond', 'salient-ui' ),
					'param_name'  => 'bg_color',
					'value'       => '#292929',
					'description' => __( 'Couleur de fond du bouton', 'salient-ui' ),
					'group'       => __( 'Couleurs', 'salient-ui' ),
				),

				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur de fond (hover)', 'salient-ui' ),
					'param_name'  => 'bg_color_hover',
					'value'       => '#333333',
					'description' => __( 'Couleur de fond au survol', 'salient-ui' ),
					'group'       => __( 'Couleurs', 'salient-ui' ),
				),

				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur du texte', 'salient-ui' ),
					'param_name'  => 'text_color',
					'value'       => '#ffffff',
					'description' => __( 'Couleur du texte au repos', 'salient-ui' ),
					'group'       => __( 'Couleurs', 'salient-ui' ),
				),

				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur du texte (hover)', 'salient-ui' ),
					'param_name'  => 'text_color_hover',
					'value'       => '#FAC921',
					'description' => __( 'Couleur du texte au survol', 'salient-ui' ),
					'group'       => __( 'Couleurs', 'salient-ui' ),
				),

				// === OMBRE ===
				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur de l\'ombre', 'salient-ui' ),
					'param_name'  => 'shadow_color',
					'value'       => 'rgba(0, 0, 0, 0.137)',
					'description' => __( 'Couleur de l\'ombre portée', 'salient-ui' ),
					'group'       => __( 'Ombre', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Offset horizontal ombre', 'salient-ui' ),
					'param_name'  => 'shadow_x',
					'value'       => '0',
					'description' => __( 'Décalage horizontal (ex: 0)', 'salient-ui' ),
					'group'       => __( 'Ombre', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Offset vertical ombre', 'salient-ui' ),
					'param_name'  => 'shadow_y',
					'value'       => '2px',
					'description' => __( 'Décalage vertical (ex: 2px)', 'salient-ui' ),
					'group'       => __( 'Ombre', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Flou de l\'ombre', 'salient-ui' ),
					'param_name'  => 'shadow_blur',
					'value'       => '10px',
					'description' => __( 'Intensité du flou (ex: 10px)', 'salient-ui' ),
					'group'       => __( 'Ombre', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Spread de l\'ombre', 'salient-ui' ),
					'param_name'  => 'shadow_spread',
					'value'       => '0',
					'description' => __( 'Étendue de l\'ombre (ex: 0)', 'salient-ui' ),
					'group'       => __( 'Ombre', 'salient-ui' ),
				),

				// === ANIMATION ===
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Durée de transition', 'salient-ui' ),
					'param_name'  => 'transition_duration',
					'value'       => '0.3s',
					'description' => __( 'Durée des transitions (ex: 0.3s)', 'salient-ui' ),
					'group'       => __( 'Animation', 'salient-ui' ),
				),

				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Type de transition', 'salient-ui' ),
					'param_name'  => 'transition_easing',
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

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Durée animation glitch', 'salient-ui' ),
					'param_name'  => 'animation_duration',
					'value'       => '1.2s',
					'description' => __( 'Durée de l\'animation glitch (ex: 1.2s)', 'salient-ui' ),
					'group'       => __( 'Animation', 'salient-ui' ),
				),

				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Type animation glitch', 'salient-ui' ),
					'param_name'  => 'animation_easing',
					'value'       => array(
						__( 'Linear', 'salient-ui' )      => 'linear',
						__( 'Ease', 'salient-ui' )        => 'ease',
						__( 'Ease In', 'salient-ui' )     => 'ease-in',
						__( 'Ease Out', 'salient-ui' )    => 'ease-out',
						__( 'Ease In Out', 'salient-ui' ) => 'ease-in-out',
					),
					'std'         => 'linear',
					'group'       => __( 'Animation', 'salient-ui' ),
				),

				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Mode animation', 'salient-ui' ),
					'param_name'  => 'animation_mode',
					'value'       => array(
						__( 'Both (avant et arrière)', 'salient-ui' ) => 'both',
						__( 'Forwards (avant)', 'salient-ui' )        => 'forwards',
						__( 'Backwards (arrière)', 'salient-ui' )     => 'backwards',
						__( 'None', 'salient-ui' )                    => 'none',
					),
					'std'         => 'both',
					'group'       => __( 'Animation', 'salient-ui' ),
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
				'text'                => 'Button',
				'link'                => '',
				'font_size'           => '16px',
				'font_weight'         => '600',
				'padding'             => '15px 20px',
				'letter_spacing'      => '0.1rem',
				'border_radius'       => '0px',
				'bg_color'            => '#292929',
				'bg_color_hover'      => '#333333',
				'text_color'          => '#ffffff',
				'text_color_hover'    => '#FAC921',
				'shadow_color'        => 'rgba(0, 0, 0, 0.137)',
				'shadow_x'            => '0',
				'shadow_y'            => '2px',
				'shadow_blur'         => '10px',
				'shadow_spread'       => '0',
				'transition_duration' => '0.3s',
				'transition_easing'   => 'ease',
				'animation_duration'  => '1.2s',
				'animation_easing'    => 'linear',
				'animation_mode'      => 'both',
				'el_class'            => '',
			),
			$atts,
			$this->get_shortcode_tag()
		);

		// Parser le lien
		$link_data = $this->parse_vc_link( $atts['link'] );

		// Déterminer la balise HTML
		$tag = ! empty( $link_data['url'] ) ? 'a' : 'button';

		// Générer un ID unique pour les styles inline
		$unique_id = 'sui-gb-' . uniqid();

		// Construire les classes CSS
		$classes = array(
			'salient-ui-gb-button',
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
			'glitch-button',
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
		$styles .= "--sui-gb-bg-default: {$atts['bg_color']};";
		$styles .= "--sui-gb-padding: {$atts['padding']};";
		$styles .= "--sui-gb-bg-hover: {$atts['bg_color_hover']};";
		$styles .= "--sui-gb-transition: {$atts['transition_duration']} {$atts['transition_easing']};";
		$styles .= "--sui-gb-letter-spacing: {$atts['letter_spacing']};";
		$styles .= "--sui-gb-animation-duration: {$atts['animation_duration']};";
		$styles .= "--sui-gb-animation-easing: {$atts['animation_easing']};";
		$styles .= "--sui-gb-animation-mode: {$atts['animation_mode']};";
		$styles .= "--sui-gb-shadow-color: {$atts['shadow_color']};";
		$styles .= "--sui-gb-shadow: {$atts['shadow_x']} {$atts['shadow_y']} {$atts['shadow_blur']} {$atts['shadow_spread']} var(--sui-gb-shadow-color);";
		$styles .= "--sui-gb-text-color-default: {$atts['text_color']};";
		$styles .= "--sui-gb-text-color-hover: {$atts['text_color_hover']};";
		$styles .= "--sui-gb-font-size: {$atts['font_size']};";
		$styles .= "--sui-gb-font-weight: {$atts['font_weight']};";
		$styles .= "--sui-gb-border-radius: {$atts['border_radius']};";
		$styles .= "}";

		$styles .= "</style>";

		return $styles;
	}
}