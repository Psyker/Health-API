<?php

namespace App\Controller\Api;

use App\Repository\HintRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class HintController extends Controller
{

    /**
     * @Route("/hints", name="app_get_hints")
     * @param HintRepository $hintRepository
     * @param SerializerInterface $serializer
     * @return Response
     */
    public function getHints(HintRepository $hintRepository, SerializerInterface $serializer)
    {
        $hints = $hintRepository->findAll();
        shuffle($hints);
        $hints = array_slice($hints, 0, 5);

        if (empty($hints)) {
            return $this->json('There are no hints.', 404);
        }

        return new Response($serializer->serialize($hints, 'json'));
    }

}