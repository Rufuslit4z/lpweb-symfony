<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('cart/index.html.twig', [
            // 'controller_name' => 'CartController',
        ]);
    }

    public function add($id, SessionInterface $session): Response
    {
        $cart = $session->get('panier', []);
        $cart[$id] = 1;
        $session->set('panier', $cart);
        
        return $this->render('cart/add.html.twig', [
            // 'controller_name' => 'CartController',
        ]);        
    }
}
