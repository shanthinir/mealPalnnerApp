<?php

namespace App\DataFixtures;

use App\Entity\Recipe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Generator;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /** @var Generator */
        $faker = Factory::create();

        for ($i = 0; $i < 50; $i++) {
            $recipe = new Recipe();
            $recipe->setName($faker->sentence($nbWords = 3, $variableNbWords = true));
            $recipe->setDescription($faker->paragraph($nbSentences = 3, $variableNbSentences = true));
            $recipe->setuserId(rand(1,10));

            $manager->persist($recipe);
        }
        $manager->flush();
    }
}
