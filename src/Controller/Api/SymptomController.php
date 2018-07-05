<?php

namespace App\Controller\Api;

use App\Repository\SymptomRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Serializer\SerializerInterface;

class SymptomController extends Controller
{
    /**
     * @Route("/symptoms", name="app_symptom_search", methods={"GET"})
     * @param SymptomRepository $symptomRepository
     * @param SerializerInterface $serializer
     * @return \Symfony\Component\HttpFoundation\JsonResponse|Response
     */
    public function searchSymptom(SymptomRepository $symptomRepository, SerializerInterface $serializer)
    {
        $symptoms = $symptomRepository->findAll();

        if (!$symptoms) {
            return $this->json('There are no symptoms available.', 404);
        }

        return new Response($serializer->serialize($symptoms, 'json'));
    }
}
