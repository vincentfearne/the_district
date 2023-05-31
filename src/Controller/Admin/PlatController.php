<?php

namespace App\Controller\Admin;

use App\Repository\PlatRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/plat', name: 'admin_plat_')]
class PlatController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(PlatRepository $platRepository): Response
    {
        $plat = $platRepository->findBy([], ['id' => 'asc']);

        return $this->render('admin/plat/index.html.twig', compact('plat'));
    }
}
