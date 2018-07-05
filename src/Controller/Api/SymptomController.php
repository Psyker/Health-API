<?php

namespace App\Controller\Api;

use App\Repository\SymptomRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Serializer\SerializerInterface;

class SymptomController extends Controller
{
    /**
     * @Route("/symptoms/search", name="app_symptom_search", methods={"GET"})
     * @param Request $request
     * @param SymptomRepository $symptomRepository
     * @param SerializerInterface $serializer
     * @return \Symfony\Component\HttpFoundation\JsonResponse|Response
     */
    public function searchSymptom(Request $request, SymptomRepository $symptomRepository, SerializerInterface $serializer)
    {
        $symptoms = $symptomRepository->searchByQuery($request->get('query'));

        if (!$symptoms) {
            return $this->json('There are no symptoms available.', 404);
        }

        return new Response($serializer->serialize($symptoms, 'json'));
    }
}
