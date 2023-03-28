<?php

namespace App\Controller;

use App\Entity\Rproduits;
use App\Form\Rproduits1Type;
use App\Repository\RproduitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/rproduits')]
class AdminRproduitsController extends AbstractController
{
    #[Route('/', name: 'app_admin_rproduits_index', methods: ['GET'])]
    public function index(RproduitsRepository $rproduitsRepository): Response
    {
        return $this->render('admin_rproduits/index.html.twig', [
            'rproduits' => $rproduitsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_rproduits_new', methods: ['GET', 'POST'])]
    public function new(Request $request, RproduitsRepository $rproduitsRepository): Response
    {
        $rproduit = new Rproduits();
        $form = $this->createForm(Rproduits1Type::class, $rproduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rproduitsRepository->save($rproduit, true);

            return $this->redirectToRoute('app_admin_rproduits_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_rproduits/new.html.twig', [
            'rproduit' => $rproduit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_rproduits_show', methods: ['GET'])]
    public function show(Rproduits $rproduit): Response
    {
        return $this->render('admin_rproduits/show.html.twig', [
            'rproduit' => $rproduit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_rproduits_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Rproduits $rproduit, RproduitsRepository $rproduitsRepository): Response
    {
        $form = $this->createForm(Rproduits1Type::class, $rproduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rproduitsRepository->save($rproduit, true);

            return $this->redirectToRoute('app_admin_rproduits_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_rproduits/edit.html.twig', [
            'rproduit' => $rproduit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_rproduits_delete', methods: ['POST'])]
    public function delete(Request $request, Rproduits $rproduit, RproduitsRepository $rproduitsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rproduit->getId(), $request->request->get('_token'))) {
            $rproduitsRepository->remove($rproduit, true);
        }

        return $this->redirectToRoute('app_admin_rproduits_index', [], Response::HTTP_SEE_OTHER);
    }
}
