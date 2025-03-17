<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use \App\Enum\Gender;

#[ORM\Entity(repositoryClass: PlayerRepository::class)]
class Player
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $firstName = null;

    #[ORM\Column(length: 100)]
    private ?string $lastName = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $birthDate = null;

    #[ORM\Column(enumType: Gender::class)]
    private ?Gender $gender = null;

    /**
     * @var Collection<int, PlayerClubSection>
     */
    #[ORM\OneToMany(targetEntity: PlayerClubSection::class, mappedBy: 'player')]
    private Collection $playerClubSections;

    public function __construct()
    {
        $this->playerClubSections = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(?\DateTimeInterface $birthDate): static
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getGender(): ?Gender
    {
        return $this->gender;
    }

    public function setGender(Gender $gender): static
    {
        $this->gender = $gender;

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
            $playerClubSection->setPlayer($this);
        }

        return $this;
    }

    public function removePlayerClubSection(PlayerClubSection $playerClubSection): static
    {
        if ($this->playerClubSections->removeElement($playerClubSection)) {
            // set the owning side to null (unless already changed)
            if ($playerClubSection->getPlayer() === $this) {
                $playerClubSection->setPlayer(null);
            }
        }

        return $this;
    }
}
