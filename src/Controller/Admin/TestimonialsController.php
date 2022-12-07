<?php

namespace App\Controller\Admin;

use App\Entity\Testimonials;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\TestimonialsRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TestimonialsController extends AbstractController
{
    #[Route('/admin/testimonials', name: 'admin_testimonials', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function index(Request $request, TestimonialsRepository $testimonialsRepository, PaginatorInterface $paginator): Response
    {
        $testimonials = $paginator->paginate(
            $testimonialsRepository->testimonialsWithValid(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        return $this->render('pages/admin/testimonials/index.html.twig', [
            'testimonials' => $testimonials,
        ]);
    }

    #[Route('/admin/testimonials/suppresion/{id}', name: 'admin_testimonials_delete', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function delete(Testimonials $testimonials, EntityManagerInterface $em)
    {
        if (!$testimonials) {
            $this->addFlash('danger', 'Le témoignage en question n\'a pas été trouvé !');
            return $this->redirectToRoute('admin_testimonials');
        }

        $em->remove($testimonials);
        $em->flush();

        $this->addFlash('success', 'Le témoignage a été supprimé avec succès !');
        return $this->redirectToRoute('admin_testimonials');
    }
}
