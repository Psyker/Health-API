<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AppointmentRepository")
 */
class Appointment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Doctor", inversedBy="appointments")
     * @ORM\JoinColumn(name="appointment_id", referencedColumnName="id")
     */
    private $doctor;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UserMonitoring", inversedBy="appointments")
     * @ORM\JoinColumn(name="monitoring_id", referencedColumnName="id")
     */
    private $monitoring;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $grade;

    /**
     * @ORM\Column(type="string", length=2000, nullable=true)
     */
    private $comment;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     */
    private $createdAt;

    public function getId()
    {
        return $this->id;
    }

    public function getDoctor(): Doctor
    {
        return $this->doctor;
    }

    public function setDoctor(Doctor $doctor): self
    {
        $this->doctor = $doctor;

        return $this;
    }

    public function getMonitoring(): UserMonitoring
    {
        return $this->monitoring;
    }

    public function setMonitoring(UserMonitoring $monitoring): self
    {
        $this->monitoring = $monitoring;

        return $this;
    }

    public function getGrade(): ?int
    {
        return $this->grade;
    }

    public function setGrade(int $grade): self
    {
        $this->grade = $grade;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     * @return Appointment
     */
    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
