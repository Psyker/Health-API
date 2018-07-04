<?php

namespace App\Controller\Api;

use App\Entity\Specialization;
use App\Repository\DoctorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/doctor")
 * Class DoctorController
 * @package App\Controller\Api
 */
class DoctorController extends Controller
{

    /**
     * @Route("/{specialization_slug}", name="app_get_doctors_by_specialization")
     * @ParamConverter("specialization", options={"mapping": {"specialization_slug": "slug"}})
     * @param DoctorRepository $doctorRepository
     * @param SerializerInterface $serializer
     * @param Specialization $specialization
     * @return \Symfony\Component\HttpFoundation\JsonResponse|Response
     */
    public function getDoctorsBySpecialization
    (
        DoctorRepository $doctorRepository,
        SerializerInterface $serializer,
        Specialization $specialization
    ) {
        $doctors = $doctorRepository->findBy(['specialization' => $specialization]);
        shuffle($doctors);


        if (empty($doctors)) {
            return $this->json('There are no corresponding doctors to the specified specialization', 404);
        }

        return new Response($serializer->serialize($doctors[0], 'json'));
    }
}