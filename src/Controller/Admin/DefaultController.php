<?php

namespace App\Controller\Admin;

use App\Repository\ArticleRepository;
use App\Repository\MemberShipRepository;
use App\Repository\PetsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/admin/dashboard', name: 'admin_dashboard')]
    public function index(PetsRepository $petsRepo, MemberShipRepository $memberShipRepo, ArticleRepository $articleRepo,): Response
    {
        $pets = $petsRepo->findTheLast(5);
        $members = $memberShipRepo->getFiveTheLast();
        $stats = [
            'articles' => $articleRepo->selectArticleCount()[0][1],
            'pets' => $petsRepo->selectPetsCount()[0][1],
            'members' => $memberShipRepo->selectMemberCount()[0][1]
        ];

        dump($stats);

        return $this->render('pages/admin/default/index.html.twig', [
            'pets' => $pets,
            'members' => $members,
            'stats' => $stats
        ]);
    }
}
