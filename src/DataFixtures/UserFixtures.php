<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker =  Factory::create();
        for ($i = 0; $i <= 5; $i++) {
            $user = (new User())
                ->setEmail($faker->email)
                ->setFirstname($faker->firstName)
                ->setLastname($faker->lastName);
            $manager->persist($user);
        }
        $manager->flush();
    }
}
