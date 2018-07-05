<?php

namespace App\Controller\Api;

use App\Entity\Appointment;
use App\Entity\UserMonitoring;
use App\Repository\DoctorRepository;
use App\Repository\UserMonitoringRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class MonitoringController extends Controller
{

    private function getMonitoringByUser(UserMonitoringRepository $userMonitoringRepository, EntityManagerInterface $entityManager)
    {
        $user = $this->getUser();
        $monitoring = $userMonitoringRepository->findOneBy(['user' => $user]);

        if (!$monitoring) {
            $monitoring = (new UserMonitoring())->setUser($user);
            $entityManager->persist($monitoring);
            $entityManager->flush();
        }

        return $monitoring;
    }

    /**
     * @Route("/monitoring/new/appointment", name="app_monitoring_new_appointment", methods={"POST"})
     * @param Request $request
     * @param UserMonitoringRepository $userMonitoringRepository
     * @param DoctorRepository $doctorRepository
     * @param EntityManagerInterface $entityManager
     * @return \Symfony\Component\HttpFoundation\JsonResponse|Response
     */
    public function createAppointment(
        Request $request,
        UserMonitoringRepository $userMonitoringRepository,
        DoctorRepository $doctorRepository,
        EntityManagerInterface $entityManager
    ) {
        $content = $request->getContent();
        if (!empty($content) && $request->getFormat('application/json')) {
            $data = new ArrayCollection(json_decode($content, true));
            $doctor = $doctorRepository->find($data['doctor_id']);
            $monitoring = $this->getMonitoringByUser($userMonitoringRepository, $entityManager);
            $appointment = (new Appointment())->setMonitoring($monitoring)->setDoctor($doctor);

            $monitoring->addAppointments($appointment);
            $entityManager->persist($appointment);
            $entityManager->flush();

            $encoder = new JsonEncoder();
            $normalizer = new ObjectNormalizer();
            $normalizer->setIgnoredAttributes(['monitoring', 'doctor']);
            $serializer = new Serializer([$normalizer], [$encoder]);

            return new Response($serializer->serialize($appointment, 'json'));
        }

        return $this->json('An error occured', 500);
    }
}