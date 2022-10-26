<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PagesController extends AbstractController
{
    #[Route('/maltraitance', name: 'app_abuse')]
    public function index(): Response
    {
        return $this->render('pages/abuse.html.twig');
    }
}
