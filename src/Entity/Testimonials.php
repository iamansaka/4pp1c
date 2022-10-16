<?php

namespace App\Entity;

use App\Repository\TestimonialsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TestimonialsRepository::class)]
class Testimonials
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Veuillez renseigner votre nom')]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Veuillez renseigner votre email')]
    #[Assert\Email(message: "L'email {{ value }} n'est pas un email valide.")]
    private ?string $email = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: 'Veuillez renseigner une note')]
    private ?int $rating = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Veuillez renseigner votre témoignage')]
    #[Assert\Length(min: 5, max: 200, minMessage: ' Votre témoignage est trop courte', maxMessage: 'Votre témoignage est trop long : 200 caractères')]
    private ?string $content = null;

    #[ORM\Column]
    private ?bool $anonyme = null;

    #[ORM\Column]
    private ?bool $isValid = null;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function isAnonyme(): ?bool
    {
        return $this->anonyme;
    }

    public function setAnonyme(bool $anonyme): self
    {
        $this->anonyme = $anonyme;

        return $this;
    }

    public function isIsValid(): ?bool
    {
        return $this->isValid;
    }

    public function setIsValid(bool $isValid): self
    {
        $this->isValid = $isValid;

        return $this;
    }
}
