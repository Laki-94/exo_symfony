<?php

namespace App\Controller;

use App\Entity\Rproduits;
use App\Form\RproduitsType;
use App\Repository\RproduitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/rproduits')]
class RproduitsController extends AbstractController
{
    #[Route('/', name: 'app_rproduits_index', methods: ['GET'])]
    public function index(RproduitsRepository $rproduitsRepository): Response
    {
        return $this->render('rproduits/index.html.twig', [
            'rproduits' => $rproduitsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_rproduits_new', methods: ['GET', 'POST'])]
    public function new(Request $request, RproduitsRepository $rproduitsRepository): Response
    {
        $rproduit = new Rproduits();
        $form = $this->createForm(RproduitsType::class, $rproduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rproduitsRepository->save($rproduit, true);

            return $this->redirectToRoute('app_rproduits_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rproduits/new.html.twig', [
            'rproduit' => $rproduit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_rproduits_show', methods: ['GET'])]
    public function show(Rproduits $rproduit): Response
    {
        return $this->render('rproduits/show.html.twig', [
            'rproduit' => $rproduit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_rproduits_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Rproduits $rproduit, RproduitsRepository $rproduitsRepository): Response
    {
        $form = $this->createForm(RproduitsType::class, $rproduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rproduitsRepository->save($rproduit, true);

            return $this->redirectToRoute('app_rproduits_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rproduits/edit.html.twig', [
            'rproduit' => $rproduit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_rproduits_delete', methods: ['POST'])]
    public function delete(Request $request, Rproduits $rproduit, RproduitsRepository $rproduitsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rproduit->getId(), $request->request->get('_token'))) {
            $rproduitsRepository->remove($rproduit, true);
        }

        return $this->redirectToRoute('app_rproduits_index', [], Response::HTTP_SEE_OTHER);
    }
}
