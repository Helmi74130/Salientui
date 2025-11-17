<?php
/**
 * Élément Circular Text Button pour WPBakery Page Builder
 * Bouton circulaire avec texte rotatif et icône flèche au centre
 *
 * @package SalientUI
 * @since 1.0.0
 */

// Si ce fichier est appelé directement, on arrête l'exécution
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Salient_UI_Circular_Text_Button
 *
 * Élément WPBakery pour afficher un bouton circulaire avec texte rotatif
 */
class Salient_UI_Circular_Text_Button extends Salient_UI_Element_Base {

	/**
	 * Obtenir le tag du shortcode
	 *
	 * @return string Tag du shortcode
	 */
	protected function get_shortcode_tag() {
		return 'salient_ui_circular_text_button';
	}

	/**
	 * Obtenir le slug de l'élément (pour les assets CSS/JS)
	 *
	 * @return string Slug de l'élément
	 */
	protected function get_element_slug() {
		return 'circular-text-button';
	}

	/**
	 * Obtenir la configuration WPBakery pour cet élément
	 *
	 * @return array Configuration de l'élément pour vc_map()
	 */
	protected function get_vc_config() {
		return array(
			'name'        => __( 'Circular Text Button', 'salient-ui' ),
			'base'        => $this->get_shortcode_tag(),
			'category'    => __( 'SalientUI', 'salient-ui' ),
			'icon'        => SALIENT_UI_URL . 'assets/images/icon-circular-text-button.svg',
			'description' => __( 'Bouton circulaire avec texte rotatif et icône flèche animée au centre', 'salient-ui' ),
			'params'      => array(
				// === CONTENU ===
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Texte rotatif', 'salient-ui' ),
					'param_name'  => 'text',
					'value'       => 'AWESOME CSS BUTTON',
					'description' => __( 'Texte qui tourne autour du bouton', 'salient-ui' ),
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
					'description' => __( 'Afficher l\'icône flèche au centre', 'salient-ui' ),
				),

				// === DIMENSIONS ===
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Taille du bouton', 'salient-ui' ),
					'param_name'  => 'button_size',
					'value'       => '100px',
					'description' => __( 'Taille du bouton circulaire (ex: 100px)', 'salient-ui' ),
					'group'       => __( 'Dimensions', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Taille du cercle intérieur', 'salient-ui' ),
					'param_name'  => 'circle_size',
					'value'       => '40px',
					'description' => __( 'Taille du cercle blanc central (ex: 40px)', 'salient-ui' ),
					'group'       => __( 'Dimensions', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Taille de l\'icône', 'salient-ui' ),
					'param_name'  => 'icon_size',
					'value'       => '14px',
					'description' => __( 'Taille de l\'icône SVG (ex: 14px)', 'salient-ui' ),
					'group'       => __( 'Dimensions', 'salient-ui' ),
					'dependency'  => array(
						'element' => 'show_icon',
						'value'   => 'yes',
					),
				),

				// === STYLE TEXTE ===
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Taille de police', 'salient-ui' ),
					'param_name'  => 'font_size',
					'value'       => '14px',
					'description' => __( 'Taille de la police du texte rotatif (ex: 14px)', 'salient-ui' ),
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
					'std'         => '600',
					'group'       => __( 'Style Texte', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Inset du texte', 'salient-ui' ),
					'param_name'  => 'text_inset',
					'value'       => '7px',
					'description' => __( 'Distance du texte par rapport au bord (ex: 7px)', 'salient-ui' ),
					'group'       => __( 'Style Texte', 'salient-ui' ),
				),

				// === COULEURS ===
				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur de fond', 'salient-ui' ),
					'param_name'  => 'bg_color',
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
					'description' => __( 'Couleur du texte rotatif', 'salient-ui' ),
					'group'       => __( 'Couleurs', 'salient-ui' ),
				),

				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur fond cercle intérieur', 'salient-ui' ),
					'param_name'  => 'circle_bg_color',
					'value'       => '#ffffff',
					'description' => __( 'Couleur de fond du cercle central', 'salient-ui' ),
					'group'       => __( 'Couleurs', 'salient-ui' ),
				),

				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur de l\'icône', 'salient-ui' ),
					'param_name'  => 'icon_color',
					'value'       => '#7808d0',
					'description' => __( 'Couleur de l\'icône', 'salient-ui' ),
					'group'       => __( 'Couleurs', 'salient-ui' ),
					'dependency'  => array(
						'element' => 'show_icon',
						'value'   => 'yes',
					),
				),

				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur icône (hover)', 'salient-ui' ),
					'param_name'  => 'icon_color_hover',
					'value'       => '#000000',
					'description' => __( 'Couleur de l\'icône au survol', 'salient-ui' ),
					'group'       => __( 'Couleurs', 'salient-ui' ),
					'dependency'  => array(
						'element' => 'show_icon',
						'value'   => 'yes',
					),
				),

				// === ANIMATION ===
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Durée rotation texte', 'salient-ui' ),
					'param_name'  => 'text_rotation_duration',
					'value'       => '8s',
					'description' => __( 'Durée de rotation du texte (ex: 8s)', 'salient-ui' ),
					'group'       => __( 'Animation', 'salient-ui' ),
				),

				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Type animation rotation', 'salient-ui' ),
					'param_name'  => 'rotation_timing',
					'value'       => array(
						__( 'Linear', 'salient-ui' )      => 'linear',
						__( 'Ease', 'salient-ui' )        => 'ease',
						__( 'Ease In Out', 'salient-ui' ) => 'ease-in-out',
					),
					'std'         => 'linear',
					'group'       => __( 'Animation', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Durée transition fond', 'salient-ui' ),
					'param_name'  => 'bg_transition_duration',
					'value'       => '300ms',
					'description' => __( 'Durée transition couleur fond (ex: 300ms)', 'salient-ui' ),
					'group'       => __( 'Animation', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Durée transition scale', 'salient-ui' ),
					'param_name'  => 'scale_transition_duration',
					'value'       => '200ms',
					'description' => __( 'Durée transition échelle (ex: 200ms)', 'salient-ui' ),
					'group'       => __( 'Animation', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Scale au hover', 'salient-ui' ),
					'param_name'  => 'hover_scale',
					'value'       => '1.05',
					'description' => __( 'Facteur d\'agrandissement au survol (ex: 1.05)', 'salient-ui' ),
					'group'       => __( 'Animation', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Durée animation icône', 'salient-ui' ),
					'param_name'  => 'icon_transition_duration',
					'value'       => '0.3s',
					'description' => __( 'Durée animation icône (ex: 0.3s)', 'salient-ui' ),
					'group'       => __( 'Animation', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Délai icône copie', 'salient-ui' ),
					'param_name'  => 'icon_copy_delay',
					'value'       => '0.1s',
					'description' => __( 'Délai animation copie icône (ex: 0.1s)', 'salient-ui' ),
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
				'text'                       => 'AWESOME CSS BUTTON',
				'link'                       => '',
				'show_icon'                  => 'yes',
				'button_size'                => '100px',
				'circle_size'                => '40px',
				'icon_size'                  => '14px',
				'font_size'                  => '14px',
				'font_weight'                => '600',
				'text_inset'                 => '7px',
				'bg_color'                   => '#7808d0',
				'bg_color_hover'             => '#000000',
				'text_color'                 => '#ffffff',
				'circle_bg_color'            => '#ffffff',
				'icon_color'                 => '#7808d0',
				'icon_color_hover'           => '#000000',
				'text_rotation_duration'     => '8s',
				'rotation_timing'            => 'linear',
				'bg_transition_duration'     => '300ms',
				'scale_transition_duration'  => '200ms',
				'hover_scale'                => '1.05',
				'icon_transition_duration'   => '0.3s',
				'icon_copy_delay'            => '0.1s',
				'el_class'                   => '',
			),
			$atts,
			$this->get_shortcode_tag()
		);

		// Parser le lien
		$link_data = $this->parse_vc_link( $atts['link'] );

		// Déterminer la balise HTML
		$tag = ! empty( $link_data['url'] ) ? 'a' : 'button';

		// Générer un ID unique pour les styles inline
		$unique_id = 'sui-ctb-' . uniqid();

		// Construire les classes CSS
		$classes = array(
			'salient-ui-ctb-button',
			$unique_id,
		);

		// Ajouter la classe personnalisée si fournie
		if ( ! empty( $atts['el_class'] ) ) {
			$classes[] = esc_attr( $atts['el_class'] );
		}

		// Séparer le texte en lettres individuelles
		$text_chars = $this->split_text_to_chars( $atts['text'] );

		// Générer les styles inline pour cet élément spécifique
		$inline_styles = $this->generate_inline_styles( $unique_id, $atts, count( $text_chars ) );

		// Charger le template avec les variables
		return $inline_styles . $this->load_template(
			'circular-text-button',
			array(
				'text_chars' => $text_chars,
				'tag'        => $tag,
				'href'       => $link_data['url'],
				'target'     => $link_data['target'],
				'title'      => $link_data['title'],
				'classes'    => $this->build_classes( $classes ),
				'show_icon'  => $atts['show_icon'] === 'yes',
			)
		);
	}

	/**
	 * Séparer le texte en caractères individuels
	 *
	 * @param string $text Texte à séparer
	 * @return array Tableau de caractères
	 */
	private function split_text_to_chars( $text ) {
		// Convertir en array de caractères (support UTF-8)
		return preg_split( '//u', $text, -1, PREG_SPLIT_NO_EMPTY );
	}

	/**
	 * Générer les styles CSS inline pour cet élément
	 *
	 * @param string $unique_id  ID unique de l'élément
	 * @param array  $atts       Attributs de l'élément
	 * @param int    $char_count Nombre de caractères
	 * @return string Balise <style> avec les CSS inline
	 */
	private function generate_inline_styles( $unique_id, $atts, $char_count ) {
		$styles = "<style>";

		// Calculer l'angle de rotation par caractère
		$rotation_angle = 360 / $char_count;

		// Variables CSS personnalisées
		$styles .= ".{$unique_id} {";
		$styles .= "--sui-ctb-button-size: {$atts['button_size']};";
		$styles .= "--sui-ctb-circle-size: {$atts['circle_size']};";
		$styles .= "--sui-ctb-icon-size: {$atts['icon_size']};";
		$styles .= "--sui-ctb-font-size: {$atts['font_size']};";
		$styles .= "--sui-ctb-font-weight: {$atts['font_weight']};";
		$styles .= "--sui-ctb-text-inset: {$atts['text_inset']};";
		$styles .= "--sui-ctb-bg-color: {$atts['bg_color']};";
		$styles .= "--sui-ctb-bg-hover: {$atts['bg_color_hover']};";
		$styles .= "--sui-ctb-text-color: {$atts['text_color']};";
		$styles .= "--sui-ctb-circle-bg: {$atts['circle_bg_color']};";
		$styles .= "--sui-ctb-icon-color: {$atts['icon_color']};";
		$styles .= "--sui-ctb-icon-color-hover: {$atts['icon_color_hover']};";
		$styles .= "--sui-ctb-rotation-duration: {$atts['text_rotation_duration']};";
		$styles .= "--sui-ctb-rotation-timing: {$atts['rotation_timing']};";
		$styles .= "--sui-ctb-bg-transition: {$atts['bg_transition_duration']};";
		$styles .= "--sui-ctb-scale-transition: {$atts['scale_transition_duration']};";
		$styles .= "--sui-ctb-hover-scale: {$atts['hover_scale']};";
		$styles .= "--sui-ctb-icon-transition: {$atts['icon_transition_duration']};";
		$styles .= "--sui-ctb-icon-delay: {$atts['icon_copy_delay']};";
		$styles .= "--sui-ctb-rotation-angle: {$rotation_angle}deg;";
		$styles .= "}";

		$styles .= "</style>";

		return $styles;
	}
}