# PRÉPARATION DU PROJET

---

## 1. Création du projet Symfony
> 📌 **Pour démarrer un projet Symfony, consultez la documentation officielle [ici](https://symfony.com/doc/current/the-fast-track/en/3-zero.html#initializing-the-project).**

Dans un terminal, exécutez la commande suivante pour créer un projet Symfony avec toutes les dépendances nécessaires pour une application web :

```bash
symfony new monprojet --webapp
```

> **Note** : L'option `--webapp` installe toutes les dépendances essentielles pour un projet Symfony dédié à une application web.

---

## 2. Création du `HomeController`
> 📌 **Pour en savoir plus sur les contrôleurs, consultez la documentation officielle [ici](https://symfony.com/doc/current/controller.html).**

Pour générer un contrôleur nommé `HomeController`, exécutez la commande suivante dans votre terminal :

```bash
php bin/console make:controller HomeController
```

Cette commande va créer un contrôleur ainsi qu'une vue par défaut dans les répertoires `src/Controller` et `templates`.

---

## 3. Modification de la route du contrôleur
> 📌 **Pour plus d'informations sur les routes, consultez la documentation [ici](https://symfony.com/doc/current/routing.html).**

Une fois le contrôleur généré, ouvrez le fichier `src/Controller/HomeController.php` dans votre éditeur de texte ou IDE préféré.

> **Modification nécessaire** : Dans ce fichier, localisez la ligne suivante :

```php
#[Route('/home', name: 'app_home')]
```

Et remplacez-la par :

```php
#[Route('/', name: 'app_home')]
```

Cela mettra à jour la route de la page d'accueil de `/home` à la racine `/` de votre application, facilitant ainsi l'accès à la page d'accueil.

---

## 4. Installation de TailwindCSS (SymfonyCast Bundle)
> 📌 **Pour intégrer TailwindCSS dans Symfony, consultez la documentation officielle du [TailwindCSS Symfony Bundle](https://symfony.com/bundles/TailwindBundle/current/index.html).**

Dans un terminal, exécutez les commandes suivantes pour installer TailwindCSS dans votre projet Symfony :

```bash
composer require symfonycasts/tailwind-bundle
php bin/console tailwind:init
```

Cela générera les fichiers nécessaires pour configurer TailwindCSS dans votre application Symfony.
> **Modification supplémentaire** : 
> - Rendez-vous à la racine du projet et ouvrez le fichier `tailwind.config.js`.
> - Ajoutez le chemin suivant pour inclure les fichiers PHP dans le processus de construction de Tailwind :

```js
module.exports = {
  content: [
    "./src/**/*.php",
    "./templates/**/*.twig",
    "./assets/**/*.js"
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
```

Cela permettra à TailwindCSS de traiter les fichiers PHP dans le dossier `src/` et de les utiliser pour générer les classes CSS.
> **Note** : Cette étape sera utile plus tard pour appliquer TailwindCSS dans votre projet, notamment lorsque vous utiliserez les formulaires.

---

## 5. Configuration de l'AutoBuild CSS pour le serveur local (SymfonyCast Bundle / Symfony CLI)
Pour que vos assets soient automatiquement compilés à chaque lancement de votre serveur local, rendez-vous à la racine de votre projet et créez ou modifiez le fichier suivant :

```yaml
#.symfony.local.yaml

workers:
  tailwind:
    cmd: ['symfony', 'console', 'tailwind:build', '--watch']
```

Cette configuration permet de recompiler automatiquement les fichiers CSS de TailwindCSS à chaque modification, sans redémarrer le serveur ni exécuter la commande `php bin/console asset-map:compile.`.

---