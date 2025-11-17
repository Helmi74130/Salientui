# Architecture SalientUI

Ce document explique l'architecture du plugin SalientUI, spécialement conçue pour être **scalable** et pouvoir gérer **des centaines d'éléments** facilement.

## 📁 Structure des fichiers

```
salient-ui/
├── salient-ui.php                          # Fichier principal
├── README.md                                # Documentation utilisateur
├── ARCHITECTURE.md                          # Ce fichier
├── readme.txt                               # WordPress plugin readme
├── assets/
│   ├── css/
│   │   ├── base.css                        # ⭐ Variables CSS, reset, utilitaires
│   │   ├── elements/
│   │   │   ├── button.css                  # CSS spécifique au bouton
│   │   │   └── card.css                    # CSS spécifique à la card
│   │   └── salient-ui.css                  # [DEPRECATED] Ancien fichier monolithique
│   ├── js/
│   │   ├── salient-ui-core.js              # ⭐ Core JS avec utilitaires
│   │   ├── elements/
│   │   │   ├── button.js                   # JS spécifique au bouton
│   │   │   └── card.js                     # JS spécifique à la card
│   │   └── salient-ui.js                   # [DEPRECATED] Ancien fichier monolithique
│   └── images/
│       ├── icon-button.svg
│       └── icon-card.svg
├── includes/
│   ├── class-salient-ui-core.php           # Classe principale
│   ├── class-salient-ui-assets.php         # Gestion des assets globaux
│   ├── class-salient-ui-wpbakery.php       # Intégration WPBakery
│   ├── elements/
│   │   ├── class-salient-ui-element-base.php  # ⭐ Classe de base abstraite
│   │   ├── class-salient-ui-button.php        # Élément Button
│   │   └── class-salient-ui-card.php          # Élément Card
│   └── templates/
│       ├── button.php                      # Template HTML Button
│       └── card.php                        # Template HTML Card
└── languages/
    └── salient-ui.pot
```

## 🎯 Principes de l'architecture

### 1. Séparation des assets par élément

**Avant** (approche monolithique) :
- ❌ Un seul fichier `salient-ui.css` avec tous les styles
- ❌ Un seul fichier `salient-ui.js` avec tout le JavaScript
- ❌ Difficile à maintenir avec des centaines d'éléments
- ❌ Chargement de styles/scripts inutilisés

**Maintenant** (approche modulaire) :
- ✅ Fichier `base.css` avec uniquement les variables et utilitaires
- ✅ Chaque élément a son propre CSS : `elements/[slug].css`
- ✅ Chaque élément a son propre JS : `elements/[slug].js`
- ✅ Facile à maintenir et à étendre
- ✅ Code organisé et prévisible

### 2. Chargement automatique des assets

Chaque élément charge automatiquement ses propres assets via la classe `Salient_UI_Element_Base`.

**Fichiers de base** (chargés sur toutes les pages) :
- `base.css` - Variables CSS, reset, utilitaires
- `salient-ui-core.js` - Utilitaires JavaScript communs

**Fichiers par élément** (chargés automatiquement) :
- `elements/[slug].css` - Styles de l'élément
- `elements/[slug].js` - JavaScript de l'élément

### 3. Pattern de développement

Le plugin utilise plusieurs design patterns pour garantir la qualité :

- **Singleton** : Pour les classes principales (Core, Assets, WPBakery)
- **Template Method** : Via la classe abstraite Element_Base
- **Autoloading PSR-4** : Chargement automatique des classes
- **Observer Pattern** : Pour le contenu dynamique (MutationObserver)

## 🔧 Comment ajouter un nouvel élément

### Étape 1 : Créer la classe PHP

Créez `includes/elements/class-salient-ui-[element].php` :

```php
<?php
class Salient_UI_Alert extends Salient_UI_Element_Base {

    protected function get_shortcode_tag() {
        return 'salient_ui_alert';
    }

    protected function get_element_slug() {
        return 'alert'; // ⭐ Utilisé pour charger les assets
    }

    protected function get_vc_config() {
        return array(
            'name'        => __( 'Alert', 'salient-ui' ),
            'base'        => $this->get_shortcode_tag(),
            'category'    => __( 'SalientUI', 'salient-ui' ),
            'description' => __( 'Alert component', 'salient-ui' ),
            'params'      => array(
                // Vos paramètres ici
            ),
        );
    }

    public function render( $atts, $content = null ) {
        $atts = shortcode_atts(
            array(
                'type' => 'info',
                'title' => '',
            ),
            $atts,
            $this->get_shortcode_tag()
        );

        return $this->load_template( 'alert', array(
            'type'  => $atts['type'],
            'title' => $atts['title'],
            'content' => $content,
        ));
    }
}
```

### Étape 2 : Créer le template HTML

Créez `includes/templates/alert.php` :

```php
<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<div class="salient-ui-alert salient-ui-alert--<?php echo esc_attr( $type ); ?>">
    <?php if ( ! empty( $title ) ) : ?>
        <h4 class="salient-ui-alert__title">
            <?php echo esc_html( $title ); ?>
        </h4>
    <?php endif; ?>

    <div class="salient-ui-alert__content">
        <?php echo wp_kses_post( $content ); ?>
    </div>
</div>
```

### Étape 3 : Créer le CSS

Créez `assets/css/elements/alert.css` :

