<?php

namespace App\Entity\Categorie;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Categorie\CategorieRepository")
 */
class Categorie
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
     * @Assert\Length(min="2", minMessage="Le nom doit comporter au moins 2 caractères.")
     */
    private $nom;

    /**
     * @var string
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     * @Assert\NotBlank()
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Etude\Etude", mappedBy="categorie")
     */
    private $etudes;

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
     * @return string
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @return mixed
     */
    public function getEtudes()
    {
        return $this->etudes;
    }

    /**
     * @param mixed $etudes
     */
    public function setEtudes($etudes): void
    {
        $this->etudes = $etudes;
    }
}
