<?php

namespace App\Entity;

use App\Repository\RegistrationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use \App\Enum\PaymentMethods;
use Gedmo\Mapping\Annotation\Timestampable;

#[ORM\Entity(repositoryClass: RegistrationRepository::class)]
class Registration
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

    #[ORM\ManyToOne(inversedBy: 'registrations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CompetitionDiscipline $competitionDiscipline = null;

    #[ORM\ManyToOne(inversedBy: 'registrations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?PlayerClubSection $playerClubSection = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $startNumber = null;

    #[ORM\Column]
    private ?bool $isPaid = false;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $paidDate = null;

    #[ORM\Column(nullable: true, enumType: PaymentMethods::class)]
    private ?PaymentMethods $paymentMethod = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $registrationDate = null;

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

    public function getPlayerClubSection(): ?PlayerClubSection
    {
        return $this->playerClubSection;
    }

    public function setPlayerClubSection(?PlayerClubSection $playerClubSection): static
    {
        $this->playerClubSection = $playerClubSection;

        return $this;
    }

    public function getStartNumber(): ?string
    {
        return $this->startNumber;
    }

    public function setStartNumber(?string $startNumber): static
    {
        $this->startNumber = $startNumber;

        return $this;
    }

    public function isPaid(): ?bool
    {
        return $this->isPaid;
    }

    public function setIsPaid(bool $isPaid): static
    {
        $this->isPaid = $isPaid;

        return $this;
    }

    public function getPaidDate(): ?\DateTimeInterface
    {
        return $this->paidDate;
    }

    public function setPaidDate(?\DateTimeInterface $paidDate): static
    {
        $this->paidDate = $paidDate;

        return $this;
    }

    public function getPaymentMethod(): ?PaymentMethods
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod(?PaymentMethods $paymentMethod): static
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    public function getRegistrationDate(): ?\DateTimeInterface
    {
        return $this->registrationDate;
    }

    public function setRegistrationDate(\DateTimeInterface $registrationDate): static
    {
        $this->registrationDate = $registrationDate;

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
