<?php

namespace App\Entity;

use App\Repository\AttributesTypesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AttributesTypesRepository::class)]
class AttributesTypes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    private ?string $dataType = null;

    /**
     * @var Collection<int, AttributesValues>
     */
    #[ORM\OneToMany(targetEntity: AttributesValues::class, mappedBy: 'attributesType')]
    private Collection $attributesValues;

    #[ORM\ManyToOne(inversedBy: 'attributesTypes')]
    private ?Type $type = null;

    public function __construct()
    {
        $this->attributesValues = new ArrayCollection();
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

    public function getDataType(): ?string
    {
        return $this->dataType;
    }

    public function setDataType(string $dataType): void
    {
        $this->dataType = $dataType;
    }

    /**
     * @return Collection<int, AttributesValues>
     */
    public function getAttributesValues(): Collection
    {
        return $this->attributesValues;
    }

    public function addAttributesValue(AttributesValues $attributesValue): static
    {
        if (!$this->attributesValues->contains($attributesValue)) {
            $this->attributesValues->add($attributesValue);
            $attributesValue->setAttributesType($this);
        }

        return $this;
    }

    public function removeAttributesValue(AttributesValues $attributesValue): static
    {
        if ($this->attributesValues->removeElement($attributesValue)) {
            // set the owning side to null (unless already changed)
            if ($attributesValue->getAttributesType() === $this) {
                $attributesValue->setAttributesType(null);
            }
        }

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): static
    {
        $this->type = $type;

        return $this;
    }
}
