<?php

namespace App\Controller;

use App\Form\FormtestType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TestformController extends AbstractController
{
    #[Route('/testform', name: 'app_testform')]
    public function index(Request $request): Response
    {
        // recuperer le formulaire dans une variable correspondant 
        // a FormTestType
        $form = $this->createForm(FormTestType::class);

        
        // on prend l'objet form qui va lire la request
        $form->handleRequest($request);

        // test si l'envoie en post et est valide est bien envoyé
        if ($form->isSubmitted() && $form->isValid()) {
            // creer une variable task qui est un tableau clé valeur
            // contenant les données envoyé en POST
            $data= $form->getData();
            // dd($data);
            // renvoie une twig contenant les données du form
            // avec la variable task
            return $this->render('testform/traitement.html.twig', [
                'mes_donnes'=>$data 
            ]);

            // dd($task);
        }


        return $this->renderForm('testform/index.html.twig', [
            'monformulaire'=>$form 
        ]);
    }
}
