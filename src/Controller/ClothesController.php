<?php

namespace App\Controller;

use App\Entity\Clothes;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Entity\ClothesSearch;
use App\Form\ClothesSearchType;
use App\Repository\ClothesRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Notification\ContactNotification;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClothesController extends AbstractController
{
    private $em;
    private $clothesRepository;

    public function __construct(EntityManagerInterface $em, ClothesRepository $clothesRepository)
    {
        $this->clothesRepository = $clothesRepository;
        $this->em = $em;
    }
    /**
     * @Route("/clothes", name="clothes.index")
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        
        // Gérer le traitement pour la requête de tri selon le prix
        $search = new ClothesSearch();
        $form = $this->createForm(ClothesSearchType::class, $search);
        $form->handleRequest($request);

        // Request all clothes and paginate it at the same time
        $clothes = $paginator->paginate(
            $this->clothesRepository->findAllClothesNotSoldRequest($search),
            $request->query->getInt('page', 1), 9
        );
    
        return $this->render('clothes/index.html.twig', [
            'current_menu' => 'clothes',
            'clothes' => $clothes,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/clothes/{slug}-{id}", name="clothes.show", requirements={"slug": "[a-z0-9\-]*$"})
     * @return Response
     */
    public function show(Clothes $clothes, string $slug, Request $request, ContactNotification $notification): Response
    {
        
        if ($clothes->getSlug() !== $slug) {
            return $this->redirectToRoute('clothes.show', [
                'id' => $clothes->getId(),
                'slug' => $clothes->getSlug()
            ], 301);
        }
        // Ajout du formulaire de contact
        $contact = new Contact();
        $contact->setClothes($clothes);

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $notification->notify($contact);

            $this->addFlash('success', 'Votre email a bien été envoyé');

            return $this->redirectToRoute('clothes.show', [
                'id' => $clothes->getId(),
                'slug' => $clothes->getSlug()
            ], 301);
        }

        return $this->render('clothes/show.html.twig', [
            'current_menu' => 'clothes',
            'clothes' => $clothes,
            'form' => $form->createView()
        ]);
    }
}
