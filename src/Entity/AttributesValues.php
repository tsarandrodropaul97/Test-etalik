<?php

namespace App\Entity;

use App\Repository\AttributesValuesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AttributesValuesRepository::class)]
class AttributesValues
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $value = null;

    #[ORM\ManyToOne(inversedBy: 'attributesValues')]
    private ?AttributesTypes $attributesType = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function getAttributesType(): ?AttributesTypes
    {
        return $this->attributesType;
    }

    public function setAttributesType(?AttributesTypes $attributesType): static
    {
        $this->attributesType = $attributesType;

        return $this;
    }
}
