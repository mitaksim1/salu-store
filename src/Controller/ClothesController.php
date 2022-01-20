<?php

namespace App\Controller;

use App\Entity\Clothes;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClothesController extends AbstractController
{
    /**
     * @Route("/clothes", name="clothes.index")
     */
    public function index(EntityManagerInterface $em): Response
    {
        $clothes = new Clothes();
        $clothes->setName('Vestido preto')
                ->setDescription('SVestido preto curto')
                ->setSize(36)
                ->setPrice(70.00)
                ->setSlug('vestido-preto')
                ->setFile('../../public/images/black-dress.jpg');

                $em->persist($clothes);
                $em->flush();

        return $this->render('clothes/index.html.twig', [
            'current_menu' => 'clothes',
        ]);
    }
}
