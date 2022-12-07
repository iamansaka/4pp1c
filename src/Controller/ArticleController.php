<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class ArticleController extends AbstractController
{
    /**
     * This controller display all articles
     *
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @param ArticleRepository $articleRepository
     * @return Response
     */
    #[Route('/actualites', name: 'app_article', methods: 'GET')]
    public function index(Request $request, PaginatorInterface $paginator, ArticleRepository $articleRepository): Response
    {
        $articlesRepository = $articleRepository->findAllWithPublished();

        $articles = $paginator->paginate(
            $articlesRepository,
            $request->query->getInt('page', 1),
            9
        );

        return $this->render('pages/article/index.html.twig', [
            'articles' => $articles,
        ]);
    }


    /**
     * This controller display show article
     *
     * @param [type] $slug
     * @param ArticleRepository $articleRepo
     * @param CacheInterface $cache
     * @return Response
     */
    #[Route('/actualites/{slug}', name: 'app_article_show', methods: 'GET', requirements: ['slug' => '^[a-z0-9]+(?:-[a-z0-9]+)*$'])]
    public function show($slug, ArticleRepository $articleRepo, CacheInterface $cache): Response
    {
        // On récupère l'article correspondant au slug
        $article = $cache->get('app_article_show_' . $slug, function (ItemInterface $item) use ($articleRepo, $slug) {
            $item->expiresAfter(20);
            return $articleRepo->findOneBy(['slug' => $slug]);
        });

        // Si aucun article n'est trouvé, nous créons une exception
        if (!$article) {
            throw $this->createNotFoundException('L\'article n\'existe pas');
        }

        return $this->render('pages/article/show.html.twig', [
            'article' => $article
        ]);
    }

    /**
     * This controller display all articles json
     *
     * @param string $search
     * @param ArticleRepository $articleRepository
     * @return JsonResponse
     */
    #[Route('/ajax/actualites/search/{search}', name: 'app_article_search')]
    public function articleSearch(string $search, ArticleRepository $articleRepository): JsonResponse
    {
        $article = $articleRepository->findBySearch($search);
        return $this->json(json_encode($article));
    }
}
