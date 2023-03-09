<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $formateur = "Yoel";
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'nom_formateur' => $formateur,
            'mon_prenom' => 'Lakdar',
            'mon_age' => ' j\'ai 36 ans',
        ]);
    }
}
