<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\ProductRepository;

class HomeController extends AbstractController
{
    #[Route('/index', name: 'index')]
    public function index(ProductRepository $product_repository): Response
    {
        $products = $product_repository->findAll();
        return $this->render('home.html.twig', [
            'products' => $products,
        ]);
        
    }
}