<?php

namespace App\Entity\Newsletter;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Newsletter\NewsletterRepository")
 */
class Newsletter
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\NotEqualTo(false, message="Veuillez accepter les conditions d'utilisation en cochant la case.")
     */
    private $acceptTerms = false;


    public function getId()
    {
        return $this->id;
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

    public function getAcceptTerms(): ?bool
    {
        return $this->acceptTerms;
    }

    public function setAcceptTerms(bool $acceptTerms): self
    {
        $this->acceptTerms = $acceptTerms;

        return $this;
    }
}
