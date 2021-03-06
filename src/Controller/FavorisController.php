<?php

namespace App\Controller;

use App\Entity\Favoris;
use App\Entity\Utilisateur;
use App\Form\FavorisType;
use App\Repository\FavorisRepository;
use Container2A8lYOX\getUtilisateurRepositoryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/favoris')]
class FavorisController extends AbstractController
{
    #[Route('/', name: 'app_favoris_index', methods: ['GET'])]
    public function index(FavorisRepository $favorisRepository): Response
    {
        //Je charge tous les favoris
        $favoris = $favorisRepository->findAll();

        //Si je ne suis pas admin, je charge les favoris de l'utilisateur connecté
        if(!in_array('ROLE_ADMIN',$this->getUser()->getRoles())) {
            $favoris = $this->getUser()->getFavoris();
        }

        return $this->render('favoris/index.html.twig', [
            'favoris' => $favoris,
        ]);
    }

    #[Route('/new', name: 'app_favoris_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FavorisRepository $favorisRepository): Response
    {
        $favori = new Favoris();
        $form = $this->createForm(FavorisType::class, $favori);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $favorisRepository->add($favori, true);

            return $this->redirectToRoute('app_favoris_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('favoris/new.html.twig', [
            'favori' => $favori,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_favoris_show', methods: ['GET'])]
    public function show(Favoris $favori): Response
    {
        return $this->render('favoris/show.html.twig', [
            'favori' => $favori,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_favoris_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Favoris $favori, FavorisRepository $favorisRepository): Response
    {
        $form = $this->createForm(FavorisType::class, $favori);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $favorisRepository->add($favori, true);

            return $this->redirectToRoute('app_favoris_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('favoris/edit.html.twig', [
            'favori' => $favori,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_favoris_delete', methods: ['POST'])]
    public function delete(Request $request, Favoris $favori, FavorisRepository $favorisRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$favori->getId(), $request->request->get('_token'))) {
            $favorisRepository->remove($favori, true);
        }

        return $this->redirectToRoute('app_favoris_index', [], Response::HTTP_SEE_OTHER);
    }
}
