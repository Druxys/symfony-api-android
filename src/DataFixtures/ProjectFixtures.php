<?php

namespace App\DataFixtures;

use App\Entity\Project;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProjectFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        // Fixture for Project
        for ($i = 0; $i < 10; $i++) {

            $user = (new User())
                ->setUsername($faker->userName)
                ->setEmail($faker->email)
                ->setPassword('password');

            $manager->persist($user);
            $manager->flush();


            $project = (new Project())
                ->setTitle($faker->sentence)
                ->setDescription($faker->text)
                ->setLimitDate($faker->dateTime())
                ->setPledge($faker->randomFloat(2, 0, 13000.00))
                ->setContributors($faker->numberBetween(1, 100))
               // ->setUser($user)
                ->setGoal($faker->randomFloat(100, 5000.00, 10000.00));

            $manager->persist($project);
            $manager->flush();
        }

    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}