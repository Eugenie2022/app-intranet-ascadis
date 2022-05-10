<?php

namespace App\DataFixtures;

use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class UtilisateurFixtures extends Fixture implements DependentFixtureInterface
{
    public const DUPONT_REFERENCE = 'Dupont';
    public const LEPOUREAU_REFERENCE = 'Lepoureau';
    public const MARTIENNE_REFERENCE = 'Martienne';

    public function load(ObjectManager $manager): void
    {
        $dupont = new Utilisateur();
        $dupont->setUsername('Dupont');
        $dupont->setRoles(['ROLE_USER']);
        $dupont->setPassword('azerty');
        $manager->persist($dupont);
        $this->addReference(self::DUPONT_REFERENCE, $dupont);

        $lepoureau = new Utilisateur();
        $lepoureau->setUsername('Lepoureau');
        $lepoureau->setRoles(['ROLE_ADMIN']);
        $lepoureau->setPassword('admin123');
        $manager->persist($lepoureau);
        $this->addReference(self::LEPOUREAU_REFERENCE, $lepoureau);

        $martienne = new Utilisateur();
        $martienne->setUsername('Martienne');
        $martienne->setRoles(['ROLE_DIRECTION']);
        $martienne->setPassword('toto');
        $manager->persist($martienne);
        $this->addReference(self::MARTIENNE_REFERENCE, $martienne);


        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            RoleFixtures::class,
        ];
    }

}
