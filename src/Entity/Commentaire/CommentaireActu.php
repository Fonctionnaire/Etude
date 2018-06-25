<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 18/06/2018
 * Time: 17:39
 */

namespace App\Entity\Commentaire;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Commentaire\CommentaireActuRepository")
 */
class CommentaireActu
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var \DateTime
     * @ORM\Column(name="date_ajout", type="datetime")
     */
    private $dateAjout;

    /**
     * @var string
     * @ORM\Column(name="texte", type="text")
     * @Assert\NotBlank()
     * @Assert\Length(max="1500", maxMessage="Votre commentaire ne peut dépacer les 1500 caractères.")
     */
    private $texte;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User\User", inversedBy="commentairesActu")
     */
    private $user;

    /**
     * @var bool
     * @ORM\Column(name="signale", type="boolean")
     */
    private $signale = false;

    /**
     * @var bool
     * @ORM\Column(name="actif", type="boolean")
     */
    private $actif = true;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Actualite\Actualite", inversedBy="commentaires")
     */
    private $actu;


    public function __construct()
    {
        $this->dateAjout = new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getActu()
    {
        return $this->actu;
    }

    /**
     * @param mixed $actu
     */
    public function setActu($actu): void
    {
        $this->actu = $actu;
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
    public function isSignale(): bool
    {
        return $this->signale;
    }

    /**
     * @param bool $signale
     */
    public function setSignale(bool $signale): void
    {
        $this->signale = $signale;
    }

    /**
     * @return bool
     */
    public function isActif(): bool
    {
        return $this->actif;
    }

    /**
     * @param bool $actif
     */
    public function setActif(bool $actif): void
    {
        $this->actif = $actif;
    }
}