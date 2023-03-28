<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/admin/test', name: 'app_test')]
    public function index(): Response
    {   
        $produit=[
        "nom" => "tele",
        "desc" => "super tele",
        "prix" => 2000,
    ];

        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
            'produit' => $produit,
        ]);
    }
}
