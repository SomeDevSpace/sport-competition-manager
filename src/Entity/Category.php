<?php

namespace App\Entity;

use App\Enum\Gender;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?int $minAge = null;

    #[ORM\Column(nullable: true)]
    private ?int $maxAge = null;

    #[ORM\Column(nullable: true, enumType: Gender::class)]
    private ?Gender $gender = null;

    /**
     * @var Collection<int, CompetitionDisciplineCategory>
     */
    #[ORM\OneToMany(targetEntity: CompetitionDisciplineCategory::class, mappedBy: 'category')]
    private Collection $competitionDisciplineCategories;

    public function __construct()
    {
        $this->competitionDisciplineCategories = new ArrayCollection();
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

    public function getMinAge(): ?int
    {
        return $this->minAge;
    }

    public function setMinAge(?int $minAge): static
    {
        $this->minAge = $minAge;

        return $this;
    }

    public function getMaxAge(): ?int
    {
        return $this->maxAge;
    }

    public function setMaxAge(?int $maxAge): static
    {
        $this->maxAge = $maxAge;

        return $this;
    }

    public function getGender(): ?Gender
    {
        return $this->gender;
    }

    public function setGender(?Gender $gender): static
    {
        $this->gender = $gender;

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
            $competitionDisciplineCategory->setCategory($this);
        }

        return $this;
    }

    public function removeCompetitionDisciplineCategory(CompetitionDisciplineCategory $competitionDisciplineCategory): static
    {
        if ($this->competitionDisciplineCategories->removeElement($competitionDisciplineCategory)) {
            // set the owning side to null (unless already changed)
            if ($competitionDisciplineCategory->getCategory() === $this) {
                $competitionDisciplineCategory->setCategory(null);
            }
        }

        return $this;
    }
}
