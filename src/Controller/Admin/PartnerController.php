<?php

namespace App\Controller\Admin;

use App\Entity\Partner;
use App\Form\PartnerType;
use App\Service\FileUploader;
use App\Repository\PartnerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PartnerController extends AbstractController
{
    #[Route('/admin/partner', name: 'admin_partner', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
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
    #[Route('/admin/partner/edition/{id}', name: 'admin_partner_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function formPartner(?Partner $partner, Request $request, EntityManagerInterface $em, FileUploader $fileUploader): Response
    {
        $edit = $partner ? true : false;

        if (!$edit) {
            if ($request->attributes->get(('_route')) === "admin_partner_edit") {
                $partner = $partner;
            } else {
                $partner = new Partner();
            }
        }

        $partnerForm = $this->createForm(PartnerType::class, $partner);
        $partnerForm->handleRequest($request);

        if ($partnerForm->isSubmitted() && $partnerForm->isValid()) {
            $picture = $partnerForm->get("pictureFile")->getData();

            if ($picture) {
                $olderPicture = $edit ? $partner->getPicture() : null;
                $partner->setPicture($fileUploader->uploadFile($picture, $olderPicture));
            }

            $em->persist($partner);
            $em->flush();

            if ($edit) {
                $this->addFlash('success', 'Le partenaire' . $partner->getName() . ' a bien été modifié avec succès !');
            } else {
                $this->addFlash('success', 'Le nouveau partenaire a bien été ajouté avec succès !');
            }

            return $this->redirectToRoute('admin_partner');
        }

        return $this->render('pages/admin/partner/form.html.twig', [
            'form' => $partnerForm->createView()
        ]);
    }

    #[Route('admin/partner/suppresion/{id}', name: 'admin_partner_delete', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function delete(Partner $partner, EntityManagerInterface $em): Response
    {
        $em->remove($partner);
        $em->flush();

        $this->addFlash('success', 'Le partenaire a bien été supprimé avec succès !');
        return $this->redirectToRoute('admin_partner');
    }
}
