<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\PetsRepository;
use App\Repository\TestimonialsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{

    #[Route('/', name: 'app_home', methods: ['GET'])]
    public function index(TestimonialsRepository $testimonialsRepo, ArticleRepository $articleRepo, PetsRepository $petsRepo): Response
    {
        $pets = $petsRepo->findTheLast(5);
        $articles = $articleRepo->findTheLastThree();
        $testimonials = $testimonialsRepo->findTheLastNine();

        dump($pets);

        return $this->render('pages/home.html.twig', [
            'pets' => $pets,
            'articles' => $articles,
            'testimonials' => $testimonials,
        ]);
    }

    #[Route('/qui-sommes-nous', name: 'app_about', methods: ['GET'])]
    public function aboutUs(): Response
    {
        return $this->render("pages/about_us.html.twig");
    }
}
