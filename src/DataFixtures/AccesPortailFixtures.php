<?php

namespace App\DataFixtures;

use App\Entity\AccesPortail;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AccesPortailFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $laposte = new AccesPortail();
        $laposte->setNom('la poste');
        $laposte->setLogin('facteur');
        $laposte->setPassword('facteur');
        $laposte->setDescription('Accès à la poste');
        $laposte->setRole('ROLE_USER');
        $manager->persist($laposte);


        $facebook = new AccesPortail();
        $facebook->setNom('facebook');
        $facebook->setLogin('facebook');
        $facebook->setPassword('facebook');
        $facebook->setDescription('Accès au compte facebook d\'ascadis');
        $facebook->setRole('ROLE_USER');
        $manager->persist($facebook);

        $banque = new AccesPortail();
        $banque->setNom('banque');
        $banque->setLogin('banque');
        $banque->setPassword('banque123');
        $banque->setDescription('Accès au compte de l\entreprise');
        $banque->setRole('ROLE_DIRECTION');
        $manager->persist($banque);


        $manager->flush();


    }
}


