<?php

namespace App\DataFixtures;

use App\Entity\Specialization;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class SpecializationFixtures extends Fixture
{

    private $specializations = [
        ["name" => "Généraliste", "slug" => "generaliste"],
        ["name" => "Gynécologie", "slug" => "gynecologie"],
        ["name" => "Dermatologie", "slug" => "dermatologie"],
        ["name" => "Nutrition", "slug" => "nutrition"],
        ["name" => "Pédiatrie", "slug" => "pediatrie"],
        ["name" => "Psychologie", "slug" => "psychologie"],
        ["name" => "Dentaire", "slug" => "dentaire"],
        ["name" => "Ophtamologie", "slug" => "ophtamologie"]
    ];

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        foreach ($this->specializations as $specialization) {
            $specialization = (new Specialization())
                ->setDescription($faker->text(150))
                ->setSlug($specialization["slug"])
                ->setName($specialization["name"]);

            $manager->persist($specialization);
        }

        $manager->flush();
    }
}
