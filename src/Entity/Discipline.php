<?php

namespace App\Entity;

use App\Repository\DisciplineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DisciplineRepository::class)]
class Discipline
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, nullable: false)]
    private string $name;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 5)]
    private ?string $unit = null;

    /**
     * @var Collection<int, CompetitionDiscipline>
     */
    #[ORM\OneToMany(targetEntity: CompetitionDiscipline::class, mappedBy: 'discipline')]
    private Collection $competitionDisciplines;

    public function __construct()
    {
        $this->competitionDisciplines = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, CompetitionDiscipline>
     */
    public function getCompetitionDisciplines(): Collection
    {
        return $this->competitionDisciplines;
    }

    public function addCompetitionDiscipline(CompetitionDiscipline $competitionDiscipline): static
    {
        if (!$this->competitionDisciplines->contains($competitionDiscipline)) {
            $this->competitionDisciplines->add($competitionDiscipline);
            $competitionDiscipline->setDiscipline($this);
        }

        return $this;
    }

    public function removeCompetitionDiscipline(CompetitionDiscipline $competitionDiscipline): static
    {
        if ($this->competitionDisciplines->removeElement($competitionDiscipline)) {
            // set the owning side to null (unless already changed)
            if ($competitionDiscipline->getDiscipline() === $this) {
                $competitionDiscipline->setDiscipline(null);
            }
        }

        return $this;
    }

    public function getUnit(): ?string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): static
    {
        $this->unit = $unit;

        return $this;
    }
}
