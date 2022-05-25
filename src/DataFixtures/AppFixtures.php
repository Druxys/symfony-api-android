<?php

namespace App\DataFixtures;

use App\Entity\Project;
use App\Entity\Tier;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        $products = array();
        for ($i = 0; $i < 20; $i++) {
            $products = new Project();
            $products[$i]->setName($faker->title);
            $products[$i]->setGoal($faker->randomFloat(2, 0, 1000000));
            $products[$i]->setPledge($faker->randomFloat(2, 0, 5000000));
            $products[$i]->setDescription($faker->paragraph());
            $manager->persist($products[$i]);
        }

        $tiers = array();

        for ($i = 0; $i <= 100; $i++) {
            $tiers[$i] = new Tier();
            $tiers[$i]->setName($faker->title);
            $tiers[$i]->setDescription($faker->sentence());
            $tiers[$i]->setPrice($faker->randomFloat(2, 1, 1000));
            $tiers[$i]->setPrice($faker->randomFloat(2, 1, 1000));
            $tiers[$i]->setShipping($faker->unixTime($max = 'now'));

        }

        $manager->flush();
    }
}
