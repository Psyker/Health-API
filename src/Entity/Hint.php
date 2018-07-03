<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HintRepository")
 */
class Hint
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=2000)
     */
    private $body;

    /**
     * @ORM\Column(name="image_uri", type="string")
     */
    private $imageUri;

    public function getId()
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getImageUri()
    {
        return $this->imageUri;
    }

    /**
     * @param string $imageUri
     * @return Hint
     */
    public function setImageUri(string $imageUri): self
    {
        $this->imageUri = $imageUri;

        return $this;
    }
}
