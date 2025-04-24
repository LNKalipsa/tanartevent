<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TagRepository::class)]
class Tag
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\ManyToMany(targetEntity: Design::class, mappedBy: 'tag')]
    private Collection $designs;

    public function __construct()
    {
        $this->designs = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->label;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection<int, Design>
     */
    public function getDesigns(): Collection
    {
        return $this->designs;
    }

    public function addDesign(Design $design): static
    {
        if (!$this->designs->contains($design)) {
            $this->designs->add($design);
            $design->addTag($this);
        }

        return $this;
    }

    public function removeDesign(Design $design): static
    {
        if ($this->designs->removeElement($design)) {
            $design->removeTag($this);
        }

        return $this;
    }

    public function getNumberOfDesign()
    {
        return (string)count($this->designs);
    }
}
