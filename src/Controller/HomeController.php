<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\PlatRepository;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', 'home.index', methods: ['GET'])]
    public function index(CategorieRepository $repository, PlatRepository $platRepository): Response
    {

        $categorie = $repository->findAll();
        $plat = $platRepository->findAll();
        return $this->render('/home.html.twig', ['categorie' => $categorie, 'plat' => $plat]);
    
    }

    #[Route('/plat', 'plat.index', methods: ['GET'])]
    public function plat(PlatRepository $platRepository): Response
    {
        
        return $this->render('/plat.html.twig', [
            'plat' => $platRepository->findAll()
        ]);


    }

    #[Route('/plat/{id}', 'detail.plat', methods: ['GET'])]
    public function detailplat(PlatRepository $detailplatRepository, int $id): Response
    {
        

        return $this->render('/detailplat.html.twig', [
            'plat' => $detailplatRepository->findOneBy( ['id' => $id] )

        ]);

    }

    #[Route('/categorie', 'categorie.index', methods: ['GET'])]
    public function categorie(CategorieRepository $categorieRepository): Response
    {
        
        return $this->render('/categorie.html.twig', [
            'categorie' => $categorieRepository->findAll()
        ]);


    }

    #[Route('/categorie/{id}', 'detail.categorie', methods: ['GET'])]
    public function detailcategorie(Categorie $detailcategorie): Response
    {
        

        return $this->render('/detailcategorie.html.twig', [
            'categorie' => $detailcategorie

        ]);

    }

    
}
