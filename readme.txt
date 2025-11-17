=== SalientUI ===
Contributors: Helmi74130
Tags: wpbakery, page builder, components, ui, shadcn
Requires at least: 5.0
Tested up to: 6.4
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Ajoute des composants modernes (style shadcn/ui) à WPBakery Page Builder. Compatible avec tous les thèmes utilisant WPBakery.

== Description ==

**SalientUI** est un plugin WordPress qui ajoute des composants d'interface utilisateur modernes et élégants à WPBakery Page Builder, inspirés de la bibliothèque shadcn/ui.

= Caractéristiques principales =

* ✅ **Composants modernes** - Design inspiré de shadcn/ui
* ✅ **Compatible universel** - Fonctionne avec TOUS les thèmes utilisant WPBakery
* ✅ **Facile à utiliser** - Intégration native dans WPBakery Page Builder
* ✅ **Code moderne** - Architecture POO, ES6+, PSR-12
* ✅ **Extensible** - Architecture conçue pour ajouter facilement de nouveaux composants
* ✅ **Accessible** - Support ARIA et navigation clavier
* ✅ **Responsive** - Optimisé pour tous les appareils
* ✅ **Dark Mode** - Support du mode sombre automatique

= Composants inclus =

**Modern Button**
* 5 variantes : Default, Secondary, Outline, Ghost, Destructive
* 3 tailles : Small, Medium, Large
* Support des icônes (gauche/droite)
* Animations et transitions fluides
* États hover et focus accessibles

**Modern Card**
* 3 variantes : Default, Bordered, Elevated
* Support image, titre, contenu, et lien
* Animations au survol
* Card entièrement cliquable (optionnel)
* Layout flexible et adaptatif

= Pourquoi SalientUI ? =

Contrairement aux bibliothèques de composants existantes, SalientUI se concentre sur :

* **Qualité plutôt que quantité** - Composants soigneusement designés
* **Performance** - Code optimisé et léger
* **Compatibilité** - Fonctionne avec n'importe quel thème WPBakery
* **Maintenabilité** - Code propre et bien documenté

= Développeurs =

Le plugin est conçu avec une architecture extensible :

* **Autoloader PSR-4** - Chargement automatique des classes
* **Pattern Singleton** - Gestion optimale des ressources
* **Classe de base abstraite** - Facilite la création de nouveaux éléments
* **Templates séparés** - HTML séparé de la logique PHP
* **Code ES6+** - JavaScript moderne (const/let, arrow functions, etc.)

Pour ajouter un nouveau composant, il suffit de :
1. Créer une classe qui étend `Salient_UI_Element_Base`
2. Créer le template HTML correspondant
3. Ajouter le composant dans `class-salient-ui-wpbakery.php`

= Prérequis =

* WordPress 5.0 ou supérieur
* PHP 7.4 ou supérieur
* **WPBakery Page Builder** (obligatoire)

== Installation ==

= Installation automatique =

1. Allez dans "Extensions" > "Ajouter"
2. Recherchez "SalientUI"
3. Cliquez sur "Installer maintenant"
4. Activez le plugin

= Installation manuelle =

1. Téléchargez le fichier ZIP du plugin
2. Allez dans "Extensions" > "Ajouter" > "Téléverser une extension"
3. Choisissez le fichier ZIP et cliquez sur "Installer maintenant"
4. Activez le plugin

= Après l'activation =

1. Assurez-vous que WPBakery Page Builder est installé et activé
2. Éditez une page avec WPBakery
3. Cherchez la catégorie "SalientUI" dans la liste des éléments
4. Ajoutez les composants Modern Button ou Modern Card à votre page

== Frequently Asked Questions ==

= Le plugin fonctionne-t-il sans WPBakery Page Builder ? =

Non, ce plugin nécessite WPBakery Page Builder pour fonctionner. Si WPBakery n'est pas installé, le plugin affichera un message d'erreur et ne se chargera pas.

= Le plugin est-il compatible avec mon thème ? =

Oui ! SalientUI est conçu pour fonctionner avec TOUS les thèmes qui utilisent WPBakery Page Builder. Il n'est pas limité au thème Salient.

= Puis-je personnaliser les styles des composants ? =

Oui, vous pouvez :
* Utiliser le champ "Classe CSS supplémentaire" dans chaque composant
* Surcharger les styles CSS dans votre thème
* Modifier les variables CSS dans `:root` pour changer les couleurs globales

= Comment ajouter mes propres composants ? =

Le plugin est conçu pour être extensible. Consultez la documentation développeur sur GitHub pour apprendre à créer vos propres composants.

= Le plugin ralentit-il mon site ? =

Non, le plugin est optimisé pour la performance :
* Fichiers CSS et JS minifiés
* Chargement uniquement sur le frontend
* Code moderne et efficace

= Le plugin est-il traduit ? =

Le plugin est prêt pour la traduction (i18n ready) et inclut :
* Fichier POT pour les traducteurs
* Tous les textes sont traduisibles
* Support de la localisation WordPress

== Screenshots ==

1. Composant Modern Button avec différentes variantes
2. Composant Modern Card avec image et contenu
3. Interface WPBakery avec les éléments SalientUI
4. Options de configuration du bouton dans WPBakery
5. Options de configuration de la card dans WPBakery

== Changelog ==

= 1.0.0 - 2025-01-13 =
* 🎉 Version initiale
* ✅ Composant Modern Button (5 variantes, 3 tailles)
* ✅ Composant Modern Card (3 variantes)
* ✅ Architecture extensible
* ✅ Code ES6+ moderne
* ✅ Support Dark Mode
* ✅ Support accessibilité (ARIA)
* ✅ Documentation complète

== Upgrade Notice ==

= 1.0.0 =
Version initiale du plugin. Installez pour commencer à utiliser les composants modernes dans WPBakery.

== Credits ==

* Inspiré par [shadcn/ui](https://ui.shadcn.com/)
* Développé par [Helmi74130](https://github.com/Helmi74130)

== Support ==

Pour obtenir de l'aide :
* Consultez la documentation : [GitHub Repository](https://github.com/Helmi74130/Salientui)
* Signalez un bug : [GitHub Issues](https://github.com/Helmi74130/Salientui/issues)
* Posez une question : [Support Forum](https://wordpress.org/support/plugin/salient-ui/)

== Contributing ==

Les contributions sont les bienvenues ! Visitez le [GitHub Repository](https://github.com/Helmi74130/Salientui) pour contribuer.

== License ==

Ce plugin est sous licence GPL v2 ou ultérieure.
