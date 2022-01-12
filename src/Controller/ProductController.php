<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    public function index(ProductRepository $productRepository): Response
    {
        $productRepository = $this->getDoctrine()->getRepository(Product::class);
        $products = $productRepository->findAll();
        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }

    public function show(ProductRepository $productRepository, int $id): Response
    {        
        $product = $productRepository->find($id);
        if (!$product)
        {   
            throw $this->createNotFoundException('The product does not exist');
        } else {
            return $this->render('product/show.html.twig', [
                 'product' => $product,
                 'id' => $id,
            ]);
        }
       
    }
}
