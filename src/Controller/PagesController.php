<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PagesController extends AbstractController
{
    #[Route('/maltraitance', name: 'app_abuse', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('pages/abuse.html.twig');
    }

    #[Route('/politique-de-cookies', name: 'app_policy_cookies', methods: ['GET'])]
    public function policyCookie(): Response
    {
        return $this->render('pages/policy_cookie.html.twig');
    }

    #[Route('mentions-legales', name: 'app_mentions', methods: ['GET'])]
    public function mentionsLegales(): Response
    {
        return $this->render('pages/mentions.html.twig');
    }
}
