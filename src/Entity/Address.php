<?php

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AddressRepository::class)]
class Address
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 4)]
    private ?string $number = null;

    #[ORM\Column(length: 255)]
    private ?string $path = null;

    #[ORM\Column(length: 6)]
    private ?string $postalCode = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\OneToMany(mappedBy: 'address', targetEntity: Estimate::class)]
    private Collection $estimates;

    public function __construct()
    {
        $this->estimates = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->number.' '.$this->path.' '.$this->postalCode.' '.$this->city;
    }

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

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): static
    {
        $this->path = $path;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): static
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return Collection<int, Estimate>
     */
    public function getEstimates(): Collection
    {
        return $this->estimates;
    }

    public function addEstimate(Estimate $estimate): static
    {
        if (!$this->estimates->contains($estimate)) {
            $this->estimates->add($estimate);
            $estimate->setAddress($this);
        }

        return $this;
    }

    public function removeEstimate(Estimate $estimate): static
    {
        if ($this->estimates->removeElement($estimate)) {
            // set the owning side to null (unless already changed)
            if ($estimate->getAddress() === $this) {
                $estimate->setAddress(null);
            }
        }

        return $this;
    }
}
