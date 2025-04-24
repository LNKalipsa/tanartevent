<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\OneToOne(mappedBy: 'event', cascade: ['persist', 'remove'])]
    private ?Estimate $estimate = null;

    #[ORM\OneToMany(mappedBy: 'event', targetEntity: EventPicture::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $eventPictures;

    public function __construct()
    {
        $this->eventPictures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getEstimate(): ?Estimate
    {
        return $this->estimate;
    }

    public function setEstimate(?Estimate $estimate): static
    {
        // unset the owning side of the relation if necessary
        if ($estimate === null && $this->estimate !== null) {
            $this->estimate->setEvent(null);
        }

        // set the owning side of the relation if necessary
        if ($estimate !== null && $estimate->getEvent() !== $this) {
            $estimate->setEvent($this);
        }

        $this->estimate = $estimate;

        return $this;
    }

    /**
     * @return Collection<int, EventPicture>
     */
    public function getEventPictures(): Collection
    {
        return $this->eventPictures;
    }

    public function addEventPicture(EventPicture $eventPicture): static
    {
        if (!$this->eventPictures->contains($eventPicture)) {
            $this->eventPictures->add($eventPicture);
            $eventPicture->setEvent($this);
        }

        return $this;
    }

    public function removeEventPicture(EventPicture $eventPicture): static
    {
        if ($this->eventPictures->removeElement($eventPicture)) {
            // set the owning side to null (unless already changed)
            if ($eventPicture->getEvent() === $this) {
                $eventPicture->setEvent(null);
            }
        }

        return $this;
    }

    private ?Address $eventAddress;
    /**
     * @return Event
     */public function setEventAddress(Address $adress)
    {
        $this->eventAddress = $adress;
        return $this;
    }

    /**
     * @return Address
     */
    public function getEventAddress(): Address
    {
        return $this->eventAddress;
    }
}
