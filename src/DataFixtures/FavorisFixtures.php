<?php

namespace App\DataFixtures;

use App\Entity\Favoris;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class FavorisFixtures extends Fixture implements DependentFixtureInterface
{
//    public const USER

    public function load(ObjectManager $manager): void
    {
        $laposte = new Favoris();
        $laposte->setNom('google');
        $laposte->setUrl('https://www.google.fr/');
        $laposte->setUtilisateurs($this->getReference(UtilisateurFixtures::DUPONT_REFERENCE));
        $manager->persist($laposte);

        $laposte = new Favoris();
        $laposte->setNom('youtube');
        $laposte->setUrl('https://www.youtube.fr/');
        $laposte->setUtilisateurs($this->getReference(UtilisateurFixtures::LEPOUREAU_REFERENCE));
        $manager->persist($laposte);

        $laposte = new Favoris();
        $laposte->setNom('twitter');
        $laposte->setUrl('https://www.twitter.fr/');
        $laposte->setUtilisateurs($this->getReference(UtilisateurFixtures::MARTIENNE_REFERENCE));
        $manager->persist($laposte);


        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UtilisateurFixtures::class,
        ];
    }
}
