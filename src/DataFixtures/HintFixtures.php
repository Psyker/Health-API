<?php

namespace App\DataFixtures;

use App\Entity\Hint;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class HintFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        for ($i = 0; $i <= 20; $i++) {
            $hint = (new Hint())
                ->setBody($faker->text(400))
                ->setTitle("Le saviez-vous ?")
                ->setImageUri($faker->imageUrl(400, 400));
            $manager->persist($hint);
        }

        $manager->flush();
    }
}
