<?php

namespace App\Entity;

use App\Repository\PetsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PetsRepository::class)]
class Pets
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $registryNumber = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?bool $sexe = null;

    #[ORM\Column(nullable: true)]
    private ?int $age = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $arrivedAtRefuge = null;

    #[ORM\Column]
    private ?bool $isVaccinated = null;

    #[ORM\Column]
    private ?bool $isSterilized = null;

    #[ORM\Column]
    private ?bool $isAffinityDog = null;

    #[ORM\Column]
    private ?bool $isAffinityCat = null;

    #[ORM\Column]
    private ?bool $isAffinityChildren = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable;
        $this->updatedAt = new \DateTimeImmutable;
    }

    #[ORM\PrePersist()]
    public function setUpdatedAtValue(): void
    {
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getRegistryNumber(): ?string
    {
        return $this->registryNumber;
    }

    public function setRegistryNumber(?string $registryNumber): self
    {
        $this->registryNumber = $registryNumber;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function isSexe(): ?bool
    {
        return $this->sexe;
    }

    public function setSexe(bool $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getArrivedAtRefuge(): ?\DateTimeInterface
    {
        return $this->arrivedAtRefuge;
    }

    public function setArrivedAtRefuge(\DateTimeInterface $arrivedAtRefuge): self
    {
        $this->arrivedAtRefuge = $arrivedAtRefuge;

        return $this;
    }

    public function isIsVaccinated(): ?bool
    {
        return $this->isVaccinated;
    }

    public function setIsVaccinated(?bool $isVaccinated): self
    {
        $this->isVaccinated = $isVaccinated;

        return $this;
    }

    public function isIsSterilized(): ?bool
    {
        return $this->isSterilized;
    }

    public function setIsSterilized(?bool $isSterilized): self
    {
        $this->isSterilized = $isSterilized;

        return $this;
    }

    public function isIsAffinityDog(): ?bool
    {
        return $this->isAffinityDog;
    }

    public function setIsAffinityDog(?bool $isAffinityDog): self
    {
        $this->isAffinityDog = $isAffinityDog;

        return $this;
    }

    public function isIsAffinityCat(): ?bool
    {
        return $this->isAffinityCat;
    }

    public function setIsAffinityCat(bool $isAffinityCat): self
    {
        $this->isAffinityCat = $isAffinityCat;

        return $this;
    }

    public function isIsAffinityChildren(): ?bool
    {
        return $this->isAffinityChildren;
    }

    public function setIsAffinityChildren(bool $isAffinityChildren): self
    {
        $this->isAffinityChildren = $isAffinityChildren;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
