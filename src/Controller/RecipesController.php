<?php

// src/Controller/RecipesController.php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RecipesController extends AbstractController
{
    #[Route('/recettes', name: 'recipes')]
    public function chaud(): Response
    {
        return $this->render('recipes/recipes.html.twig', [
        ]);

    }
}

?>