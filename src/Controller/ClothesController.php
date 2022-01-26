<?php

namespace App\Controller;

use App\Entity\Clothes;
use App\Repository\ClothesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
    public function index(): Response
    {
        // Request all clothes
        $clothes = $this->clothesRepository->findAllClothesNotSold();
    
        return $this->render('clothes/index.html.twig', [
            'current_menu' => 'clothes',
            'clothes' => $clothes
        ]);
    }

    /**
     * @Route("/clothes/{slug}-{id}", name="clothes.show", requirements={"slug": "[a-z0-9\-]*$"})
     * @return Response
     */
    public function show(Clothes $clothes, string $slug): Response
    {
        if ($clothes->getSlug() !== $slug) {
            return $this->redirectToRoute('clothes.show', [
                'id' => $clothes->getId(),
                'slug' => $clothes->getSlug()
            ], 301);
        }
        return $this->render('clothes/show.html.twig', [
            'current_menu' => 'clothes',
            'clothes' => $clothes
        ]);
    }
}
