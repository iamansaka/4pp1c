<?php

namespace App\Controller;

use App\Entity\Testimonials;
use App\Form\TestimonialsType;
use App\Repository\TestimonialsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TestimonialsController extends AbstractController
{
    /**
     * This function display all and post testimonials 
     *
     * @param Request $request
     * @param TestimonialsRepository $testimonialsRepository
     * @return Response
     */
    #[Route('/testimonials', name: 'app_testimonials')]
    public function index(Request $request, TestimonialsRepository $testimonialsRepository, PaginatorInterface $paginator, EntityManagerInterface $em): Response
    {
        $testimonialsData = $paginator->paginate(
            $testimonialsRepository->testimonialsWithValid(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            5 /*limit per page*/
        );

        $testimonials = new Testimonials();
        $testimonialsForm = $this->createForm(TestimonialsType::class, $testimonials);

        $testimonialsForm->handleRequest($request);

        if ($testimonialsForm->isSubmitted() && $testimonialsForm->isValid()) {
            $testimonials->setAnonyme(false);
            $em->persist($testimonials);
            $em->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('pages/testimonials/index.html.twig', [
            'form' => $testimonialsForm->createView(),
            'testimonials' => $testimonialsData
        ]);
    }
}
