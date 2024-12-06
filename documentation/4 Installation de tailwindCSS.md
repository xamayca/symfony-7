## 4. Installation de TailwindCSS (SymfonyCast Bundle)

---

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
> 🗒️ **Remarque** : Cette étape sera utile plus tard pour appliquer TailwindCSS dans votre projet, notamment lorsque vous utiliserez les formulaires.

---