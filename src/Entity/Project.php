<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProjectRepository::class)
 */
class Project
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
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="decimal", precision=7, scale=2)
     */
    private $goal;

    /**
     * @ORM\Column(type="decimal", precision=7, scale=2)
     */
    private $pledge;

    /**
     * @ORM\Column(type="bigint")
     */
    private $contributors;

    /**
     * @ORM\Column(type="datetime")
     */
    private $limit_date;

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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getGoal(): ?string
    {
        return $this->goal;
    }

    public function setGoal(string $goal): self
    {
        $this->goal = $goal;

        return $this;
    }

    public function getPledge(): ?string
    {
        return $this->pledge;
    }

    public function setPledge(string $pledge): self
    {
        $this->pledge = $pledge;

        return $this;
    }

    public function getContributors(): ?string
    {
        return $this->contributors;
    }

    public function setContributors(string $contributors): self
    {
        $this->contributors = $contributors;

        return $this;
    }

    public function getLimitDate(): ?\DateTimeInterface
    {
        return $this->limit_date;
    }

    public function setLimitDate(\DateTimeInterface $limit_date): self
    {
        $this->limit_date = $limit_date;

        return $this;
    }
}
