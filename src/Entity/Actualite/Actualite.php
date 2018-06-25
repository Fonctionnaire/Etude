<?php

namespace App\Entity\Actualite;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Actualite\ActualiteRepository")
 */
class Actualite
{
    const NB_ACTU = 15;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var \DateTime
     * @ORM\Column(name="date_ajout", type="datetime")
     * @Assert\DateTime()
     * @Assert\NotNull()
     */
    private $dateAjout;

    /**
     * @var string
     * @ORM\Column(name="titre", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min="2", minMessage="Le titre doit comporter au moins 2 caractères")
     */
    private $titre;

    /**
     * @var string
     * @ORM\Column(name="texte", type="text")
     * @Assert\NotBlank()
     * @Assert\Length(min="2", minMessage="Le texte doit comporter au moins 2 caractères")
     */
    private $texte;

    /**
     * @var string
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     * @Assert\NotBlank()
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commentaire\CommentaireActu", mappedBy="actu")
     * @ORM\JoinColumn(nullable=true)
     */
    private $commentaires;


    public function __construct()
    {
        $this->dateAjout = new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    /**
     * @param mixed $commentaires
     */
    public function setCommentaires($commentaires): void
    {
        $this->commentaires = $commentaires;
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
    public function getDateAjout(): \DateTime
    {
        return $this->dateAjout;
    }

    /**
     * @param \DateTime $dateAjout
     */
    public function setDateAjout(\DateTime $dateAjout): void
    {
        $this->dateAjout = $dateAjout;
    }

    /**
     * @return string
     */
    public function getTitre(): ?string
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre(string $titre): void
    {
        $this->titre = $titre;
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
    public function getSlug(): string
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
}
