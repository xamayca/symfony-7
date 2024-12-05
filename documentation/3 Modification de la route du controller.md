## 3. Modification de la route du contrôleur
> 📌 **Pour plus d'informations sur les routes, consultez la documentation [Symfony Routing](https://symfony.com/doc/current/routing.html).**

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