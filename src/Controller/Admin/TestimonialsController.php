<?php

namespace App\Controller\Admin;

use App\Repository\TestimonialsRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TestimonialsController extends AbstractController
{
    #[Route('/admin/testimonials', name: 'admin_testimonials')]
    public function index(Request $request, TestimonialsRepository $testimonialsRepository, PaginatorInterface $paginator): Response
    {
        $testimonials = $paginator->paginate(
            $testimonialsRepository->testimonialsWithValid(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            15 /*limit per page*/
        );

        return $this->render('pages/admin/testimonials/index.html.twig', [
            'testimonials' => $testimonials,
        ]);
    }
}
