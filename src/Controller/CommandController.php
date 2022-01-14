<?php

namespace App\Controller;

use App\Repository\CommandRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CommandController extends AbstractController
{
    /**
     * @Route("/command", name="command")
     */
    public function index(CommandRepository $commandeRepository, SessionInterface $session): Response
    {
        $email = $session->get('email');
        // dd($email);
        // foreach($email as $id => $email){
        //     dd($id);
        //     // $product = $productRepository->findById($id);
        //     // $products[$count] = ['product' => $product, 'quantity' => $quantity];
        //     // $totalPrice += $product[0]->getPrice() * $quantity;
        //     // $count++;
        // }
        // dd($session);
        $commands = $commandeRepository->findByEmail($email);
        // $commands = $commandeRepository->findAll();
        return $this->render('command/index.html.twig', [
            'commands' => $commands,
        ]);
    }

    public function show(int $id, CommandRepository $commandeRepository): Response
    {
        $command = $commandeRepository->findById($id);
        $products = $command[0]->getProducts();
        return $this->render('command/show.html.twig', [
            'command' => $command,
            'products' => $products,
        ]);
    }
}
