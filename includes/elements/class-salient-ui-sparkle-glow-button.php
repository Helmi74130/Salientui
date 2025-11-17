<?php
/**
 * Élément Sparkle Glow Button pour WPBakery Page Builder
 * Bouton avec effet de brillance, bordures animées et icône SVG sparkle
 *
 * @package SalientUI
 * @since 1.0.0
 */

// Si ce fichier est appelé directement, on arrête l'exécution
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Salient_UI_Sparkle_Glow_Button
 *
 * Élément WPBakery pour afficher un bouton avec effet sparkle et bordures tournantes
 */
class Salient_UI_Sparkle_Glow_Button extends Salient_UI_Element_Base {

	/**
	 * Obtenir le tag du shortcode
	 *
	 * @return string Tag du shortcode
	 */
	protected function get_shortcode_tag() {
		return 'salient_ui_sparkle_glow_button';
	}

	/**
	 * Obtenir le slug de l'élément (pour les assets CSS/JS)
	 *
	 * @return string Slug de l'élément
	 */
	protected function get_element_slug() {
		return 'sparkle-glow-button';
	}

	/**
	 * Obtenir la configuration WPBakery pour cet élément
	 *
	 * @return array Configuration de l'élément pour vc_map()
	 */
	protected function get_vc_config() {
		return array(
			'name'        => __( 'Sparkle Glow Button', 'salient-ui' ),
			'base'        => $this->get_shortcode_tag(),
			'category'    => __( 'SalientUI', 'salient-ui' ),
			'icon'        => SALIENT_UI_URL . 'assets/images/icon-sparkle-glow-button.svg',
			'description' => __( 'Bouton avec effet de brillance, bordures tournantes et icône sparkle animée', 'salient-ui' ),
			'params'      => array(
				// === CONTENU ===
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Texte du bouton', 'salient-ui' ),
					'param_name'  => 'text',
					'value'       => 'Generate Site',
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
					'heading'     => __( 'Afficher l\'icône sparkle', 'salient-ui' ),
					'param_name'  => 'show_sparkle',
					'value'       => array(
						__( 'Oui', 'salient-ui' ) => 'yes',
						__( 'Non', 'salient-ui' ) => 'no',
					),
					'std'         => 'yes',
					'description' => __( 'Afficher l\'icône étoile animée', 'salient-ui' ),
				),

				// === STYLE GÉNÉRAL ===
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Taille de police', 'salient-ui' ),
					'param_name'  => 'font_size',
					'value'       => '1rem',
					'description' => __( 'Taille de la police (ex: 1rem ou 16px)', 'salient-ui' ),
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
					'std'         => '500',
					'group'       => __( 'Style', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Padding', 'salient-ui' ),
					'param_name'  => 'padding',
					'value'       => '1rem 2rem',
					'description' => __( 'Padding du bouton (ex: 1rem 2rem)', 'salient-ui' ),
					'group'       => __( 'Style', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Rayon de bordure', 'salient-ui' ),
					'param_name'  => 'border_radius',
					'value'       => '9999px',
					'description' => __( 'Rayon de bordure (ex: 9999px pour arrondi complet)', 'salient-ui' ),
					'group'       => __( 'Style', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Espacement entre icône et texte', 'salient-ui' ),
					'param_name'  => 'gap',
					'value'       => '0.5rem',
					'description' => __( 'Espacement (ex: 0.5rem)', 'salient-ui' ),
					'group'       => __( 'Style', 'salient-ui' ),
				),

				// === COULEURS FOND ===
				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur de fond principal', 'salient-ui' ),
					'param_name'  => 'bg_color',
					'value'       => '#1f1f1f',
					'description' => __( 'Couleur de fond du bouton (noir par défaut)', 'salient-ui' ),
					'group'       => __( 'Couleurs Fond', 'salient-ui' ),
				),

				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur hover - Centre', 'salient-ui' ),
					'param_name'  => 'hover_gradient_center',
					'value'       => '#b491f5',
					'description' => __( 'Couleur centrale du gradient au hover', 'salient-ui' ),
					'group'       => __( 'Couleurs Fond', 'salient-ui' ),
				),

				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur hover - Haut droite', 'salient-ui' ),
					'param_name'  => 'hover_gradient_top_right',
					'value'       => '#9a7cc2',
					'description' => __( 'Couleur coin haut-droit du gradient', 'salient-ui' ),
					'group'       => __( 'Couleurs Fond', 'salient-ui' ),
				),

				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur hover - Bas gauche', 'salient-ui' ),
					'param_name'  => 'hover_gradient_bottom_left',
					'value'       => '#9a7cc2',
					'description' => __( 'Couleur coin bas-gauche du gradient', 'salient-ui' ),
					'group'       => __( 'Couleurs Fond', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Opacité du gradient hover', 'salient-ui' ),
					'param_name'  => 'hover_gradient_opacity',
					'value'       => '0.75',
					'description' => __( 'Opacité du gradient au hover (0 à 1)', 'salient-ui' ),
					'group'       => __( 'Couleurs Fond', 'salient-ui' ),
				),

				// === COULEURS TEXTE ===
				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur texte (normal)', 'salient-ui' ),
					'param_name'  => 'text_color',
					'value'       => '#ffffff',
					'description' => __( 'Couleur du texte au repos', 'salient-ui' ),
					'group'       => __( 'Couleurs Texte', 'salient-ui' ),
				),

				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur texte (hover)', 'salient-ui' ),
					'param_name'  => 'text_color_hover',
					'value'       => '#ffffff',
					'description' => __( 'Couleur du texte au hover', 'salient-ui' ),
					'group'       => __( 'Couleurs Texte', 'salient-ui' ),
				),

				// === COULEURS SPARKLE ===
				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur de l\'icône sparkle', 'salient-ui' ),
					'param_name'  => 'sparkle_color',
					'value'       => '#ffffff',
					'description' => __( 'Couleur de l\'icône étoile', 'salient-ui' ),
					'group'       => __( 'Couleurs Sparkle', 'salient-ui' ),
					'dependency'  => array(
						'element' => 'show_sparkle',
						'value'   => 'yes',
					),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Taille de l\'icône sparkle', 'salient-ui' ),
					'param_name'  => 'sparkle_size',
					'value'       => '1.75rem',
					'description' => __( 'Taille de l\'icône (ex: 1.75rem)', 'salient-ui' ),
					'group'       => __( 'Couleurs Sparkle', 'salient-ui' ),
					'dependency'  => array(
						'element' => 'show_sparkle',
						'value'   => 'yes',
					),
				),

				// === BORDURES ANIMÉES ===
				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur bordure tournante', 'salient-ui' ),
					'param_name'  => 'dots_border_color',
					'value'       => '#ffffff',
					'description' => __( 'Couleur de la bordure animée', 'salient-ui' ),
					'group'       => __( 'Bordures Animées', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Hauteur de la bordure', 'salient-ui' ),
					'param_name'  => 'dots_border_height',
					'value'       => '2rem',
					'description' => __( 'Hauteur de la bande tournante (ex: 2rem)', 'salient-ui' ),
					'group'       => __( 'Bordures Animées', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Durée rotation bordure', 'salient-ui' ),
					'param_name'  => 'border_rotation_duration',
					'value'       => '2s',
					'description' => __( 'Durée de la rotation (ex: 2s)', 'salient-ui' ),
					'group'       => __( 'Bordures Animées', 'salient-ui' ),
				),

				// === OMBRES ===
				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur ombre interne haut', 'salient-ui' ),
					'param_name'  => 'inset_shadow_top',
					'value'       => '#ffffff',
					'description' => __( 'Couleur de l\'ombre interne du haut', 'salient-ui' ),
					'group'       => __( 'Ombres', 'salient-ui' ),
				),

				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur ombre interne bas', 'salient-ui' ),
					'param_name'  => 'inset_shadow_bottom',
					'value'       => '#000000',
					'description' => __( 'Couleur de l\'ombre interne du bas', 'salient-ui' ),
					'group'       => __( 'Ombres', 'salient-ui' ),
				),

				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur ombre externe', 'salient-ui' ),
					'param_name'  => 'outer_shadow_color',
					'value'       => '#000000',
					'description' => __( 'Couleur de l\'ombre portée', 'salient-ui' ),
					'group'       => __( 'Ombres', 'salient-ui' ),
				),

				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur lueur hover', 'salient-ui' ),
					'param_name'  => 'hover_glow_color',
					'value'       => '#8250f9',
					'description' => __( 'Couleur de la lueur au hover', 'salient-ui' ),
					'group'       => __( 'Ombres', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Opacité lueur hover', 'salient-ui' ),
					'param_name'  => 'hover_glow_opacity',
					'value'       => '0.75',
					'description' => __( 'Opacité de la lueur (0 à 1)', 'salient-ui' ),
					'group'       => __( 'Ombres', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Taille de la lueur hover', 'salient-ui' ),
					'param_name'  => 'hover_glow_size',
					'value'       => '0.375rem',
					'description' => __( 'Taille de la lueur (ex: 0.375rem)', 'salient-ui' ),
					'group'       => __( 'Ombres', 'salient-ui' ),
				),

				// === ANIMATION ===
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Durée animation sparkle', 'salient-ui' ),
					'param_name'  => 'sparkle_animation_duration',
					'value'       => '1.5s',
					'description' => __( 'Durée de l\'animation de l\'étoile (ex: 1.5s)', 'salient-ui' ),
					'group'       => __( 'Animation', 'salient-ui' ),
					'dependency'  => array(
						'element' => 'show_sparkle',
						'value'   => 'yes',
					),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Délai animation sparkle', 'salient-ui' ),
					'param_name'  => 'sparkle_animation_delay',
					'value'       => '0.5s',
					'description' => __( 'Délai avant l\'animation (ex: 0.5s)', 'salient-ui' ),
					'group'       => __( 'Animation', 'salient-ui' ),
					'dependency'  => array(
						'element' => 'show_sparkle',
						'value'   => 'yes',
					),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Scale hover bouton', 'salient-ui' ),
					'param_name'  => 'hover_scale',
					'value'       => '1.1',
					'description' => __( 'Facteur de grossissement au hover (ex: 1.1)', 'salient-ui' ),
					'group'       => __( 'Animation', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Durée transition', 'salient-ui' ),
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
						__( 'Ease In Out', 'salient-ui' ) => 'ease-in-out',
						__( 'Linear', 'salient-ui' )      => 'linear',
						__( 'Ease', 'salient-ui' )        => 'ease',
						__( 'Ease In', 'salient-ui' )     => 'ease-in',
						__( 'Ease Out', 'salient-ui' )    => 'ease-out',
					),
					'std'         => 'ease-in-out',
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
				'text'                        => 'Generate Site',
				'link'                        => '',
				'show_sparkle'                => 'yes',
				'font_size'                   => '1rem',
				'font_weight'                 => '500',
				'padding'                     => '1rem 2rem',
				'border_radius'               => '9999px',
				'gap'                         => '0.5rem',
				'bg_color'                    => '#1f1f1f',
				'hover_gradient_center'       => '#b491f5',
				'hover_gradient_top_right'    => '#9a7cc2',
				'hover_gradient_bottom_left'  => '#9a7cc2',
				'hover_gradient_opacity'      => '0.75',
				'text_color'                  => '#ffffff',
				'text_color_hover'            => '#ffffff',
				'sparkle_color'               => '#ffffff',
				'sparkle_size'                => '1.75rem',
				'dots_border_color'           => '#ffffff',
				'dots_border_height'          => '2rem',
				'border_rotation_duration'    => '2s',
				'inset_shadow_top'            => '#ffffff',
				'inset_shadow_bottom'         => '#000000',
				'outer_shadow_color'          => '#000000',
				'hover_glow_color'            => '#8250f9',
				'hover_glow_opacity'          => '0.75',
				'hover_glow_size'             => '0.375rem',
				'sparkle_animation_duration'  => '1.5s',
				'sparkle_animation_delay'     => '0.5s',
				'hover_scale'                 => '1.1',
				'transition_duration'         => '0.3s',
				'transition_easing'           => 'ease-in-out',
				'el_class'                    => '',
			),
			$atts,
			$this->get_shortcode_tag()
		);

		// Parser le lien
		$link_data = $this->parse_vc_link( $atts['link'] );

		// Déterminer la balise HTML
		$tag = ! empty( $link_data['url'] ) ? 'a' : 'button';

		// Générer un ID unique pour les styles inline
		$unique_id = 'sui-sgb-' . uniqid();

		// Construire les classes CSS
		$classes = array(
			'salient-ui-sgb-button',
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
			'sparkle-glow-button',
			array(
				'text'         => $atts['text'],
				'tag'          => $tag,
				'href'         => $link_data['url'],
				'target'       => $link_data['target'],
				'title'        => $link_data['title'],
				'classes'      => $this->build_classes( $classes ),
				'show_sparkle' => $atts['show_sparkle'] === 'yes',
				'atts'         => $atts,
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
		// Convertir les couleurs en HSLA si nécessaire
		$bg_color_hsla                 = $this->hex_to_hsla( $atts['bg_color'], 1 );
		$hover_gradient_center_hsla    = $this->hex_to_hsla( $atts['hover_gradient_center'], $atts['hover_gradient_opacity'] );
		$hover_gradient_tr_hsla        = $this->hex_to_hsla( $atts['hover_gradient_top_right'], 1 );
		$hover_gradient_bl_hsla        = $this->hex_to_hsla( $atts['hover_gradient_bottom_left'], 1 );
		$inset_shadow_top_hsla         = $this->hex_to_hsla( $atts['inset_shadow_top'], 1 );
		$inset_shadow_bottom_hsla      = $this->hex_to_hsla( $atts['inset_shadow_bottom'], 1 );
		$outer_shadow_hsla             = $this->hex_to_hsla( $atts['outer_shadow_color'], 1 );
		$hover_glow_hsla               = $this->hex_to_hsla( $atts['hover_glow_color'], $atts['hover_glow_opacity'] );

		$styles = "<style>";

		// Variables CSS personnalisées
		$styles .= ".{$unique_id} {";
		$styles .= "--sui-sgb-bg-color: {$bg_color_hsla};";
		$styles .= "--sui-sgb-border-radius: {$atts['border_radius']};";
		$styles .= "--sui-sgb-transition: {$atts['transition_duration']} {$atts['transition_easing']};";
		$styles .= "--sui-sgb-active: 0;";
		$styles .= "--sui-sgb-font-size: {$atts['font_size']};";
		$styles .= "--sui-sgb-font-weight: {$atts['font_weight']};";
		$styles .= "--sui-sgb-padding: {$atts['padding']};";
		$styles .= "--sui-sgb-gap: {$atts['gap']};";
		$styles .= "--sui-sgb-text-color: {$atts['text_color']};";
		$styles .= "--sui-sgb-text-color-hover: {$atts['text_color_hover']};";
		$styles .= "--sui-sgb-sparkle-color: {$atts['sparkle_color']};";
		$styles .= "--sui-sgb-sparkle-size: {$atts['sparkle_size']};";
		$styles .= "--sui-sgb-dots-color: {$atts['dots_border_color']};";
		$styles .= "--sui-sgb-dots-height: {$atts['dots_border_height']};";
		$styles .= "--sui-sgb-border-rotation: {$atts['border_rotation_duration']};";
		$styles .= "--sui-sgb-hover-scale: {$atts['hover_scale']};";
		$styles .= "--sui-sgb-sparkle-duration: {$atts['sparkle_animation_duration']};";
		$styles .= "--sui-sgb-sparkle-delay: {$atts['sparkle_animation_delay']};";
		$styles .= "}";

		// Box shadow avec variables
		$styles .= ".{$unique_id}::before {";
		$styles .= "box-shadow: ";
		$styles .= "inset 0 0.5px {$inset_shadow_top_hsla}, ";
		$styles .= "inset 0 -1px 2px 0 {$inset_shadow_bottom_hsla}, ";
		$styles .= "0px 4px 10px -4px {$outer_shadow_hsla}, ";
		$styles .= "0 0 0 calc(var(--sui-sgb-active, 0) * {$atts['hover_glow_size']}) {$hover_glow_hsla};";
		$styles .= "}";

		// Background gradient hover
		$styles .= ".{$unique_id}::after {";
		$styles .= "background-color: {$hover_gradient_center_hsla};";
		$styles .= "background-image: ";
		$styles .= "radial-gradient(at 51% 89%, {$hover_gradient_tr_hsla} 0px, transparent 50%), ";
		$styles .= "radial-gradient(at 100% 100%, {$hover_gradient_bl_hsla} 0px, transparent 50%), ";
		$styles .= "radial-gradient(at 22% 91%, {$hover_gradient_bl_hsla} 0px, transparent 50%);";
		$styles .= "}";

		$styles .= "</style>";

		return $styles;
	}

	/**
	 * Convertir hex en HSLA
	 *
	 * @param string $hex   Couleur hex
	 * @param float  $alpha Opacité
	 * @return string Couleur HSLA
	 */
	private function hex_to_hsla( $hex, $alpha = 1 ) {
		// Enlever le # si présent
		$hex = ltrim( $hex, '#' );

		// Convertir en RGB
		if ( strlen( $hex ) === 3 ) {
			$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
			$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
			$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
		} else {
			$r = hexdec( substr( $hex, 0, 2 ) );
			$g = hexdec( substr( $hex, 2, 2 ) );
			$b = hexdec( substr( $hex, 4, 2 ) );
		}

		// Convertir en HSL
		$r = $r / 255;
		$g = $g / 255;
		$b = $b / 255;

		$max = max( $r, $g, $b );
		$min = min( $r, $g, $b );
		$l   = ( $max + $min ) / 2;

		if ( $max === $min ) {
			$h = $s = 0;
		} else {
			$d = $max - $min;
			$s = $l > 0.5 ? $d / ( 2 - $max - $min ) : $d / ( $max + $min );

			switch ( $max ) {
				case $r:
					$h = ( ( $g - $b ) / $d + ( $g < $b ? 6 : 0 ) );
					break;
				case $g:
					$h = ( ( $b - $r ) / $d + 2 );
					break;
				case $b:
					$h = ( ( $r - $g ) / $d + 4 );
					break;
			}

			$h = $h / 6;
		}

		$h = round( $h * 360 );
		$s = round( $s * 100 );
		$l = round( $l * 100 );

		return "hsla({$h} {$s}% {$l}% / {$alpha})";
	}
}