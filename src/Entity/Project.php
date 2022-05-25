<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\OneToMany(targetEntity=Tier::class, mappedBy="project")
     */
    private $tier_id;

    public function __construct()
    {
        $this->tier_id = new ArrayCollection();
    }

    public function getId(): ?int
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

    /**
     * @return Collection<int, Tier>
     */
    public function getTierId(): Collection
    {
        return $this->tier_id;
    }

    public function addTierId(Tier $tierId): self
    {
        if (!$this->tier_id->contains($tierId)) {
            $this->tier_id[] = $tierId;
            $tierId->setProject($this);
        }

        return $this;
    }

    public function removeTierId(Tier $tierId): self
    {
        if ($this->tier_id->removeElement($tierId)) {
            // set the owning side to null (unless already changed)
            if ($tierId->getProject() === $this) {
                $tierId->setProject(null);
            }
        }

        return $this;
    }
}
