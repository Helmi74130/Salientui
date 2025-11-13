# SalientUI - Composants modernes pour WPBakery Page Builder

Plugin WordPress qui ajoute des composants modernes (style shadcn/ui) à WPBakery Page Builder.

## 🎯 Prérequis

- WordPress 5.0 ou supérieur
- PHP 7.4 ou supérieur
- **WPBakery Page Builder** (obligatoire)

## 📦 Installation

### Installation standard

1. Téléchargez le plugin (dossier `salient-ui`)
2. Zippez le dossier en `salient-ui.zip`
3. Allez dans WordPress : **Extensions → Ajouter → Téléverser une extension**
4. Choisissez le fichier ZIP et cliquez sur **Installer maintenant**
5. **Activez le plugin**

### Installation manuelle via FTP

1. Téléversez le dossier `salient-ui` dans `/wp-content/plugins/`
2. Allez dans **Extensions** et activez **SalientUI**

## 🚀 Utilisation

1. Éditez une page avec **WPBakery Page Builder**
2. Cliquez sur **Ajouter un élément**
3. Cherchez la catégorie **"SalientUI"**
4. Ajoutez les composants **Modern Button** ou **Modern Card**

## 🔧 Résolution de problèmes

### Les éléments n'apparaissent pas dans WPBakery

Si les composants SalientUI n'apparaissent pas dans l'interface de WPBakery, suivez ces étapes :

#### 1. Vérifier que WPBakery est activé

Allez dans **Extensions** et assurez-vous que **WPBakery Page Builder** est bien activé.

#### 2. Activer le mode Debug

Ajoutez ces lignes dans votre fichier `wp-config.php` (avant la ligne `/* C'est tout, ne touchez pas à ce qui suit ! */`) :

```php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
```

#### 3. Consulter les logs

1. Les logs se trouvent dans `/wp-content/debug.log`
2. Rechargez une page de votre site (frontend ou admin)
3. Ouvrez le fichier `debug.log` et cherchez les lignes commençant par `[SalientUI]`

Exemple de logs normaux (tout fonctionne) :

```
[SalientUI] === Initialisation de SalientUI ===
[SalientUI] WPBakery détecté - Version : 6.10.0
[SalientUI] Fonction vc_map disponible : OUI
[SalientUI] Classe chargée : Salient_UI_Core depuis /path/to/includes/class-salient-ui-core.php
[SalientUI] Core::init() appelé
[SalientUI] vc_map existe déjà - Initialisation immédiate de WPBakery
[SalientUI] Core::init_wpbakery() appelé
[SalientUI] Classe chargée : Salient_UI_WPBakery depuis /path/to/includes/class-salient-ui-wpbakery.php
[SalientUI] WPBakery::load_elements() appelé
[SalientUI] Nombre d'éléments à charger : 2
[SalientUI] Tentative de chargement de la classe : Salient_UI_Button
[SalientUI] Classe chargée : Salient_UI_Button depuis /path/to/includes/elements/class-salient-ui-button.php
[SalientUI] ✓ Classe Salient_UI_Button instanciée avec succès
[SalientUI] Element_Base::__construct() appelé pour Salient_UI_Button
[SalientUI] Shortcode enregistré : salient_ui_button
[SalientUI] map_element() appelé pour Salient_UI_Button
[SalientUI] Configuration récupérée pour Salient_UI_Button : base = salient_ui_button
[SalientUI] ✓ Élément Salient_UI_Button enregistré dans WPBakery avec succès
```

#### 4. Identifier le problème

**Si vous voyez :** `ERREUR : WPBakery Page Builder n'est pas détecté`
→ **Solution :** Activez WPBakery Page Builder

**Si vous voyez :** `Fonction vc_map disponible : NON`
→ **Solution :** WPBakery n'est pas complètement chargé. Vérifiez que vous utilisez une version récente de WPBakery (6.0+)

**Si vous voyez :** `ERREUR : Fichier introuvable pour`
→ **Solution :** Le plugin n'est pas installé correctement. Réinstallez-le en vous assurant que tous les fichiers sont présents.

**Si vous voyez :** `La classe X n'existe pas`
→ **Solution :** Un fichier PHP est manquant ou corrompu. Réinstallez le plugin.

## 📝 Composants disponibles

### Modern Button

- **5 variantes :** Default, Secondary, Outline, Ghost, Destructive
- **3 tailles :** Small, Medium, Large
- **Support des icônes** (gauche/droite)
- **Animations** et transitions fluides

### Modern Card

- **3 variantes :** Default, Bordered, Elevated
- **Support :** Image, Titre, Contenu, Lien
- **Card cliquable** (optionnel)
- **Animations** au survol

## 🛠️ Support technique

### Vérifications de base

1. **Version de WordPress** : 5.0 minimum
2. **Version de PHP** : 7.4 minimum
3. **WPBakery** : Doit être actif et à jour
4. **Thème** : Compatible avec tous les thèmes qui utilisent WPBakery

### Conflits potentiels

Le plugin est conçu pour être compatible avec tous les thèmes et plugins, mais en cas de conflit :

1. Désactivez temporairement les autres plugins pour identifier le conflit
2. Vérifiez que votre thème n'écrase pas les styles du plugin
3. Consultez les logs avec WP_DEBUG activé

### Contacter le support

Si le problème persiste après avoir suivi ces étapes :

1. Activez WP_DEBUG et récupérez les logs
2. Notez la version de WordPress, PHP et WPBakery utilisée
3. Ouvrez une issue sur GitHub : [github.com/Helmi74130/Salientui/issues](https://github.com/Helmi74130/Salientui/issues)

## 💻 Pour les développeurs

### Ajouter un nouveau composant

1. Créez une classe dans `includes/elements/` qui étend `Salient_UI_Element_Base`
2. Créez le template HTML dans `includes/templates/`
3. Ajoutez la classe dans `includes/class-salient-ui-wpbakery.php`

Exemple :

```php
// includes/elements/class-salient-ui-alert.php
class Salient_UI_Alert extends Salient_UI_Element_Base {
    protected function get_shortcode_tag() {
        return 'salient_ui_alert';
    }

    protected function get_vc_config() {
        return array(
            'name' => 'Modern Alert',
            'base' => 'salient_ui_alert',
            'category' => 'SalientUI',
            // ... config
        );
    }

    public function render($atts, $content = null) {
        // ... render
    }
}
```

### Architecture

- **Autoloader PSR-4** : Chargement automatique des classes
- **Pattern Singleton** : Pour les classes principales
- **Code ES6+** : JavaScript moderne
- **PSR-12** : Standards de code PHP

## 📄 Licence

GPL v2 or later

## 🙏 Crédits

- Inspiré par [shadcn/ui](https://ui.shadcn.com/)
- Développé par [Helmi74130](https://github.com/Helmi74130)
