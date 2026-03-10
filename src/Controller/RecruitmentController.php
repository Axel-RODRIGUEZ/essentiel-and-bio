<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RecruitmentController extends AbstractController
{
    #[Route('/index/recrutement', name: 'recruitment')]
    public function recruitment(): Response
    {
        return $this->render('recruitement/recruitment.html.twig');
    }
}
