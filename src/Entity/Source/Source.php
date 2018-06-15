<?php

namespace App\Entity\Source;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Source\SourceRepository")
 */
class Source
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="nom", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Etude\Etude", inversedBy="sources", cascade={"persist"})
     */
    private $etude;

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
     * @return string
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getEtude()
    {
        return $this->etude;
    }

    /**
     * @param mixed $etude
     */
    public function setEtude($etude)
    {
        $this->etude = $etude;
    }
}
