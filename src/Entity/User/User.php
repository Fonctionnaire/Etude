<?php

namespace App\Entity\User;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Table(name="app_users")
 * @ORM\Entity(repositoryClass="App\Repository\User\UserRepository")
 * @UniqueEntity(fields="email", message="Cet e-mail est déjà utilisé")
 * @UniqueEntity(fields="username", message="Ce nom d'utilisateur existe déjà")
*/
class User implements AdvancedUserInterface
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @ORM\Column(type="string", length=25, unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(min="2", max="15",
     *     minMessage="Votre nom d'utilisateur doit comporter au moins 2 caractères.",
     *     maxMessage="Votre nom d'utilisateur ne peut comporter plus de 15 caractères"
     * )
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=64)
     * @Assert\Length(min="6", minMessage="Votre mot de passe doit comporter au moins 6 caractères.")
     */
    private $password;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $plainPassword;


    /**
     * @ORM\Column(type="string", length=60, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email(message="Veuillez saisir une adresse e-mail valide.")
     */
    private $email;

    /**
     * @var array
     *
     * @ORM\Column(type="json")
     */
    private $roles = [];


    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive = false;

    /**
     * @var string
     * @ORM\Column(name="confirmation_token", type="string", nullable=true)
     */
    private $confirmationToken;

    /**
     * @var string
     * @ORM\Column(name="change_password_token", type="string", nullable=true)
     */
    private $changePasswordToken;

    /**
     * @var \DateTime
     * @ORM\Column(name="change_password_token_validity", type="datetime", nullable=true)
     */
    private $changePasswordTokenValidity;


    /**
     * @var boolean
     * @ORM\Column(name="email_confirmed", type="boolean")
     */
    private $emailConfirmed = false;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_register", type="datetime")
     */
    private $dateRegister;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commentaire\CommentaireEtude", mappedBy="user")
     * @ORM\JoinColumn(nullable=true)
     */
    private $commentairesEtude;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commentaire\CommentaireActu", mappedBy="user")
     * @ORM\JoinColumn(nullable=true)
     */
    private $commentairesActu;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Etude\Etude", mappedBy="user")
     */
    private $etudes;

    /**
     * @var boolean
     * @ORM\Column(name="accept_terms", type="boolean")
     * @Assert\NotNull()
     * @Assert\NotEqualTo(false, message="Veuillez accepter les conditions d'utilisation en cochant la case.")
     */
    private $acceptTerms;

    /**
     * @var string
     * @ORM\Column(name="user_ip", type="string", length=255)
     */
    private $userIp;


    public function __construct()
    {
        $this->roles = ['ROLE_USER'];
        $this->dateRegister = new \DateTime();
    }

    /**
     * @return string
     */
    public function getUserIp(): ?string
    {
        return $this->userIp;
    }

    /**
     * @param string $userIp
     */
    public function setUserIp(string $userIp): void
    {
        $this->userIp = $userIp;
    }

    /**
     * @return \DateTime
     */
    public function getChangePasswordTokenValidity(): ?\DateTime
    {
        return $this->changePasswordTokenValidity;
    }

    /**
     * @param \DateTime $changePasswordTokenValidity
     */
    public function setChangePasswordTokenValidity(\DateTime $changePasswordTokenValidity): void
    {
        $this->changePasswordTokenValidity = $changePasswordTokenValidity;
    }

    /**
     * @return mixed
     */
    public function getCommentairesEtude()
    {
        return $this->commentairesEtude;
    }

    /**
     * @param mixed $commentairesEtude
     */
    public function setCommentairesEtude($commentairesEtude): void
    {
        $this->commentairesEtude = $commentairesEtude;
    }

    /**
     * @return mixed
     */
    public function getCommentairesActu()
    {
        return $this->commentairesActu;
    }

    /**
     * @param mixed $commentairesActu
     */
    public function setCommentairesActu($commentairesActu): void
    {
        $this->commentairesActu = $commentairesActu;
    }

    /**
     * @return string
     */
    public function getChangePasswordToken(): string
    {
        return $this->changePasswordToken;
    }

    /**
     * @param string $changePasswordToken
     */
    public function setChangePasswordToken(string $changePasswordToken): void
    {
        $this->changePasswordToken = $changePasswordToken;
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


    /**
     * @return \DateTime
     */
    public function getDateRegister(): \DateTime
    {
        return $this->dateRegister;
    }

    /**
     * @param \DateTime $dateRegister
     */
    public function setDateRegister(\DateTime $dateRegister): void
    {
        $this->dateRegister = $dateRegister;
    }

    /**
     * @return bool
     */
    public function isEmailConfirmed(): bool
    {
        return $this->emailConfirmed;
    }

    /**
     * @param bool $emailConfirmed
     */
    public function setEmailConfirmed(bool $emailConfirmed): void
    {
        $this->emailConfirmed = $emailConfirmed;
    }

    /**
     * @return string
     */
    public function getConfirmationToken(): string
    {
        return $this->confirmationToken;
    }

    /**
     * @param string $confirmationToken
     */
    public function setConfirmationToken(string $confirmationToken): void
    {
        $this->confirmationToken = $confirmationToken;
    }

    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getisActive()
    {
        return $this->isActive;
    }

    /**
     * @param mixed $isActive
     */
    public function setIsActive($isActive): void
    {
        $this->isActive = $isActive;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getSalt()
    {
// you *may* need a real salt depending on your encoder
// see section on salt below
        return null;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
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
     * Returns the roles or permissions granted to the user for security.
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantees that a user always has at least one role for security
        if (empty($roles)) {
            $roles[] = 'ROLE_USER';
        }
        return array_unique($roles);
    }
    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    public function eraseCredentials()
    {
    }

    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->isActive;
    }


}