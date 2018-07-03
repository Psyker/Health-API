<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SpecializationRepository")
 */
class Specialization
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=500, nullable=false)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=1500, nullable=false)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=500, nullable=false)
     */
    private $slug;

    public function getId()
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     * @return Specialization
     */
    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
