## 6. Création de l'entité User

> 📌 **Pour créer l'entité `User`, consultez la documentation officielle de [Symfony (User)](https://symfony.com/doc/current/security.html#the-user).**

Pour créer l'entité User, rendez-vous dans votre terminal et éxecuter la commande suivante :
````bash
php bin/console make:user
````
Et répondez aux questions suivantes :

```txt
The name of the security user class (e.g. User) [User]:
 > User

 Do you want to store user data in the database (via Doctrine)? (yes/no) [yes]:
 > yes

 Enter a property name that will be the unique "display" name for the user (e.g. email, username, uuid) [email]:
 > email

 Will this app need to hash/check user passwords? Choose No if passwords are not needed or will be checked/hashed by some other system (e.g. a single sign-on server).

 Does this app need to hash/check user passwords? (yes/no) [yes]:
 > yes

 created: src/Entity/User.php
 created: src/Repository/UserRepository.php
 updated: src/Entity/User.php
 updated: config/packages/security.yaml
```

### Ajout de nouvelles propriétés à l'entité User

Ensuite, nous allons ajouter des champs à l'entité User avec la commande suivante :

```bash
symfony console make:entity User 
```

Répondez de nouveau aux questions comme suit :

````txt
 Your entity already exists! So let's add some new fields!

 New property name (press <return> to stop adding fields):
 > username

 Field type (enter ? to see all types) [string]:
 >

 Field length [255]:
 >

 Can this field be null in the database (nullable) (yes/no) [no]:
 >
 
 updated: src/Entity/User.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > createdAt

 Field type (enter ? to see all types) [datetime_immutable]:
 >

 Can this field be null in the database (nullable) (yes/no) [no]:
 >

 updated: src/Entity/User.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 >
````

Nous devons maintenant mettre à jour le schéma de la base de données avec la commande suivante :

```bash
symfony console d:s:u -f
```

La commande `symfony console d:s:u -f` est utilisée pour mettre à jour le schéma de la base de données selon les entités et migrations.

> 🗒️ **Remarque** :
> - **`d`** : Référence à **Doctrine**, la bibliothèque de gestion de la base de données.
> - **`s`** : Signifie **schema** (schéma), ce qui fait référence à la structure de la base de données.
> - **`u`** : Signifie **update** (mettre à jour), indiquant que la base de données doit être mise à jour pour correspondre aux entités actuelles.
> - **`-f`** (ou **`--force`**) permet de forcer l'exécution de la mise à jour sans demander confirmation.
> #### ⚠️ Cette commande n'effectue pas de migration, mais applique directement les modifications à la base de données.

Pour créer une migration, vous devez d'abord exécuter la commande suivante :
```bash
php bin/console make:migration
```
Cette commande créeras un fichier de migration contenant toute les requetes a la racine de votre projet dans le dossier `migrations`.

Puis, pour éffectuer la migration la commande suivante :

```bash
php bin/console doctrine:migrations:migrate
```

Notre entité posséde maintenant les champs `username`,`email`,`password`,`roles`,`created_at` en base de données.


---