<?php

namespace App\Controller\Admin;

use App\Entity\Partner;
use App\Form\PartnerType;
use App\Repository\PartnerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PartnerController extends AbstractController
{
    #[Route('/admin/partner', name: 'admin_partner', methods: ['GET'])]
    public function index(PartnerRepository $partnerRepo, Request $request, PaginatorInterface $paginator): Response
    {

        $partners = $paginator->paginate(
            $partnerRepo->findAllPagination(),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('pages/admin/partner/index.html.twig', [
            'partners' => $partners,
        ]);
    }

    #[Route('/admin/partner/nouveau', name: 'admin_partner_new', methods: ['GET', 'POST'])]
    public function formPartner(Request $request, EntityManagerInterface $em): Response
    {

        $partner = new Partner();
        $partnerForm = $this->createForm(PartnerType::class, $partner);
        $partnerForm->handleRequest($request);

        if ($partnerForm->isSubmitted() && $partnerForm->isValid()) {
            $partner = $partnerForm->getData();
            dump($partner);
            $em->persist($partner);
            $em->flush();

            $this->addFlash('success', 'Le nouveau partenaire a bien été ajouté avec succès !');

            return $this->redirectToRoute('admin_partner');
        }

        return $this->render('pages/admin/partner/form.html.twig', [
            'form' => $partnerForm->createView()
        ]);
    }

    #[Route('admin/partner/suppresion/{id}', name: 'admin_partner_delete', methods: ['GET', 'POST'])]
    public function delete(Partner $partner, EntityManagerInterface $em): Response
    {
        $em->remove($partner);
        $em->flush();

        $this->addFlash('success', 'Le partenaire a bien été supprimé avec succès !');
        return $this->redirectToRoute('admin_partner');
    }
}
