<?php
/**
 * Gestion des assets (CSS et JavaScript) du plugin SalientUI
 * Enqueue les fichiers CSS et JS sur le frontend
 *
 * @package SalientUI
 * @since 1.0.0
 */

// Si ce fichier est appelé directement, on arrête l'exécution
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Salient_UI_Assets
 *
 * Pattern Singleton pour garantir une seule instance de la classe
 */
class Salient_UI_Assets {

	/**
	 * Instance unique de la classe (Singleton)
	 *
	 * @var Salient_UI_Assets|null
	 */
	private static $instance = null;

	/**
	 * Constructeur privé pour empêcher l'instanciation directe
	 * Appelé uniquement via get_instance()
	 */
	private function __construct() {
		$this->init_hooks();
	}

	/**
	 * Récupérer l'instance unique de la classe (Singleton)
	 *
	 * @return Salient_UI_Assets Instance unique de la classe
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Initialiser les hooks WordPress
	 */
	private function init_hooks() {
		// Enqueue assets sur le frontend
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_frontend_assets' ) );
	}

	/**
	 * Enqueue les assets CSS et JS sur le frontend
	 * Appelé sur le hook 'wp_enqueue_scripts'
	 */
	public function enqueue_frontend_assets() {
		// Enqueue CSS
		wp_enqueue_style(
			'salient-ui',
			SALIENT_UI_URL . 'assets/css/salient-ui.css',
			array(), // Pas de dépendances CSS
			SALIENT_UI_VERSION,
			'all' // Media type
		);

		// Enqueue JavaScript
		wp_enqueue_script(
			'salient-ui',
			SALIENT_UI_URL . 'assets/js/salient-ui.js',
			array( 'jquery' ), // Dépendance à jQuery
			SALIENT_UI_VERSION,
			true // Charger dans le footer
		);

		// Passer des données PHP au JavaScript si nécessaire
		wp_localize_script(
			'salient-ui',
			'salientUI',
			array(
				'ajaxUrl' => admin_url( 'admin-ajax.php' ),
				'nonce'   => wp_create_nonce( 'salient-ui-nonce' ),
			)
		);
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
