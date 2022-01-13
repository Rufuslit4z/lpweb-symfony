<?php

namespace App\Controller;
// namespace App\Entity;

use App\Repository\ProductRepository;
use App\Entity\Command;
use App\Form\CommandType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\Persistence\ManagerRegistry;

class CartController extends AbstractController
{
    public function index(ManagerRegistry $doctrine, Request $request, ProductRepository $productRepository, SessionInterface $session): Response
    {
        $products = [];
        $count = 0;
        $cart = $session->get('panier', []);
        $totalPrice = 0;
        foreach($cart as $id => $quantity){
            $product = $productRepository->findById($id);
            $products[$count] = ['product' => $product, 'quantity' => $quantity];
            $totalPrice += $product[0]->getPrice() * $quantity;
            $count++;
        }

        $command = new Command();
        $commandForm = $this->createForm(CommandType::class, $command);
        $commandForm->handleRequest($request);
        
        if ($commandForm->isSubmitted() && $commandForm->isValid())
        {
            $command->setCreatedAt(new \DateTime);
            foreach($products as $index => $product){
                $command->addProduct($product['product'][0]);
            }
            $entityManager = $doctrine->getManager();
            $entityManager->persist($command);
            $entityManager->flush();
            $this->addFlash('success','Commande effectuée');
            return $this->redirectToRoute('cart.index', [
                //
            ]);
        }

        return $this->render('cart/index.html.twig', [
            'products' => $products,
            'totalPrice' => $totalPrice,
            'commandForm' => $commandForm->createView()
        ]);
    }

    public function add(int $id, SessionInterface $session): Response
    {
        $cart = $session->get('panier', []);
        $cart[$id]++;
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
