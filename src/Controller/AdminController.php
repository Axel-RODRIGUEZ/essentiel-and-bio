<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ProductRepository;

final class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin')]
    public function index(ProductRepository $product_repository): Response
    {
        $products = $product_repository->findAll();
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'products' => $products,
        ]);
    }
}
