<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductRepository;

class HomeController extends AbstractController
{
    public function index(ProductRepository $productRepository): Response
    {
        $allProduct = ['recent' => $productRepository->getRecentProduct(), 'cheapest' => $productRepository->getLessPrice()];
        // dd($allProduct);
        return $this->render('home/index.html.twig', [
            'allProduct' => $allProduct,
        ]);
    }
}
