<?php

namespace App\Controller\Admin;

use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/categorie', name: 'admin_categorie_')]
class CategorieController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CategorieRepository $categorieRepository): Response
    {
        $categorie = $categorieRepository->findBy([], ['id' => 'asc']);

        return $this->render('admin/categorie/index.html.twig', compact('categorie'));
    }
}
