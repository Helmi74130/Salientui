<?php
/**
 * Classe de base abstraite pour tous les éléments WPBakery
 * Fournit une structure commune et des méthodes réutilisables
 *
 * @package SalientUI
 * @since 1.0.0
 */

// Si ce fichier est appelé directement, on arrête l'exécution
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Salient_UI_Element_Base
 *
 * Classe abstraite à étendre par tous les éléments personnalisés
 */
abstract class Salient_UI_Element_Base {

	/**
	 * Constructeur
	 * Initialise l'élément en enregistrant le shortcode et la configuration WPBakery
	 */
	public function __construct() {
		// Enregistrer l'élément dans WPBakery sur le hook 'init'
		add_action( 'init', array( $this, 'map_element' ) );

		// Enregistrer le shortcode WordPress
		add_shortcode( $this->get_shortcode_tag(), array( $this, 'render' ) );
	}

	/**
	 * Obtenir le tag du shortcode
	 * Doit être implémenté par les classes enfants
	 *
	 * @return string Tag du shortcode (ex: 'salient_ui_button')
	 */
	abstract protected function get_shortcode_tag();

	/**
	 * Obtenir la configuration WPBakery pour cet élément
	 * Doit être implémenté par les classes enfants
	 *
	 * @return array Configuration de l'élément pour vc_map()
	 */
	abstract protected function get_vc_config();

	/**
	 * Render le shortcode
	 * Doit être implémenté par les classes enfants
	 *
	 * @param array  $atts    Attributs du shortcode
	 * @param string $content Contenu du shortcode (pour les shortcodes avec contenu)
	 * @return string HTML de l'élément
	 */
	abstract public function render( $atts, $content = null );

	/**
	 * Enregistrer l'élément dans WPBakery Page Builder
	 * Appelé sur le hook 'init'
	 */
	public function map_element() {
		// Vérifier que la fonction vc_map existe (WPBakery actif)
		if ( ! function_exists( 'vc_map' ) ) {
			return;
		}

		// Récupérer la configuration de l'élément
		$config = $this->get_vc_config();

		// Enregistrer l'élément dans WPBakery
		vc_map( $config );
	}

	/**
	 * Charger un template et retourner son HTML
	 *
	 * @param string $template_name Nom du template (sans .php)
	 * @param array  $args          Variables à passer au template
	 * @return string HTML du template
	 */
	protected function load_template( $template_name, $args = array() ) {
		// Extraire les variables pour les rendre disponibles dans le template
		if ( ! empty( $args ) && is_array( $args ) ) {
			extract( $args );
		}

		// Chemin du template
		$template_path = SALIENT_UI_PATH . 'includes/templates/' . $template_name . '.php';

		// Vérifier que le template existe
		if ( ! file_exists( $template_path ) ) {
			if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
				return sprintf(
					'<!-- SalientUI: Template %s introuvable -->',
					esc_html( $template_name )
				);
			}
			return '';
		}

		// Démarrer la capture de sortie
		ob_start();

		// Inclure le template
		include $template_path;

		// Récupérer le contenu et nettoyer le buffer
		$html = ob_get_clean();

		return $html;
	}

	/**
	 * Parser un paramètre vc_link
	 * Convertit la chaîne vc_link en tableau exploitable
	 *
	 * @param string $value Valeur du paramètre vc_link
	 * @return array Tableau avec url, title, target
	 */
	protected function parse_vc_link( $value ) {
		// Valeurs par défaut
		$defaults = array(
			'url'    => '',
			'title'  => '',
			'target' => '_self',
		);

		// Si la valeur est vide, retourner les valeurs par défaut
		if ( empty( $value ) ) {
			return $defaults;
		}

		// Parser le lien avec la fonction WPBakery
		if ( function_exists( 'vc_build_link' ) ) {
			$link = vc_build_link( $value );
			return wp_parse_args( $link, $defaults );
		}

		return $defaults;
	}

	/**
	 * Construire une chaîne de classes CSS
	 *
	 * @param array $classes Tableau de classes CSS
	 * @return string Chaîne de classes séparées par des espaces
	 */
	protected function build_classes( $classes ) {
		// Filtrer les valeurs vides
		$classes = array_filter( $classes );

		// Joindre avec des espaces
		return implode( ' ', $classes );
	}

	/**
	 * Obtenir l'URL d'une image depuis son ID
	 *
	 * @param int    $image_id ID de l'image
	 * @param string $size     Taille de l'image (thumbnail, medium, large, full)
	 * @return string|false URL de l'image ou false si non trouvée
	 */
	protected function get_image_url( $image_id, $size = 'full' ) {
		if ( empty( $image_id ) ) {
			return false;
		}

		$image = wp_get_attachment_image_src( $image_id, $size );

		return $image ? $image[0] : false;
	}
}
