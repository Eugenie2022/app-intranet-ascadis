<?php

namespace App\DataFixtures;

use App\Entity\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RoleFixtures extends Fixture
{
    public const ROLE_ADMIN = 'ROLE_ADMIN';
    public const ROLE_DIRECTION = 'ROLE_DIRECTION';
    public const ROLE_USER = 'ROLE_USER';

    public function load(ObjectManager $manager): void
    {
        $roleUser = new Role();
        $roleUser->setNom(self::ROLE_USER);
        $roleUser->setHabilitation(1);
        $manager->persist($roleUser);
        $this->addReference(self::ROLE_USER, $roleUser);


        $roleDirection = new Role();
        $roleDirection->setNom(self::ROLE_DIRECTION);
        $roleDirection->setHabilitation(2);
        $manager->persist($roleDirection);
        $this->addReference(self::ROLE_DIRECTION, $roleDirection);
        $roleAdmin = new Role();
        $roleAdmin->setNom(self::ROLE_ADMIN);
        $roleAdmin->setHabilitation(3);
        $manager->persist($roleAdmin);
        $this->addReference(self::ROLE_ADMIN, $roleAdmin);

        $manager->flush();




    }
}
