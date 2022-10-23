<?php

namespace App\Controller;

use App\Entity\Pets;
use App\Repository\PetsRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

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
    public function show(ManagerRegistry $doctrine, string $slug, int $id, CacheInterface $cache): Response
    {
        // $pet = $petsRepo->findBy($id)
        $pet = $doctrine->getRepository(Pets::class)->find($id);
        // Si le nom de l'animal ne correspond pas avec le slug, nous créons une exception
        if (strtolower($pet->getName()) !== $slug) {
            throw $this->createNotFoundException('La page que vous demander n\'existe pas');
        }

        dump($pet);

        return $this->render('pages/pets/show.html.twig', [
            'pet' => $pet
        ]);
    }
}
