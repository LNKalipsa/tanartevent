<?php

namespace App\Entity;

use App\Repository\EstimateRepository;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EstimateRepository::class)]
class Estimate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    private ?string $number = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?DateTimeImmutable $emissionDate = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?DateTimeImmutable $validateDate = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $eventDate = null;

    #[ORM\Column(type: Types::TIME_IMMUTABLE)]
    private ?DateTimeImmutable $startTime = null;

    #[ORM\Column(type: Types::TIME_IMMUTABLE)]
    private ?DateTimeImmutable $endTime = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: 2)]
    private ?float $price = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: 2)]
    private ?float $defrayal = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\ManyToOne(inversedBy: 'estimates')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client = null;

    #[ORM\ManyToOne(cascade: ['persist'], inversedBy: 'estimates')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Address $address = null;

    #[ORM\OneToOne(inversedBy: 'estimate', cascade: ['persist', 'remove'])]
    private ?Event $event = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): static
    {
        $this->number = $number;

        return $this;
    }

    public function getEmissionDate(): ?DateTimeImmutable
    {
        return $this->emissionDate ?? new DateTimeImmutable();
    }

    public function setEmissionDate(DateTimeImmutable $emissionDate): static
    {
        $this->emissionDate = $emissionDate;

        return $this;
    }

    public function getValidateDate(): ?DateTimeImmutable
    {
        return $this->validateDate ??( new DateTimeImmutable('now'))->modify('+6 months');
    }

    public function setValidateDate(DateTimeImmutable $validateDate): static
    {
        $this->validateDate = $validateDate;

        return $this;
    }

    public function getEventDate(): ?DateTimeImmutable
    {
        return $this->eventDate;
    }

    public function setEventDate(DateTimeImmutable $eventDate): static
    {
        $this->eventDate = $eventDate;

        return $this;
    }

    public function getStartTime(): ?DateTimeImmutable
    {
        return $this->startTime;
    }

    public function setStartTime(DateTimeImmutable $startTime): static
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getEndTime(): ?DateTimeImmutable
    {
        return $this->endTime;
    }

    public function setEndTime(DateTimeImmutable $endTime): static
    {
        $this->endTime = $endTime;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getDefrayal(): ?float
    {
        return $this->defrayal;
    }

    public function setDefrayal(float $defrayal): static
    {
        $this->defrayal = $defrayal;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): static
    {
        $this->client = $client;

        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): static
    {
        $this->event = $event;

        return $this;
    }

    public function calculTotal()
    {
        return $this->defrayal + $this->price;
    }

}
