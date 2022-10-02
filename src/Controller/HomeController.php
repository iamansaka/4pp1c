<?php

namespace App\Controller;

use App\Repository\TestimonialsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{

    #[Route('/', name: 'app_home')]
    public function index(TestimonialsRepository $testimonialsRepository): Response
    {
        $testimonials = $testimonialsRepository->findTheLastNine();

        return $this->render('pages/home.html.twig', [
            'testimonials' => $testimonials
        ]);
    }
}
