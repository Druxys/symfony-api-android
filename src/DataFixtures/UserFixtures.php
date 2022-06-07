<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    const USER_REFERENCE = 'user';

    /**
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager)
    {
        $user = (new User())
            ->setUsername('admin')
            ->setEmail('user@email.fr')
            ->setPassword('password');

        $manager->persist($user);
        $manager->flush();
    }
}