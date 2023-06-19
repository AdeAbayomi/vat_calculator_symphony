<?php

namespace App\Entity;

use App\Repository\CalculationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CalculationRepository::class)]
class Calculation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $Calculation = null;

    #[ORM\Column(nullable: true)]
    private ?float $value = null;

    #[ORM\Column(nullable: true)]
    private ?float $vatRate = null;

    #[ORM\Column(nullable: true)]
    private ?float $exVatValue = null;

    #[ORM\Column(nullable: true)]
    private ?float $incVatValue = null;

    #[ORM\Column(nullable: true)]
    private ?float $vatAmount = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCalculation(): ?int
    {
        return $this->Calculation;
    }

    public function setCalculation(int $Calculation): static
    {
        $this->Calculation = $Calculation;

        return $this;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(?float $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function getVatRate(): ?float
    {
        return $this->vatRate;
    }

    public function setVatRate(?float $vatRate): static
    {
        $this->vatRate = $vatRate;

        return $this;
    }

    public function getExVatValue(): ?float
    {
        return $this->exVatValue;
    }

    public function setExVatValue(?float $exVatValue): static
    {
        $this->exVatValue = $exVatValue;

        return $this;
    }

    public function getIncVatValue(): ?float
    {
        return $this->incVatValue;
    }

    public function setIncVatValue(?float $incVatValue): static
    {
        $this->incVatValue = $incVatValue;

        return $this;
    }

    public function getVatAmount(): ?float
    {
        return $this->vatAmount;
    }

    public function setVatAmount(?float $vatAmount): static
    {
        $this->vatAmount = $vatAmount;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
