<?php
/**
 * Classe principale du plugin SalientUI
 * Gère l'initialisation et la coordination des différents composants
 *
 * @package SalientUI
 * @since 1.0.0
 */

// Si ce fichier est appelé directement, on arrête l'exécution
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Salient_UI_Core
 *
 * Pattern Singleton pour garantir une seule instance de la classe
 */
class Salient_UI_Core {

	/**
	 * Instance unique de la classe (Singleton)
	 *
	 * @var Salient_UI_Core|null
	 */
	private static $instance = null;

	/**
	 * Constructeur privé pour empêcher l'instanciation directe
	 * Appelé uniquement via get_instance()
	 */
	private function __construct() {
		$this->init();
	}

	/**
	 * Récupérer l'instance unique de la classe (Singleton)
	 *
	 * @return Salient_UI_Core Instance unique de la classe
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Initialiser le plugin
	 * Configure tous les hooks et charge les composants nécessaires
	 */
	private function init() {
		// Charger les traductions
		add_action( 'init', array( $this, 'load_textdomain' ) );

		// Initialiser la gestion des assets (CSS/JS)
		Salient_UI_Assets::get_instance();

		// Hook pour intégrer avec WPBakery Page Builder
		// vc_before_init se déclenche quand WPBakery est prêt
		add_action( 'vc_before_init', array( $this, 'init_wpbakery' ) );
	}

	/**
	 * Charger les fichiers de traduction du plugin
	 * Permet la traduction des textes du plugin
	 */
	public function load_textdomain() {
		load_plugin_textdomain(
			'salient-ui',
			false,
			dirname( plugin_basename( SALIENT_UI_PATH ) ) . '/languages/'
		);
	}

	/**
	 * Initialiser l'intégration avec WPBakery Page Builder
	 * Appelé sur le hook 'vc_before_init'
	 */
	public function init_wpbakery() {
		// Initialiser le gestionnaire d'éléments WPBakery
		Salient_UI_WPBakery::get_instance();
	}

	/**
	 * Empêcher le clonage de l'instance (Singleton)
	 */
	private function __clone() {}

	/**
	 * Empêcher la désérialisation de l'instance (Singleton)
	 */
	public function __wakeup() {
		throw new Exception( 'Cannot unserialize singleton' );
	}
}
