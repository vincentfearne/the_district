<?php

namespace App\Controller;

use App\Entity\Plat;
use App\Entity\Categorie;
use App\Form\CategorieType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Loader\Configurator\form;

class CrudController extends AbstractController
{
    #[Route('/categorie/nouveau', 'categorie.new', methods: ['GET', 'POST'])]
    public function newcategorie() : Response
    {
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);
        return $this->render('crud/newcategorie.html.twig', [
        'form' => $form->createView()
        ]);

        if($form->isSubmitted()){

        
        $image = $form->get('image')->getData();
        dd($image);
        }
    }

    #[Route('/plat/nouveau', 'plat.new', methods: ['GET', 'POST'])]
    public function newplat(Request $request) : Response
    {
        $plat = new Plat();
        $form = $this->createForm(PlatType::class, $plat);


        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
            {

            }
            else {

                }
        
        return $this->render('crud/newplat.html.twig', [
        'form' => $form->createView()
        ]);
    }
}
