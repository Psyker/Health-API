<?php

namespace App\DataFixtures;

use App\Entity\Specialization;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class SpecializationFixtures extends Fixture
{

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        for ($i = 0; $i <= 5; $i++) {
            $specialization = (new Specialization())
                ->setDescription($faker->text(150))
                ->setSlug($faker->slug)
                ->setName($faker->jobTitle);

            $manager->persist($specialization);
        }

        $manager->flush();
    }
}
