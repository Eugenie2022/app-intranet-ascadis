<?php

namespace App\Controller;

use App\Entity\Favoris;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'home', methods: ['GET', 'POST'])]
    public function index(ManagerRegistry $doctrine, Request $request): Response
    {
        $favoris = $doctrine->getRepository(Favoris::class)->findAll();

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'favoris' => $favoris,
        ]);
    }
}
