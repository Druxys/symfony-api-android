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
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

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
     * @ORM\Column(type="date")
     */
    private $limit_date;

    /**
     * @ORM\OneToMany(targetEntity=Tier::class, mappedBy="project")
     */
    private $tier;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Media::class, mappedBy="project")
     */
    private $media;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="projects")
     */
    private $user;



    public function __construct()
    {
        $this->tier = new ArrayCollection();
        $this->media = new ArrayCollection();
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
    public function getTier(): Collection
    {
        return $this->tier;
    }

    public function addTier(Tier $tier): self
    {
        if (!$this->tier->contains($tier)) {
            $this->tier[] = $tier;
            $tier->setProject($this);
        }

        return $this;
    }

    public function removeTier(Tier $tier): self
    {
        if ($this->tier->removeElement($tier)) {
            // set the owning side to null (unless already changed)
            if ($tier->getProject() === $this) {
                $tier->setProject(null);
            }
        }

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Media>
     */
    public function getMedia(): Collection
    {
        return $this->media;
    }

    public function addMedium(Media $medium): self
    {
        if (!$this->media->contains($medium)) {
            $this->media[] = $medium;
            $medium->setProject($this);
        }

        return $this;
    }

    public function removeMedium(Media $medium): self
    {
        if ($this->media->removeElement($medium)) {
            // set the owning side to null (unless already changed)
            if ($medium->getProject() === $this) {
                $medium->setProject(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }


}
