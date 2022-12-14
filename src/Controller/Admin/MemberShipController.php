<?php

namespace App\Controller\Admin;

use App\Entity\MemberShip;
use App\Form\MemberShipType;
use App\Repository\MemberShipRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MemberShipController extends AbstractController
{
    #[Route('/admin/membership', name: 'admin_membership')]
    #[IsGranted('ROLE_USER')]
    public function index(MemberShipRepository $memberShipRepo, Request $request, PaginatorInterface $paginator): Response
    {
        $memberships = $paginator->paginate(
            $memberShipRepo->findLastAll(),
            $request->query->getInt('page', 1),
            15
        );

        dump($memberships);

        return $this->render('pages/admin/member_ship/index.html.twig', [
            'memberships' => $memberships
        ]);
    }

    #[Route('/admin/membership/ajouter', name: 'admin_membership_new', methods: ['GET', 'POST'])]
    #[Route('/admin/membership/edition/{id}', name: 'admin_membership_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function crudMembership(?MemberShip $member, Request $request, EntityManagerInterface $em): Response
    {
        $edit = $member ? true : false;

        if (!$edit) {
            if ($request->attributes->get('_route') === "admin_membership_edit") {
                $member;
            } else {
                $member = new MemberShip();
            }
        }

        $memberForm = $this->createForm(MemberShipType::class, $member);
        $memberForm->handleRequest($request);

        if ($memberForm->isSubmitted() && $memberForm->isValid()) {
            $member = $memberForm->getData();
            $em->persist($member);
            $em->flush();

            $this->addFlash('success', 'Le nouveau membre a bien ??t?? ajout?? avec succ??s !');

            return $this->redirectToRoute('admin_membership');
        }

        return $this->render('pages/admin/member_ship/form.html.twig', [
            'form' => $memberForm->createView()
        ]);
    }

    #[Route('/admin/membership/show/{id}', name: 'admin_membership_show', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function show(MemberShip $memberShip): Response
    {
        if (!$memberShip) {
            $this->addFlash('error', 'Le membre n\'existe pas');
            return $this->redirectToRoute('admin_membership');
        }

        return $this->render('pages/admin/member_ship/show.html.twig', [
            'membership' => $memberShip
        ]);
    }

    #[Route('/admin/membership/suppression/{id}', name: 'admin_membership_delete', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function delete(MemberShip $memberShip, EntityManagerInterface $em): Response
    {
        $em->remove($memberShip);
        $em->flush();

        return $this->redirectToRoute('admin_membership');
    }
}
