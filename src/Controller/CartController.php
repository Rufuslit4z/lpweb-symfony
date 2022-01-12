<?php

namespace App\Controller;
// namespace App\Entity;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartController extends AbstractController
{
    public function index(ProductRepository $productRepository, SessionInterface $session): Response
    {
        $products = [];
        $count = 0;
        $cart = $session->get('panier', []);
        $totalPrice = 0;
        foreach($cart as $id => $quantity){
            $product = $productRepository->findById($id);
            $products[$count] = ['product' => $product, 'quantity' => $quantity];
            $totalPrice += $product[0]->getPrice();
            $count++;
        }
        
        return $this->render('cart/index.html.twig', [
            'products' => $products,
            'totalPrice' => $totalPrice,
        ]);
    }

    public function add(int $id, SessionInterface $session): Response
    {
        $cart = $session->get('panier', []);
        $cart[$id] = 1;
        $session->set('panier', $cart);
        
        return $this->render('cart/add.html.twig', [
            // 'controller_name' => 'CartController',
        ]);        
    }

    public function delete(int $id, SessionInterface $session): Response
    {
        $cart = $session->get('panier', []);
        $message = "Le produit a été retiré de votre panier";
        if($cart[$id]){
            unset($cart[$id]);
            $session->set('panier', $cart);
            $this->addFlash('success','Article supprimé');
        }
        return $this->redirectToRoute('cart.index');
    }
}
