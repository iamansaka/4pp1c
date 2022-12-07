<?php

namespace App\Controller\Admin;

use App\Repository\PetsRepository;
use App\Repository\ArticleRepository;
use App\Repository\MemberShipRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    #[Route('/admin/dashboard', name: 'admin_dashboard')]
    #[IsGranted('ROLE_USER')]
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
