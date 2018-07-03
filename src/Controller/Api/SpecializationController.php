<?php

namespace App\Controller\Api;

use App\Repository\SpecializationRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class SpecializationController
 * @package App\Controller\Api
 */
class SpecializationController extends Controller
{

    /**
     * @Route("/specializations", name="app_get_psychologist_specializations")
     * @param SpecializationRepository $specializationRepository
     * @param SerializerInterface $serializer
     * @return \Symfony\Component\HttpFoundation\JsonResponse|Response
     */
    public function getPsychologistsSpecializations
    (
        SpecializationRepository $specializationRepository,
        SerializerInterface $serializer
    ) {
        $specializations = $specializationRepository->findAll();

        if (empty($specializations)) {
            return $this->json('There are no specializations.', 404);
        }

        return new Response($serializer->serialize($specializations, 'json'));
    }

}