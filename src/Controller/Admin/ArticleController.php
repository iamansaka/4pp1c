<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use App\Service\FileUploader;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/admin/article', name: 'admin_article', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function index(Request $request, PaginatorInterface $paginator, ArticleRepository $articleRepository): Response
    {
        $requestArticle = $request->query->get('q');

        if (!$requestArticle || $requestArticle === 'all') {
            $articleQuery = $articleRepository->findBy([], ['id' => 'DESC']);
        } else {
            if ($requestArticle === 'published') {
                $articleQuery = $articleRepository->findBy(['isPublished' => 1], ['id' => 'DESC']);
            } else {
                $articleQuery = $articleRepository->findBy(['isPublished' => 0], ['id' => 'DESC']);
            }
        }

        $articles = $paginator->paginate(
            $articleQuery,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('pages/admin/article/index.html.twig', [
            'articles' => $articles
        ]);
    }

    #[Route('/admin/article/nouveau', name: 'admin_article_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function new(Request $request, EntityManagerInterface $em, FileUploader $fileUploader): Response
    {
        $article = new Article();
        $articleForm = $this->createForm(ArticleType::class, $article);
        $articleForm->handleRequest($request);

        if ($articleForm->isSubmitted() && $articleForm->isValid()) {
            $picture = $articleForm->get("pictureFile")->getData();
            $slug = (new Slugify())->slugify($article->getTitle());
            $article->setSlug($slug);
            $article->setPicture($fileUploader->uploadFile($picture));

            $em->persist($article);
            $em->flush();

            $this->addFlash('success', 'Votre article a ??t?? cr??e avec succ??s !');
            return $this->redirectToRoute('admin_article');
        }

        return $this->render("pages/admin/article/new.html.twig", [
            'form' => $articleForm->createView(),
        ]);
    }

    #[Route('/admin/article/edition/{id}', name: 'admin_article_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function edit(Request $request, Article $article, EntityManagerInterface $em, FileUploader $fileUploader): Response
    {
        $articleForm = $this->createForm(ArticleType::class, $article);
        $articleForm->handleRequest($request);

        if ($articleForm->isSubmitted() && $articleForm->isValid()) {
            $article = $articleForm->getData();
            $picture = $articleForm->get('pictureFile')->getData();
            if ($picture) {
                $article->setPicture($fileUploader->uploadFile($picture, $article->getPicture() ? $article->getPicture() : null));
            }

            $em->persist($article);
            $em->flush();

            $this->addFlash('success', 'Votre article a bien ??t?? modifi??');
            return $this->redirectToRoute('admin_article');
        }

        return $this->render('pages/admin/article/edit.html.twig', [
            'form' => $articleForm->createView()
        ]);
    }

    #[Route('admin/article/suppression/{id}', name: 'admin_article_delete', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function delete(Article $article, EntityManagerInterface $em): Response
    {
        if (!$article) {
            return throw $this->createNotFoundException('L\'article en question n\'existe pas ou n\'a pas ??t?? trouv??!');
        }


        $em->remove($article);
        $em->flush();

        $this->addFlash('success', 'Votre article a ??t?? supprim?? avec succ??s !');

        return $this->redirectToRoute('admin_article');
    }
}
