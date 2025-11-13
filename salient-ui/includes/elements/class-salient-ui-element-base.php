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
		salient_ui_log( 'Element_Base::__construct() appelé pour ' . get_class( $this ) );

		// Enregistrer le shortcode WordPress
		add_shortcode( $this->get_shortcode_tag(), array( $this, 'render' ) );
		salient_ui_log( 'Shortcode enregistré : ' . $this->get_shortcode_tag() );

		// Enregistrer l'élément dans WPBakery immédiatement
		// (pas besoin de hook car on est déjà dans le bon contexte)
		$this->map_element();

		// Enregistrer les assets CSS/JS de l'élément
		$this->register_element_assets();
	}

	/**
	 * Obtenir le tag du shortcode
	 * Doit être implémenté par les classes enfants
	 *
	 * @return string Tag du shortcode (ex: 'salient_ui_button')
	 */
	abstract protected function get_shortcode_tag();

	/**
	 * Obtenir le slug de l'élément (pour les assets CSS/JS)
	 * Doit être implémenté par les classes enfants
	 *
	 * @return string Slug de l'élément (ex: 'button', 'card')
	 */
	abstract protected function get_element_slug();

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
	 * Appelé directement depuis le constructeur
	 */
	public function map_element() {
		$class_name = get_class( $this );
		salient_ui_log( "map_element() appelé pour {$class_name}" );

		// Vérifier que la fonction vc_map existe (WPBakery actif)
		if ( ! function_exists( 'vc_map' ) ) {
			salient_ui_log( "✗ ERREUR : vc_map() n'existe pas pour {$class_name}" );
			return;
		}

		// Récupérer la configuration de l'élément
		$config = $this->get_vc_config();
		salient_ui_log( "Configuration récupérée pour {$class_name} : base = " . ( isset( $config['base'] ) ? $config['base'] : 'non défini' ) );

		// Enregistrer l'élément dans WPBakery
		vc_map( $config );
		salient_ui_log( "✓ Élément {$class_name} enregistré dans WPBakery avec succès" );
	}

	/**
	 * Enregistrer les assets CSS et JS de l'élément
	 * Appelé depuis le constructeur
	 */
	protected function register_element_assets() {
		$slug = $this->get_element_slug();
		$class_name = get_class( $this );

		salient_ui_log( "Enregistrement des assets pour {$class_name} (slug: {$slug})" );

		// Enregistrer le CSS de l'élément
		$css_file = SALIENT_UI_PATH . 'assets/css/elements/' . $slug . '.css';
		if ( file_exists( $css_file ) ) {
			$handle = 'salient-ui-' . $slug;
			wp_register_style(
				$handle,
				SALIENT_UI_URL . 'assets/css/elements/' . $slug . '.css',
				array( 'salient-ui-base' ), // Dépend du CSS de base
				SALIENT_UI_VERSION,
				'all'
			);

			// Enqueue immédiatement (sera chargé sur toutes les pages)
			// Alternative : enqueue seulement si le shortcode est utilisé (via has_shortcode)
			add_action( 'wp_enqueue_scripts', function() use ( $handle ) {
				wp_enqueue_style( $handle );
			} );

			salient_ui_log( "✓ CSS enregistré : {$handle}" );
		} else {
			salient_ui_log( "⚠ Fichier CSS introuvable : {$css_file}" );
		}

		// Enregistrer le JS de l'élément
		$js_file = SALIENT_UI_PATH . 'assets/js/elements/' . $slug . '.js';
		if ( file_exists( $js_file ) ) {
			$handle = 'salient-ui-' . $slug;
			wp_register_script(
				$handle,
				SALIENT_UI_URL . 'assets/js/elements/' . $slug . '.js',
				array( 'jquery', 'salient-ui-core' ), // Dépend de jQuery et du core
				SALIENT_UI_VERSION,
				true
			);

			// Enqueue immédiatement
			add_action( 'wp_enqueue_scripts', function() use ( $handle ) {
				wp_enqueue_script( $handle );
			} );

			salient_ui_log( "✓ JS enregistré : {$handle}" );
		} else {
			salient_ui_log( "⚠ Fichier JS introuvable : {$js_file}" );
		}
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
