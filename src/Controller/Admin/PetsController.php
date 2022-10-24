<?php

namespace App\Controller\Admin;

use App\Entity\Pets;
use App\Form\PetsType;
use App\Repository\PetsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
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

    #[Route('/admin/pets/nouveau', name: 'admin_pets_new', methods: ['GET', 'POST'])]
    #[Route('/admin/pets/{id}', name: 'admin_pets_edit', methods: ['GET', 'POST'])]
    public function new(?Pets $pet, Request $request, EntityManagerInterface $em): Response
    {
        $edit = $pet ? true : false;

        if (!$edit) {
            if ($request->attributes->get('_route') === "admin_pets_edit") {
                $pet;
            } else {
                $pet = new Pets();
            }
        }

        $petForm = $this->createForm(PetsType::class, $pet);
        $petForm->handleRequest($request);

        if ($petForm->isSubmitted() && $petForm->isValid()) {

            $pet = $petForm->getData();
            $picture = $petForm->get('thumbnail')->getData();
            $filename = pathinfo($picture->getClientOriginalName(), PATHINFO_FILENAME) . '-' . bin2hex(random_bytes(10));
            $extension = $picture->guessExtension() ?? 'jpg';

            /** @var UploadedFile */
            $picture->move('animals', $filename . '.' . $extension);

            // dd($picture, $filename);
            $pet->setPicture($filename . '.' . $extension);
            $em->persist($pet);
            $em->flush();

            if ($edit) {
                $this->addFlash('success', 'Le chat(on) a bien été modifié avec succès !');
            } else {
                $this->addFlash('success', 'Le nouveau chat(on) a bien été ajouté avec succès !');
            }

            return $this->redirectToRoute('admin_pets');
        }

        return $this->render('pages/admin/pets/new.html.twig', [
            'form' => $petForm->createView()
        ]);
    }

    #[Route('/admin/pets/suppresion/{id}', name: 'admin_pets_delete', methods: ['GET', 'POST'])]
    public function delete(Pets $pets, EntityManagerInterface $em): Response
    {

        $em->remove($pets);
        $em->flush();

        $this->addFlash('success', 'Le chat(on) a bien été supprimé avec succès !');

        return $this->redirectToRoute('admin_pets');
    }
}
