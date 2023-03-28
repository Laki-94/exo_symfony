<?php

namespace App\Controller;

use App\Entity\Acategorie;
use App\Form\AcategorieType;
use App\Repository\AcategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/acategorie')]
class AcategorieController extends AbstractController
{
    #[Route('/', name: 'app_acategorie_index', methods: ['GET'])]
    public function index(AcategorieRepository $acategorieRepository): Response
    {
        return $this->render('acategorie/index.html.twig', [
            'acategories' => $acategorieRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_acategorie_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AcategorieRepository $acategorieRepository): Response
    {
        $acategorie = new Acategorie();
        $form = $this->createForm(AcategorieType::class, $acategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $acategorieRepository->save($acategorie, true);

            return $this->redirectToRoute('app_acategorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('acategorie/new.html.twig', [
            'acategorie' => $acategorie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_acategorie_show', methods: ['GET'])]
    public function show(Acategorie $acategorie): Response
    {
        return $this->render('acategorie/show.html.twig', [
            'acategorie' => $acategorie,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_acategorie_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Acategorie $acategorie, AcategorieRepository $acategorieRepository): Response
    {
        $form = $this->createForm(AcategorieType::class, $acategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $acategorieRepository->save($acategorie, true);

            return $this->redirectToRoute('app_acategorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('acategorie/edit.html.twig', [
            'acategorie' => $acategorie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_acategorie_delete', methods: ['POST'])]
    public function delete(Request $request, Acategorie $acategorie, AcategorieRepository $acategorieRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$acategorie->getId(), $request->request->get('_token'))) {
            $acategorieRepository->remove($acategorie, true);
        }

        return $this->redirectToRoute('app_acategorie_index', [], Response::HTTP_SEE_OTHER);
    }
}
