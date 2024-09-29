<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeRepository::class)]
class Type
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    /**
     * @var Collection<int, AttributesTypes>
     */
    #[ORM\OneToMany(targetEntity: AttributesTypes::class, mappedBy: 'type')]
    private Collection $attributesTypes;

    public function __construct()
    {
        $this->attributesTypes = new ArrayCollection();
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

    public function __toString(): string
    {
        return $this->label;
    }

    /**
     * @return Collection<int, AttributesTypes>
     */
    public function getAttributesTypes(): Collection
    {
        return $this->attributesTypes;
    }

    public function addAttributesType(AttributesTypes $attributesType): static
    {
        if (!$this->attributesTypes->contains($attributesType)) {
            $this->attributesTypes->add($attributesType);
            $attributesType->setType($this);
        }

        return $this;
    }

    public function removeAttributesType(AttributesTypes $attributesType): static
    {
        if ($this->attributesTypes->removeElement($attributesType)) {
            // set the owning side to null (unless already changed)
            if ($attributesType->getType() === $this) {
                $attributesType->setType(null);
            }
        }

        return $this;
    }
}
