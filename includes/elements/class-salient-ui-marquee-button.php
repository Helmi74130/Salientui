<?php
/**
 * Élément Marquee Button pour WPBakery Page Builder
 * Bouton avec effet de texte défilant au survol
 *
 * @package SalientUI
 * @since 1.0.0
 */

// Si ce fichier est appelé directement, on arrête l'exécution
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Salient_UI_Marquee_Button
 *
 * Élément WPBakery pour afficher un bouton avec effet marquee
 */
class Salient_UI_Marquee_Button extends Salient_UI_Element_Base {

	/**
	 * Obtenir le tag du shortcode
	 *
	 * @return string Tag du shortcode
	 */
	protected function get_shortcode_tag() {
		return 'salient_ui_marquee_button';
	}

	/**
	 * Obtenir le slug de l'élément (pour les assets CSS/JS)
	 *
	 * @return string Slug de l'élément
	 */
	protected function get_element_slug() {
		return 'marquee-button';
	}

	/**
	 * Obtenir la configuration WPBakery pour cet élément
	 *
	 * @return array Configuration de l'élément pour vc_map()
	 */
	protected function get_vc_config() {
		return array(
			'name'        => __( 'Marquee Button', 'salient-ui' ),
			'base'        => $this->get_shortcode_tag(),
			'category'    => __( 'SalientUI', 'salient-ui' ),
			'icon'        => SALIENT_UI_URL . 'assets/images/icon-marquee-button.svg',
			'description' => __( 'Bouton avec effet de texte défilant horizontal au survol', 'salient-ui' ),
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
					'value'       => '100%',
					'description' => __( 'Taille de la police (ex: 100% ou 16px)', 'salient-ui' ),
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
						__( 'Black (900)', 'salient-ui' )  => '900',
					),
					'std'         => '900',
					'group'       => __( 'Style', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Hauteur de ligne', 'salient-ui' ),
					'param_name'  => 'line_height',
					'value'       => '1.5',
					'description' => __( 'Hauteur de ligne (ex: 1.5)', 'salient-ui' ),
					'group'       => __( 'Style', 'salient-ui' ),
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
					'group'       => __( 'Style', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Padding', 'salient-ui' ),
					'param_name'  => 'padding',
					'value'       => '0.8rem 3rem',
					'description' => __( 'Padding du bouton (ex: 0.8rem 3rem)', 'salient-ui' ),
					'group'       => __( 'Style', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Rayon de bordure', 'salient-ui' ),
					'param_name'  => 'border_radius',
					'value'       => '99rem',
					'description' => __( 'Rayon de bordure (ex: 99rem pour complètement arrondi)', 'salient-ui' ),
					'group'       => __( 'Style', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Épaisseur de bordure', 'salient-ui' ),
					'param_name'  => 'border_width',
					'value'       => '2px',
					'description' => __( 'Épaisseur de la bordure (ex: 2px)', 'salient-ui' ),
					'group'       => __( 'Style', 'salient-ui' ),
				),

				// === COULEURS ===
				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur de fond', 'salient-ui' ),
					'param_name'  => 'bg_color',
					'value'       => '#000000',
					'description' => __( 'Couleur de fond du bouton', 'salient-ui' ),
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
					'heading'     => __( 'Couleur de bordure', 'salient-ui' ),
					'param_name'  => 'border_color',
					'value'       => '#ffffff',
					'description' => __( 'Couleur de la bordure', 'salient-ui' ),
					'group'       => __( 'Couleurs', 'salient-ui' ),
				),

				// === EFFET MARQUEE ===
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Espacement du marquee', 'salient-ui' ),
					'param_name'  => 'marquee_spacing',
					'value'       => '5em',
					'description' => __( 'Distance entre les répétitions du texte (ex: 5em)', 'salient-ui' ),
					'group'       => __( 'Effet Marquee', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Position de départ', 'salient-ui' ),
					'param_name'  => 'marquee_start',
					'value'       => '0em',
					'description' => __( 'Position initiale du texte (ex: 0em)', 'salient-ui' ),
					'group'       => __( 'Effet Marquee', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Position de fin', 'salient-ui' ),
					'param_name'  => 'marquee_end',
					'value'       => '5em',
					'description' => __( 'Position finale du texte (ex: 5em)', 'salient-ui' ),
					'group'       => __( 'Effet Marquee', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Durée de l\'animation', 'salient-ui' ),
					'param_name'  => 'marquee_duration',
					'value'       => '1s',
					'description' => __( 'Durée de l\'animation (ex: 1s)', 'salient-ui' ),
					'group'       => __( 'Effet Marquee', 'salient-ui' ),
				),

				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Type d\'animation', 'salient-ui' ),
					'param_name'  => 'marquee_easing',
					'value'       => array(
						__( 'Linear', 'salient-ui' )      => 'linear',
						__( 'Ease', 'salient-ui' )        => 'ease',
						__( 'Ease In', 'salient-ui' )     => 'ease-in',
						__( 'Ease Out', 'salient-ui' )    => 'ease-out',
						__( 'Ease In Out', 'salient-ui' ) => 'ease-in-out',
					),
					'std'         => 'linear',
					'group'       => __( 'Effet Marquee', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Durée transition opacité', 'salient-ui' ),
					'param_name'  => 'opacity_duration',
					'value'       => '0.2s',
					'description' => __( 'Durée de la transition d\'opacité (ex: 0.2s)', 'salient-ui' ),
					'group'       => __( 'Effet Marquee', 'salient-ui' ),
				),

				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Type transition opacité', 'salient-ui' ),
					'param_name'  => 'opacity_easing',
					'value'       => array(
						__( 'Ease', 'salient-ui' )        => 'ease',
						__( 'Linear', 'salient-ui' )      => 'linear',
						__( 'Ease In', 'salient-ui' )     => 'ease-in',
						__( 'Ease Out', 'salient-ui' )    => 'ease-out',
						__( 'Ease In Out', 'salient-ui' ) => 'ease-in-out',
					),
					'std'         => 'ease',
					'group'       => __( 'Effet Marquee', 'salient-ui' ),
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
				'text'             => 'Button',
				'link'             => '',
				'font_size'        => '100%',
				'font_weight'      => '900',
				'line_height'      => '1.5',
				'text_transform'   => 'uppercase',
				'padding'          => '0.8rem 3rem',
				'border_radius'    => '99rem',
				'border_width'     => '2px',
				'bg_color'         => '#000000',
				'text_color'       => '#ffffff',
				'border_color'     => '#ffffff',
				'marquee_spacing'  => '5em',
				'marquee_start'    => '0em',
				'marquee_end'      => '5em',
				'marquee_duration' => '1s',
				'marquee_easing'   => 'linear',
				'opacity_duration' => '0.2s',
				'opacity_easing'   => 'ease',
				'el_class'         => '',
			),
			$atts,
			$this->get_shortcode_tag()
		);

		// Parser le lien
		$link_data = $this->parse_vc_link( $atts['link'] );

		// Déterminer la balise HTML
		$tag = ! empty( $link_data['url'] ) ? 'a' : 'button';

		// Générer un ID unique pour les styles inline
		$unique_id = 'sui-mb-' . uniqid();

		// Construire les classes CSS
		$classes = array(
			'salient-ui-mb-button',
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
			'marquee-button',
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
		$styles .= "--sui-mb-bg-color: {$atts['bg_color']};";
		$styles .= "--sui-mb-text-color: {$atts['text_color']};";
		$styles .= "--sui-mb-border-color: {$atts['border_color']};";
		$styles .= "--sui-mb-font-size: {$atts['font_size']};";
		$styles .= "--sui-mb-font-weight: {$atts['font_weight']};";
		$styles .= "--sui-mb-line-height: {$atts['line_height']};";
		$styles .= "--sui-mb-text-transform: {$atts['text_transform']};";
		$styles .= "--sui-mb-padding: {$atts['padding']};";
		$styles .= "--sui-mb-border-radius: {$atts['border_radius']};";
		$styles .= "--sui-mb-border-width: {$atts['border_width']};";
		$styles .= "--sui-mb-marquee-spacing: {$atts['marquee_spacing']};";
		$styles .= "--sui-mb-marquee-start: {$atts['marquee_start']};";
		$styles .= "--sui-mb-marquee-end: {$atts['marquee_end']};";
		$styles .= "--sui-mb-marquee-duration: {$atts['marquee_duration']};";
		$styles .= "--sui-mb-marquee-easing: {$atts['marquee_easing']};";
		$styles .= "--sui-mb-opacity-duration: {$atts['opacity_duration']};";
		$styles .= "--sui-mb-opacity-easing: {$atts['opacity_easing']};";
		$styles .= "}";

		$styles .= "</style>";

		return $styles;
	}
}