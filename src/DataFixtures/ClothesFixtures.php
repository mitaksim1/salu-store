<?php

namespace App\DataFixtures;

use App\Entity\Clothes;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ClothesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('pt_BR');
        // Création de 100 fixtures
        for ($i = 0; $i < 100; $i++) {
            $clothes = new Clothes();
            $clothes->setName($faker->words(3, true));
            $clothes->setDescription($faker->sentences(3, true));
            $clothes->setSize($faker->numberBetween(32, 56));
            $clothes->setPrice($faker->randomFloat(2, 1, 100));
            $clothes->setSlug($faker->slug());
            $clothes->setIsSold(false);
            $clothes->setFile($clothes->getName() . '.' . $faker->fileExtension());

            $manager->persist($clothes);
        }
        $manager->flush();
    }
}
