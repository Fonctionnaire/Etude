<?php

namespace App\Entity\Newsletter;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Newsletter\SendNewsletterRepository")
 */
class SendNewsletter
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="texte", type="text")
     * @Assert\NotBlank()
     */
    private $texte;


    /**
     * @var \DateTime
     * @ORM\Column(name="date_envoi", type="datetime")
     */
    private $dateEnvoi;


    public function __construct()
    {
        $this->dateEnvoi = new \DateTime();
    }

    public function getId()
    {
        return $this->id;
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
     * @return \DateTime
     */
    public function getDateEnvoi(): \DateTime
    {
        return $this->dateEnvoi;
    }

    /**
     * @param \DateTime $dateEnvoi
     */
    public function setDateEnvoi(\DateTime $dateEnvoi): void
    {
        $this->dateEnvoi = $dateEnvoi;
    }
}
