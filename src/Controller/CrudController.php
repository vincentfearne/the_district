<?php

namespace App\Controller;

use App\Entity\Plat;
use App\Form\PlatType;
use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Service\PictureService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Loader\Configurator\form;

class CrudController extends AbstractController
{
    #[Route('/categorie/nouveau', 'categorie.new', methods: ['GET', 'POST'])]
    public function newcategorie(Request $request, EntityManagerInterface $em, PictureService $pictureService) : Response
    {
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);
        
        if($form->isSubmitted()){

        
        $image = $form->get('image')->getData();
        $folder = 'category';
        $fichier = $pictureService->add($image, $folder, 300, 300);
        $categorie->setImage($fichier);
        $em->persist($categorie);
        $em->flush();

        return $this->redirectToRoute('categorie.index');

        }
        return $this->render('crud/newcategorie.html.twig', [
            'form' => $form->createView()
            ]);
    }

    #[Route('/plat/nouveau', 'plat.new', methods: ['GET', 'POST'])]
    public function newplat(Request $request, EntityManagerInterface $em, PictureService $pictureService) : Response
    {
        $plat = new Plat();
        $form = $this->createForm(PlatType::class, $plat);
        $form->handleRequest($request);
        
        if($form->isSubmitted()){

        
        $image = $form->get('image')->getData();
        $folder = 'plat';
        $fichier = $pictureService->add($image, $folder, 300, 300);
        $plat->setImage($fichier);
        $em->persist($plat);
        $em->flush();

        return $this->redirectToRoute('plat.index');

        }
        return $this->render('crud/newplat.html.twig', [
            'form' => $form->createView()
            ]);
    }
}
