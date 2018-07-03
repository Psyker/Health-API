<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

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
     * @param mixed $appointments
     */
    public function addAppointments(Appointment $appointments): void
    {
        $this->appointments[] = $appointments;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }
}
