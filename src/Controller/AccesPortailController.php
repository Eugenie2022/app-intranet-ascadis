<?php

namespace App\Controller;

use App\Entity\AccesPortail;
use App\Form\AccesPortailType;
use App\Repository\AccesPortailRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/portail')]
class AccesPortailController extends AbstractController
{
    #[Route('/', name: 'app_acces_portail_index', methods: ['GET'])]
    public function index(AccesPortailRepository $accesPortailRepository): Response
    {
        $accessPortails = [];
        foreach($accesPortailRepository->findAll() as $accesPortail) {
            if($this->isGranted($accesPortail->getRole())) {
                $accessPortails[] = $accesPortail;
            }
        }

        return $this->render('acces_portail/index.html.twig', [
            'acces_portails' => $accessPortails,
        ]);
    }

    #[Route('/new', name: 'app_acces_portail_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AccesPortailRepository $accesPortailRepository): Response
    {
        $accesPortail = new AccesPortail();
        $form = $this->createForm(AccesPortailType::class, $accesPortail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $accesPortailRepository->add($accesPortail, true);

            return $this->redirectToRoute('app_acces_portail_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('acces_portail/new.html.twig', [
            'acces_portail' => $accesPortail,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_acces_portail_show', methods: ['GET'])]
    public function show(AccesPortail $accesPortail): Response
    {
        return $this->render('acces_portail/show.html.twig', [
            'acces_portail' => $accesPortail,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_acces_portail_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AccesPortail $accesPortail, AccesPortailRepository $accesPortailRepository): Response
    {
        $form = $this->createForm(AccesPortailType::class, $accesPortail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $accesPortailRepository->add($accesPortail, true);

            return $this->redirectToRoute('app_acces_portail_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('acces_portail/edit.html.twig', [
            'acces_portail' => $accesPortail,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_acces_portail_delete', methods: ['POST'])]
    public function delete(Request $request, AccesPortail $accesPortail, AccesPortailRepository $accesPortailRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$accesPortail->getId(), $request->request->get('_token'))) {
            $accesPortailRepository->remove($accesPortail, true);
        }

        return $this->redirectToRoute('app_acces_portail_index', [], Response::HTTP_SEE_OTHER);
    }
}
