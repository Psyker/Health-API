<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DoctorRepository")
 */
class Doctor
{

    CONST GENDER_MALE   = 1;
    CONST GENDER_FEMALE = 0;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $lastname;

    /**
     * @ORM\Column(type="boolean")
     */
    private $gender;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Specialization")
     * @ORM\JoinColumn(name="specialization_id", referencedColumnName="id")
     */
    private $specialization;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Appointment", mappedBy="doctor")
     */
    private $appointments;

    public function __construct()
    {
        $this->appointments =  new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getGender(): ?bool
    {
        return $this->gender;
    }

    public function setGender(bool $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getSpecialization(): Specialization
    {
        return $this->specialization;
    }

    public function setSpecialization(Specialization $specialization): self
    {
        $this->specialization = $specialization;

        return $this;
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
}
