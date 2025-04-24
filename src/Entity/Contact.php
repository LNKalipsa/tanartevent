<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Email(
        message: "{{ value }} n'est pas une adresse mail valide.",
    )]
    private ?string $email = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank]
    #[Assert\Regex('#^[a-zA-ZÀ-ÿ -]+$#', message: "Le nom entré n'est pas valide.",)]
    private ?string $name = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank]
    #[Assert\Regex('#^[a-zA-ZÀ-ÿ -]+$#', message: "Le prénom entré n'est pas valide.",)]
    private ?string $firstname = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $society = null;

    #[ORM\Column(length: 511, type: Types::TEXT)]
    #[Assert\NotBlank]
    private ?string $message = null;

    #[ORM\Column]
    private ?bool $status = false;

    #[ORM\Column(length: 10)]
    #[Assert\NotBlank]
    //Regex : 10 numbers between 0-9 with first is 0.
    #[Assert\Regex('#^0[0-9]{9}$#', message: "Le numéro de téléphone saisi n'est pas valide.",)]
    private ?string $phoneNumber = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
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

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getSociety(): ?string
    {
        return $this->society;
    }

    public function setSociety(?string $society): static
    {
        $this->society = $society;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): static
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }
}