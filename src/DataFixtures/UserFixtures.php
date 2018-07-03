<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker =  Factory::create();
        for ($i = 0; $i <= 5; $i++) {

            $user = (new User())
                ->setEmail($faker->email)
                ->setFirstname($faker->firstName)
                ->setLastname($faker->lastName);

            $password = $this->encoder->encodePassword($user, "userpass");
            $user->setPassword($password);

            $manager->persist($user);
        }
        $manager->flush();
    }
}
