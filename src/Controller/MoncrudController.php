<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\NewformType;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/moncrud')]
class MoncrudController extends AbstractController
{
    #[Route('/articles', name: 'app_articles')]
    public function index(ArticleRepository $articleRepository): Response
    {   
        return $this->render('moncrud/index.html.twig', [
            'article' => $articleRepository->findAll() ,
        ]);
    }

    #[Route('/article/{id}', name: 'app_article')]
    public function index2(Article $article): Response
    {   dd("Je suis dans mon article");
        return $this->render('moncrud/index.html.twig', [
            'controller_name' => 'MoncrudController',
            "monarticle" => $article,
        ]);
    }

    #[Route('/new', name: 'route_new' )]
    function new(ArticleRepository $articleRepository, 
                Request    $request   ){
        //article->id = "";
        //$article->titre="";
        //$article->contenue=""
        $article=new Article();
        // une variable $form qui contient le formulaire
        // de ArticleType

        $form=$this->createForm(NewformType::class, $article);
        //article->id = $_POST['id'];
        //$article->titre=$_POST['titre'];
        //$article->contenue=$_POST['contenue'];

        // lire ce qui est envoyé en POST via le formulaire
        $form->handleRequest($request);

        // le cas ou on traite le form
        if ($form->isSubmitted() && $form->isValid()) {
           //  dd($request);
            // dd($article);
            $articleRepository->save($article  ,true) ;
            dd("t");
            //article->id  
            //$article->titre
            //$article->contenue


            //  dd("je passe par le traitement du form");

        }
        return $this->renderForm("moncrud/new_article_form.html.twig", [
            'route_new'=> $form
        ]);
        
    }
}
