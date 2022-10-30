<?php

namespace App\Entity;

use App\Repository\PartnerRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PartnerRepository::class)]
class Partner
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Veuillez remplir le champs')]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $picture = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Assert\Length(min: 5, minMessage: 'Le champs doit faire au moins plus de 5 caractères')]
    #[Assert\NotBlank(message: 'Veuillez remplir le champs')]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $representativeName = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Email(message: 'L\'email {{ value }} n\'est pas un email valide')]
    private ?string $representativeMail = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $representativePhone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adress = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

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

    public function getRepresentativeName(): ?string
    {
        return $this->representativeName;
    }

    public function setRepresentativeName(?string $representativeName): self
    {
        $this->representativeName = $representativeName;

        return $this;
    }

    public function getRepresentativeMail(): ?string
    {
        return $this->representativeMail;
    }

    public function setRepresentativeMail(?string $representativeMail): self
    {
        $this->representativeMail = $representativeMail;

        return $this;
    }

    public function getRepresentativePhone(): ?string
    {
        return $this->representativePhone;
    }

    public function setRepresentativePhone(?string $representativePhone): self
    {
        $this->representativePhone = $representativePhone;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(?string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }
}
