<?php

namespace App\Controller\Admin;

use App\Entity\Clothes;
use App\Form\ClothesType;
use App\Repository\ClothesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @var ClothesRepository
     */
    private $clothesRepository;

    /**
     *
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(ClothesRepository $clothesRepository, EntityManagerInterface $em)
    {
        $this->clothesRepository = $clothesRepository;
        $this->em = $em;
    }

    /**
     * Show all clothes in the admin's dashboard interface
     * 
     * @Route("/admin", name="admin.dashboard.index")
     * @return Response
     */
    public function index()
    {
        $clothes = $this->clothesRepository->findAll();
        return $this->render('admin/clothes/index.html.twig', compact('clothes'));
    }

    /**
     * Add new clothes at the admin dashboard's interface
     * 
     * @Route("/admin/clothes/create", name="admin.dashboard.new")
     */
    public function new(Request $request)
    {
        $clothes = new Clothes;

        $form = $this->createForm(ClothesType::class, $clothes);
        // Récupère et traite les informations du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Comme on a instancié Clothes manuellement, l'instance n'ait pas suivie par $em
            // Il faut donc, la persister avant de l'envoyer vers la bdd
            $this->em->persist($clothes);
            // Envoi les informations traitées vers la bdd
            $this->em->flush();
            // Redirige vers la page précisée
            return $this->redirectToRoute('admin.dashboard.index');
        }

        return $this->render('admin/clothes/new.html.twig', [
            'clothes' => $clothes,
            'form' => $form->createView()
        ]);
    }

    /**
     * Edit clothes in the admin's dashboard interface
     * 
     * @Route("/admin/clothes/{id}", name="admin.dashboard.edit")
     * @return Response
     */
    public function edit(Clothes $clothes, Request $request)
    {
        $form = $this->createForm(ClothesType::class, $clothes);
        // Récupère et traite les informations du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Envoi les informations traitées vers la bdd
            $this->em->flush();
            // Redirige vers la page précisée
            return $this->redirectToRoute('admin.dashboard.index');
        }

        return $this->render('admin/clothes/edit.html.twig', [
            'clothes' => $clothes,
            'form' => $form->createView()
        ]);
    }
}