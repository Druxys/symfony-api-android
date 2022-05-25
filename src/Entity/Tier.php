<?php

namespace App\Entity;

use App\Repository\TierRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TierRepository::class)
 */
class Tier
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="decimal", precision=7, scale=2)
     */
    private $price;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $shipping;

    /**
     * @ORM\ManyToOne(targetEntity=Project::class, inversedBy="tier_id")
     */
    private $project;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getShipping(): ?\DateTimeInterface
    {
        return $this->shipping;
    }

    public function setShipping(?\DateTimeInterface $shipping): self
    {
        $this->shipping = $shipping;

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

        return $this;
    }
}
