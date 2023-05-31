<?php

namespace App\Controller;

use App\Entity\Plat;
use App\Form\PlatType;
use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Service\PictureService;
use App\Repository\PlatRepository;
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
        $this->addFlash(
            'success',
            'Votre catégorie a été crée avec succès !'
        );

        return $this->redirectToRoute('admin_categorie_index');


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
        $this->addFlash(
            'success',
            'Votre plat a été ajouté au menu avec succès !'
        );
        return $this->redirectToRoute('admin_plat_index');


        }
        return $this->render('crud/newplat.html.twig', [
            'form' => $form->createView()
            ]);
    }

    #[Route('plat/edit/{id}', 'plat.edit', methods: ['GET', 'POST'])]
    public function editplat(Plat $plat, Request $request, EntityManagerInterface $manager, PictureService $pictureService) : Response
    {
        $form = $this->createForm(PlatType::class, $plat);
        $form->handleRequest($request);
        if($form->isSubmitted()){

            $plat = $form->getData();
            $image = $form->get('image')->getData();
            $folder = 'plat';
            $fichier = $pictureService->add($image, $folder, 300, 300);
            $plat->setImage($fichier);
            $manager->persist($plat);
            $manager->flush();
            $this->addFlash(
                'success',
                'Votre plat a été modifiée avec succès !'
            );

            return $this->redirectToRoute('admin_plat_index');
    
            }

        return $this->render('crud/plat_edit.html.twig', [
            'form' => $form->createView()
        ]);

    }

        #[Route('categorie/edit/{id}', 'categorie.edit', methods: ['GET', 'POST'])]
        public function editcategorie(Categorie $categorie, Request $request, EntityManagerInterface $manager, PictureService $pictureService) : Response
        {
            $form = $this->createForm(CategorieType::class, $categorie);
            $form->handleRequest($request);
            if($form->isSubmitted()){
    
                $categorie = $form->getData();
                $image = $form->get('image')->getData();
                $folder = 'category';
                $fichier = $pictureService->add($image, $folder, 300, 300);
                $categorie->setImage($fichier);
                $manager->persist($categorie);
                $manager->flush();
                $this->addFlash(
                    'success',
                    'Votre catégorie a été modifiée avec succès !'
                );
        
                return $this->redirectToRoute('admin_categorie_index');
        
                }
    
            return $this->render('crud/categorie_edit.html.twig', [
                'form' => $form->createView()
            ]);
        }
    
        #[Route('/plat/suppression/{id}', 'plat.delete', methods: ['GET', 'POST'])]
        public function delete_plat(EntityManagerInterface $manager, Plat $plat) : Response
        {
            if(!$plat) {

                $this->addFlash(
                    'success',
                    'Le plat en question n\'a pas été trouvé !'
                );
                return $this->redirectToRoute('admin_plat_index');
            }

            $manager->remove($plat);
            $manager->flush();
            $this->addFlash(
                'success',
                'Votre plat a été supprimé avec succès !'
            );
            return $this->redirectToRoute('admin_plat_index');
        }
};
