<?php

namespace App\Entity;

use App\Repository\ClubSectionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation\Timestampable;

#[ORM\Entity(repositoryClass: ClubSectionRepository::class)]
class ClubSection
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Timestampable(on: 'create')]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    #[Timestampable(on: 'update')]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'clubSections')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Club $club = null;

    #[ORM\ManyToOne(inversedBy: 'clubSections')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Sport $sport = null;

    /**
     * @var Collection<int, PlayerClubSection>
     */
    #[ORM\OneToMany(targetEntity: PlayerClubSection::class, mappedBy: 'clubSection')]
    private Collection $playerClubSections;

    public function __construct()
    {
        $this->playerClubSections = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClub(): ?Club
    {
        return $this->club;
    }

    public function setClub(?Club $club): static
    {
        $this->club = $club;

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

    /**
     * @return Collection<int, PlayerClubSection>
     */
    public function getPlayerClubSections(): Collection
    {
        return $this->playerClubSections;
    }

    public function addPlayerClubSection(PlayerClubSection $playerClubSection): static
    {
        if (!$this->playerClubSections->contains($playerClubSection)) {
            $this->playerClubSections->add($playerClubSection);
            $playerClubSection->setClubSection($this);
        }

        return $this;
    }

    public function removePlayerClubSection(PlayerClubSection $playerClubSection): static
    {
        if ($this->playerClubSections->removeElement($playerClubSection)) {
            // set the owning side to null (unless already changed)
            if ($playerClubSection->getClubSection() === $this) {
                $playerClubSection->setClubSection(null);
            }
        }

        return $this;
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

}
