<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
    #[Assert\NotBlank(message: 'Veuillez renseigner votre nom')]
    private string $fullname;

    #[Assert\NotBlank(message: 'Veuillez renseigner votre email')]
    #[Assert\Email(message: "L'email {{ value }} n'est pas un email valide.")]
    private string $mail;

    #[Assert\NotBlank(message: 'Veuillez renseigner votre numéro de téléphone')]
    private string $phone;

    #[Assert\NotBlank(message: 'Veuillez renseigner votre sujet')]
    #[Assert\Length(min: 5, minMessage: 'Votre sujet est trop courte')]
    private string $subjet;

    #[Assert\NotBlank(message: 'Veuillez renseigner votre message')]
    #[Assert\Length(min: 10, minMessage: 'Votre message est trop courte')]
    private string $message;
    private bool $copy = false;

    public function getFullname(): ?string
    {
        return $this->fullname;
    }

    public function setFullname(?string $fullname): self
    {
        $this->fullname = $fullname;
        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): self
    {
        $this->mail = $mail;
        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }


    public function getSubjet(): string
    {
        return $this->subjet;
    }

    public function setSubjet(?string $subjet): self
    {
        $this->subjet = $subjet;

        return $this;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;
        return $this;
    }

    public function getCopy(): bool
    {
        return $this->copy;
    }

    public function setCopy(?bool $copy): self
    {
        $this->copy = $copy;
        return $this;
    }
}
