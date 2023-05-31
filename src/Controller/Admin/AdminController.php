<?php

namespace App\Controller\Admin;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin', name: 'admin_')]
class AdminController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }


    #[Route('/registration', 'user', methods: ['GET'])]
    public function user(UserRepository $userRepository): Response
    {
        return $this->render('registration/user.html.twig', [
            'user' => $userRepository->findAll()
        ]);
    }
}
