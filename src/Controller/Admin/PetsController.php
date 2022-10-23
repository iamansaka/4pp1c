<?php

namespace App\Controller\Admin;

use App\Repository\PetsRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PetsController extends AbstractController
{
    #[Route('/admin/pets', name: 'admin_pets')]
    public function index(Request $request, PetsRepository $petsRepo, PaginatorInterface $paginator): Response
    {
        $pets = $paginator->paginate(
            $petsRepo->findAll(),
            $request->query->getInt('page', 1),
            10
        );

        dump($pets);

        return $this->render('pages/admin/pets/index.html.twig', [
            'pets' => $pets,
        ]);
    }
}
