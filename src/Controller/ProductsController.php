<?php

// src/Controller/ProductsController.php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use 
Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductsController extends AbstractController
{
    #[Route('/produits', name: 'products')]
    public function index(ProductRepository $product_repository): Response
    {
        $products = $product_repository->findAll();
        return $this->render('products/products.html.twig', [
            'products' => $products,
        ]);

    }

    #[Route('/produit/nouveau', name: 'new_product')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $product = new Product();

        $form = $this->createForm(ProductType::class, $product);
        

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $imageFile */
            $imageFile = $form->get('image')->getData();

            if ($imageFile) {
                $newFilename = uniqid().'.'.$imageFile->guessExtension();

                $imageFile->move(
                    $this->getParameter('kernel.project_dir').'/public/img',
                    $newFilename
                );

                $product->setImage($newFilename);
            }

            $em->persist($product);
            $em->flush();

        return $this->redirectToRoute('admin');
    }
    return $this->render('products/new.html.twig', [ 'formProduct' => $form->createView(), 
    ]);
    }

    #[Route('/produit/toggle-favorite/{id}', name: 'app_product_toggle_favorite')]
    public function toggleFavorite(Product $product, EntityManagerInterface $entity_manager): Response
    {
        $product->setFavorite(!$product->getFavorite());
        $entity_manager->flush();
        $this->addFlash('success', 'Le statut favori a bien été modifié !');
        return $this->redirectToRoute('admin');
    }

    #[Route('/produit/éditer/{id}', name: 'update')]
    public function update(Product $product, Request $request, EntityManagerInterface $entity_manager): Response
    {
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        $entity_manager->flush();

        $this->addFlash('success', 'Le produit a bien été modifié !');
        return $this->redirectToRoute('admin'); 
        }

        return $this->render('products/update.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    #[Route('produit/supprimer/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Product $product, Request $request, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete' . $product->getId(), $request->request->get('_token'))){
        $em->remove($product);
        $em->flush();
    }
    return $this->redirectToRoute('admin');
    }
}