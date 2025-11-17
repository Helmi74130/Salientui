<?php
/**
 * Élément Word Rotator Loader pour WPBakery Page Builder
 * Loader animé avec rotation de mots
 *
 * @package SalientUI
 * @since 1.0.0
 */

// Si ce fichier est appelé directement, on arrête l'exécution
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Salient_UI_Word_Rotator_Loader
 *
 * Élément WPBakery pour afficher un loader avec rotation de mots
 */
class Salient_UI_Word_Rotator_Loader extends Salient_UI_Element_Base {

	/**
	 * Obtenir le tag du shortcode
	 *
	 * @return string Tag du shortcode
	 */
	protected function get_shortcode_tag() {
		return 'salient_ui_word_rotator_loader';
	}

	/**
	 * Obtenir le slug de l'élément (pour les assets CSS/JS)
	 *
	 * @return string Slug de l'élément
	 */
	protected function get_element_slug() {
		return 'word-rotator-loader';
	}

	/**
	 * Obtenir la configuration WPBakery pour cet élément
	 *
	 * @return array Configuration de l'élément pour vc_map()
	 */
	protected function get_vc_config() {
		return array(
			'name'        => __( 'Word Rotator Loader', 'salient-ui' ),
			'base'        => $this->get_shortcode_tag(),
			'category'    => __( 'SalientUI', 'salient-ui' ),
			'icon'        => SALIENT_UI_URL . 'assets/images/icon-word-rotator-loader.svg',
			'description' => __( 'Loader animé avec rotation de mots personnalisables', 'salient-ui' ),
			'params'      => array(
				// === CONTENU ===
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Texte principal', 'salient-ui' ),
					'param_name'  => 'main_text',
					'value'       => 'loading',
					'description' => __( 'Texte affiché avant les mots animés', 'salient-ui' ),
					'admin_label' => true,
				),

				array(
					'type'        => 'textarea',
					'heading'     => __( 'Mots à faire défiler', 'salient-ui' ),
					'param_name'  => 'rotating_words',
					'value'       => "buttons\nforms\nswitches\ncards\nbuttons",
					'description' => __( 'Un mot par ligne. Le dernier mot devrait être identique au premier pour une boucle fluide.', 'salient-ui' ),
				),

				// === STYLE CONTENEUR ===
				array(
					'type'       => 'dropdown',
					'heading'    => __( 'Style Conteneur', 'salient-ui' ),
					'param_name' => 'container_separator',
					'value'      => array( '' => '' ),
					'group'      => __( 'Style Conteneur', 'salient-ui' ),
				),

				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur de fond', 'salient-ui' ),
					'param_name'  => 'bg_color',
					'value'       => '#111111',
					'description' => __( 'Couleur de fond du conteneur', 'salient-ui' ),
					'group'       => __( 'Style Conteneur', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Padding', 'salient-ui' ),
					'param_name'  => 'container_padding',
					'value'       => '1rem 2rem',
					'description' => __( 'Padding du conteneur (ex: 1rem 2rem)', 'salient-ui' ),
					'group'       => __( 'Style Conteneur', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Rayon de bordure', 'salient-ui' ),
					'param_name'  => 'border_radius',
					'value'       => '1.25rem',
					'description' => __( 'Rayon de bordure (ex: 1.25rem)', 'salient-ui' ),
					'group'       => __( 'Style Conteneur', 'salient-ui' ),
				),

				// === STYLE TEXTE ===
				array(
					'type'       => 'dropdown',
					'heading'    => __( 'Style Texte', 'salient-ui' ),
					'param_name' => 'text_separator',
					'value'      => array( '' => '' ),
					'group'      => __( 'Style Texte', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Taille de police', 'salient-ui' ),
					'param_name'  => 'font_size',
					'value'       => '25px',
					'description' => __( 'Taille de la police (ex: 25px)', 'salient-ui' ),
					'group'       => __( 'Style Texte', 'salient-ui' ),
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
					'group'       => __( 'Style Texte', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Famille de police', 'salient-ui' ),
					'param_name'  => 'font_family',
					'value'       => 'Poppins, sans-serif',
					'description' => __( 'Famille de police (ex: Poppins, sans-serif)', 'salient-ui' ),
					'group'       => __( 'Style Texte', 'salient-ui' ),
				),

				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur du texte principal', 'salient-ui' ),
					'param_name'  => 'main_text_color',
					'value'       => '#7c7c7c',
					'description' => __( 'Couleur du texte "loading"', 'salient-ui' ),
					'group'       => __( 'Style Texte', 'salient-ui' ),
				),

				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Couleur des mots animés', 'salient-ui' ),
					'param_name'  => 'animated_words_color',
					'value'       => '#956afa',
					'description' => __( 'Couleur des mots qui défilent', 'salient-ui' ),
					'group'       => __( 'Style Texte', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Espacement des mots', 'salient-ui' ),
					'param_name'  => 'word_spacing',
					'value'       => '6px',
					'description' => __( 'Espacement entre le texte et les mots (ex: 6px)', 'salient-ui' ),
					'group'       => __( 'Style Texte', 'salient-ui' ),
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
					'heading'     => __( 'Durée de l\'animation', 'salient-ui' ),
					'param_name'  => 'animation_duration',
					'value'       => '4s',
					'description' => __( 'Durée totale de l\'animation (ex: 4s)', 'salient-ui' ),
					'group'       => __( 'Animation', 'salient-ui' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Hauteur du conteneur de mots', 'salient-ui' ),
					'param_name'  => 'words_height',
					'value'       => '40px',
					'description' => __( 'Hauteur de la zone d\'affichage des mots (ex: 40px)', 'salient-ui' ),
					'group'       => __( 'Animation', 'salient-ui' ),
				),

				// Classe CSS personnalisée
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Classe CSS supplémentaire', 'salient-ui' ),
					'param_name'  => 'el_class',
					'value'       => '',
					'description' => __( 'Classe CSS personnalisée', 'salient-ui' ),
					'group'       => __( 'Style Conteneur', 'salient-ui' ),
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
				'main_text'            => 'loading',
				'rotating_words'       => "buttons\nforms\nswitches\ncards\nbuttons",
				'bg_color'             => '#111111',
				'container_padding'    => '1rem 2rem',
				'border_radius'        => '1.25rem',
				'font_size'            => '25px',
				'font_weight'          => '500',
				'font_family'          => 'Poppins, sans-serif',
				'main_text_color'      => '#7c7c7c',
				'animated_words_color' => '#956afa',
				'word_spacing'         => '6px',
				'animation_duration'   => '4s',
				'words_height'         => '40px',
				'el_class'             => '',
			),
			$atts,
			$this->get_shortcode_tag()
		);

		// Convertir les mots en tableau
		$words_array = array_filter( array_map( 'trim', explode( "\n", $atts['rotating_words'] ) ) );

		// Générer un ID unique pour les styles inline
		$unique_id = 'sui-wrl-' . uniqid();

		// Construire les classes CSS
		$classes = array(
			'salient-ui-wrl-container',
			$unique_id,
		);

		// Ajouter la classe personnalisée si fournie
		if ( ! empty( $atts['el_class'] ) ) {
			$classes[] = esc_attr( $atts['el_class'] );
		}

		// Générer les styles inline pour cet élément spécifique
		$inline_styles = $this->generate_inline_styles( $unique_id, $atts, $words_array );

		// Charger le template avec les variables
		return $inline_styles . $this->load_template(
			'word-rotator-loader',
			array(
				'main_text' => $atts['main_text'],
				'words'     => $words_array,
				'classes'   => $this->build_classes( $classes ),
			)
		);
	}

	/**
	 * Générer les styles CSS inline pour cet élément
	 *
	 * @param string $unique_id   ID unique de l'élément
	 * @param array  $atts        Attributs de l'élément
	 * @param array  $words_array Tableau des mots
	 * @return string Balise <style> avec les CSS inline
	 */
	private function generate_inline_styles( $unique_id, $atts, $words_array ) {
		$styles = "<style>";

		// Styles du conteneur principal
		$styles .= ".{$unique_id} {";
		$styles .= "--sui-wrl-bg-color: {$atts['bg_color']};";
		$styles .= "background-color: var(--sui-wrl-bg-color);";
		$styles .= "padding: {$atts['container_padding']};";
		$styles .= "border-radius: {$atts['border_radius']};";
		$styles .= "}";

		// Styles du loader
		$styles .= ".{$unique_id} .salient-ui-wrl-loader {";
		$styles .= "color: {$atts['main_text_color']};";
		$styles .= "font-family: {$atts['font_family']};";
		$styles .= "font-weight: {$atts['font_weight']};";
		$styles .= "font-size: {$atts['font_size']};";
		$styles .= "height: {$atts['words_height']};";
		$styles .= "}";

		// Styles des mots animés
		$styles .= ".{$unique_id} .salient-ui-wrl-word {";
		$styles .= "color: {$atts['animated_words_color']};";
		$styles .= "padding-left: {$atts['word_spacing']};";
		$styles .= "animation-duration: {$atts['animation_duration']};";
		$styles .= "}";

		// Générer l'animation keyframes personnalisée basée sur le nombre de mots
		$word_count = count( $words_array );
		if ( $word_count > 1 ) {
			$styles .= $this->generate_keyframes_animation( $unique_id, $word_count );
		}

		$styles .= "</style>";

		return $styles;
	}

	/**
	 * Générer les keyframes d'animation basés sur le nombre de mots
	 *
	 * @param string $unique_id  ID unique de l'élément
	 * @param int    $word_count Nombre de mots
	 * @return string CSS keyframes
	 */
	private function generate_keyframes_animation( $unique_id, $word_count ) {
		$keyframes = "@keyframes sui-wrl-spin-{$unique_id} {";

		// Calculer les pourcentages pour chaque mot
		$step_percentage = 100 / $word_count;

		for ( $i = 0; $i < $word_count; $i++ ) {
			$pause_start = ( $i * $step_percentage ) + ( $step_percentage * 0.1 );
			$move_start  = ( $i * $step_percentage ) + ( $step_percentage * 0.25 );

			// Position de pause
			if ( $i < $word_count - 1 ) {
				$translate_y = -( ( $i + 1 ) * 102 );

				$keyframes .= $pause_start . '% {';
				$keyframes .= "transform: translateY({$translate_y}%);";
				$keyframes .= '}';

				$keyframes .= $move_start . '% {';
				$keyframes .= "transform: translateY(" . ( $translate_y + 2 ) . '%);';
				$keyframes .= '}';
			}
		}

		// Position finale (retour au début)
		$final_translate = -( ( $word_count - 1 ) * 100 );
		$keyframes       .= '100% {';
		$keyframes       .= "transform: translateY({$final_translate}%);";
		$keyframes       .= '}';

		$keyframes .= '}';

		// Appliquer l'animation personnalisée
		$keyframes .= ".{$unique_id} .salient-ui-wrl-word {";
		$keyframes .= "animation-name: sui-wrl-spin-{$unique_id};";
		$keyframes .= '}';

		return $keyframes;
	}
}