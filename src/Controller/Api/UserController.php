<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\MakerBundle\Validator;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends Controller
{

    /**
     * @Route("/login", name="app_user_login", methods={"POST"})
     * @param Request $request
     * @param UserRepository $userRepository
     * @param UserPasswordEncoderInterface $encoder
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function login(Request $request, UserRepository $userRepository, UserPasswordEncoderInterface $encoder)
    {
        $userData = new User();
        $content = $request->getContent();
        if (empty($content) && !$request->getFormat('application/json') ) {
            return $this->json('Bad request', 500);
        }

        $data = new ArrayCollection(json_decode($content, true));
        $userData->setEmail($data["email"])->setPassword($data["password"]);

        $user = $userRepository->findOneBy(['email' => $userData->getEmail()]);
        if ($user && $encoder->isPasswordValid($user, $userData->getPassword())) {
            return $this->json(['token' => $user->getToken()], 200);
        }

        return $this->json('Bad credentials.', 403);
    }

    /**
     * @Route("/register", name="app_user_register", methods={"POST"})
     * @param Request $request
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     * @param EntityManagerInterface $entityManager
     * @param UserRepository $userRepository
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function register(
        Request $request,
        UserPasswordEncoderInterface $userPasswordEncoder,
        EntityManagerInterface $entityManager,
        UserRepository $userRepository
    ) {
        $userData = new User();
        $content = $request->getContent();
        if (empty($content) && !$request->getFormat('application/json') ) {
            return $this->json('Bad request', 500);
        }

        try {
            $data = new ArrayCollection(json_decode($content,true));
            $userData->setFirstname($data['firstname'])->setLastname($data['lastname'])->setEmail($data['email'])
                ->setPassword($userPasswordEncoder->encodePassword($userData, $data['password']));
            $entityManager->persist($userData);
            $entityManager->flush();
        } catch (\Exception $exception) {
            return $this->json("An error occured : $exception", 500);
        }


        $user = $userRepository->findOneBy(['email' => $userData->getEmail()]);
        if ($user && $userPasswordEncoder->isPasswordValid($user, $userData->getPassword())) {
            return $this->json(['token' => $user->getToken()], 200);
        }

        return $this->json('User does not exist.', 403);
    }

}