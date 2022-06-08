<?php

namespace App\DataFixtures;

use App\Entity\Media;
use App\Entity\Project;
use App\Entity\Tier;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

class ProjectFixtures extends Fixture implements DependentFixtureInterface
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

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
                ->setEmail($faker->email);
            $hashedPassword = $this->passwordHasher->hashPassword(
                $user,
                'password'
            );
            $user->setPassword($hashedPassword);

            $manager->persist($user);
            $manager->flush();


            $project = (new Project())
                ->setTitle($faker->sentence)
                ->setDescription($faker->text)
                ->setLimitDate($faker->dateTime())
                ->setPledge($faker->randomFloat(2, 0, 13000.00))
                ->setContributors($faker->numberBetween(1, 100))
                ->setUser($user)
                ->setGoal($faker->randomFloat(100, 5000.00, 10000.00));
            $manager->persist($project);
            $manager->flush();


            // Fixture for Media
            for ($j = 0; $j < $faker->numberBetween(1, 3); $j++) {
                $media = (new Media())
                    ->setSource($faker->imageUrl())
                    ->setFilename($faker->sentence)
                    ->setProject($project);
                $manager->persist($media);
                $manager->flush();
            }

            for ($j = 0; $j < $faker->numberBetween(1, 5); $j++) {
                $tier = (new Tier())
                    ->setProject($project)
                    ->setName($faker->sentence)
                    ->setDescription($faker->text)
                    ->setPrice($faker->randomFloat(2, 0, 1000.00))
                    ->setShipping($faker->dateTime());
                $manager->persist($tier);
                $manager->flush();
            }
        }

    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}