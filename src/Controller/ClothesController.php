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
     */
    public function index(): Response
    {
    
        return $this->render('clothes/index.html.twig', [
            'current_menu' => 'clothes',
        ]);
    }
}
