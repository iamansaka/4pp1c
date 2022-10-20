<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PetsController extends AbstractController
{
    #[Route('/adoption', name: 'app_pets')]
    public function index(): Response
    {
        return $this->render('pets/index.html.twig', [
            'controller_name' => 'PetsController',
        ]);
    }
}
