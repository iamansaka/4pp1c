<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Partner;
use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use App\Repository\PetsRepository;
use App\Repository\ArticleRepository;
use App\Repository\PartnerRepository;
use App\Repository\TestimonialsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{

    #[Route('/', name: 'app_home', methods: ['GET'])]
    public function index(TestimonialsRepository $testimonialsRepo, ArticleRepository $articleRepo, PetsRepository $petsRepo): Response
    {
        $pets = $petsRepo->findTheLast(5);
        $articles = $articleRepo->findTheLastThree();
        $testimonials = $testimonialsRepo->findTheLastNine();

        dump($pets);

        return $this->render('pages/home.html.twig', [
            'pets' => $pets,
            'articles' => $articles,
            'testimonials' => $testimonials,
        ]);
    }


    #[Route('/partenaires', name: 'app_partner', methods: ['GET'])]
    public function partners(PartnerRepository $partnerRepo): Response
    {
        $partners = $partnerRepo->findAllPagination();

        return $this->render('pages/partner.html.twig', [
            'partners' => $partners
        ]);
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        $contact = new Contact();
        $contactForm = $this->createForm(ContactType::class, $contact);
        $contactForm->handleRequest($request);

        // $email = new Email();
        // $email->from('Ansaka <contact@ansaka.fr>')
        //     ->to('admin@4pp1c.com')
        //     ->subject('Bienvenue sur 4 pattes des poils et 1 coeur')
        //     ->html('<p>See Twig integration for better HTML integration!</p>');

        // $mailer->send($email);

        if ($contactForm->isSubmitted() && $contactForm->isValid()) {
            $contact = $contactForm->getData();
            dump($contact);


            // $this->addFlash('success', 'Votre demande a bien été envoyé avec succès');
            // return $this->redirectToRoute('app_contact');
        }

        return $this->render('pages/contact.html.twig', [
            'form' => $contactForm->createView()
        ]);
    }
}
