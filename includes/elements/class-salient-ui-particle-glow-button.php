<?php
/**
 * Élément Particle Glow Button pour WPBakery Page Builder
 * Bouton avec particules animées et effet de lueur
 *
 * @package SalientUI
 * @since 1.0.0
 */

// Si ce fichier est appelé directement, on arrête l'exécution
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Salient_UI_Particle_Glow_Button
 *
 * Élément WPBakery pour afficher un bouton avec particules luminescentes
 */
class Salient_UI_Particle_Glow_Button extends Salient_UI_Element_Base {

	/**
	 * Obtenir le tag du shortcode
	 *
	 * @return string Tag du shortcode
	 */
	protected function get_shortcode_tag() {
		return 'salient_ui_particle_glow_button';
	}

	/**
	 * Obtenir le slug de l'élément (pour les assets CSS/JS)
	 *
	 * @return string Slug de l'élément
	 */
	protected function get_element_slug() {
		return 'particle-glow-button';
	}

	/**
	 * Obtenir la configuration WPBakery pour cet élément
	 *
	 * @return array Configuration de l'élément pour vc_map()
	 */
	protected function get_vc_config() {
		return array(
			'name'        => __( 'Particle Glow Button', 'salient-ui' ),
			'base'        => $this->get_shortcode_tag(),
			'category'    => __( 'SalientUI', 'salient-ui' ),
			'icon'        => SALIENT_UI_URL . 'assets/images/icon-particle-glow-button.svg',
			'description' => __( 'Bouton avec particules animées et effet de lueur radiale', 'salient-ui' ),
			'params'      => array(
				// === CONTENU ===
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Texte du bouton', 'salient-ui' ),
					'param_name'  => 'text',
					'value'       => 'UIVERSE',
					'description' => __( 'Texte affiché sur le bouton', 'salient-ui' ),
					'admin_label' => true,
				),

				array(
					'type'        => 'vc_link',
					'heading'     => __( 'Lien', 'salient-ui' ),
					'param_name'  => 'link',
					'description' => __( 'URL du lien du bouton', 'salient-ui' ),
				),

				// === STYLE GÉNÉRAL ===
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
						__( 'Normal', 'salient-ui' )    => '400',
						__( 'Medium', 'salient-ui' )    => '500',
						__( 'Semi-Bold', 'salient-ui' ) => '600',
						__( 'Bold', 'salient-ui' )      => '700',
					),
					'std'         => '600',
					'group'       => __( 'Style', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Espacement des lettres', 'salient-ui' ),
					'param_name'  => 'letter_spacing',
					'value'       => '0.02em',
					'description' => __( 'Espacement entre les lettres (ex: 0.02em)', 'salient-ui' ),
					'group'       => __( 'Style', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Rayon de bordure', 'salient-ui' ),
					'param_name'  => 'border_radius',
					'value'       => '24px',
					'description' => __( 'Rayon de bordure (ex: 24px)', 'salient-ui' ),
					'group'       => __( 'Style', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Largeur minimale', 'salient-ui' ),
					'param_name'  => 'min_width',
					'value'       => '132px',
					'description' => __( 'Largeur minimale du bouton (ex: 132px)', 'salient-ui' ),
					'group'       => __( 'Style', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Padding vertical', 'salient-ui' ),
					'param_name'  => 'padding_vertical',
					'value'       => '12px',
					'description' => __( 'Padding haut/bas (ex: 12px)', 'salient-ui' ),
					'group'       => __( 'Style', 'salient-ui' ),
				),

				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur du texte', 'salient-ui' ),
					'param_name'  => 'text_color',
					'value'       => '#ffffff',
					'description' => __( 'Couleur du texte', 'salient-ui' ),
					'group'       => __( 'Style', 'salient-ui' ),
				),

				// === GRADIENT RADIAL ===
				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur gradient centre', 'salient-ui' ),
					'param_name'  => 'radial_inner',
					'value'       => '#ffd215',
					'description' => __( 'Couleur au centre du gradient', 'salient-ui' ),
					'group'       => __( 'Gradient', 'salient-ui' ),
				),

				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur gradient extérieur', 'salient-ui' ),
					'param_name'  => 'radial_outer',
					'value'       => '#fff172',
					'description' => __( 'Couleur extérieure du gradient', 'salient-ui' ),
					'group'       => __( 'Gradient', 'salient-ui' ),
				),

				// === OMBRES ===
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Couleur ombre externe', 'salient-ui' ),
					'param_name'  => 'shadow_color',
					'value'       => 'rgba(255, 223, 87, 0.5)',
					'description' => __( 'Couleur de l\'ombre externe (rgba)', 'salient-ui' ),
					'group'       => __( 'Ombres', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Intensité ombre externe', 'salient-ui' ),
					'param_name'  => 'shadow_blur',
					'value'       => '14px',
					'description' => __( 'Flou de l\'ombre externe (ex: 14px)', 'salient-ui' ),
					'group'       => __( 'Ombres', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Couleur ombre interne haut', 'salient-ui' ),
					'param_name'  => 'shadow_inset_top',
					'value'       => 'rgba(255, 223, 52, 0.9)',
					'description' => __( 'Couleur de l\'ombre interne du haut (rgba)', 'salient-ui' ),
					'group'       => __( 'Ombres', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Couleur ombre interne bas', 'salient-ui' ),
					'param_name'  => 'shadow_inset_bottom',
					'value'       => 'rgba(255, 250, 215, 0.8)',
					'description' => __( 'Couleur de l\'ombre interne du bas (rgba)', 'salient-ui' ),
					'group'       => __( 'Ombres', 'salient-ui' ),
				),

				// === COULEURS DES PARTICULES ===
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Couleur particule 1 (Orange)', 'salient-ui' ),
					'param_name'  => 'particle_color_1',
					'value'       => 'rgba(255, 163, 26, 0.7)',
					'description' => __( 'Couleur des particules 1, 2, 7, 8, 11, 12', 'salient-ui' ),
					'group'       => __( 'Particules', 'salient-ui' ),
				),

				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur particule 2 (Bleu)', 'salient-ui' ),
					'param_name'  => 'particle_color_2',
					'value'       => '#1a23ff',
					'description' => __( 'Couleur des particules 3, 4', 'salient-ui' ),
					'group'       => __( 'Particules', 'salient-ui' ),
				),

				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur particule 3 (Magenta)', 'salient-ui' ),
					'param_name'  => 'particle_color_3',
					'value'       => '#e21bda',
					'description' => __( 'Couleur des particules 5, 6', 'salient-ui' ),
					'group'       => __( 'Particules', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Couleur particule 4 (Jaune)', 'salient-ui' ),
					'param_name'  => 'particle_color_4',
					'value'       => 'rgba(255, 232, 26, 0.7)',
					'description' => __( 'Couleur des particules 1, 9, 10', 'salient-ui' ),
					'group'       => __( 'Particules', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Taille des particules', 'salient-ui' ),
					'param_name'  => 'particle_size',
					'value'       => '40px',
					'description' => __( 'Taille des cercles (ex: 40px)', 'salient-ui' ),
					'group'       => __( 'Particules', 'salient-ui' ),
				),

				// === ANIMATION ===
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Durée animation (normal)', 'salient-ui' ),
					'param_name'  => 'animation_duration',
					'value'       => '7s',
					'description' => __( 'Durée de l\'animation au repos (ex: 7s)', 'salient-ui' ),
					'group'       => __( 'Animation', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Durée animation (hover)', 'salient-ui' ),
					'param_name'  => 'animation_duration_hover',
					'value'       => '1400ms',
					'description' => __( 'Durée de l\'animation au survol (ex: 1400ms)', 'salient-ui' ),
					'group'       => __( 'Animation', 'salient-ui' ),
				),

				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Type d\'animation', 'salient-ui' ),
					'param_name'  => 'animation_easing',
					'value'       => array(
						__( 'Linear', 'salient-ui' )         => 'linear',
						__( 'Ease', 'salient-ui' )           => 'ease',
						__( 'Ease In', 'salient-ui' )        => 'ease-in',
						__( 'Ease Out', 'salient-ui' )       => 'ease-out',
						__( 'Ease In Out', 'salient-ui' )    => 'ease-in-out',
					),
					'std'         => 'linear',
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
				'text'                     => 'UIVERSE',
				'link'                     => '',
				'font_size'                => '16px',
				'font_weight'              => '600',
				'letter_spacing'           => '0.02em',
				'border_radius'            => '24px',
				'min_width'                => '132px',
				'padding_vertical'         => '12px',
				'text_color'               => '#ffffff',
				'radial_inner'             => '#ffd215',
				'radial_outer'             => '#fff172',
				'shadow_color'             => 'rgba(255, 223, 87, 0.5)',
				'shadow_blur'              => '14px',
				'shadow_inset_top'         => 'rgba(255, 223, 52, 0.9)',
				'shadow_inset_bottom'      => 'rgba(255, 250, 215, 0.8)',
				'particle_color_1'         => 'rgba(255, 163, 26, 0.7)',
				'particle_color_2'         => '#1a23ff',
				'particle_color_3'         => '#e21bda',
				'particle_color_4'         => 'rgba(255, 232, 26, 0.7)',
				'particle_size'            => '40px',
				'animation_duration'       => '7s',
				'animation_duration_hover' => '1400ms',
				'animation_easing'         => 'linear',
				'el_class'                 => '',
			),
			$atts,
			$this->get_shortcode_tag()
		);

		// Parser le lien
		$link_data = $this->parse_vc_link( $atts['link'] );

		// Déterminer la balise HTML
		$tag = ! empty( $link_data['url'] ) ? 'a' : 'button';

		// Générer un ID unique pour les styles inline
		$unique_id = 'sui-pgb-' . uniqid();

		// Construire les classes CSS
		$classes = array(
			'salient-ui-pgb-button',
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
			'particle-glow-button',
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
		$styles .= "--sui-pgb-duration: {$atts['animation_duration']};";
		$styles .= "--sui-pgb-easing: {$atts['animation_easing']};";
		$styles .= "--sui-pgb-c-color-1: {$atts['particle_color_1']};";
		$styles .= "--sui-pgb-c-color-2: {$atts['particle_color_2']};";
		$styles .= "--sui-pgb-c-color-3: {$atts['particle_color_3']};";
		$styles .= "--sui-pgb-c-color-4: {$atts['particle_color_4']};";
		$styles .= "--sui-pgb-c-shadow: {$atts['shadow_color']};";
		$styles .= "--sui-pgb-c-shadow-inset-top: {$atts['shadow_inset_top']};";
		$styles .= "--sui-pgb-c-shadow-inset-bottom: {$atts['shadow_inset_bottom']};";
		$styles .= "--sui-pgb-c-radial-inner: {$atts['radial_inner']};";
		$styles .= "--sui-pgb-c-radial-outer: {$atts['radial_outer']};";
		$styles .= "--sui-pgb-c-color: {$atts['text_color']};";
		$styles .= "--sui-pgb-font-size: {$atts['font_size']};";
		$styles .= "--sui-pgb-font-weight: {$atts['font_weight']};";
		$styles .= "--sui-pgb-letter-spacing: {$atts['letter_spacing']};";
		$styles .= "--sui-pgb-border-radius: {$atts['border_radius']};";
		$styles .= "--sui-pgb-min-width: {$atts['min_width']};";
		$styles .= "--sui-pgb-padding-vertical: {$atts['padding_vertical']};";
		$styles .= "--sui-pgb-particle-size: {$atts['particle_size']};";
		$styles .= "--sui-pgb-shadow-blur: {$atts['shadow_blur']};";
		$styles .= "}";

		// Hover duration
		$styles .= ".{$unique_id}:hover {";
		$styles .= "--sui-pgb-duration: {$atts['animation_duration_hover']};";
		$styles .= "}";

		$styles .= "</style>";

		return $styles;
	}
}