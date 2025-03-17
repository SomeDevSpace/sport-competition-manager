<?php

namespace App\Entity;

use App\Repository\SportRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SportRepository::class)]
class Sport
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    /**
     * @var Collection<int, ClubSection>
     */
    #[ORM\OneToMany(targetEntity: ClubSection::class, mappedBy: 'sport')]
    private Collection $clubSections;

    /**
     * @var Collection<int, Discipline>
     */
    #[ORM\OneToMany(targetEntity: Discipline::class, mappedBy: 'sport')]
    private Collection $disciplines;

    /**
     * @var Collection<int, Competition>
     */
    #[ORM\OneToMany(targetEntity: Competition::class, mappedBy: 'sport')]
    private Collection $competitions;

    public function __construct()
    {
        $this->clubSections = new ArrayCollection();
        $this->disciplines = new ArrayCollection();
        $this->competitions = new ArrayCollection();
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
            $clubSection->setSport($this);
        }

        return $this;
    }

    public function removeClubSection(ClubSection $clubSection): static
    {
        if ($this->clubSections->removeElement($clubSection)) {
            // set the owning side to null (unless already changed)
            if ($clubSection->getSport() === $this) {
                $clubSection->setSport(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Discipline>
     */
    public function getDisciplines(): Collection
    {
        return $this->disciplines;
    }

    public function addDiscipline(Discipline $discipline): static
    {
        if (!$this->disciplines->contains($discipline)) {
            $this->disciplines->add($discipline);
            $discipline->setSport($this);
        }

        return $this;
    }

    public function removeDiscipline(Discipline $discipline): static
    {
        if ($this->disciplines->removeElement($discipline)) {
            // set the owning side to null (unless already changed)
            if ($discipline->getSport() === $this) {
                $discipline->setSport(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Competition>
     */
    public function getCompetitions(): Collection
    {
        return $this->competitions;
    }

    public function addCompetition(Competition $competition): static
    {
        if (!$this->competitions->contains($competition)) {
            $this->competitions->add($competition);
            $competition->setSport($this);
        }

        return $this;
    }

    public function removeCompetition(Competition $competition): static
    {
        if ($this->competitions->removeElement($competition)) {
            // set the owning side to null (unless already changed)
            if ($competition->getSport() === $this) {
                $competition->setSport(null);
            }
        }

        return $this;
    }
}
