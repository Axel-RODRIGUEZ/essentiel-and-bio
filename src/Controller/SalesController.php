<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SalesController extends AbstractController
{
    #[Route('/index/soldes', name: 'sales')]
    public function sales(): Response
    {
        return $this->render('sales/sales.html.twig');
    }
}