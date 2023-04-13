<?php

namespace App\Controller;

use App\Repository\PlatRepository;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', 'home.index', methods: ['GET'])]
    public function index(CategorieRepository $repository): Response
    {

        $categorie = $repository->findAll();
    
        return $this->render('/home.html.twig', [
            'categorie' => $categorie
        ]);
    }

    #[Route('/plat', 'plat.index', methods: ['GET'])]
    public function plat(PlatRepository $platRepository): Response
    {
        

        $plat = $platRepository->findAll();

        return $this->render('/plat.html.twig', [
            'plat' => $plat
        ]);


    }

    
}
