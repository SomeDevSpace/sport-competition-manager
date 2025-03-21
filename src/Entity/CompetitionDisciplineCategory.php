<?php

namespace App\Entity;

use App\Repository\CompetitionDisciplineCategoryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompetitionDisciplineCategoryRepository::class)]
class CompetitionDisciplineCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'competitionDisciplineCategories')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CompetitionDiscipline $competitionDiscipline = null;

    #[ORM\ManyToOne(inversedBy: 'competitionDisciplineCategories')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\Column(nullable: true)]
    private ?float $entryFee = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $otherInfo = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompetitionDiscipline(): ?CompetitionDiscipline
    {
        return $this->competitionDiscipline;
    }

    public function setCompetitionDiscipline(?CompetitionDiscipline $competitionDiscipline): static
    {
        $this->competitionDiscipline = $competitionDiscipline;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getEntryFee(): ?float
    {
        return $this->entryFee;
    }

    public function setEntryFee(?float $entryFee): static
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
}
