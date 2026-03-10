<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InfosController extends AbstractController
{
    #[Route('/index/nos_engagements', name: 'commitments')]
    public function commitments(): Response
    {
        return $this->render('commitments/commitments.html.twig');
    }

    #[Route('/index/contactez_nous', name: 'contact')]
    public function contact(): Response
    {
        return $this->render('contact/contact.html.twig');
    }

    #[Route('/index/informations', name: "infos")]
    public function infos(): Response
    {
        return $this->render('infos/infos.html.twig');
    }
}