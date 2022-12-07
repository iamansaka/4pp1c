<?php

namespace App\Controller\Admin;

use App\Entity\Pets;
use App\Form\PetsType;
use App\Service\FileUploader;
use App\Repository\PetsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PetsController extends AbstractController
{
    #[Route('/admin/pets', name: 'admin_pets')]
    #[IsGranted('ROLE_USER')]
    public function index(Request $request, PetsRepository $petsRepo, PaginatorInterface $paginator): Response
    {
        $pets = $paginator->paginate(
            $petsRepo->findBy([], ['id' => 'DESC']),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('pages/admin/pets/index.html.twig', [
            'pets' => $pets,
        ]);
    }

    #[Route('/admin/pets/nouveau', name: 'admin_pets_new', methods: ['GET', 'POST'])]
    #[Route('/admin/pets/edition/{id}', name: 'admin_pets_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function new(?Pets $pet, Request $request, EntityManagerInterface $em, FileUploader $fileUploader): Response
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

            $picture = $petForm->get('thumbnail')->getData();
            if ($picture) {
                $olderPicture = $edit ? $pet->getPicture() : null;
                $pet->setPicture($fileUploader->uploadFile($picture, $olderPicture));
            }

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

    #[Route('admin/pets/{id}', name: 'admin_pets_show', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function show(ManagerRegistry $doctrine, int $id): Response
    {
        $pet = $doctrine->getRepository(Pets::class)->find($id);

        if (!$pet) {
            return throw $this->createNotFoundException('Le chat(on) que tu cherches n\'est pas ou plus disponible.');
        }

        return $this->render('pages/admin/pets/show.html.twig', [
            'pet' => $pet
        ]);
    }

    #[Route('/admin/pets/suppresion/{id}', name: 'admin_pets_delete', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function delete(Pets $pets, EntityManagerInterface $em): Response
    {

        $em->remove($pets);
        $em->flush();

        $this->addFlash('success', 'Le chat(on) a bien été supprimé avec succès !');

        return $this->redirectToRoute('admin_pets');
    }
}
