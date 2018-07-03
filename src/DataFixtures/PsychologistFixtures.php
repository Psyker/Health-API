<?php

namespace App\DataFixtures;

use App\Entity\Doctor;
use App\Entity\Specialization;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class PsychologistFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        $specializations = $manager->getRepository(Specialization::class)->findAll();
        for ($i = 0; $i <= 20; $i++) {
            $randomIndex = $faker->numberBetween(0, count($specializations) - 1);
            /** @var Specialization $specialization */
            $specialization = $specializations[$randomIndex];
            $psychologist = (new Doctor())
                ->setFirstname($faker->firstName)
                ->setLastname($faker->lastName)
                ->setAge($faker->numberBetween(20, 80))
                ->setGender($faker->numberBetween(0, 1))
                ->setSpecialization($specialization);
            $manager->persist($psychologist);
        }

        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies()
    {
        return [
            SpecializationFixtures::class
        ];
    }
}
