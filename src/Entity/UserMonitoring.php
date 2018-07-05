<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserMonitoringRepository")
 */
class UserMonitoring
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Appointment", mappedBy="monitoring")
     */
    private $appointments;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="monitoring")
     */
    private $user;

    public function __construct()
    {
        $this->appointments = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getAppointments()
    {
        return $this->appointments;
    }

    /**
     * @param Appointment $appointment
     */
    public function addAppointments(Appointment $appointment): void
    {
        $this->appointments[] = $appointment;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param $user
     * @return UserMonitoring
     */
    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
