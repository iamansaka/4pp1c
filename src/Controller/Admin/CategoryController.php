<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/admin/category', name: 'admin_category', methods: ['GET', 'POST'])]
    #[Route('/admin/category/edition/{id}', name: 'admin_category_edit', methods: ['GET', 'POST'])]
    public function index(Request $request, CategoryRepository $categoryRepo, EntityManagerInterface $em, ?Category $categorie): Response
    {
        $edit = $categorie ? true : false;

        // dd($categoryRepo->getCategoryWithArticle());

        if (!$edit) {
            if ($request->attributes->get('_route') === "admin_category_edit") {
                $categorie;
            } else {
                $categorie = new Category();
            }
        }

        $categoryForm = $this->createForm(CategoryType::class, $categorie);
        $categoryForm->handleRequest($request);

        if ($categoryForm->isSubmitted() && $categoryForm->isValid()) {
            $category = $categoryForm->getData();
            $em->persist($category);
            $em->flush();

            $this->addFlash('success', 'Votre catégorie a été crée avec succès !');

            return $this->redirectToRoute('admin_category');
        }

        return $this->render('pages/admin/category/index.html.twig', [
            'categories' => $categoryRepo->getCategoryWithArticle(),
            'form' => $categoryForm->createView(),
        ]);
    }

    #[Route('/admin/category/suppression/{id}', name: 'admin_category_delete', methods: ['DELETE', 'POST'])]
    public function delete(Category $id, EntityManagerInterface $em): Response
    {
        if (!$id) {
            return throw $this->createNotFoundException('La catégorie en question n\'existe pas ou n\'a pas été trouvé!');
        }

        $em->remove($id);
        $em->flush();

        $this->addFlash('success', 'Votre catégorie a été supprimé avec succès !');

        return $this->redirectToRoute('admin_category');
    }
}
