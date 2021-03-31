<?php

namespace App\Entity;

use App\Repository\PersonneRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PersonneRepository::class)
 * @UniqueEntity(
 *     fields={"email"},
 *     message="adresse mail deja utilisee !"
 * )
 */
class Personne implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups ("post:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Nom is required")
     * @Groups ("post:read")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Prenom is required")
     * @Groups ("post:read")
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Sexe is required")
     * @Groups ("post:read")
     */
    private $sexe;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Age is required")
     * @Assert\Positive(message="numero negatif ")
     * @Groups ("post:read")
     */
    private $age;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="Birthddate is required")
     * @Assert\LessThan("today")
     * @Groups ("post:read")
     */
    private $dateNaissance;


    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Telephone is required")
     * @Groups ("post:read")
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Adresse is required")
     * @Groups ("post:read")
     */
    private $adresse;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="Inscription Date is required")
     * @Groups ("post:read")
     * @Assert\EqualTo("today")
     */
    private $dateInscription;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="password is required")
     * @Groups ("post:read")
     * @Assert\Length(min="4",minMessage="minimum 4 caracteres")
     */
    private $password;

    /**
     * @Assert\NotBlank(message="confirm your password")
     * @Groups ("post:read")
     * @Assert\EqualTo(propertyPath="password",message="different password")
     */
    public $confirm_password;

    /**
     * @Assert\NotBlank(message="username is require")
     * @Groups ("post:read")
     * @ORM\Column(type="string", length=255)
     */
    private $username;


    /**
     * @Groups ("post:read")
     * @ORM\Column(type="json")
     */
    private $roles = [];
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Email is required")
     * @Assert\Email(message="verifier la syntaxe ")
     * @Groups ("post:read")
     */
    private $email;

    /**
     * One Profil has One Personne.
     * @ORM\OneToOne(targetEntity="App\Entity\Profil", mappedBy="personne")
     */
    private $profil;


    public function getId(): int
    {
        return (int) $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
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

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->dateInscription;
    }

    public function setDateInscription(\DateTimeInterface $dateInscription): self
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getProfil(): ?Profil
    {
        return $this->profil;
    }

    public function setProfil(?Profil $profil): self
    {
        // unset the owning side of the relation if necessary
        if ($profil === null && $this->profil !== null) {
            $this->profil->setPersonne(null);
        }

        // set the owning side of the relation if necessary
        if ($profil !== null && $profil->getPersonne() !== $this) {
            $profil->setPersonne($this);
        }

        $this->profil = $profil;

        return $this;
    }


}
