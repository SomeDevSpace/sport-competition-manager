<?php

namespace App\Entity;

use App\Repository\CompetitionDisciplineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompetitionDisciplineRepository::class)]
class CompetitionDiscipline
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'competitionDisciplines')]
    #[ORM\JoinColumn(nullable: false)]
    private Competition $competition;

    #[ORM\ManyToOne(inversedBy: 'competitionDisciplines')]
    #[ORM\JoinColumn(nullable: false)]
    private Discipline $discipline;

    #[ORM\Column(nullable: false)]
    private float $entryFee = 0.0;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $otherInfo = null;

    /**
     * @var Collection<int, Registration>
     */
    #[ORM\OneToMany(targetEntity: Registration::class, mappedBy: 'competitionDiscipline')]
    private Collection $registrations;

    /**
     * @var Collection<int, CompetitionDisciplineCategory>
     */
    #[ORM\OneToMany(targetEntity: CompetitionDisciplineCategory::class, mappedBy: 'competitionDiscipline')]
    private Collection $competitionDisciplineCategories;

    public function __construct()
    {
        $this->registrations = new ArrayCollection();
        $this->competitionDisciplineCategories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompetition(): ?Competition
    {
        return $this->competition;
    }

    public function setCompetition(?Competition $competition): static
    {
        $this->competition = $competition;

        return $this;
    }

    public function getDiscipline(): ?Discipline
    {
        return $this->discipline;
    }

    public function setDiscipline(?Discipline $discipline): static
    {
        $this->discipline = $discipline;

        return $this;
    }

    public function getEntryFee(): ?float
    {
        return $this->entryFee;
    }

    public function setEntryFee(float $entryFee): static
    {
        $this->entryFee = $entryFee;

        return $this;
    }

    public function getOtherInfo(): ?string
    {
        return $this->otherInfo;
    }

    public function setOtherInfo(?string $otherInfo): static
    {
        $this->otherInfo = $otherInfo;

        return $this;
    }

    /**
     * @return Collection<int, Registration>
     */
    public function getRegistrations(): Collection
    {
        return $this->registrations;
    }

    public function addRegistration(Registration $registration): static
    {
        if (!$this->registrations->contains($registration)) {
            $this->registrations->add($registration);
            $registration->setCompetitionDiscipline($this);
        }

        return $this;
    }

    public function removeRegistration(Registration $registration): static
    {
        if ($this->registrations->removeElement($registration)) {
            // set the owning side to null (unless already changed)
            if ($registration->getCompetitionDiscipline() === $this) {
                $registration->setCompetitionDiscipline(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CompetitionDisciplineCategory>
     */
    public function getCompetitionDisciplineCategories(): Collection
    {
        return $this->competitionDisciplineCategories;
    }

    public function addCompetitionDisciplineCategory(CompetitionDisciplineCategory $competitionDisciplineCategory): static
    {
        if (!$this->competitionDisciplineCategories->contains($competitionDisciplineCategory)) {
            $this->competitionDisciplineCategories->add($competitionDisciplineCategory);
            $competitionDisciplineCategory->setCompetitionDiscipline($this);
        }

        return $this;
    }

    public function removeCompetitionDisciplineCategory(CompetitionDisciplineCategory $competitionDisciplineCategory): static
    {
        if ($this->competitionDisciplineCategories->removeElement($competitionDisciplineCategory)) {
            // set the owning side to null (unless already changed)
            if ($competitionDisciplineCategory->getCompetitionDiscipline() === $this) {
                $competitionDisciplineCategory->setCompetitionDiscipline(null);
            }
        }

        return $this;
    }
}
