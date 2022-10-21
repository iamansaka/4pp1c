<?php

namespace App\Controller;

use App\Entity\Pets;
use App\Repository\PetsRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PetsController extends AbstractController
{
    #[Route('/adoption', name: 'app_pets', methods: ['GET'])]
    public function index(Request $request, PetsRepository $petsRepo, PaginatorInterface $paginator): Response
    {
        $pets = $paginator->paginate(
            $petsRepo->findAll(),
            $request->query->getInt('page', 1),
            12
        );

        return $this->render('pages/pets/index.html.twig', [
            'pets' => $pets,
        ]);
    }

    #[Route('/adoption/{slug}-{id}', name: 'app_pets_show')]
    public function show(Pets $pets): Response
    {
        return $this->render('pages/pets/show.html.twig');
    }
}
