<?php
/**
 * Plugin Name: SalientUI
 * Plugin URI: https://github.com/Helmi74130/Salientui
 * Description: Ajoute des composants modernes (style shadcn/ui) à WPBakery Page Builder. Compatible avec tous les thèmes utilisant WPBakery.
 * Version: 1.0.0
 * Author: Helmi74130
 * Author URI: https://github.com/Helmi74130
 * Text Domain: salient-ui
 * Domain Path: /languages
 * Requires at least: 5.0
 * Requires PHP: 7.4
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 * @package SalientUI
 */

// Si ce fichier est appelé directement, on arrête l'exécution
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Définition des constantes du plugin
 */
define( 'SALIENT_UI_VERSION', '1.0.0' );
define( 'SALIENT_UI_PATH', plugin_dir_path( __FILE__ ) );
define( 'SALIENT_UI_URL', plugin_dir_url( __FILE__ ) );

/**
 * Autoloader PSR-4 pour charger automatiquement les classes
 *
 * Convertit les noms de classes en noms de fichiers :
 * - Salient_UI_Button → class-salient-ui-button.php
 * - Salient_UI_Core → class-salient-ui-core.php
 *
 * @param string $class_name Nom de la classe à charger
 */
function salient_ui_autoloader( $class_name ) {
	// Préfixe des classes du plugin
	$prefix = 'Salient_UI_';

	// Vérifier si la classe utilise notre préfixe
	$len = strlen( $prefix );
	if ( strncmp( $prefix, $class_name, $len ) !== 0 ) {
		return;
	}

	// Récupérer le nom de la classe sans le préfixe
	$relative_class = substr( $class_name, $len );

	// Convertir le nom de classe en nom de fichier
	// Salient_UI_Element_Base → element-base
	$file_name = strtolower( str_replace( '_', '-', $relative_class ) );

	// Chemin complet du fichier
	// class-salient-ui-{nom}.php
	$file = SALIENT_UI_PATH . 'includes/class-salient-ui-' . $file_name . '.php';

	// Cas spécial pour les éléments dans le sous-dossier elements/
	if ( strpos( $class_name, 'Salient_UI_Element_' ) === 0 ||
	     strpos( $class_name, 'Salient_UI_Button' ) === 0 ||
	     strpos( $class_name, 'Salient_UI_Card' ) === 0 ) {
		$file = SALIENT_UI_PATH . 'includes/elements/class-salient-ui-' . $file_name . '.php';
	}

	// Charger le fichier s'il existe
	if ( file_exists( $file ) ) {
		require_once $file;
	}
}
spl_autoload_register( 'salient_ui_autoloader' );

/**
 * Vérifier que WPBakery Page Builder est actif
 *
 * @return bool True si WPBakery est actif, false sinon
 */
function salient_ui_check_wpbakery() {
	// Vérifier si la fonction principale de WPBakery existe
	if ( ! function_exists( 'vc_map' ) ) {
		return false;
	}

	// Vérifier si la constante WPB_VC_VERSION est définie
	if ( ! defined( 'WPB_VC_VERSION' ) ) {
		return false;
	}

	return true;
}

/**
 * Afficher une notice d'administration si WPBakery n'est pas actif
 */
function salient_ui_admin_notice() {
	?>
	<div class="notice notice-error">
		<p>
			<strong><?php esc_html_e( 'SalientUI', 'salient-ui' ); ?></strong>
			<?php esc_html_e( 'nécessite que WPBakery Page Builder soit installé et activé.', 'salient-ui' ); ?>
		</p>
	</div>
	<?php
}

/**
 * Hook d'activation du plugin
 * Vérifie que WPBakery est installé
 */
function salient_ui_activate() {
	// Vérifier WPBakery lors de l'activation
	if ( ! salient_ui_check_wpbakery() ) {
		// Désactiver le plugin
		deactivate_plugins( plugin_basename( __FILE__ ) );

		// Message d'erreur
		wp_die(
			esc_html__( 'SalientUI nécessite que WPBakery Page Builder soit installé et activé. Veuillez installer WPBakery Page Builder avant d\'activer ce plugin.', 'salient-ui' ),
			esc_html__( 'Erreur d\'activation du plugin', 'salient-ui' ),
			array( 'back_link' => true )
		);
	}
}
register_activation_hook( __FILE__, 'salient_ui_activate' );

/**
 * Initialiser le plugin
 * Appelé sur le hook 'plugins_loaded'
 */
function salient_ui_init() {
	// Vérifier que WPBakery est actif
	if ( ! salient_ui_check_wpbakery() ) {
		// Afficher une notice d'administration
		add_action( 'admin_notices', 'salient_ui_admin_notice' );
		return;
	}

	// Initialiser la classe principale
	Salient_UI_Core::get_instance();
}
add_action( 'plugins_loaded', 'salient_ui_init' );
