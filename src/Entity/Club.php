<?php

namespace App\Entity;

use App\Repository\ClubRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClubRepository::class)]
class Club
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200)]
    private ?string $name = null;

    #[ORM\Column(length: 100)]
    private ?string $city = null;

    /**
     * @var Collection<int, ClubSection>
     */
    #[ORM\OneToMany(targetEntity: ClubSection::class, mappedBy: 'club')]
    private Collection $clubSections;

    public function __construct()
    {
        $this->clubSections = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return Collection<int, ClubSection>
     */
    public function getClubSections(): Collection
    {
        return $this->clubSections;
    }

    public function addClubSection(ClubSection $clubSection): static
    {
        if (!$this->clubSections->contains($clubSection)) {
            $this->clubSections->add($clubSection);
            $clubSection->setClub($this);
        }

        return $this;
    }

    public function removeClubSection(ClubSection $clubSection): static
    {
        if ($this->clubSections->removeElement($clubSection)) {
            // set the owning side to null (unless already changed)
            if ($clubSection->getClub() === $this) {
                $clubSection->setClub(null);
            }
        }

        return $this;
    }
}
