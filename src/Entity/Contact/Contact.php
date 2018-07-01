<?php

namespace App\Entity\Contact;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Contact\ContactRepository")
 */
class Contact
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var \DateTime
     * @ORM\Column(name="date_envoie", type="datetime")
     */
    private $dateEnvoie;

    /**
     * @var string
     * @ORM\Column(name="pseudo", length=255, type="string")
     * @Assert\NotBlank()
     * @Assert\Length(min="2", max="15",
     *  maxMessage="Votre pseudo ne peut comporter plus de 15 caractères.",
     *     minMessage="Votre pseudo doit comporter au moins 2 caractères."
     * )
     */
    private $pseudo;

    /**
     * @var string
     * @ORM\Column(name="sujet", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min="2",
     *     max="100",
     *     minMessage="Le sujet de votre demande doit comporter au moins 2 caractères.",
     *     maxMessage="Le sujet de votre demande ne peut excéder les 100 caractères."
     * )
     */
    private $sujet;

    /**
     * @var string
     * @ORM\Column(name="texte", type="text")
     * @Assert\NotBlank()
     * @Assert\Length(min="2", max="1200",
     *
     *     minMessage="Votre demande doit comporter au moins 2 caractères.",
     *     maxMessage="Votre demande ne doit pas excéder les 1200 caractères."
     * )
     */
    private $texte;

    /**
     * @var string
     * @ORM\Column(name="email", type="string", length=60)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @var boolean
     * @ORM\Column(name="accept_terms", type="boolean")
     * @Assert\NotNull()
     * @Assert\NotEqualTo(false, message="Veuillez accepter les conditions d'utilisation en cochant la case.")
     */
    private $acceptTerms;

    /**
     * @var boolean
     * @ORM\Column(name="status", type="boolean")
     */
    private $status = false;


    public function __construct()
    {
        $this->dateEnvoie = new \DateTime();
    }

    /**
     * @return bool
     */
    public function isStatus(): bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     */
    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }

    /**
     * @return bool
     */
    public function isAcceptTerms(): ?bool
    {
        return $this->acceptTerms;
    }

    /**
     * @param bool $acceptTerms
     */
    public function setAcceptTerms(bool $acceptTerms): void
    {
        $this->acceptTerms = $acceptTerms;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return \DateTime
     */
    public function getDateEnvoie(): \DateTime
    {
        return $this->dateEnvoie;
    }

    /**
     * @param \DateTime $dateEnvoie
     */
    public function setDateEnvoie(\DateTime $dateEnvoie): void
    {
        $this->dateEnvoie = $dateEnvoie;
    }

    /**
     * @return string
     */
    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    /**
     * @param string $pseudo
     */
    public function setPseudo(string $pseudo): void
    {
        $this->pseudo = $pseudo;
    }

    /**
     * @return string
     */
    public function getSujet(): ?string
    {
        return $this->sujet;
    }

    /**
     * @param string $sujet
     */
    public function setSujet(string $sujet): void
    {
        $this->sujet = $sujet;
    }

    /**
     * @return string
     */
    public function getTexte(): ?string
    {
        return $this->texte;
    }

    /**
     * @param string $texte
     */
    public function setTexte(string $texte): void
    {
        $this->texte = $texte;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

}
