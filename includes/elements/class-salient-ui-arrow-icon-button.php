<?php
/**
 * Élément Arrow Icon Button pour WPBakery Page Builder
 * Bouton avec icône SVG flèche et animation diagonale au survol
 *
 * @package SalientUI
 * @since 1.0.0
 */

// Si ce fichier est appelé directement, on arrête l'exécution
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Salient_UI_Arrow_Icon_Button
 *
 * Élément WPBakery pour afficher un bouton avec icône flèche animée
 */
class Salient_UI_Arrow_Icon_Button extends Salient_UI_Element_Base {

	/**
	 * Obtenir le tag du shortcode
	 *
	 * @return string Tag du shortcode
	 */
	protected function get_shortcode_tag() {
		return 'salient_ui_arrow_icon_button';
	}

	/**
	 * Obtenir le slug de l'élément (pour les assets CSS/JS)
	 *
	 * @return string Slug de l'élément
	 */
	protected function get_element_slug() {
		return 'arrow-icon-button';
	}

	/**
	 * Obtenir la configuration WPBakery pour cet élément
	 *
	 * @return array Configuration de l'élément pour vc_map()
	 */
	protected function get_vc_config() {
		return array(
			'name'        => __( 'Arrow Icon Button', 'salient-ui' ),
			'base'        => $this->get_shortcode_tag(),
			'category'    => __( 'SalientUI', 'salient-ui' ),
			'icon'        => SALIENT_UI_URL . 'assets/images/icon-arrow-icon-button.svg',
			'description' => __( 'Bouton avec icône flèche SVG et animation diagonale au survol', 'salient-ui' ),
			'params'      => array(
				// === CONTENU ===
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Texte du bouton', 'salient-ui' ),
					'param_name'  => 'text',
					'value'       => 'Explore All',
					'description' => __( 'Texte affiché sur le bouton', 'salient-ui' ),
					'admin_label' => true,
				),

				array(
					'type'        => 'vc_link',
					'heading'     => __( 'Lien', 'salient-ui' ),
					'param_name'  => 'link',
					'description' => __( 'URL du lien du bouton', 'salient-ui' ),
				),

				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Afficher l\'icône', 'salient-ui' ),
					'param_name'  => 'show_icon',
					'value'       => array(
						__( 'Oui', 'salient-ui' ) => 'yes',
						__( 'Non', 'salient-ui' ) => 'no',
					),
					'std'         => 'yes',
					'description' => __( 'Afficher l\'icône flèche', 'salient-ui' ),
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
					'value'       => '0.75rem 1.5rem',
					'description' => __( 'Padding du bouton (ex: 0.75rem 1.5rem)', 'salient-ui' ),
					'group'       => __( 'Style', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Padding gauche', 'salient-ui' ),
					'param_name'  => 'padding_left',
					'value'       => '20px',
					'description' => __( 'Padding gauche spécifique (ex: 20px)', 'salient-ui' ),
					'group'       => __( 'Style', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Rayon de bordure', 'salient-ui' ),
					'param_name'  => 'border_radius',
					'value'       => '10rem',
					'description' => __( 'Rayon de bordure (ex: 10rem pour complètement arrondi)', 'salient-ui' ),
					'group'       => __( 'Style', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Espacement icône/texte', 'salient-ui' ),
					'param_name'  => 'gap',
					'value'       => '0.75rem',
					'description' => __( 'Espacement entre icône et texte (ex: 0.75rem)', 'salient-ui' ),
					'group'       => __( 'Style', 'salient-ui' ),
				),

				// === COULEURS ===
				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur principale', 'salient-ui' ),
					'param_name'  => 'primary_color',
					'value'       => '#7808d0',
					'description' => __( 'Couleur de fond du bouton', 'salient-ui' ),
					'group'       => __( 'Couleurs', 'salient-ui' ),
				),

				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur de fond (hover)', 'salient-ui' ),
					'param_name'  => 'bg_color_hover',
					'value'       => '#000000',
					'description' => __( 'Couleur de fond au survol', 'salient-ui' ),
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

				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur fond icône', 'salient-ui' ),
					'param_name'  => 'icon_bg_color',
					'value'       => '#ffffff',
					'description' => __( 'Couleur de fond de l\'icône', 'salient-ui' ),
					'group'       => __( 'Couleurs', 'salient-ui' ),
				),

				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur de l\'icône', 'salient-ui' ),
					'param_name'  => 'icon_color',
					'value'       => '#7808d0',
					'description' => __( 'Couleur de l\'icône (prend la couleur principale par défaut)', 'salient-ui' ),
					'group'       => __( 'Couleurs', 'salient-ui' ),
				),

				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur icône (hover)', 'salient-ui' ),
					'param_name'  => 'icon_color_hover',
					'value'       => '#000000',
					'description' => __( 'Couleur de l\'icône au survol', 'salient-ui' ),
					'group'       => __( 'Couleurs', 'salient-ui' ),
				),

				// === ICÔNE ===
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Taille du wrapper icône', 'salient-ui' ),
					'param_name'  => 'icon_wrapper_size',
					'value'       => '25px',
					'description' => __( 'Taille du conteneur circulaire de l\'icône (ex: 25px)', 'salient-ui' ),
					'group'       => __( 'Icône', 'salient-ui' ),
					'dependency'  => array(
						'element' => 'show_icon',
						'value'   => 'yes',
					),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Taille du SVG icône', 'salient-ui' ),
					'param_name'  => 'icon_svg_size',
					'value'       => '10px',
					'description' => __( 'Taille du SVG de l\'icône (ex: 10px)', 'salient-ui' ),
					'group'       => __( 'Icône', 'salient-ui' ),
					'dependency'  => array(
						'element' => 'show_icon',
						'value'   => 'yes',
					),
				),

				// === ANIMATION ===
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Durée transition fond', 'salient-ui' ),
					'param_name'  => 'bg_transition_duration',
					'value'       => '0.3s',
					'description' => __( 'Durée de la transition du fond (ex: 0.3s)', 'salient-ui' ),
					'group'       => __( 'Animation', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Durée animation icône', 'salient-ui' ),
					'param_name'  => 'icon_transition_duration',
					'value'       => '0.3s',
					'description' => __( 'Durée de l\'animation de l\'icône (ex: 0.3s)', 'salient-ui' ),
					'group'       => __( 'Animation', 'salient-ui' ),
				),

				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Type de transition', 'salient-ui' ),
					'param_name'  => 'transition_timing',
					'value'       => array(
						__( 'Ease In Out', 'salient-ui' ) => 'ease-in-out',
						__( 'Ease', 'salient-ui' )        => 'ease',
						__( 'Linear', 'salient-ui' )      => 'linear',
						__( 'Ease In', 'salient-ui' )     => 'ease-in',
						__( 'Ease Out', 'salient-ui' )    => 'ease-out',
					),
					'std'         => 'ease-in-out',
					'group'       => __( 'Animation', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Délai animation copie icône', 'salient-ui' ),
					'param_name'  => 'icon_copy_delay',
					'value'       => '0.1s',
					'description' => __( 'Délai avant l\'animation de la copie de l\'icône (ex: 0.1s)', 'salient-ui' ),
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
				'text'                      => 'Explore All',
				'link'                      => '',
				'show_icon'                 => 'yes',
				'font_size'                 => '16px',
				'font_weight'               => '600',
				'padding'                   => '0.75rem 1.5rem',
				'padding_left'              => '20px',
				'border_radius'             => '10rem',
				'gap'                       => '0.75rem',
				'primary_color'             => '#7808d0',
				'bg_color_hover'            => '#000000',
				'text_color'                => '#ffffff',
				'icon_bg_color'             => '#ffffff',
				'icon_color'                => '#7808d0',
				'icon_color_hover'          => '#000000',
				'icon_wrapper_size'         => '25px',
				'icon_svg_size'             => '10px',
				'bg_transition_duration'    => '0.3s',
				'icon_transition_duration'  => '0.3s',
				'transition_timing'         => 'ease-in-out',
				'icon_copy_delay'           => '0.1s',
				'el_class'                  => '',
			),
			$atts,
			$this->get_shortcode_tag()
		);

		// Parser le lien
		$link_data = $this->parse_vc_link( $atts['link'] );

		// Déterminer la balise HTML
		$tag = ! empty( $link_data['url'] ) ? 'a' : 'button';

		// Générer un ID unique pour les styles inline
		$unique_id = 'sui-aib-' . uniqid();

		// Construire les classes CSS
		$classes = array(
			'salient-ui-aib-button',
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
			'arrow-icon-button',
			array(
				'text'      => $atts['text'],
				'tag'       => $tag,
				'href'      => $link_data['url'],
				'target'    => $link_data['target'],
				'title'     => $link_data['title'],
				'classes'   => $this->build_classes( $classes ),
				'show_icon' => $atts['show_icon'] === 'yes',
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
		$styles .= "--sui-aib-primary-color: {$atts['primary_color']};";
		$styles .= "--sui-aib-bg-hover: {$atts['bg_color_hover']};";
		$styles .= "--sui-aib-text-color: {$atts['text_color']};";
		$styles .= "--sui-aib-icon-bg: {$atts['icon_bg_color']};";
		$styles .= "--sui-aib-icon-color: {$atts['icon_color']};";
		$styles .= "--sui-aib-icon-color-hover: {$atts['icon_color_hover']};";
		$styles .= "--sui-aib-font-size: {$atts['font_size']};";
		$styles .= "--sui-aib-font-weight: {$atts['font_weight']};";
		$styles .= "--sui-aib-padding: {$atts['padding']};";
		$styles .= "--sui-aib-padding-left: {$atts['padding_left']};";
		$styles .= "--sui-aib-border-radius: {$atts['border_radius']};";
		$styles .= "--sui-aib-gap: {$atts['gap']};";
		$styles .= "--sui-aib-icon-wrapper-size: {$atts['icon_wrapper_size']};";
		$styles .= "--sui-aib-icon-svg-size: {$atts['icon_svg_size']};";
		$styles .= "--sui-aib-bg-transition: {$atts['bg_transition_duration']};";
		$styles .= "--sui-aib-icon-transition: {$atts['icon_transition_duration']};";
		$styles .= "--sui-aib-transition-timing: {$atts['transition_timing']};";
		$styles .= "--sui-aib-icon-copy-delay: {$atts['icon_copy_delay']};";
		$styles .= "}";

		$styles .= "</style>";

		return $styles;
	}
}