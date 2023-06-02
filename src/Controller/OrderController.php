<?php

namespace App\Controller;

use App\Form\OrderType;
use App\Entity\Commande;
use App\Service\CartService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderController extends AbstractController
{
    #[Route('/order/create', name: 'order_index')]
    public function index(CartService $cartService): Response
    {

        // dd($this->getUser());
        if (!$this->getUser()){
            return $this->redirectToRoute( route: 'app_login');
        }




        $form = $this->createForm(OrderType::class,  null, [
            'user' => $this->getUser()

        ]);
        return $this->render('order/index.html.twig', [
            'form' => $form->createView(),
            'recapCart' => $cartService->getTotal()
        ]);
    }

    #[Route('/order/verify', name: 'order_prepare', methods: ['POST'])]
    public function prepareOrder(Request $request): Response
    {
        $form = $this->createForm(OrderType::class, null, [
            'user' => $this->getUser()
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $datetime = new \DateTime ('now');
            $delivery = $form->get('addresses')->getData();
            $commande = new Commande();
            $commande->setUser($this->getUser());
            $commande->setDateCommande($datetime);


        }

        return $this->render('order/recap.html.twig');
    }




}
 