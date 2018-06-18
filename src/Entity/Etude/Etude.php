<?php

namespace App\Entity\Etude;



use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Etude\EtudeRepository")
 */
class Etude
{
    const NB_ETUDES = 15;

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
     * @var \DateTime
     * @ORM\Column(name="date_validation", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $dateValidation;

    /**
     * @var string
     * @ORM\Column(name="titre", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min="2",
     *     max="200",
     *     minMessage="Le titre doit comporter au moins 2 caractères.",
     *     maxMessage="Le titre ne peut comporter plus de 200 caractères."
     * )
     */
    protected $titre;

    /**
     * @var string
     * @ORM\Column(name="texte", type="text")
     * @Assert\NotBlank()
     * @Assert\Length(min="2", minMessage="Le texte doit comporter au moins 2 caractères.")
     */
    private $texte;

    /**
     * @var string
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie\Categorie", inversedBy="etudes")
     */
    private $categorie;

    /**
     * @var boolean
     * @ORM\Column(name="valide", type="boolean")
     */
    private $valide = false;
    /**
     * @var bool
     * @ORM\Column(name="refuse", type="boolean")
     */
    private $refuse = false;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User\User", inversedBy="etudes")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user;

    /**
     * @var string
     * @ORM\Column(name="motif_refus", type="text", nullable=true)
     */
    private $motifRefus;

    /**
     * @var Source[]
     * @ORM\OneToMany(targetEntity="App\Entity\Source\Source", mappedBy="etude", cascade={"persist"})
     * @Assert\NotNull()
     */
    private $sources;

    public function __construct()
    {
        $this->dateAjout = new \DateTime();
    }

    /**
     * @return \DateTime
     */
    public function getDateValidation(): \DateTime
    {
        return $this->dateValidation;
    }

    /**
     * @param \DateTime $dateValidation
     */
    public function setDateValidation(\DateTime $dateValidation): void
    {
        $this->dateValidation = $dateValidation;
    }


    /**
     * Get sources
     */
    public function getSources()
    {
        return $this->sources;
    }

    /**
     * @param mixed $sources
     */
    public function setSources($sources)
    {
        $this->sources = $sources;
        return $this;
    }

    /**
     * @return string
     */
    public function getMotifRefus(): ?string
    {
        return $this->motifRefus;
    }

    /**
     * @param string $motifRefus
     */
    public function setMotifRefus(string $motifRefus): void
    {
        $this->motifRefus = $motifRefus;
    }

    /**
     * @return bool
     */
    public function isRefuse(): bool
    {
        return $this->refuse;
    }

    /**
     * @param bool $refuse
     */
    public function setRefuse(bool $refuse): void
    {
        $this->refuse = $refuse;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }


    /**
     * @return bool
     */
    public function isValide(): bool
    {
        return $this->valide;
    }

    /**
     * @param bool $valide
     */
    public function setValide(bool $valide): void
    {
        $this->valide = $valide;
    }

    /**
     * @return mixed
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param mixed $categorie
     */
    public function setCategorie($categorie): void
    {
        $this->categorie = $categorie;
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
