<?php

namespace App\Controller;

use App\Repository\CommandRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandController extends AbstractController
{
    /**
     * @Route("/command", name="command")
     */
    public function index(CommandRepository $commandeRepository): Response
    {
        $commands = $commandeRepository->findAll();
        return $this->render('command/index.html.twig', [
            'commands' => $commands,
        ]);
    }

    public function show(int $id, CommandRepository $commandeRepository): Response
    {
        $command = $commandeRepository->findById($id);
        $products = $command[0]->getProducts();//['products'];//['products']->getProducts();
        return $this->render('command/show.html.twig', [
            'command' => $command,
            'products' => $products,
        ]);
    }
}
