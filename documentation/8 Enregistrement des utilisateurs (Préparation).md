## 8. Enregistrement des utilisateurs (Préparation)

---

> 📌 **Pour intégrer l'enregistrement des utilisateurs dans Symfony, vous pouvez consulter la documentation officielle de [Symfony](https://symfony.com/doc/current/security.html#registering-the-user-hashing-passwords).**

Commencez par créer un contrôleur dédié à l'enregistrement des utilisateurs.

Pour ce faire, ouvrez votre terminal et exécutez la commande suivante :

```bash
symfony console make:controller RegistrationController
```

> 🗒️ **Remarque** :
> - Cette commande se chargera de créer un controller à l'emplacement `src/Controller/RegistrationController.php`
> - Ce contrôleur sera responsable de la `logique` de l'inscription des utilisateurs.
> - Elle créera aussi un `template Twig` à l'emplacement `templates/registration/index.html.twig`


Ensuite, vous devez créer un formulaire pour l'inscription des utilisateurs.

> 📌 **Pour en savoir plus sur les formulaires, vous pouvez consulter la documentation officielle de [Symfony (FormType)](https://symfony.com/doc/current/reference/forms/types.html).**

Exécutez la commande suivante pour générer un formulaire :

```bash
symfony console make:form RegistrationForm
```
> 🗒️ **Remarque** : Cette commande crée un `FormType`, à l'emplacement `src/Form/RegistrationFormType.php`, qui définit les champs du formulaire pour l'enregistrement d'un utilisateur.

Répondez maintenant à la question suivante de cette façon :

```txt
 The name of Entity or fully qualified model class name that the new form will be bound to (empty for none):
 > User

 created: src/Form/RegistrationFormType.php
```

Cela liera votre formulaire à l'entité User que vous avez créée précédemment, permettant ainsi l'insertion des données de l'utilisateur dans la base de données.

---