```css
/**
 * Alert Component Styles
 */

.salient-ui-alert {
    padding: 1rem;
    border-radius: var(--sui-radius);
    border-left: 4px solid currentColor;
}

.salient-ui-alert--info {
    background-color: #dbeafe;
    border-color: #3b82f6;
    color: #1e40af;
}

.salient-ui-alert--success {
    background-color: #d1fae5;
    border-color: #10b981;
    color: #065f46;
}

.salient-ui-alert__title {
    font-weight: 600;
    margin: 0 0 0.5rem 0;
}

.salient-ui-alert__content {
    font-size: 0.875rem;
}
```

### Étape 4 : Créer le JavaScript

Créez `assets/js/elements/alert.js` :

```javascript
/**
 * Alert Component JavaScript
 */

(function($) {
    'use strict';

    const AlertComponent = {
        selector: '.salient-ui-alert',

        init() {
            this.setupAlerts();
        },

        reinit(context) {
            const alerts = context.querySelectorAll(this.selector);
            if (alerts.length > 0) {
                this.setupAlerts(context);
            }
        },

        setupAlerts(context) {
            const alerts = context ?
                $(context).find(this.selector) :
                $(this.selector);

            alerts.each((index, alert) => {
                const $alert = $(alert);

                if ($alert.data('sui-alert-initialized')) {
                    return;
                }

                // Votre logique ici
                // Par exemple, fermeture de l'alert

                $alert.data('sui-alert-initialized', true);
            });

            if (window.SalientUI) {
                window.SalientUI.log(`Alert: ${alerts.length} alert(s) initialized`);
            }
        },
    };

    // Enregistrer le composant
    if (window.SalientUI) {
        window.SalientUI.registerComponent('Alert', AlertComponent);
    } else {
        $(document).ready(() => {
            AlertComponent.init();
        });
    }

})(jQuery);
```

### Étape 5 : Enregistrer l'élément

Ajoutez votre élément dans `includes/class-salient-ui-wpbakery.php` :

```php
private function load_elements() {
    $elements = array(
        'Salient_UI_Button',
        'Salient_UI_Card',
        'Salient_UI_Alert', // ⭐ Votre nouvel élément
    );

    // ... le reste du code
}
```

### ✅ C'est tout !

Les assets CSS et JS seront **automatiquement chargés** par `Element_Base::register_element_assets()`.

## 🎨 Assets de base

### base.css

Contient :
- Variables CSS (couleurs, rayons, transitions)
- Reset de base
- Utilitaires communs
- Support du dark mode

Toutes les variables utilisent le préfixe `--sui-*` :
```css
--sui-primary
--sui-secondary
--sui-border
--sui-radius
--sui-transition
```

### salient-ui-core.js

Fournit :
- Objet global `window.SalientUI`
- Système d'enregistrement des composants
- Observer pour le contenu dynamique
- Utilitaires (debounce, throttle, log)

## 🔄 Système de composants JavaScript

Chaque composant JS suit ce pattern :

```javascript
const ComponentName = {
    selector: '.salient-ui-component',

    init() {
        // Initialisation
    },

    reinit(context) {
        // Réinitialisation pour contenu dynamique
    },
};

// Enregistrement
window.SalientUI.registerComponent('ComponentName', ComponentName);
```

Le core appelle automatiquement `init()` au chargement et `reinit(context)` quand du contenu est ajouté dynamiquement.

## 📊 Avantages de cette architecture

### Maintenabilité
- ✅ Chaque élément est autonome
- ✅ Modification d'un élément n'affecte pas les autres
- ✅ Code prévisible et organisé

### Scalabilité
- ✅ Facile d'ajouter des centaines d'éléments
- ✅ Pas de conflit entre éléments
- ✅ Structure claire

### Performance
- ✅ Possibilité future de chargement conditionnel
- ✅ Séparation des responsabilités
- ✅ Code optimisé par élément

### Développement
- ✅ Développement en parallèle possible
- ✅ Tests unitaires facilités
- ✅ Documentation par élément

## 🚀 Optimisations futures possibles

### Chargement conditionnel

Actuellement, tous les assets d'éléments sont chargés sur toutes les pages. Une optimisation future pourrait être :

```php
// Charger uniquement si le shortcode est utilisé
global $post;
if ( has_shortcode( $post->post_content, 'salient_ui_button' ) ) {
    wp_enqueue_style( 'salient-ui-button' );
    wp_enqueue_script( 'salient-ui-button' );
}
```

### Build Process

- Minification automatique des CSS/JS
- Concaténation en mode production
- Source maps pour le développement

### Lazy Loading

- Chargement des CSS à la demande
- Intersection Observer pour les éléments

## 📚 Références

- **Variables CSS** : Toutes définies dans `assets/css/base.css`
- **API JavaScript** : `window.SalientUI` dans `assets/js/salient-ui-core.js`
- **Classe de base** : `Salient_UI_Element_Base` dans `includes/elements/class-salient-ui-element-base.php`

## ❓ Questions fréquentes

**Q : Puis-je utiliser SCSS/LESS ?**
R : Oui, il suffit de compiler vers CSS et placer le résultat dans `assets/css/elements/`.

**Q : Comment partager des styles entre éléments ?**
R : Utilisez `base.css` pour les variables et utilitaires partagés.

**Q : Les anciens fichiers peuvent-ils être supprimés ?**
R : Les fichiers `salient-ui.css` et `salient-ui.js` sont conservés pour compatibilité mais ne sont plus chargés.

**Q : Comment déboguer un élément ?**
R : Activez `WP_DEBUG` pour voir les logs détaillés de chargement des assets.
