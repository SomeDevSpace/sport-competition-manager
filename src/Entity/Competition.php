<?php

namespace App\Entity;

use App\Repository\CompetitionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use \App\Enum\CompetitionFormat;
use Gedmo\Mapping\Annotation\Slug;
use Gedmo\Mapping\Annotation\Timestampable;
use \App\Enum\CompetitionStatus;

#[ORM\Entity(repositoryClass: CompetitionRepository::class)]
class Competition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(unique: true)]
    #[Slug(fields: ['name'])]
    private ?string $slug = null;

    #[ORM\Column]
    #[Timestampable(on: 'create')]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    #[Timestampable(on: 'update')]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(length: 200, nullable: false)]
    private string $name;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: false)]
    private \DateTimeInterface $startDate;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: false)]
    private \DateTimeInterface $endDate;

    #[ORM\Column(enumType: CompetitionFormat::class)]
    private ?CompetitionFormat $format = null;

    #[ORM\Column(length: 200, nullable: false)]
    private string $location;

    #[ORM\Column(type: Types::TEXT, nullable: false)]
    private string $description;

    /**
     * @var Collection<int, CompetitionDiscipline>
     */
    #[ORM\OneToMany(targetEntity: CompetitionDiscipline::class, mappedBy: 'competition')]
    private Collection $competitionDisciplines;

    #[ORM\ManyToOne(inversedBy: 'competitions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Sport $sport = null;

    #[ORM\Column(enumType: CompetitionStatus::class)]
    private ?CompetitionStatus $status = CompetitionStatus::CREATED;

    #[ORM\Column]
    private ?bool $isOpenForRegistration = false;

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

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): static
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): static
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
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
            $competitionDiscipline->setCompetition($this);
        }

        return $this;
    }

    public function removeCompetitionDiscipline(CompetitionDiscipline $competitionDiscipline): static
    {
        if ($this->competitionDisciplines->removeElement($competitionDiscipline)) {
            // set the owning side to null (unless already changed)
            if ($competitionDiscipline->getCompetition() === $this) {
                $competitionDiscipline->setCompetition(null);
            }
        }

        return $this;
    }

    public function getFormat(): ?CompetitionFormat
    {
        return $this->format;
    }

    public function setFormat(CompetitionFormat $format): static
    {
        $this->format = $format;

        return $this;
    }

    public function getSport(): ?Sport
    {
        return $this->sport;
    }

    public function setSport(?Sport $sport): static
    {
        $this->sport = $sport;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): void
    {
        $this->slug = $slug;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getStatus(): ?CompetitionStatus
    {
        return $this->status;
    }

    public function setStatus(CompetitionStatus $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function isOpenForRegistration(): ?bool
    {
        return $this->isOpenForRegistration;
    }

    public function setIsOpenForRegistration(bool $isOpenForRegistration): static
    {
        $this->isOpenForRegistration = $isOpenForRegistration;

        return $this;
    }


}
