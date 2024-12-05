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
