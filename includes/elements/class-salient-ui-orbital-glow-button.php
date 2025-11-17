<?php
/**
 * Élément Orbital Glow Button pour WPBakery Page Builder
 * Bouton avec effet orbital lumineux et filtres SVG
 *
 * @package SalientUI
 * @since 1.0.0
 */

// Si ce fichier est appelé directement, on arrête l'exécution
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Salient_UI_Orbital_Glow_Button
 *
 * Élément WPBakery pour afficher un bouton avec effet orbital lumineux
 */
class Salient_UI_Orbital_Glow_Button extends Salient_UI_Element_Base {

	/**
	 * Obtenir le tag du shortcode
	 *
	 * @return string Tag du shortcode
	 */
	protected function get_shortcode_tag() {
		return 'salient_ui_orbital_glow_button';
	}

	/**
	 * Obtenir le slug de l'élément (pour les assets CSS/JS)
	 *
	 * @return string Slug de l'élément
	 */
	protected function get_element_slug() {
		return 'orbital-glow-button';
	}

	/**
	 * Obtenir la configuration WPBakery pour cet élément
	 *
	 * @return array Configuration de l'élément pour vc_map()
	 */
	protected function get_vc_config() {
		return array(
			'name'        => __( 'Orbital Glow Button', 'salient-ui' ),
			'base'        => $this->get_shortcode_tag(),
			'category'    => __( 'SalientUI', 'salient-ui' ),
			'icon'        => SALIENT_UI_URL . 'assets/images/icon-orbital-glow-button.svg',
			'description' => __( 'Bouton avec effet orbital lumineux et animations fluides', 'salient-ui' ),
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

				// Lien
				array(
					'type'        => 'vc_link',
					'heading'     => __( 'Lien', 'salient-ui' ),
					'param_name'  => 'link',
					'description' => __( 'URL du lien du bouton', 'salient-ui' ),
				),

				// === DIMENSIONS ===
				array(
					'type'       => 'dropdown',
					'heading'    => __( 'Dimensions', 'salient-ui' ),
					'param_name' => 'dimensions_separator',
					'value'      => array( '' => '' ),
					'group'      => __( 'Dimensions', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Largeur', 'salient-ui' ),
					'param_name'  => 'button_width',
					'value'       => '120px',
					'description' => __( 'Largeur du bouton (ex: 120px)', 'salient-ui' ),
					'group'       => __( 'Dimensions', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Hauteur', 'salient-ui' ),
					'param_name'  => 'button_height',
					'value'       => '60px',
					'description' => __( 'Hauteur du bouton (ex: 60px)', 'salient-ui' ),
					'group'       => __( 'Dimensions', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Rayon de bordure', 'salient-ui' ),
					'param_name'  => 'border_radius',
					'value'       => '17px',
					'description' => __( 'Rayon de bordure (ex: 17px)', 'salient-ui' ),
					'group'       => __( 'Dimensions', 'salient-ui' ),
				),

				// === STYLE ===
				array(
					'type'       => 'dropdown',
					'heading'    => __( 'Style', 'salient-ui' ),
					'param_name' => 'style_separator',
					'value'      => array( '' => '' ),
					'group'      => __( 'Style', 'salient-ui' ),
				),

				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur de fond', 'salient-ui' ),
					'param_name'  => 'bg_color',
					'value'       => '#111215',
					'description' => __( 'Couleur de fond du bouton', 'salient-ui' ),
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
					'std'         => '400',
					'group'       => __( 'Style', 'salient-ui' ),
				),

				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur bordure', 'salient-ui' ),
					'param_name'  => 'border_color',
					'value'       => '#0005',
					'description' => __( 'Couleur de la bordure (rgba supporté)', 'salient-ui' ),
					'group'       => __( 'Style', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Épaisseur bordure', 'salient-ui' ),
					'param_name'  => 'border_width',
					'value'       => '3px',
					'description' => __( 'Épaisseur de la bordure (ex: 3px)', 'salient-ui' ),
					'group'       => __( 'Style', 'salient-ui' ),
				),

				// === EFFET ORBITAL ===
				array(
					'type'       => 'dropdown',
					'heading'    => __( 'Effet Orbital', 'salient-ui' ),
					'param_name' => 'orbital_separator',
					'value'      => array( '' => '' ),
					'group'      => __( 'Effet Orbital', 'salient-ui' ),
				),

				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur gradient gauche', 'salient-ui' ),
					'param_name'  => 'gradient_color_left',
					'value'       => '#ff5500',
					'description' => __( 'Couleur du gradient côté gauche (orange)', 'salient-ui' ),
					'group'       => __( 'Effet Orbital', 'salient-ui' ),
				),

				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur gradient droite', 'salient-ui' ),
					'param_name'  => 'gradient_color_right',
					'value'       => '#0055ff',
					'description' => __( 'Couleur du gradient côté droit (bleu)', 'salient-ui' ),
					'group'       => __( 'Effet Orbital', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Intensité du flou (blur)', 'salient-ui' ),
					'param_name'  => 'blur_intense',
					'value'       => '0.25em',
					'description' => __( 'Intensité du flou intense (ex: 0.25em)', 'salient-ui' ),
					'group'       => __( 'Effet Orbital', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Flou externe', 'salient-ui' ),
					'param_name'  => 'blur_outer',
					'value'       => '2em',
					'description' => __( 'Intensité du flou externe (ex: 2em)', 'salient-ui' ),
					'group'       => __( 'Effet Orbital', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Flou interne', 'salient-ui' ),
					'param_name'  => 'blur_inner',
					'value'       => '2px',
					'description' => __( 'Intensité du flou interne (ex: 2px)', 'salient-ui' ),
					'group'       => __( 'Effet Orbital', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Opacité au repos', 'salient-ui' ),
					'param_name'  => 'glow_opacity',
					'value'       => '0.5',
					'description' => __( 'Opacité de l\'effet au repos (0 à 1)', 'salient-ui' ),
					'group'       => __( 'Effet Orbital', 'salient-ui' ),
				),

				// === ANIMATION ===
				array(
					'type'       => 'dropdown',
					'heading'    => __( 'Animation', 'salient-ui' ),
					'param_name' => 'animation_separator',
					'value'      => array( '' => '' ),
					'group'      => __( 'Animation', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Durée rotation', 'salient-ui' ),
					'param_name'  => 'rotation_duration',
					'value'       => '8s',
					'description' => __( 'Durée de la rotation (ex: 8s)', 'salient-ui' ),
					'group'       => __( 'Animation', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Durée pulsation', 'salient-ui' ),
					'param_name'  => 'pulse_duration',
					'value'       => '4s',
					'description' => __( 'Durée de la pulsation (ex: 4s)', 'salient-ui' ),
					'group'       => __( 'Animation', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Durée de transition', 'salient-ui' ),
					'param_name'  => 'transition_duration',
					'value'       => '0.3s',
					'description' => __( 'Durée de la transition hover (ex: 0.3s)', 'salient-ui' ),
					'group'       => __( 'Animation', 'salient-ui' ),
				),

				// === FILTRES SVG ===
				array(
					'type'       => 'dropdown',
					'heading'    => __( 'Filtres SVG', 'salient-ui' ),
					'param_name' => 'filters_separator',
					'value'      => array( '' => '' ),
					'group'      => __( 'Filtres SVG', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Multiplicateur alpha (filtre externe)', 'salient-ui' ),
					'param_name'  => 'filter_alpha_outer',
					'value'       => '3',
					'description' => __( 'Multiplicateur de canal alpha pour le filtre externe (ex: 9)', 'salient-ui' ),
					'group'       => __( 'Filtres SVG', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Multiplicateur alpha (filtre intense)', 'salient-ui' ),
					'param_name'  => 'filter_alpha_intense',
					'value'       => '3',
					'description' => __( 'Multiplicateur de canal alpha pour le filtre intense (ex: 3)', 'salient-ui' ),
					'group'       => __( 'Filtres SVG', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Multiplicateur alpha (filtre interne)', 'salient-ui' ),
					'param_name'  => 'filter_alpha_inner',
					'value'       => '2',
					'description' => __( 'Multiplicateur de canal alpha pour le filtre interne (ex: 2)', 'salient-ui' ),
					'group'       => __( 'Filtres SVG', 'salient-ui' ),
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
				'text'                  => 'Button',
				'link'                  => '',
				'button_width'          => '120px',
				'button_height'         => '60px',
				'border_radius'         => '17px',
				'bg_color'              => '#111215',
				'text_color'            => '#ffffff',
				'font_size'             => '16px',
				'font_weight'           => '400',
				'border_color'          => 'rgba(0, 0, 0, 0.33)',
				'border_width'          => '3px',
				'gradient_color_left'   => '#ff5500',
				'gradient_color_right'  => '#0055ff',
				'blur_intense'          => '0.25em',
				'blur_outer'            => '2em',
				'blur_inner'            => '2px',
				'glow_opacity'          => '0.5',
				'rotation_duration'     => '8s',
				'pulse_duration'        => '4s',
				'transition_duration'   => '0.3s',
				'filter_alpha_outer'    => '3',
				'filter_alpha_intense'  => '3',
				'filter_alpha_inner'    => '2',
				'el_class'              => '',
			),
			$atts,
			$this->get_shortcode_tag()
		);

		// Parser le lien
		$link_data = $this->parse_vc_link( $atts['link'] );

		// Générer un ID unique pour les styles inline et les filtres SVG
		$unique_id = 'sui-ogb-' . uniqid();

		// Construire les classes CSS
		$classes = array(
			'salient-ui-ogb-container',
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
			'orbital-glow-button',
			array(
				'text'       => $atts['text'],
				'href'       => $link_data['url'],
				'target'     => $link_data['target'],
				'title'      => $link_data['title'],
				'classes'    => $this->build_classes( $classes ),
				'unique_id'  => $unique_id,
				'atts'       => $atts,
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
		// Convertir border_color si c'est un format rgba
		$border_color = $this->parse_color( $atts['border_color'] );

		$styles = "<style>";

		// Variables CSS personnalisées
		$styles .= ".{$unique_id} {";
		$styles .= "--sui-ogb-width: {$atts['button_width']};";
		$styles .= "--sui-ogb-height: {$atts['button_height']};";
		$styles .= "--sui-ogb-border-radius: {$atts['border_radius']};";
		$styles .= "--sui-ogb-bg-color: {$atts['bg_color']};";
		$styles .= "--sui-ogb-text-color: {$atts['text_color']};";
		$styles .= "--sui-ogb-font-size: {$atts['font_size']};";
		$styles .= "--sui-ogb-font-weight: {$atts['font_weight']};";
		$styles .= "--sui-ogb-border-color: {$border_color};";
		$styles .= "--sui-ogb-border-width: {$atts['border_width']};";
		$styles .= "--sui-ogb-gradient-left: {$atts['gradient_color_left']};";
		$styles .= "--sui-ogb-gradient-right: {$atts['gradient_color_right']};";
		$styles .= "--sui-ogb-blur-intense: {$atts['blur_intense']};";
		$styles .= "--sui-ogb-blur-outer: {$atts['blur_outer']};";
		$styles .= "--sui-ogb-blur-inner: {$atts['blur_inner']};";
		$styles .= "--sui-ogb-glow-opacity: {$atts['glow_opacity']};";
		$styles .= "--sui-ogb-rotation-duration: {$atts['rotation_duration']};";
		$styles .= "--sui-ogb-pulse-duration: {$atts['pulse_duration']};";
		$styles .= "--sui-ogb-transition-duration: {$atts['transition_duration']};";
		$styles .= "}";

		$styles .= "</style>";

		return $styles;
	}

	/**
	 * Parser une couleur (supporte rgba)
	 *
	 * @param string $color Couleur à parser
	 * @return string Couleur parsée
	 */
	private function parse_color( $color ) {
		// Si c'est déjà rgba ou rgb, on retourne tel quel
		if ( strpos( $color, 'rgba' ) === 0 || strpos( $color, 'rgb' ) === 0 ) {
			return $color;
		}

		// Si c'est un format #0005 (notation courte avec alpha), convertir en rgba
		if ( preg_match( '/^#([0-9a-fA-F])([0-9a-fA-F])([0-9a-fA-F])([0-9a-fA-F])$/', $color, $matches ) ) {
			$r     = hexdec( $matches[1] . $matches[1] );
			$g     = hexdec( $matches[2] . $matches[2] );
			$b     = hexdec( $matches[3] . $matches[3] );
			$a     = hexdec( $matches[4] . $matches[4] ) / 255;
			return "rgba($r, $g, $b, $a)";
		}

		// Sinon retourner tel quel
		return $color;
	}
}