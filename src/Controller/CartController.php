<?php

namespace App\Controller;

use App\Service\CartService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
//------------AFFICHAGE D PANIER---------------------------------------------
    #[Route('/monpanier', name: 'cart_index')]
    public function index(CartService $cartService): Response
    {

        return $this->render('cart/index.html.twig', [
            'cart' => $cartService->getTotal()
        ]);
    }


//------------AJOUT D'UN PLAT-----------------------------------------------
    #[Route('/monpanier/add/{id}', name: 'cart_add')]
    public function addToCart(CartService $cartService, int $id): Response
    {

        $cartService->addToCart($id);
        if(!empty($cart[$id])){
            return $this->redirectToRoute('plat.index');
        }else{
            return $this->redirectToRoute('cart_index');
        }
        
    }

//----------DECREMENTATION QUANTITE D'UN PLAT---------------------------------
    #[Route('/mon-panier/decrease/{id}', name: 'cart_decrease')]
    public function decrease(CartService $cartService, $id): RedirectResponse
    {
        $cartService->decrease($id);

        return $this->redirectToRoute('cart_index');
    }


//---------SUPRESSION--------------------------------------------------------
    #[Route('/monpanier/remove/{id}', name: 'cart_remove')]
    public function removeToCart(CartService $cartService, int $id): Response
    {

        $cartService->removeToCart($id);
        return $this->redirectToRoute('cart_index');
    }

//---------SUPRESSION DE TOUT LE PANIER--------------------------------------
    #[Route('/monpanier/removeAll', name: 'cart_removeAll')]
    public function removeAll(CartService $cartService): Response
    {

        $cartService->removeCartAll();
        return $this->redirectToRoute('cart_index');
    }
}
  