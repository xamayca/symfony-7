## 7. Création des Fixtures Utilisateurs (Préparation de données)
> 📌 **Pour intégrer le bundle Doctrine Fixtures dans Symfony, consultez la documentation officielle du [Doctrine Fixtures Bundle](https://symfony.com/bundles/DoctrineFixturesBundle/current/).**

Pour commencer, installez le bundle `DoctrineFixturesBundle` en exécutant la commande suivante dans le terminal :

```bash
composer require --dev doctrine/doctrine-fixtures-bundle
```
Cela installera le bundle et créera automatiquement le fichier `src/DataFixtures/AppFixtures.php`.

Ensuite, pour générer des utilisateurs avec des données aléatoires, nous utiliserons la bibliothèque FakerPHP, qui facilitera la création de fausses données.

> 📌 **Pour en savoir plus sur FakerPHP, consultez la documentation officielle de [FakerPHP](https://fakerphp.org/).**

Pour l'installer, exécutez cette commande :

```bash
composer require --dev fakerphp/faker
```

Renommer le fichier `src/DataFixtures/AppFixtures.php` en `UserFixtures.php` puis modifier le par le code suivant :

```php
<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

use Faker\Factory;

class UserFixtures extends Fixture
{
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher
    ) {}

    public function load(ObjectManager $manager): void
    {
        $this->createAdminUser($manager);

        $this->createRandomUser($manager);
    }

    /**
     * Creates a user with admin privileges.
     *
     * @param ObjectManager $manager The ObjectManager used to persist the entity.
     * @return void
     */
    public function createAdminUser(ObjectManager $manager): void {
        $user = new User();
        $user->setUsername('admin');
        $user->setEmail('test@admin.fr');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'admin'));
        $user->setRoles(['ROLE_ADMIN']);
        $user->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($user);
        $manager->flush();
    }

    /**
     * Creates several random users with random data.
     *
     * @param ObjectManager $manager The ObjectManager used to persist the entities.
     * @return void
     */
    public function createRandomUser(ObjectManager $manager): void {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setUsername($faker->firstName . $faker->randomDigit());
            $user->setEmail($faker->email);
            $user->setPassword($this->passwordHasher->hashPassword($user, 'user'.$i));
            $user->setRoles([]);
            $user->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTime));
            $manager->persist($user);
        }
        $manager->flush();
    }
}
```

Cette fixture contient deux fonctions :

#### 1. **createAdminUser** :
    - Crée un utilisateur administrateur avec le nom admin, l'email test@admin.fr, et le mot de passe admin.
    - Il reçoit le rôle ['ROLE_ADMIN'].
    - L'utilisateur est enregistré dans la base de données via l'ObjectManager.

#### 2. **createRandomUser** :
    - Génère 10 utilisateurs aléatoires avec des données de FakerPHP (prénom + chiffre, email, mot de passe personnalisé).
    - Les rôles sont laissés vides.
    - Ces utilisateurs sont également enregistrés dans la base de données.

> 🗒️ **Remarques** :
> - Le fichier `UserFixtures.php` est destiné à peupler la base de données avec des données fictives pour le développement.
> - Les mots de passe sont hachés grâce à `UserPasswordHasherInterface`.
> - La fonction `flush()` est utilisée pour enregistrer les données dans la base.

Pour charger ces données dans votre base de données, vous pouvez utiliser la commande suivante :

```bash
php bin/console doctrine:fixtures:load
```

Cela exécutera les fixtures et remplira votre base de données avec les utilisateurs définis dans `UserFixtures.php`.

---
