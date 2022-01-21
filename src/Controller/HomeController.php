<?php

namespace App\Controller;

use App\Repository\ClothesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ClothesRepository $clothesRepository): Response
    {
        $clothes = $clothesRepository->findLatest();
        return $this->render('home/index.html.twig', [
            'clothes' => $clothes,
        ]);
    }
}
